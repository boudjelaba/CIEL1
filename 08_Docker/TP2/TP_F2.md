# TP2 – Analyse réseau d’un service HTTP

**Durée :** ≈ 1 h

**Objectifs :** 

* Observer le fonctionnement réseau réel d'un service HTTP (Wireshark et outils de développement du navigateur)
* Identifier le 3-way handshake TCP (SYN, SYN/ACK, ACK)
* Relier HTTP, TCP et IP au modèle OSI
* Comprendre les ports éphémères et le code 405


**Prérequis :** 

* **TP1 terminé** (service Flask fonctionnel)
* Wireshark installé ; droits de capture sur l'interface loopback
* Notions de base d'adressage IP et de ports 

**Notions abordées :** 

* Capture et filtrage de trafic (`tcp.port == 5000`)
* 3-way handshake TCP, port éphémère côté client
* Méthodes HTTP, code 405 (Method Not Allowed)
* Réponses HTML et JSON observées dans les outils de développement
* Couches OSI 3 (IP), 4 (TCP), 7 (HTTP)

**Compétences :** 

* **C10 — Exploiter un réseau informatique** (analyse de trafic, outils réseau). 
	* Tâches D3-T1 (diagnostic) et exploration.

---

On observe maintenant ce qui se passe réellement sur le réseau.

Reprendre le projet du TP 1.

Modifier l’application :

```python
app.run(host="0.0.0.0", port=5000)
```

> **Remarque :** le passage de `127.0.0.1` (TP1) à `0.0.0.0` fait écouter le service sur **toutes** les interfaces, et non plus seulement la boucle locale.

Relancer l’application.

```bash
python src/app.py
```

> Ne pas fermer ce terminal.

## 1. Capture avec Wireshark

Interface :

* Linux → `lo`
* Mac → Loopback lo0,
* Windows → Loopback / NPCAP Loopback Adapter. La capture en direct nécessite que Npcap soit installé et que son pilote soit démarré ; cette préparation peut demander les droits administrateur. Si le poste ne l’autorise pas, utiliser une capture fournie ou la capture interne décrite au TP5.

Filtre :

```
tcp.port == 5000
```

Relancer :

```bash
curl http://127.0.0.1:5000/api/status
```

## 2. Observer le 3-way handshake TCP

Identifier (dans l'ordre) :

1. SYN
2. SYN/ACK
3. ACK

Puis :

4. Requête HTTP
5. Réponse HTTP

### Questions

1. IP source ?
2. IP destination ?
3. Port source ?
4. Port destination ?

<details>
<summary><strong>Réponses</strong>
</summary>

| Élément          | Valeur attendue           |
| ---------------- | ------------------------- |
| IP source        | 127.0.0.1                 |
| IP destination   | 127.0.0.1                 |
| Port source      | Port éphémère (ex: 53214) |
| Port destination | 5000                      |

</details>

5. Pourquoi le port source change-t-il à chaque requête ?

<details>
<summary><strong>Réponses</strong>
</summary>

Le système attribue un **port éphémère** pour chaque connexion client.

Un serveur écoute sur un port fixe.
Un client utilise un port temporaire.

</details>

## 3. Observer HTTP dans TCP

Utiliser l’option `-v` (verbose) :

```bash
curl -v http://127.0.0.1:5000/api/status
```

Identifier :

* La **méthode HTTP**
* Le **chemin**
* Le **protocole**

<details>
<summary><strong>Réponse</strong>
</summary>

On observe :

```
> GET /api/status HTTP/1.1
```

* **Méthode HTTP** : `GET`
* **Chemin demandé** : `/api/status`
* **Protocole utilisé** : `HTTP/1.1`

</details>

## 3.1. Observer les requêtes du navigateur

1. Ouvrir `http://127.0.0.1:5000` dans le navigateur.
2. Ouvrir les outils de développement (`F12` ou `Ctrl`+`Maj`+`I` sous Windows/Linux ; `Cmd`+`Option`+`I` sous macOS).
3. Choisir l'onglet **Réseau** (*Network*), effacer la liste puis recharger la page.
4. Cliquer sur les liens vers `/api/status` et `/api/user/eleve`.
5. Sélectionner chaque requête et relever son URL, son code HTTP et son type de contenu (*Content-Type*).

Comparer les résultats :

| Ressource | Type de contenu attendu | Rôle |
| --- | --- | --- |
| `/` | `text/html` | Page interprétée et affichée par le navigateur |
| `/api/status` | `application/json` | Données structurées de l'API |

Les outils du navigateur montrent les requêtes HTTP émises par une navigation normale. Wireshark continue de servir à observer les paquets TCP et HTTP sur l'interface réseau ; les outils de développement présentent en plus les URL et réponses de la page.

## 4. Forcer une autre méthode

```bash
curl -v -X POST http://127.0.0.1:5000/api/status
# OU
curl -X POST http://127.0.0.1:5000/api/status -v
```

### Question

Quel code HTTP est retourné ? Pourquoi ?

<details>
<summary><strong>Réponse</strong>
</summary>

**405 Method Not Allowed**

Pourquoi ?

La route Flask accepte uniquement GET.

| Code | Type d’erreur         |
| ---- | --------------------- |
| 404  | route inexistante     |
| 405  | méthode non autorisée |

</details>

## 5. Modèle OSI

HTTP fonctionne au-dessus de quel protocole ?

À quelles couches appartiennent :

| Protocole | Couche OSI |
| --------- | ---------- |
| HTTP      | ?          |
| TCP       | ?          |
| IP        | ?          |

<details>
<summary><strong>Réponse</strong>
</summary>

HTTP fonctionne au-dessus de : → **TCP**

| Protocole | Couche          |
| --------- | --------------- |
| HTTP      | 7 (Application) |
| TCP       | 4 (Transport)   |
| IP        | 3 (Réseau)      |

</details>

Pourquoi HTTP ne peut pas fonctionner sans TCP ?

<details>
<summary><strong>Réponse</strong>
</summary>

HTTP a besoin :

* d’un transport fiable
* d’un contrôle d’erreur
* d’une gestion de session

TCP fournit cela.

</details>

## Conclusion

Chaîne complète :

```
Application
↓
HTTP
↓
TCP
↓
IP
↓
Carte réseau
```

## Questions de compréhension (synthèse)

1. Dans quel ordre apparaissent les paquets d'ouverture d'une connexion TCP ?
2. Pourquoi le port source change-t-il à chaque requête alors que le port destination reste 5000 ?
3. Pourquoi HTTP ne peut-il pas fonctionner directement sur IP, sans TCP ?
4. Quelle différence de signification y a-t-il entre les codes 404 et 405 ?

## Bilan

Savoir :

- capturer et filtrer le trafic d'un service avec Wireshark ;
- identifier le 3-way handshake TCP et le situer dans l'échange HTTP ;
- comparer dans les outils du navigateur les réponses HTML et JSON ;
- placer HTTP, TCP et IP dans le modèle OSI ;
- expliquer le rôle d'un port éphémère et le sens du code 405.
