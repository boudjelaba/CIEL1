# Dossier technique (Compte rendu) – Séquence de 5 travaux pratiques

Tout au long de cette séquence, vous constituerez un **dossier technique individuel**, enrichi progressivement à l'issue de chaque TP.

Ce dossier devra témoigner de votre compréhension de l'infrastructure étudiée, de son fonctionnement et des choix techniques réalisés.

Pour chaque TP, vous devrez :

- Présenter brièvement les objectifs et les éléments techniques étudiés.
- Sélectionner les manipulations et résultats les plus significatifs.
- Expliquer les mécanismes techniques essentiels.
- Illustrer votre travail avec quelques captures d'écran, extraits de configuration ou schémas pertinents.
- Analyser les résultats obtenus et répondre aux questions de synthèse.
- Établir, lorsque cela est pertinent, des liens avec les TP précédents.

### Consignes de rédaction

- Les explications doivent être personnelles et rédigées avec vos propres mots.
- Les commandes importantes doivent être accompagnées d'une explication de leur rôle.
- Les captures d'écran doivent être lisibles, sélectionnées et commentées.
- Les schémas doivent comporter un titre et des légendes.
- Les résultats doivent être interprétés et ne pas être simplement reproduits.

Il n'est pas demandé de recopier l'ensemble des manipulations réalisées pendant les TP. Vous devez sélectionner les éléments qui permettent de démontrer votre compréhension.

### Rendu final

Le dossier complet sera remis à l'issue du TP5.

Il devra comporter une conclusion générale présentant l'évolution de l'infrastructure, les principales difficultés rencontrées, les choix techniques effectués et les mesures mises en œuvre pour assurer son fonctionnement et sa sécurité.

**L'évaluation portera sur la compréhension technique, la pertinence des preuves apportées, la qualité de l'analyse et la capacité à établir des liens entre les cinq TP.**

---

## TP1 – Création et fonctionnement du service HTTP

Compte rendu demandé :

1. Présentation du service
   - Rôle de l'application Flask.
   - Page HTML affichée à la racine et routes JSON `/api/status` et `/api/user/<name>`.
   - Différence entre le contenu HTML et les données JSON.
   - Rôle de l'adresse `127.0.0.1` et du port `5000`.

2. Fonctionnement et vérifications
   - Démarrage du serveur et vérification de son fonctionnement.
   - Présentation d'une requête réalisée avec `curl` ou un navigateur.
   - Identification du processus à l'écoute sur le port 5000.
   - Comparaison des réponses HTTP 200 et 404.

3. Compréhension technique
   - Expliquer le rôle du processus serveur, du port TCP et de l'adresse IP d'écoute dans la mise à disposition d'un service réseau.
   - Expliquer pourquoi une réponse 404 prouve que le serveur a été contacté.

Répondre aux questions de synthèse du TP.

Illustrations demandées :

- Une capture du serveur en fonctionnement.
- Une capture de vérification du port.
- Un exemple de réponse HTTP commenté.

---

## TP2 – Analyse des communications TCP/HTTP

Compte rendu demandé :

1. Observation d'une communication
   - Interface réseau et filtre utilisés.
   - Adresses IP et ports source et destination.
   - Identification du client et du serveur.

2. Analyse des protocoles
   - Présenter les trois étapes du 3-way handshake TCP.
   - Expliquer le rôle de SYN, SYN/ACK et ACK.
   - Expliquer le rôle du port éphémère.
   - Identifier une requête HTTP et sa réponse.
   - Utiliser les outils de développement du navigateur pour observer les requêtes de la page et des routes API.
   - Comparer les types de contenu HTML et JSON, GET et POST ainsi que les réponses 404 et 405.

3. Synthèse
   - Compléter un tableau associant HTTP, TCP et IP à leur couche OSI de référence.
   - Expliquer brièvement comment ces protocoles interviennent dans une communication.

Répondre aux questions de synthèse.

Illustrations demandées :

- Une capture annotée du 3-way handshake.
- Une capture annotée d'un échange HTTP.

---

## TP3 – Conteneurisation et persistance des données

Compte rendu demandé :

1. Création et fonctionnement du conteneur
   - Rôle du Dockerfile et de ses principales instructions.
   - Différence entre image et conteneur.
   - Construction et lancement du conteneur.
   - Localisation du processus Python.

2. Réseau et publication des ports
   - Expliquer le mapping entre le port de l'hôte et celui du conteneur.
   - Expliquer la différence entre `127.0.0.1` et `0.0.0.0`.
   - Présenter le rôle du réseau bridge.
   - Expliquer comment deux conteneurs peuvent utiliser le même port interne.

3. Persistance des données
   - Présenter le bind mount `logs` et son rôle.
   - Expliquer pourquoi les journaux stockés dans le dossier de l'hôte restent disponibles après la suppression du conteneur.
   - Vérifier que la page HTML et les routes JSON des TP précédents fonctionnent dans le conteneur.

4. Schéma d'architecture : Représenter la machine hôte, les conteneurs, les ports publiés, le réseau Docker et le volume de données.

Répondre aux questions de synthèse.

Illustrations demandées :

- Un extrait commenté du Dockerfile.
- Une vérification des conteneurs et des ports.
- Une vérification de la persistance des données.
- Un schéma d'architecture.

---

## TP4 – Orchestration des services avec Docker Compose

Compte rendu demandé :

1. Présentation de l'architecture
   - Rôle de Flask et PostgreSQL.
   - Intérêt de séparer les services dans deux conteneurs.
   - Schéma de l'architecture et des communications.

2. Orchestration et communication
   - Rôle de Docker Compose.
   - Présentation des principales directives du fichier `docker-compose.yml`.
   - Rôle du nom de service dans la résolution DNS.
   - Explication de la communication entre Flask et PostgreSQL.

3. Disponibilité et persistance
   - Rôle du `healthcheck` et de `depends_on`.
   - Fonctionnement du volume nommé `pgdata`.
   - Différence entre `docker compose down` et `docker compose down -v`.

4. Interface, configuration et sécurité
   - Expliquer comment le template Jinja2 affiche des valeurs transmises par Python.
   - Présenter la séparation entre routes, modèles et présentation.
   - Vérifier que `/api/status`, `/api/user/<name>` et les routes JSON étudiants sont toujours accessibles.
   - Rôle des variables d'environnement.
   - Intérêt de ne pas exposer PostgreSQL directement sur l'hôte.
   - Intérêt de séparer les services applicatifs et les services de stockage.

Répondre aux questions de synthèse.

Illustrations demandées :

- Un extrait commenté du fichier Compose.
- Un schéma d'architecture.
- Une preuve de communication entre Flask et PostgreSQL.
- Une preuve de persistance après redémarrage.

---

## TP5 – Réseaux Docker et segmentation

Compte rendu demandé :

1. Tableau de bord et architecture réseau
   - Présenter l'état de l'application et de PostgreSQL affiché dans le tableau de bord.
   - Présenter la liste des étudiants et les entrées du journal visibles dans la page.
   - Vérifier que les routes API des TP précédents répondent toujours en JSON.
   - Rôle des réseaux `frontend` et `backend`.
   - Justification du raccordement de Flask aux deux réseaux et de PostgreSQL au seul réseau backend.
   - Schéma présentant les conteneurs, les réseaux, les adresses IP et les sous-réseaux.

2. Communication entre conteneurs
   - Présentation des interfaces réseau et des principales routes.
   - Explication du rôle des interfaces `eth0`, `eth1` et `lo`.
   - Présentation de la résolution DNS de `postgres_db`.
   - Explication de la communication avec PostgreSQL sans publication du port 5432 sur l'hôte.

3. Analyse des communications
   - Différence entre le trafic HTTP et le trafic PostgreSQL.
   - Rôle des messages ICMP Echo Request et Echo Reply.
   - Identification du 3-way handshake TCP.
   - Limites de l'analyse du contenu des paquets.

4. Vérification de l'isolation
   - Présenter les résultats de la déconnexion du réseau backend. Expliquer ce que cette manipulation permet de démontrer concernant les possibilités de communication entre les conteneurs.
   - Expliquer les conséquences sur la communication avec PostgreSQL.
   - Présenter le test d'isolation du système de fichiers avec `test.txt`.

5. Mécanismes Linux. Compléter et commenter le tableau de synthèse concernant :
   - Namespaces.
   - Interfaces veth.
   - Bridge Linux.
   - iptables.
   - DNS interne Docker.

Répondre aux questions de synthèse.

Illustrations demandées :

- Un schéma de segmentation.
- Une observation des interfaces réseau.
- Une preuve de résolution DNS.
- Une capture d'un échange TCP.
- Une comparaison avant et après déconnexion du backend.
- Une capture du tableau de bord avec l'état des services et les dernières entrées du journal.

---

## Exigences de présentation

Le rapport devra comporter :

- Une page de garde.
- Un sommaire.
- Une organisation claire par TP.
- Des captures et schémas numérotés et légendés.
- Une conclusion générale personnelle.

Les observations doivent être issues de vos propres manipulations. Les captures doivent être sélectionnées et commentées : elles ne doivent pas simplement illustrer une commande.

Le rapport doit être rédigé avec un vocabulaire technique précis et une présentation professionnelle.

### Nombre de captures et de schémas

| TP | Captures d'écran | Schémas |
| --- | --- | --- |
| TP1 | 3 | 0 |
| TP2 | 2 | 0 |
| TP3 | 3 | 1 |
| TP4 | 3 | 1 |
| TP5 | 5 | 1 |

Il s'agit de maxima indicatifs, et non d'une obligation de remplir un quota.

### Grille d'évaluation

| Critère | Points |
| --- | --- |
| Compréhension des notions techniques | 6 |
| Pertinence des manipulations et résultats présentés | 4 |
| Analyse et interprétation | 4 |
| Qualité des illustrations et schémas | 3 |
| Qualité de la rédaction et rigueur technique | 3 |
| Total | 20 |
