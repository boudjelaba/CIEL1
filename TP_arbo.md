# TP – Créer et analyser un projet Python

## Objectifs 

Créer un projet simple et vérifier sa structure avec un script Python.

* Comprendre la structure d’un projet Python
* Différencier **fichiers** et **dossiers** (icônes visibles)
* Manipuler `os.mkdir`, `os.makedirs`, `open`
* Lire et interpréter une arborescence

## Outils et logiciels

* **Matériel** : ordinateurs avec Python 3
* **Scripts fournis** :

  * `create_project.py` → création projet
  * `tree_simple.py` → analyse arborescence avec icônes

---

## 1. Générateur de projet (création d’arborescence)

### Objectif

* Manipuler `os.mkdir`
* Créer des fichiers
* Comprendre la structure d’un projet

### Script 1 – Générateur de projet : `create_project.py`

```python
#!/usr/bin/env python3

import os

def create_project(base_path):
    """
    Crée une arborescence de projet simple.
    """

    # Structure du projet
    folders = [
        "src",
        "docs",
        "tests",
        "data"
    ]

    files = {
        "README.md": "# Mon Projet\n\nDescription du projet.\n",
        "src/main.py": "print('BTS CIEL-IR')\n",
        "tests/test_main.py": "# Fichier de test\n",
        "data/sample.txt": "Lycée Charles Carnus - Rodez\n"
    }

    # Création du dossier principal
    os.makedirs(base_path, exist_ok=True)

    # Création des sous-dossiers
    for folder in folders:
        os.makedirs(os.path.join(base_path, folder), exist_ok=True)

    # Création des fichiers
    for file_path, content in files.items():
        full_path = os.path.join(base_path, file_path)
        with open(full_path, "w", encoding="utf-8") as f:
            f.write(content)

    print("Projet créé avec succès !")


if __name__ == "__main__":
    project_name = input("Nom du projet : ")
    create_project(project_name)
```

### Partie 1 – Création

1. Lancer le script :

```bash
python create_project.py
```

2. Nommer votre projet `TP1_Projet_Python`.
3. Vérifier que les dossiers et fichiers sont créés correctement.

### Partie 2 – Modification

1. Modifier `create_project.py` pour :

* Ajouter un dossier `assets`
* Ajouter un fichier `config.json`
* Ajouter un sous-dossier `src/utils`

2. Vérifier les changements.

---

## 2. Analyseur d’arborescence

### Objectif

Comprendre :

* Les fonctions
* La récursivité
* La manipulation des fichiers
* La différence entre fichier et dossier

### Script 2 – Analyseur d’arborescence : `tree_simple.py`

```python
#!/usr/bin/env python3

import os

# Icônes visuelles
DIR_ICON = "📁 "
FILE_ICON = "📄 "

def build_tree(path, prefix=""):
    """
    Affiche l'arborescence d'un dossier de manière récursive.
    """

    try:
        entries = os.listdir(path)
    except PermissionError:
        print(prefix + "Accès refusé")
        return

    entries.sort()

    for index, name in enumerate(entries):
        full_path = os.path.join(path, name)
        is_last = index == len(entries) - 1

        connector = "└── " if is_last else "├── "

        if os.path.isdir(full_path):
            print(prefix + connector + DIR_ICON + name)
            new_prefix = prefix + ("    " if is_last else "│   ")
            build_tree(full_path, new_prefix)
        else:
            print(prefix + connector + FILE_ICON + name)


if __name__ == "__main__":
    path = input("Chemin du dossier à analyser : ")
    print("\nStructure du dossier :\n")
    build_tree(path)
```

### Partie 1 – Analyse

1. Lancer le script d’analyse :

```bash
python tree_simple.py
```

2. Observer la sortie. Questions :

* Combien de dossiers ?
* Combien de fichiers ?
* Où se trouve le fichier `main.py` ?
* Identifier les icônes pour dossiers et fichiers.

### Partie 2 – Compréhension

1. À quoi sert la fonction `build_tree` ?
2. Pourquoi utilise-t-on `os.path.join()` ?
3. Pourquoi appelle-t-on `build_tree()` à l’intérieur de `build_tree()` ?

---
