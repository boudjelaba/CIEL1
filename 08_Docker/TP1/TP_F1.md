# TP1 – Développement d’un service HTTP avec Flask

**Durée :** ≈ 30 min

**Prérequis :** 

* Bases de Python (fonctions, dictionnaires)
* Notions d'algorithmique 
* Usage d'un terminal

**Notions abordées :** 

* Service HTTP, route, route dynamique (`<name>`)
* Processus / port TCP / interface d'écoute (127.0.0.1)
* Méthode HTTP GET, codes 200 et 404
* Environnement virtuel Python (`venv`)

**Compétences :** 

* **C08 — Coder** (développement d'un composant logiciel) ; 
* **C10 — Exploiter** (identification d'un service en écoute). 
    * Activité D2
        * Tâches D2-T3 et D2-T4.

## Objectifs

* Comprendre qu'un service réseau = processus + port + interface
* Afficher une page HTML avec Flask et tester les routes API au navigateur et avec `curl`
* Distinguer une réponse HTML d’une réponse JSON
* Lire les principaux codes HTTP (200, 404) et distinguer erreur applicative et erreur réseau
* Utiliser `curl`
* Repérer un port TCP en écoute (`ss`, `netstat`)

---

## 1. Préparation du projet

### 1.1. Important

> Après chaque modification du code :
>
> 1. Arrêter le serveur (`CTRL + C`)
> 2. Relancer : `python src/app.py`

### 1.2 Arborescence

Créer le dossier suivant :

```
TP_Flask_HTTP/
│
├── requirements.txt
└── src/
    ├── app.py
    └── templates/
        └── index.html
```

### 1.3. Fichier `requirements.txt`

```text
Flask>=3.0.0
```

### 1.4. Fichier `src/app.py`

Créer `src/app.py` :

```python
from flask import Flask, jsonify, render_template

app = Flask(__name__)

@app.route("/")
def home():
    return render_template("index.html")

@app.route("/api/status")
def status():
    return jsonify({"status": "OK"})

@app.route("/api/user/<name>")
def user(name):
    return jsonify({
        "name": name,
        "role": "student"
    })

if __name__ == "__main__":
    app.run(host="127.0.0.1", port=5000)
```

* `127.0.0.1` = localhost
* `5000` = port du service

Créer `src/templates/index.html` :

```html
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Première page Flask</title>
</head>
<body>
    <h1>Bienvenue</h1>
    <p>Cette page HTML est envoyée par l'application Flask.</p>
    <h2>Exemples de réponses JSON</h2>
    <ul>
        <li><a href="/api/status">État du service</a></li>
        <li><a href="/api/user/eleve">Profil d'un élève</a></li>
    </ul>
</body>
</html>
```

`render_template("index.html")` demande à Flask de charger le fichier dans `src/templates/` et de renvoyer son contenu comme page HTML. Les routes `/api/status` et `/api/user/<name>` restent des routes API et renvoient du JSON avec `jsonify()`.

> HTML décrit le contenu d'une page affichée par le navigateur. JSON représente des données structurées que le navigateur peut afficher ou qu'un autre programme peut traiter.

### 1.5. Environnement virtuel et installation

```bash
cd TP_Flask_HTTP
python -m venv .venv
```

Activation :

Linux / Mac :

```bash
source .venv/bin/activate
```

Windows :

```bash
.venv\Scripts\activate
# OU
.\.venv\Scripts\Activate.ps1
```

OU

Dans l’invite de commandes Windows, utiliser `.venv\Scripts\activate.bat`. Si l’activation est bloquée par la stratégie du poste, utiliser directement `.venv\Scripts\python.exe` pour les commandes Python.

Installer les dépendances :

```bash
pip install -r requirements.txt
```

Attendu : installation sans erreur.

---

## 2. Lancement du service

Dans le terminal (avec `.venv` activé) :

```bash
python src/app.py
```

Vous devez voir :

```text
Running on http://127.0.0.1:5000
```

> Ne pas fermer ce terminal.

### 2.1. Tester avec le navigateur

Ouvrir un navigateur et aller sur :

```
http://127.0.0.1:5000
```

### 2.2. Tester les réponses HTML et JSON

À l'adresse `http://127.0.0.1:5000`, le navigateur affiche la page HTML. Cliquer sur les deux liens pour afficher les réponses JSON des routes API.

Ouvrir un **second terminal** (toujours dans le dossier du projet, avec `.venv` activé) :

```bash
curl http://127.0.0.1:5000
```

La commande affiche le code HTML reçu. Tester ensuite une route JSON :

```bash
curl http://127.0.0.1:5000/api/status
```

Sous Windows PowerShell, vous pouvez écrire `curl.exe` à la place de `curl` (par exemple `curl.exe http://127.0.0.1:5000`) afin d’utiliser le client curl et ses options.

**Question 1**

Quelle méthode HTTP est utilisée par défaut ?

<details>
<summary><strong>Réponse</strong>
</summary>

**GET**

* Un navigateur envoie une requête GET lorsqu’on tape une URL.
* `curl` utilise GET par défaut.

</details>

### 2.3. Analyse du fonctionnement réseau

L'application est maintenant :

* Un **processus**
* Écoutant sur le **port TCP 5000**
* Sur l’adresse **127.0.0.1**

Afficher les ports ouverts :

**Linux / Mac :**

```bash
netstat -an | grep 5000
# Ou
ss -ltnp | grep 5000
```

**Windows :**

```bash
netstat -an | findstr 5000
```

**Questions**

1. Quel est le numéro de port ?
2. Quelle est l’adresse IP d’écoute ?
3. Quel processus écoute sur ce port ?

<details>
<summary><strong>Réponses</strong>
</summary>

| Élément    | Réponse   |
| ---------- | --------- |
| Port       | 5000      |
| Adresse IP | 127.0.0.1 |
| Processus  | python    |

Un service réseau =

```text
Processus + Port + Interface réseau
```

Si un des trois manque → pas de service accessible.

</details>

### 2.4. Codes HTTP

Tester :

```bash
curl -i http://127.0.0.1:5000
```

Repérer :

```
HTTP/1.1 200 OK
```

**Question**

Que signifie 200 ?

<details>
<summary><strong>Réponse</strong>
</summary>

Succès. La requête a été traitée correctement.

</details>

Tester une route inexistante :

```bash
curl -i http://127.0.0.1:5000/test
```

**Question**

Pourquoi obtient-on 404 ?

<details>
<summary><strong>Réponse</strong>
</summary>

La route demandée n’existe pas dans l’application.

404 = erreur **applicative**, ce n’est PAS une erreur réseau.

</details>

### 2.5. Route dynamique

Tester :

```bash
curl http://127.0.0.1:5000/api/user/Carnus
```

**Questions**

1. Donner l’URL complète.
2. Que représente `<name>` dans la route ?

<details>
<summary><strong>Réponses</strong>
</summary>

URL complète :

```text
http://127.0.0.1:5000/api/user/Carnus
```

`<name>` représente :

Un **paramètre dynamique** transmis à la fonction.

URL → traitement serveur → réponse

</details>

---

## Conclusion

Un service réseau repose sur :

```
Processus + Port + Interface réseau
```

---

## Questions de compréhension (synthèse)

1. Citez les trois éléments indispensables à un service réseau accessible.
2. Pourquoi un code 404 n'est-il pas une « panne réseau » ?
3. Quelle est la différence entre l'adresse `127.0.0.1` et le port `5000` dans l'URL testée ?
4. Que renverrait `curl -X POST http://127.0.0.1:5000/api/status` ? (indice : la route n'autorise que GET — voir TP2.)

## Bilan 

Savoir :

- écrire et lancer un service HTTP minimal en Flask ;
- vérifier qu'un processus écoute sur un port et une interface donnés ;
- afficher une page HTML rendue par Flask et distinguer sa réponse des réponses JSON de l'API ;
- tester une API avec `curl` et interpréter les codes HTTP 200 et 404 ;
- distinguer une erreur applicative (404) d'un problème de connectivité.
