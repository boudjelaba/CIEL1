# Docker — Cours introductif

**BTS CIEL — Préparation aux TP3 à TP5**

## Objectifs

- Comprendre le fonctionnement de Docker.
- Construire une image à partir d'un Dockerfile.
- Créer, démarrer et administrer des conteneurs.
- Persister des données avec des volumes.
- Faire communiquer plusieurs conteneurs.
- Déployer une application multi-services avec Docker Compose.
- Appliquer les principales règles de sécurité.

---

## 1. Introduction à Docker

### 1.1 Pourquoi Docker ?

Une application Python nécessite un environnement précis : version de Python, bibliothèques, dépendances système et éventuellement une base de données.

Sans Docker, cet environnement doit être installé et configuré sur chaque machine. Cela peut entraîner des problèmes de compatibilité (« ça marche sur mon ordinateur, mais pas ailleurs »).

Un environnement virtuel Python (`venv`) isole les paquets Python, mais ne garantit pas l'identité de l'ensemble du système.

**Docker permet de conteneuriser une application**, c'est-à-dire de réunir son code et ses dépendances dans une image reproductible.

### 1.2 Conteneurisation et virtualisation

- **Machine virtuelle (VM)** : émule une machine complète avec son propre système d'exploitation et son noyau.
- **Conteneur** : isole une application et son environnement, tout en partageant le noyau du système hôte.

| Critère | Machine virtuelle | Conteneur |
| --- | --- | --- |
| Système d'exploitation | Complet | Partage le noyau hôte |
| Taille | Importante | Plus légère |
| Démarrage | Plus lent | Rapide |
| Isolation | Forte | Bonne, mais non absolue |

**Avantages de Docker :**

- Portabilité et reproductibilité.
- Isolation des applications.
- Démarrage rapide.
- Utilisation efficace des ressources.

**Limite importante :** un conteneur n'est pas une machine virtuelle et ne constitue pas, à lui seul, une garantie de sécurité.

---

## 2. Architecture et fonctionnement de Docker

Docker repose sur une architecture client/serveur.

| Composant | Rôle |
| --- | --- |
| Docker Client (`docker`) | Envoie les commandes |
| Docker Daemon (`dockerd`) | Construit les images et gère les conteneurs |
| Image | Modèle servant à créer des conteneurs |
| Conteneur | Instance d'une image |
| Registre | Dépôt d'images (ex. Docker Hub) |

Lorsqu'on exécute :

```bash
docker run python:3.12-slim
```

Docker :

1. Recherche l'image localement.
2. La télécharge depuis Docker Hub si nécessaire.
3. Crée un conteneur à partir de cette image.
4. Démarre le conteneur.

Docker s'appuie notamment sur les mécanismes du noyau Linux :

- **Namespaces** : isolation des processus, du réseau et du système de fichiers.
- **Cgroups** : contrôle des ressources (CPU, mémoire).

---

## 3. Images et conteneurs

### 3.1 Différence entre image et conteneur

- Une **image** est un modèle immuable contenant l'application et son environnement.
- Un **conteneur** est une instance créée à partir de cette image.

Une même image peut servir à créer plusieurs conteneurs indépendants.

### 3.2 Commandes essentielles

```bash
# Images
docker pull python:3.12-slim
docker images
docker build -t flask-api .

# Conteneurs
docker run -p 5000:5000 flask-api
docker ps
docker ps -a
docker logs <id>
docker stop <id>
docker start <id>
docker rm <id>
docker exec -it <id> bash
docker inspect <id>
```

**À retenir :**

- `docker ps` affiche les conteneurs actifs.
- `docker ps -a` affiche également les conteneurs arrêtés.
- `docker stop` arrête un conteneur sans le supprimer.
- `docker rm` supprime un conteneur.

Les données stockées uniquement dans un conteneur peuvent disparaître lorsqu'il est supprimé. Il faut donc utiliser des volumes pour les conserver.

---

## 4. Construire une image : le Dockerfile

### 4.1 Principe

Un `Dockerfile` est un fichier texte qui décrit les étapes de construction d'une image Docker.

| Instruction | Fonction |
| --- | --- |
| `FROM` | Choisir l'image de base |
| `WORKDIR` | Définir le répertoire de travail |
| `COPY` | Copier des fichiers |
| `RUN` | Exécuter une commande pendant la construction |
| `CMD` | Définir la commande de démarrage par défaut |
| `ENTRYPOINT` | Définir la commande principale |
| `EXPOSE` | Documenter un port utilisé |
| `ENV` | Définir une variable d'environnement |

Attention : `EXPOSE` ne publie pas réellement un port. C'est l'option `-p` de `docker run` qui rend un port accessible depuis l'hôte.

### 4.2 Exemple : conteneuriser une API Flask

```dockerfile
FROM python:3.12-slim

WORKDIR /app

COPY requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

COPY src/ /app/src/
COPY run.py /app/run.py

EXPOSE 5000

CMD ["python", "run.py"]
```

Construction et lancement :

```bash
docker build -t flask-api .
docker run -p 5000:5000 flask-api
```

L'API doit écouter sur :

```python
host="0.0.0.0"
```

et non sur `127.0.0.1`, afin d'être accessible depuis l'extérieur du conteneur.

**Remarque :** copier et installer les dépendances avant de copier le code applicatif. Docker peut ainsi réutiliser son cache lors des reconstructions.

### 4.3 Pages HTML, API JSON et templates

Une route Flask peut renvoyer une page HTML avec `render_template()` ou des données JSON avec `jsonify()`. Flask inclut Jinja2 : aucune dépendance supplémentaire n'est nécessaire.

```python
from flask import render_template

@app.route("/")
def home():
    return render_template("index.html", service_status="En ligne")
```

Le fichier `templates/index.html` contient le HTML. Jinja2 insère une valeur Python avec `{{ service_status }}` et peut parcourir une liste avec `{% for ... %}`. Dans un Dockerfile qui copie tout le dossier `src/`, les templates placés sous `src/` sont inclus dans l'image.

Les routes de l'interface et de l'API peuvent coexister : par exemple, `/` renvoie du HTML et `/api/status` renvoie du JSON. Les routes API doivent rester accessibles lorsque l'interface évolue.

---

## 5. Persistance des données : volumes et bind mounts

### 5.1 Pourquoi utiliser des volumes ?

Un conteneur est éphémère : les données enregistrées dans son système de fichiers ne sont pas garanties après sa suppression.

Les volumes permettent de conserver les données indépendamment du cycle de vie des conteneurs.

### 5.2 Deux mécanismes

| Mécanisme | Fonction | Utilisation |
| --- | --- | --- |
| Volume nommé | Espace de stockage géré par Docker | Base PostgreSQL |
| Bind mount | Dossier de l'hôte monté dans le conteneur | Code source, fichiers et logs |

Exemple de bind mount :

```bash
mkdir -p logs
docker run -v ./logs:/app/logs flask-api
```

Exemple de volume nommé avec Compose :

```yaml
volumes:
  - pgdata:/var/lib/postgresql/data
```

### 5.3 Commandes importantes

```bash
docker volume ls
docker volume inspect pgdata
```

Avec Docker Compose :

```bash
docker compose down
```

Arrête et supprime les conteneurs, mais conserve les volumes.

```bash
docker compose down -v
```

Supprime également les volumes : **les données qu'ils contiennent sont perdues**.

**Note :** utiliser un volume nommé pour conserver les données PostgreSQL.

---

## 6. Réseaux Docker

### 6.1 Communication entre conteneurs

Docker permet de connecter plusieurs conteneurs à un même réseau virtuel.

Avec Docker Compose, les services peuvent communiquer en utilisant directement leur nom.

Exemple :

```text
flask_api → postgres_db:5432
```

L'API n'a donc pas besoin de connaître l'adresse IP de PostgreSQL : Docker assure la résolution du nom grâce à son DNS interne.

### 6.2 Ports et mapping

La commande :

```bash
docker run -p 8080:5000 flask-api
```

signifie :

- `8080` : port accessible sur la machine hôte.
- `5000` : port utilisé dans le conteneur.

Le port interne peut rester identique alors que le port externe change.

### 6.3 Segmentation des réseaux

Il est possible de créer plusieurs réseaux pour limiter les communications entre services.

Exemple :

```yaml
services:
  flask_api:
    networks:
      - frontend
      - backend

  postgres_db:
    networks:
      - backend

networks:
  frontend:
  backend:
```

Dans cet exemple :

- L'API est connectée aux deux réseaux.
- PostgreSQL est uniquement connecté au réseau interne `backend`.
- La base n'est pas directement accessible depuis le réseau externe.

Cette segmentation constitue une mesure de sécurité importante (TP5).

Commandes utiles :

```bash
docker network ls
docker network inspect bridge
```

---

## 7. Docker Compose

### 7.1 Principe

Docker Compose permet de décrire et de démarrer une application composée de plusieurs conteneurs à partir d'un fichier `docker-compose.yml`.

Il centralise notamment :

- Les services.
- Les images et leur construction.
- Les ports.
- Les variables d'environnement.
- Les volumes.
- Les réseaux.
- Les dépendances entre services.

### 7.2 Exemple : API Flask et PostgreSQL

```yaml
services:
  flask_api:
    build: .
    ports:
      - "5000:5000"
    environment:
      POSTGRES_USER: admin
      POSTGRES_PASSWORD: admin
      POSTGRES_DB: students_db
    depends_on:
      postgres_db:
        condition: service_healthy
    networks:
      - backend

  postgres_db:
    image: postgres:15
    environment:
      POSTGRES_USER: admin
      POSTGRES_PASSWORD: admin
      POSTGRES_DB: students_db
    volumes:
      - pgdata:/var/lib/postgresql/data
    healthcheck:
      test: ["CMD-SHELL", "pg_isready -U admin -d students_db"]
      interval: 5s
      timeout: 5s
      retries: 5
    networks:
      - backend

volumes:
  pgdata:

networks:
  backend:
```

### 7.3 Points importants

- `services` : liste des conteneurs.
- `build` : construction à partir d'un Dockerfile.
- `image` : utilisation d'une image existante.
- `ports` : publication des ports.
- `environment` : configuration par variables d'environnement.
- `volumes` : persistance des données.
- `networks` : communication entre services.
- `healthcheck` : vérification de l'état d'un service.
- `depends_on` : gestion des dépendances de démarrage.

Attention : `depends_on` seul ne garantit pas que la base est prête. L'association avec un `healthcheck` et `condition: service_healthy` permet d'attendre que le service soit opérationnel.

### 7.4 Commandes essentielles

```bash
docker compose up --build
docker compose up -d --build
docker compose ps
docker compose logs flask_api
docker compose exec flask_api bash
docker compose down
docker compose down -v
```

---

## 8. Bonnes pratiques et sécurité

### 8.1 Construire des images propres

- Utiliser des images légères (`python:3.12-slim`).
- Installer uniquement les dépendances nécessaires.
- Utiliser `pip install --no-cache-dir`.
- Créer un fichier `.dockerignore`.

Exemple :

```text
.venv
__pycache__
.git
logs
*.pyc
.env
```

Ce fichier évite d'intégrer inutilement des fichiers dans l'image.

### 8.2 Protéger les applications

Quelques règles essentielles :

- Ne jamais intégrer de mots de passe directement dans le code ou l'image.
- Utiliser des variables d'environnement pour la configuration.
- Ne pas versionner le fichier `.env`.
- Utiliser des mots de passe robustes.
- Ne pas exposer les ports inutiles.
- Segmenter les réseaux.
- Utiliser un compte PostgreSQL aux droits limités.
- Éviter d'exécuter l'application en root.
- Désactiver le mode debug en production.

### 8.3 Logs et nettoyage

Les logs permettent de surveiller une application et de détecter les incidents.

```bash
docker logs <id>
docker compose logs
```

Pour consulter les ressources :

```bash
docker system df
docker ps -a
docker volume ls
```

Pour nettoyer les ressources inutilisées :

```bash
docker system prune
```

**Attention :** les commandes de nettoyage avec suppression des volumes peuvent entraîner une perte définitive des données.

---

## 9. Synthèse et préparation aux TP

### 9.1 Les notions indispensables

| Notion | À retenir |
| --- | --- |
| Image | Modèle utilisé pour créer des conteneurs |
| Conteneur | Instance isolée d'une image |
| Dockerfile | Recette de construction d'une image |
| `docker build` | Construire une image |
| `docker run` | Créer et démarrer un conteneur |
| `-p` | Publier un port vers l'hôte |
| `0.0.0.0` | Écouter sur toutes les interfaces réseau |
| Volume | Conserver les données |
| Bind mount | Monter un dossier de l'hôte |
| Réseau Docker | Faire communiquer les conteneurs |
| DNS interne | Résoudre les noms des services |
| Docker Compose | Gérer plusieurs conteneurs |
| Healthcheck | Vérifier qu'un service est opérationnel |
| Segmentation | Limiter les communications réseau |
| HTML et JSON | Page affichée par le navigateur et données structurées d'une API |
| Jinja2 | Insérer des valeurs Python dans un template HTML |

### 9.2 Correspondance avec les TP

| TP | Notions principales | Compétences visées |
| --- | --- | --- |
| **TP1** | Première page HTML avec Flask, routes JSON, processus/port/interface, codes HTTP | C08 Coder, C10 Exploiter |
| **TP2** | Wireshark, outils réseau du navigateur, HTML et JSON, TCP, modèle OSI, code 405 | C10 Exploiter |
| **TP3** | Application des TP1–2 dans Docker, image, conteneur, ports, bridge, volume | C09 Installer, C08 Coder, C10 Exploiter |
| **TP4** | Templates Jinja2, séparation logique/présentation, Docker Compose, API + PostgreSQL | C09 Installer, C08 Coder, C10 Exploiter |
| **TP5** | Tableau de bord Flask, état et journaux, réseaux Docker, segmentation, analyse de trafic | C10 Exploiter, C09 Installer |

---

## 10. Notions complémentaires nécessaires aux TP

| Notion | TP concernés |
| --- | --- |
| Flask : routes, HTML et JSON | TP1 à TP5 |
| Templates Jinja2 | TP4 et TP5 |
| Flask-SQLAlchemy et application factory | TP4 à TP5 |
| SQL et PostgreSQL | TP4 à TP5 |
| Wireshark, tcpdump et TCP | TP2 et TP5 |

---

## 11. Référence des commandes Docker essentielles

Cette section rassemble les principales commandes Docker utilisées dans les travaux pratiques. Elle constitue un aide-mémoire pour consulter les conteneurs, gérer les images, manipuler les volumes et les réseaux, et utiliser Docker Compose.

### 11.1 Consulter et explorer les conteneurs

```bash
docker ps
```

Liste les conteneurs actuellement en cours d’exécution.

```bash
docker ps -a
```

Liste tous les conteneurs, y compris ceux qui sont arrêtés.

```bash
docker logs <id_ou_nom>
```

Affiche les journaux d’un conteneur.

```bash
docker logs -f <id_ou_nom>
```

Suit les journaux en temps réel, ce qui permet notamment d'observer les messages produits au démarrage d'une application.

```bash
docker inspect <id_ou_nom>
```

Affiche les informations détaillées d’un objet Docker, notamment d’un conteneur, au format JSON.


```bash
docker exec -it <id_ou_nom> bash
```

Ouvre un terminal interactif dans un conteneur en cours d'exécution.

Si `bash` n'est pas disponible dans l'image, utiliser plutôt :

```bash
docker exec -it <id_ou_nom> sh
```

### 11.2 Images et cycle de vie des conteneurs

| Commande | Explication |
| --- | --- |
| `docker pull <image>` | Télécharge une image depuis un registre, par exemple Docker Hub. |
| `docker images` | Liste les images présentes localement. |
| `docker build -t <nom> .` | Construit une image à partir du `Dockerfile` situé dans le répertoire courant. |
| `docker run -p 8080:5000 <image>` | Crée et démarre un conteneur. Le port `8080` de la machine hôte est redirigé vers le port `5000` du conteneur. La syntaxe est `HOST_PORT:CONTAINER_PORT`. |
| `docker run -d -p 8080:5000 <image>` | Crée et démarre un conteneur en arrière-plan (`-d` signifie _detached_). |
| `docker stop <id_ou_nom>` | Arrête un conteneur en cours d'exécution. |
| `docker start <id_ou_nom>` | Démarre un conteneur arrêté. |
| `docker rm <id_ou_nom>` | Supprime un conteneur arrêté. |
| `docker system df` | Affiche l'espace disque utilisé par les images, les conteneurs, les volumes et le cache de construction Docker. |
| `docker system prune` | Supprime les ressources Docker inutilisées : conteneurs arrêtés, réseaux inutilisés, images dangling et cache de construction. À utiliser avec prudence. Les volumes ne sont pas supprimés par défaut. |

**Note :** les commandes `docker rm` et `docker system prune` peuvent entraîner la suppression de ressources nécessaires à certains travaux pratiques.

### 11.3 Volumes et persistance des données

```bash
docker volume ls
```

Liste les volumes Docker existants.

```bash
docker volume inspect pgdata
```

Affiche les caractéristiques détaillées du volume `pgdata`, notamment son point de montage et ses informations de stockage.

Cette commande est particulièrement utile au TP4 pour vérifier la configuration du volume utilisé pour assurer la persistance des données de PostgreSQL.

| Commande | Explication |
| --- | --- |
| `docker volume ls` | Liste les volumes Docker existants. |
| `docker volume inspect <nom>` | Affiche les informations détaillées d'un volume. |
| `docker volume rm <nom>` | Supprime un volume non utilisé par un conteneur. |
| `docker volume prune` | Supprime les volumes locaux inutilisés. À utiliser avec prudence, car ils peuvent contenir des données persistantes. |

### 11.4 Réseaux Docker

```bash
docker network ls
```

Liste les réseaux Docker disponibles, y compris ceux créés automatiquement par Docker Compose.

```bash
docker network inspect backend
```

Affiche les caractéristiques du réseau `backend` : sous-réseau, passerelle et conteneurs connectés avec leurs adresses IP.

Cette commande permet de comprendre la segmentation réseau mise en place au TP5.

| Commande | Explication |
| --- | --- |
| `docker network ls` | Liste les réseaux Docker. |
| `docker network inspect <nom>` | Affiche les caractéristiques d'un réseau et les conteneurs qui y sont connectés. |
| `docker network inspect bridge` | Inspecte le réseau par défaut `bridge`. |

### 11.5 Commandes Docker Compose

| Commande | Explication |
| --- | --- |
| `docker compose up --build` | Construit ou reconstruit les images nécessaires, puis démarre les services définis dans le fichier Compose. |
| `docker compose up -d` | Démarre les services en arrière-plan. |
| `docker compose ps` | Affiche l'état des conteneurs du projet Compose. |
| `docker compose logs <service>` | Affiche les journaux d'un service. |
| `docker compose logs -f <service>` | Suit les journaux d'un service en temps réel. |
| `docker compose exec <service> bash` | Ouvre un terminal interactif dans un conteneur du service en cours d'exécution. |
| `docker compose down` | Arrête et supprime les conteneurs et les réseaux créés pour le projet. Par défaut, les volumes nommés sont conservés. |
| `docker compose down -v` | Supprime également les volumes nommés déclarés dans le fichier Compose et les volumes anonymes attachés aux conteneurs. Les données stockées dans ces volumes sont alors perdues. Les volumes externes ne sont pas supprimés. |

**Remarque :** les commandes `docker compose` s'exécutent depuis le répertoire contenant le fichier Compose, sauf si un autre fichier ou répertoire est explicitement indiqué.

### 11.6 Commandes à retenir

| Niveau | Commandes |
| --- | --- |
| Indispensables | `docker build`, `docker run`, `docker ps`, `docker stop` |
| À maîtriser pour les TP | `docker volume inspect`, `docker network inspect`, `docker compose exec` |
| À connaître pour le diagnostic | `docker logs`, `docker inspect`, `docker system df` |
| À utiliser avec prudence | `docker system prune`, `docker volume prune`, `docker compose down -v` |
