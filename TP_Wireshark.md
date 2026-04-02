# TP – Mini outil réseau avec Flask

## Objectif

* créer un environnement Python
* utiliser Flask (routes + templates)
* formulaire HTML
* récupération de données
* logique réseau simple (scan de ports)
* affichage de résultats

## Structure du projet

```
tp_reseau/
 ├── app.py
 ├── templates/
 │    ├── index.html
 │    └── result.html
 └── venv/
```

## PARTIE 1 — Mise en place

### 1. Créer le projet

Créer un dossier :

```bash
tp_reseau
```

Ouvrir avec VS Code.

### 2. Créer un environnement virtuel

Dans le terminal :

```bash
python -m venv venv
```

Activer :

* Linux :

```bash
source venv/bin/activate
```

* Windows :

```bash
venv\Scripts\activate
```

> Vérifier :

```
(venv)
```

### 3. Installer Flask

```bash
pip install flask
```

---

## PARTIE 2 — Application Flask

Créer `app.py` :

```python
from flask import Flask, render_template, request
import socket
import re

app = Flask(__name__)

# -----------------------------
# Validation IP
# -----------------------------
def is_valid_ip(ip):
    pattern = r"^\d{1,3}(\.\d{1,3}){3}$"
    if not re.match(pattern, ip):
        return False

    parts = ip.split(".")
    return all(0 <= int(part) <= 255 for part in parts)

# -----------------------------
# Scan de ports
# -----------------------------
def scan_ports(ip):
    ports_ouverts = []
    ports_a_tester = [21, 22, 80, 443, 3306]

    for port in ports_a_tester:
        try:
            sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
            sock.settimeout(0.5)

            result = sock.connect_ex((ip, port))
            if result == 0:
                ports_ouverts.append(f"{port}/tcp ouvert")

            sock.close()

        except Exception:
            pass

    return ports_ouverts

# -----------------------------
# Routes
# -----------------------------
@app.route("/")
def index():
    return render_template("index.html")

@app.route("/scan", methods=["POST"])
def scan():
    ip = request.form.get("ip")

    if not ip:
        return "Veuillez entrer une adresse IP"

    if not is_valid_ip(ip):
        return "Adresse IP invalide"

    ports = scan_ports(ip)

    return render_template("result.html", ip=ip, ports=ports)

# -----------------------------
if __name__ == "__main__":
    app.run(debug=True)
```

Lancer :

```bash
python app.py
```

> Ouvrir :
[http://127.0.0.1:5000](http://127.0.0.1:5000)

---

## Interface HTML

### Créer `templates/index.html` :

```html
<!DOCTYPE html>
<html>
<head>
    <title>Scanner réseau</title>
</head>
<body>

<h1>Scanner une machine</h1>

<form action="/scan" method="post">
    <input type="text" name="ip" value="127.0.0.1">
    <button type="submit">Scanner</button>
</form>

</body>
</html>
```

### Créer `templates/result.html`

```html
<!DOCTYPE html>
<html>
<head>
    <title>Résultat</title>
</head>
<body>

<h1>Résultat du scan</h1>

<p>IP scannée : {{ ip }}</p>

{% if ports %}
    <ul>
    {% for port in ports %}
        <li>{{ port }}</li>
    {% endfor %}
    </ul>
{% else %}
    <p>Aucun port ouvert trouvé</p>
{% endif %}

<a href="/">Retour</a>

</body>
</html>
```

---

## MODE 1 — Analyse réseau avec Wireshark

### Objectifs

* visualiser des échanges réseau réels
* comprendre HTTP
* faire le lien avec ton app Flask

### 1. Lancer l'application Flask

```bash
python app.py
```

### 2. Ouvrir Wireshark

* Choisir l’interface réseau (LoopBack, Wi-Fi ou Ethernet)

### 3. Démarrer la capture

### 4. Filtrer uniquement ton app Flask

Dans la barre de filtre :

```
tcp.port == 5000
```

### 5. Générer du trafic

* Ouvrir navigateur
* Aller sur :

```
http://127.0.0.1:5000
```

* Faire un scan

### 6. Observer

Cliquer sur un paquet HTTP :

Chercher :

* méthode **GET / POST**
* IP source : `127.0.0.1`
* port 5000
* contenu de la requête

---

## MODE 2 — Analyse avec fichier `.pcap`

### Fichier fourni `capture_http.pcap`

Nom : `flask_capture.pcap`

A générer :

1. Lancer Flask
2. Lancer Wireshark
3. Filtrer :

```
tcp.port == 5000
```

4. Naviguer sur l'app
5. Sauvegarder le fichier

### 1. Ouvrir la capture

* Lancer Wireshark
* Fichier → Ouvrir → `flask_capture.pcap`

### 2. Observer les paquets

* Colonnes : IP source / destination / protocole

### 3. Filtrer le trafic HTTP

Dans la barre de filtre :

```
http
```

OU

```
tcp
```

OU 'si trop de trafic'

```
ip.addr == 127.0.0.1
```

### 4. Analyser une requête

Cliquer sur un paquet → chercher :

* **Méthode HTTP** (GET / POST)
* **Host** : `127.0.0.1:5000`
* chemin : `/` ou `/scan`
* **User-Agent**

### 5. Questions

* Quelle est l’adresse IP du client ?
* Quel port est utilisé par le serveur ?
* Quelle méthode HTTP est utilisée ?

* Quelle URL est appelée ?
* Combien de requêtes sont envoyées ?
