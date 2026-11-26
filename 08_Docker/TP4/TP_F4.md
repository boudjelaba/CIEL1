# TP 4 - Déployer une API professionnelle multi-conteneurs

**Durée :** ≈ 1 h 

**Objectifs :** 

* Déployer une application **multi-conteneurs** avec Docker Compose
* Faire communiquer une API Flask et une base PostgreSQL
* Utiliser des variables d'environnement pour la configuration
* Mettre en place un volume PostgreSQL persistant
* Comprendre `depends_on` + `healthcheck`

**Prérequis :** 

* **TP3 terminé** (image, conteneur, volume, mapping de ports)
* Notions de base de données relationnelle et de SQL (SELECT)
* Lecture conseillée : `COURS_DOCKER.md`, parties 5 à 7

**Compétences :** 

* **C09 — Installer** (architecture multi-conteneurs) ; 
* **C08 — Coder** (API + ORM) ; 
* **C10 — Exploiter** (volumes, logs). Notions de sécurité d'infrastructure. 
    * Activité D2, tâches D2-T1, D2-T3.

---

## Contexte professionnel

Vous devez déployer une API de gestion d’étudiants.

Contraintes :

* Exposer un service HTTP
* Stocker les données en base PostgreSQL
* Fonctionner dans un environnement isolé
* Être redémarrable sans perte de données
* Sécuriser l’architecture réseau

Architecture cible :

```
Client
   ↓
Service HTTP (API Flask)
   ↓
Base PostgreSQL
   ↓
Volume persistant
   ↓
Réseau Docker isolé
```
---

## 1. Structure du projet

Cette version reprend le service Flask des TP1 à TP3 et le réorganise en package pour séparer les routes, les modèles et les templates. Les routes `/api/status` et `/api/user/<name>` sont conservées ; les routes `/students` ajoutent la gestion des étudiants. La page `/` reste l'interface HTML.

```text
student_api_project/
│
├── src/
│   └── app/
│       ├── __init__.py
│       ├── routes.py
│       ├── models.py
│       └── templates/
│           └── index.html
│
├── run.py
├── requirements.txt
├── logs/
├── Dockerfile
├── docker-compose.yml
├── .dockerignore
└── .gitignore
```

### `requirements.txt`

```text
Flask==3.0.0
Flask-SQLAlchemy==3.1.1
psycopg2-binary==2.9.9
SQLAlchemy==2.0.20
```

### `src/app/__init__.py`

La route `/` affiche une page HTML. La réponse JSON `/api/status` du TP1–TP3 est conservée telle quelle. L'ancien message d'accueil JSON du TP4 est disponible sur `/api/student-status`.

```python
import logging
import os

from flask import Flask, jsonify, render_template

from .models import Student, db
from .routes import student_bp


def create_app():
    os.makedirs("logs", exist_ok=True)
    logging.basicConfig(
        filename="logs/log.txt",
        level=logging.INFO,
        format="%(asctime)s - %(message)s"
    )

    app = Flask(__name__)

    app.config["SQLALCHEMY_DATABASE_URI"] = (
        f"postgresql://{os.getenv('POSTGRES_USER')}:{os.getenv('POSTGRES_PASSWORD')}"
        f"@postgres_db:5432/{os.getenv('POSTGRES_DB')}"
    )
    app.config["SQLALCHEMY_TRACK_MODIFICATIONS"] = False

    db.init_app(app)
    app.register_blueprint(student_bp)

    @app.route("/")
    def home():
        students = Student.query.order_by(Student.id).all()
        logging.info("Page d'accueil consultée")
        return render_template(
            "index.html",
            service_status="Application Flask en ligne",
            database_status="PostgreSQL connecté",
            students=students
        )

    @app.route("/api/status")
    def status():
        return jsonify({"status": "OK"})

    @app.route("/api/student-status")
    def student_status():
        return jsonify({"status": "ok", "message": "API Student Running"})

    @app.route("/api/user/<name>")
    def user(name):
        return jsonify({"name": name, "role": "student"})

    with app.app_context():
        db.create_all()

    return app
```

### `src/app/routes.py`

Les routes d'étudiants conservent leurs réponses JSON. Les URL `/students` et `/students/` sont acceptées.

```python
import logging

from flask import Blueprint, jsonify, request

from .models import Student, db

student_bp = Blueprint("student_bp", __name__, url_prefix="/students")

@student_bp.route("", methods=["GET"])
@student_bp.route("/", methods=["GET"])
def list_students():
    students = Student.query.order_by(Student.id).all()
    result = [
        {"id": student.id, "name": student.name, "email": student.email}
        for student in students
    ]
    logging.info("Liste des étudiants consultée")
    return jsonify(result)

@student_bp.route("", methods=["POST"])
@student_bp.route("/", methods=["POST"])
def add_student():
    data = request.get_json()

    if not data or not data.get("name") or not data.get("email"):
        return jsonify({"error": "Invalid data"}), 400

    student = Student(name=data["name"], email=data["email"])
    db.session.add(student)
    db.session.commit()
    logging.info("Étudiant ajouté")

    return jsonify({"message": "Student added"}), 201
```

### `src/app/models.py`

```python
from flask_sqlalchemy import SQLAlchemy

db = SQLAlchemy()

class Student(db.Model):
    __tablename__ = "students"

    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(50), nullable=False)
    email = db.Column(db.String(100), nullable=False)
```

### `src/app/templates/index.html`

Le template reçoit les valeurs de `home()` et les affiche avec les expressions `{{ ... }}`. Les blocs `{% ... %}` permettent de parcourir la liste d'étudiants.

```html
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Application Flask — TP4</title>
</head>
<body>
    <h1>Application de gestion des étudiants</h1>
    <h2>État des services</h2>
    <p>Application : {{ service_status }}</p>
    <p>Base de données : {{ database_status }}</p>
    <h2>Étudiants ({{ students|length }})</h2>
    {% if students %}
    <ul>
        {% for student in students %}
        <li>{{ student.name }} — {{ student.email }}</li>
        {% endfor %}
    </ul>
    {% else %}
    <p>Aucun étudiant enregistré.</p>
    {% endif %}
    <h2>Routes API</h2>
    <ul>
        <li><a href="/api/status">État JSON conservé</a></li>
        <li><a href="/api/student-status">Message d'état TP4 en JSON</a></li>
        <li><a href="/api/user/eleve">Profil JSON</a></li>
        <li><a href="/students">Liste JSON des étudiants</a></li>
    </ul>
</body>
</html>
```

### `run.py`

```python
import os
from src.app import create_app

app = create_app()

if __name__ == "__main__":
    app.run(
        host="0.0.0.0",
        port=5000,
        debug=os.getenv("FLASK_DEBUG", "False") == "True"
    )
```

### `Dockerfile`

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

### `docker-compose.yml`

```yaml
services:
  flask_api:
    build: .
    container_name: flask_api
    ports:
      - "5000:5000"
    volumes:
      - ./logs:/app/logs
    environment:
      POSTGRES_USER: admin
      POSTGRES_PASSWORD: admin
      POSTGRES_DB: students_db
    depends_on:
      postgres_db:
        condition: service_healthy

  postgres_db:
    image: postgres:15
    container_name: postgres_db
    environment:
      POSTGRES_USER: admin
      POSTGRES_PASSWORD: admin
      POSTGRES_DB: students_db
    volumes:
      - pgdata:/var/lib/postgresql/data
    # Exposé uniquement pour test local
    ports:
      - "5432:5432"
    healthcheck:
      test: ["CMD-SHELL", "pg_isready -U admin -d students_db"]
      interval: 5s
      timeout: 5s
      retries: 5

volumes:
  pgdata:
```

### `.dockerignore`

```
.venv
__pycache__
.git
.gitignore
logs
```

### `.gitignore`

```
.venv
__pycache__
*.pyc
*.pyo
*.pyd
*.sqlite3
*.log
```

---

## 2. Environnement virtuel (Optionnel) 

Créer un environnement Python local pour tester le projet hors Docker :

```bash
python -m venv .venv
source .venv/bin/activate   # Linux/macOS
.venv\Scripts\activate      # Windows
# .\.venv\Scripts\Activate.ps1  # Windows PowerShell ; en CMD : .venv\Scripts\activate.bat

# Installer les dépendances du projet
pip install -r requirements.txt
```

* `flask` → pour l’API web
* `psycopg2-binary` → pour se connecter à PostgreSQL

> Vérifier :
>
> ```bash
> pip list | grep -E "Flask|psycopg2"
> ```

## 3. Lancement

Ouvrir `Docker Desktop`

Vérifications Docker / Compose (dans un terminal) :

```bash
docker info
```

* Construire l’image et lancer les conteneurs test (Lancer Docker / PostgreSQL / Flask) :

```bash
docker compose down
docker compose up --build
```

* Vérifier les conteneurs actifs :

```bash
docker ps
```

* Vérifier la persistance de PostgreSQL (volume `pgdata`) :

```bash
docker volume ls
```

* Page HTML Flask disponible sur `http://localhost:5000`
* Route d'état TP1–TP3 conservée : `http://localhost:5000/api/status`
* Ancien message d'état TP4 : `http://localhost:5000/api/student-status`
* Endpoint étudiants : `http://localhost:5000/students` ou `/students/`
* PostgreSQL : port `5432` (local pour test)

## 4. Test API :

### Vérifier API

```bash
curl -i http://localhost:5000/
curl http://localhost:5000/api/status
# Renvoie : {"status": "OK"}
curl http://localhost:5000/api/student-status
# Renvoie : {"status": "ok", "message": "API Student Running"}
```

La route `/` affiche maintenant le template HTML. La réponse de `/api/status` des TP précédents reste inchangée ; l'ancien message JSON du TP4 est conservé sur `/api/student-status`. Les routes `/students` gardent leurs réponses JSON.

### Lister étudiants

```bash
curl http://localhost:5000/students
# Renvoie : [] renvoie un tableau JSON (vide au départ)
```

### Ajouter étudiant

```bash
curl -X POST http://localhost:5000/students \
     -H "Content-Type: application/json" \
     -d '{"name":"Carnus","email":"lycee@carnus.fr"}'
```

* Vérifier ajout :

```bash
curl http://localhost:5000/students
# [{"id":1,"name":"Carnus","email":"lycee@carnus.fr"}]
```

* **Vérifier les logs de l'application et le volume PostgreSQL**

    ```bash
    docker logs flask_api
    docker logs postgres_db
    ```

* **Tester la base (Vérifier PostgreSQL)**

    * Se connecter depuis un autre conteneur :

    ```bash
    docker exec -it postgres_db psql -U admin -d students_db
    ```

        * Tester les commandes suivantes :
            * `\dt` : pour voir les tables
            * `SELECT * FROM students;` : pour voir les enregistrements
            * ou une autre commande

## 5. Exercice : Persistance

1. Ajouter un étudiant

    ```bash
    curl -X POST http://localhost:5000/students \
         -H "Content-Type: application/json" \
         -d '{"name":"Exercice","email":"exercice@carnus.fr"}'
    ```

    ```bash
    curl http://localhost:5000/students
    ```

2. Faire :

    ```bash
    docker compose down # Arrêter SANS supprimer le volume
    docker compose up   # Relancer
    ```

3. Vérifier que l’étudiant existe toujours. Expliquer pourquoi.

    ```bash
    curl http://localhost:5000/students
    ```

4. Vérifier que le volume existe

    ```bash
    docker volume ls
    ```

    Résultat :

    ```text
    tp4_pgdata
    ```

    Inspecter :

    ```bash
    docker volume inspect tp4_pgdata
    ```

## 6. Remarques

* `logs/log.txt` est écrit dans le dossier `logs` monté depuis l'hôte ; le montage est conservé jusqu'au TP5
* `.dockerignore` pour `.venv`, `__pycache__`
* Volumes pour persistance PostgreSQL
* Variables d’environnement pour credentials

```bash
docker compose down -v
```

> Le `-v` supprime le volume `pgdata`.

* volume supprimé
* base recréée
* table vide

---

## 7. Notions sécurité

1. Pourquoi ne pas exposer le port PostgreSQL à l’internet public ?
2. Que se passe-t-il si l’on change `0.0.0.0` pour `127.0.0.1` dans Flask ?
3. Quel est l’intérêt d’un volume pour la DB ?

<details>
<summary><strong>Réponses</strong>
</summary>

* Exposition publique → risque de piratage
* `127.0.0.1` → service accessible seulement localement
* Volume → persistance des données
* 
</details>

---

## Questions de compréhension (synthèse)

1. À quoi sert `depends_on: condition: service_healthy` ? Que se passerait-il sans le `healthcheck` ?
2. Comment l'API retrouve-t-elle la base alors qu'aucune adresse IP n'est écrite en dur ?
3. Pourquoi les identifiants de la base sont-ils passés par variables d'environnement plutôt qu'écrits dans le code ?
4. Quelle est la différence entre `docker compose down` et `docker compose down -v` pour les données ?
5. Pourquoi est-il préférable de ne pas rendre PostgreSQL directement accessible depuis l'extérieur de l'infrastructure, alors que l'API Flask doit être accessible par le client ?

## Bilan 

Savoir :

- écrire un `docker-compose.yml` orchestrant plusieurs services ;
- configurer une application par variables d'environnement ;
- faire dialoguer une API et une base via le nom de service ;
- garantir la persistance d'une base avec un volume nommé ;
- synchroniser le démarrage des services avec `healthcheck` et `depends_on`.
