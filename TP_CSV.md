# TP : Exploitation de fichiers CSV et analyse de mesures réseau en Python

## Contexte 

Vous êtes **technicien réseau dans un lycée**.
Un outil de supervision a généré un fichier CSV contenant des mesures quotidiennes de performance réseau.

Votre mission est de :

* Identifier les anomalies réseau
* Analyser les performances par poste
* Générer automatiquement un rapport exploitable

## Objectifs

### Manipulation de fichiers CSV en Python standard

* Ouvrir un fichier en lecture
* Lire ligne par ligne
* Extraire et convertir des données
* Écrire un nouveau fichier CSV

### Utilisation de bibliothèques

* Utiliser le module `csv`
* Utiliser la bibliothèque `pandas`
* Filtrer des données
* Calculer des statistiques
* Générer des graphiques
* Exporter des résultats
* Générer un rapport HTML automatique

## Structure du dossier final

Le dossier doit être construit progressivement :

```
TP_CSV_ANALYSE_RESEAU/
│
├── README.txt
│
├── 📁 donnees/
│   └── mesures_reseau.csv
│
├── 📁 scripts/
│   ├── 01_lecture_simple.py
│   ├── 02_traitement_sans_module.py
│   ├── 03_module_csv.py
│   ├── 04_alertes_csv.py
│   ├── 05_analyse_pandas.py
│   ├── 06_statistiques_pandas.py
│   ├── 07_graphiques.py
│   ├── 08_generation_html.py
│   └── analyse_reseau.py
│
├── 📁 resultats/
│   ├── alertes_reseau.csv
│   ├── rapport_statistiques.csv
│   ├── rapport_final.csv
│   ├── graphique_latence.png
│   └── rapport.html
│
├── 📁 templates/
│   ├── rapport_template.html
│   └── style.css
│
└── 📁 consignes/
    └── enonce_TP.pdf
```

Tous les scripts sont exécutés depuis le dossier `/scripts`.

Les chemins devront donc utiliser :

```python
"../donnees/mesures_reseau.csv"
```

### Fichier CSV de données - `mesures_reseau.csv`

On travaille avec un fichier de mesures réseau dans un laboratoire informatique : `mesures_reseau.csv`

```csv
date,poste,ip,latence_ms,debit_mbps
2025-01-10,PC01,192.168.1.10,12,95
2025-01-10,PC02,192.168.1.11,25,72
2025-01-10,PC03,192.168.1.12,18,88
2025-01-11,PC01,192.168.1.10,15,91
2025-01-11,PC02,192.168.1.11,40,60
2025-01-11,PC03,192.168.1.12,22,80
2025-01-12,PC01,192.168.1.10,17,89
2025-01-12,PC02,192.168.1.11,42,58
2025-01-12,PC03,192.168.1.12,20,85
2025-01-13,PC01,192.168.1.10,50,55
2025-01-13,PC02,192.168.1.11,28,75
2025-01-13,PC03,192.168.1.12,19,90
2025-01-14,PC01,192.168.1.10,14,93
2025-01-14,PC02,192.168.1.11,35,68
2025-01-14,PC03,192.168.1.12,45,62
2025-01-15,PC01,192.168.1.10,13,94
2025-01-15,PC02,192.168.1.11,38,70
2025-01-15,PC03,192.168.1.12,23,82
2025-01-16,PC01,192.168.1.10,60,48
2025-01-16,PC02,192.168.1.11,30,73
2025-01-16,PC03,192.168.1.12,25,78
2025-01-17,PC01,192.168.1.10,18,88
2025-01-17,PC02,192.168.1.11,27,74
2025-01-17,PC03,192.168.1.12,21,86
```

**Règle d’anomalie (POUR TOUT LE TP)**

Une anomalie est détectée si :

* latence > 40 ms
  OU
* débit < 65 Mbps

Cette règle doit être utilisée dans toutes les parties.

### `README.txt`

```
TP : Analyse de mesures réseau en Python

Objectif :
Analyser un fichier CSV contenant des mesures réseau
et produire un rapport avec statistiques et graphiques.

Organisation :
- Les fichiers de données sont dans /donnees
- Les scripts Python sont dans /scripts
- Les fichiers générés doivent être placés dans /resultats

Important :
Toujours vérifier le dossier courant avant d'exécuter un script.
```

## PARTIE 1 — Lecture de CSV en Python standard

### 1. Lecture simple avec `open()`

Objectif :

* Ouvrir le fichier
* Afficher son contenu
* Fermer le fichier

Fichier : `01_lecture_simple.py`

Utiliser :

```python
open()
read()
close()
```

```python
fichier = open("../donnees/mesures_reseau.csv", "r")
contenu = fichier.read()
print(contenu)
fichier.close()
```

### 2. Lecture ligne par ligne

Fichier : `02_traitement_sans_module.py`

Objectifs :

* Ignorer l’en-tête
* Séparer les colonnes avec `split(",")`
* Convertir les valeurs numériques avec `int()`
* Afficher uniquement les anomalies
* Compter le nombre total d’anomalies

## 3. Utilisation du module `csv`

Fichier : `03_module_csv.py`

Objectifs :

* Utiliser `csv.reader`
* Afficher poste et débit uniquement
* Détecter et afficher les anomalies
* Compter les anomalies

```python
import csv

with open("../donnees/mesures_reseau.csv", newline='') as f:
    lecteur = csv.reader(f)
    for ligne in lecteur:
        print(ligne)
```

* Afficher uniquement le poste et le débit.
* Détection d’anomalies

    On considère qu’il y a anomalie si :

    * latence > 40 ms
      OU
    * débit < 65 Mbps

    1. Afficher uniquement les lignes correspondant à une anomalie.
    2. Compter le nombre total d’anomalies.

---

## PARTIE 2 — Génération d’un fichier d’alertes

Fichier : `04_alertes_csv.py`

Objectif :

Créer :

```
/resultats/alertes_reseau.csv
```

Contraintes :

* Conserver l’en-tête
* Respecter la règle d’anomalie
* Placer le fichier dans `/resultats`

Chemin de sortie :

```python
"../resultats/alertes_reseau.csv"
```

```python
import csv

with open("../donnees/mesures_reseau.csv", newline='') as entree:
    lecteur = csv.reader(entree)
    header = next(lecteur)

    with open("../resultats/alertes_reseau.csv"
, "w", newline='') as sortie:
        writer = csv.writer(sortie)
        writer.writerow(header)

        for ligne in lecteur:
            latence = int(ligne[3])
            debit = int(ligne[4])

            if latence > 40 or debit < 65:
                writer.writerow(ligne)
```

---

## PARTIE 3 — Introduction à pandas

Dans le monde professionnel, on utilise des bibliothèques spécialisées comme **pandas**

* Code plus lisible
* Gain de temps
* Outils statistiques intégrés

### 1. Installation

```bash
pip install pandas
```

### 2. Lecture du fichier

Fichier : `05_analyse_pandas.py`

```python
import pandas as pd

df = pd.read_csv("../donnees/mesures_reseau.csv")

print(df.head())
print(df.info())
```

Convertir la colonne date :

```python
df["date"] = pd.to_datetime(df["date"])
```

```python
import pandas as pd

df = pd.read_csv("../donnees/mesures_reseau.csv")
df.head()
df.info()
print(df)
```

### 3. Filtrage des anomalies

```python
alertes = df[(df["latence_ms"] > 40) | (df["debit_mbps"] < 65)]
print(alertes)
```

### 4. Statistiques simples

Fichier : `06_statistiques_pandas.py`

Calculer :

* Latence moyenne globale
* Débit moyen global
* Latence moyenne par poste

```python
print("Latence moyenne :", df["latence_ms"].mean())
print("Débit moyen :", df["debit_mbps"].mean())

print(df.groupby("poste")["latence_ms"].mean())
```

Exporter :

```
/resultats/rapport_statistiques.csv
```

---

## PARTIE 4 - Visualisation avec matplotlib

Les graphiques permettent de visualiser l’évolution des performances.

Installer **(si nécessaire)** :

```bash
pip install matplotlib
```

### 1. Courbe simple

Fichier : `07_graphiques.py`

1. Tracer la courbe de la latence (toutes mesures).
2. Ajouter :

   * un titre
   * un label axe X
   * un label axe Y
   * légende
4. Sauvegarde automatique :

```python
plt.savefig("../resultats/graphique_latence.png")
```

```python
import matplotlib.pyplot as plt
import pandas as pd

df = pd.read_csv("../donnees/mesures_reseau.csv")
df["date"] = pd.to_datetime(df["date"])

plt.plot(df["latence_ms"], label="Latence (ms)")
plt.title("Évolution de la latence globale")
plt.xlabel("Index des mesures")
plt.ylabel("Latence (ms)")
plt.legend()
plt.tight_layout()
plt.savefig("../resultats/graphique_latence.png")
plt.show()
```

* Axe X = index
* Axe Y = latence

### 2. Courbe par poste

1. Tracer la latence du poste PC01 en fonction de la date.
2. Faire la même chose pour PC02.
3. Afficher les deux courbes sur le même graphique.
4. Ajouter une légende.

Tracer la latence pour :

* PC01
* PC02
* PC03

Sur le même graphique.

Questions d’analyse :

1. Quel poste semble le plus instable ?
2. À quelle date observe-t-on la plus forte dégradation ?
3. Observe-t-on une relation entre débit et latence ?

**Code à compléter**

```python
pc01 = df[df["poste"] == "PC01"]

plt.plot(pc01["date"], pc01["latence_ms"])
plt.xticks(rotation=45)
plt.show()
```

1. Quel poste semble le plus instable ?
2. À quelle date observe-t-on la plus forte dégradation ?
3. Le débit et la latence semblent-ils liés ?

### 3. Graphique comparatif

```python
for poste in df["poste"].unique():
    data = df[df["poste"] == poste]
    plt.plot(data["date"], data["latence_ms"], label=poste)

plt.legend()
plt.xticks(rotation=45)
plt.tight_layout()
plt.show()
```

---

## MINI-PROJET — Script final

Vous êtes technicien réseau et vous devez analyser les mesures et générer un rapport automatique.

Créer `analyse_reseau.py` qui :

1. Charge les données
2. Applique la règle d’anomalie
3. Calcule :

   * Nombre total d’anomalies
   * Moyenne de latence par poste
4. Génère :

   * Graphique PNG
5. Exporte :

   * `rapport_final.csv`

Objectif : script exécutable en une seule commande.

### Livrables attendus

À rendre :

* Scripts Python
* Fichiers CSV générés
* Image(s) des graphiques
* Réponses aux questions d’interprétation

---

## PARTIE 5 — Génération d’un rapport HTML automatique

### Objectif

produire un rapport `mesures_reseau.csv` exploitable par un chef d’établissement.

Le rapport doit contenir :

* Nombre d’anomalies
* Moyennes par poste
* Tableau complet des données
* Graphique intégré

### Structure à ajouter au projet

```
TP_CSV_ANALYSE_RESEAU/
│
├── templates/
│   ├── rapport_template.html
│   └── style.css
│
├── resultats/
│   ├── rapport.html
│   ├── graphique_latence.png
│   └── style.css   ← à copier ici
│
└── scripts/
    └── 08_generation_html.py
```

Créer :

```
templates/style.css
```

```css
body {
    font-family: Arial, sans-serif;
    background-color: #e6f2ff;
}

h1 {
    color: #003366;
}

table {
    border-collapse: collapse;
    background-color: white;
}

th, td {
    border: 1px solid black;
    padding: 6px;
}

th {
    background-color: #cce0ff;
}

.titre-principal {
    color: darkblue;
    text-transform: uppercase;
}
```

### Étape 1 — Créer le template (modèle) HTML

Créer un fichier :
`templates/rapport_template.html`

Copier le code suivant :

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rapport Réseau</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1 class="titre-principal">Rapport d'analyse réseau</h1>

<h2>Statistiques</h2>

<p><strong>Nombre d'anomalies :</strong> {{nb_alertes}}</p>

<h3>Moyenne de latence par poste</h3>
{{table_moyennes}}

<h2>Données complètes</h2>
{{table_donnees}}

<h2>Graphique</h2>
<img src="graphique_latence.png" width="600">

</body>
</html>
```

> Les `{{ }}` sont des **marqueurs à remplacer en Python**.

### Étape 2 — Script Python de génération

Créer le script :
`scripts/08_generation_html.py`


**2.1 Importer les bibliothèques**

Écrire :

```python
import pandas as pd
```

**2.2 Charger les données**

Compléter le code :

```python
df = pd.read_csv("../donnees/____________")
print(df.head())
```

Vérifier que les données s’affichent.

**2.3 Calculer le nombre d’anomalies**

Rappel :
Anomalie si :

* latence > 40
  OU
* débit < 65

Compléter :

```python
alertes = df[(df["latence_ms"] > ____) | (df["debit_mbps"] < ____)]
nb_alertes = len(alertes)

print("Nombre d'anomalies :", nb_alertes)
```

Vérifier que le résultat semble cohérent.

**2.4 Calculer la moyenne par poste**

Compléter :

```python
moyennes = df.groupby("_______")["___________"].mean()
print(moyennes)
```

### ÉTAPE 3 — Transformer en tableau HTML

Ajouter :

```python
table_moyennes_html = moyennes.to_frame().to_html()
table_donnees_html = df.to_html(index=False)

print(table_moyennes_html)
```

### ÉTAPE 4 — Lire le template HTML

Compléter :

```python
with open("../templates/rapport_template.html", "r", encoding="utf-8") as f:
    template = f.read()

print(template)
```

### ÉTAPE 5 — Remplacer les marqueurs

Compléter :

```python
template = template.replace("{{nb_alertes}}", str(nb_alertes))
template = template.replace("{{table_moyennes}}", table_moyennes_html)
template = template.replace("{{table_donnees}}", table_donnees_html)
```

### ÉTAPE 6 — Générer le fichier final

Compléter :

```python
with open("../resultats/rapport.html", "w", encoding="utf-8") as f:
    f.write(template)

print("Rapport généré.")
```

### Code complet

```python
import pandas as pd

# Chargement des données
df = pd.read_csv("../donnees/mesures_reseau.csv")

# Calculs
moyennes = df.groupby("poste")["latence_ms"].mean()
nb_alertes = len(df[(df["latence_ms"] > 40) | (df["debit_mbps"] < 65)])

# Conversion en tableaux HTML
table_moyennes_html = moyennes.to_frame().to_html()
table_donnees_html = df.to_html(index=False)

# Lecture du template
with open("../templates/rapport_template.html", "r", encoding="utf-8") as f:
    template = f.read()

# Remplacement des marqueurs
template = template.replace("{{nb_alertes}}", str(nb_alertes))
template = template.replace("{{table_moyennes}}", table_moyennes_html)
template = template.replace("{{table_donnees}}", table_donnees_html)

# Écriture du fichier final
with open("../resultats/rapport.html", "w", encoding="utf-8") as f:
    f.write(template)

print("Rapport HTML généré avec succès.")
```

* Exécuter le code `08_generation_html.py` 

### Vérification

1. Ouvrir `rapport.html` dans un navigateur.
2. Vérifier :

   * Les statistiques sont affichées
   * Les tableaux apparaissent correctement
   * Le graphique est visible

---
