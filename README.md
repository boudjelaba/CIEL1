## BTS CIEL-1

---

# Créer une signature mail en HTML

## 1. Créer le fichier HTML

Créer un dossier `Signature_mail` et créer à l'intérieur de ce dossier un nouveau fichier `signature.html`

Commencer par la structure classique d'une page HTML :

```html
<!DOCTYPE html>
<html>
<head>
  ...
</head>
<body>
  ...
</body>
</html>
```

Pour une signature, le contenu qui nous intéresse principalement se trouve dans `<body>`.

---

## 2. Utiliser un tableau pour organiser la signature

Pour une signature mail, il est recommandé d'utiliser un **tableau HTML** plutôt que des éléments de mise en page modernes comme `flex` ou `grid`, car les logiciels de messagerie ne les gèrent pas tous correctement.

Structure de départ :

```html
<table>
  <tr>
      <td>
          ...
      </td>
      <td>
          ...
      </td>
  </tr>
</table>
```

---

## 3. Ajouter le logo

Le logo est inséré avec la balise `<img>` :

```
<img src="LIEN_DU_LOGO" alt="Logo de l'établissement">
```

Dans notre cas, utiliser le lien direct vers l'image disponible dans mon GitHub:

```
https://raw.githubusercontent.com/Boudjelaba/Utiles/main/Logo/logo3.png
```

On peut également définir sa largeur :

```
width="120"
```

> Éviter de mettre une image trop grande : **100 à 150 px de largeur** est généralement suffisant pour une signature.

L'attribut `alt` permet de fournir un texte alternatif si l'image ne peut pas être chargée.

---

## 4. Ajouter le nom et la fonction

Utiliser les balises classiques :

- `<strong>` pour mettre le nom en évidence ;
- `<br>` pour passer à la ligne.

Par exemple :

```
<strong>Prénom NOM</strong><br>
Fonction / Service
```

On peut ensuite ajouter le nom de l'établissement.

---

## 5. Ajouter les coordonnées

Ajouter les informations :

```
Téléphone
Adresse mail
Site internet
```

Pour créer un lien vers une adresse mail, utiliser :

```
<a href="mailto:adresse@carnus.fr">adresse@carnus.fr</a>
```

Cela permet au destinataire de **cliquer directement** sur l'adresse.

---

## 6. Ajouter la mise en forme

Pour une signature mail, privilégier le **CSS directement dans les balises HTML** (« inline CSS »).

Par exemple :

```
style="font-family: Arial; font-size: 14px; color: #333333;"
```

On peut notamment modifier :

- `font-family` → police ;
- `font-size` → taille ;
- `color` → couleur du texte ;
- `font-weight` → épaisseur ;
- `padding` → espace intérieur ;
- `border` → ligne ou séparation.

Exemple :

```
<td style="padding-left: 15px;">
```

Cela permet d'avoir un espace entre le logo et les informations.

---

## 7. Créer une séparation

Si on veut une ligne entre le logo et les coordonnées, on peut utiliser une bordure sur la deuxième cellule :

```
<td style="border-left: 1px solid #999999; padding-left: 15px;">
```

Cela donne visuellement :

**\[ LOGO \] | Prénom NOM**\
Fonction\
Téléphone\
Email

---

## 8. Tester le fichier

Une fois le HTML terminé :

1. Enregistrer le fichier.
2. Ouvrir le fichier dans le navigateur.
3. Vérifier que le logo apparaît.
4. Vérifier les espacements et les couleurs.
5. Cliquer sur les liens pour vérifier qu'ils fonctionnent.

---

### Exemple de structure

```
HTML
└── BODY
  └── TABLE
      └── TR
          ├── TD
          │   └── IMG (logo)
          │
          └── TD
              ├── NOM
              ├── Fonction
              ├── Téléphone
              ├── Email
              └── Site internet
```

---

# Ressources de formation

Ce dépôt regroupe les ressources utilisées dans le cadre de la formation : supports de cours, exercices, travaux pratiques et documents complémentaires.

Les ressources sont organisées par thématique afin de faciliter leur consultation et leur réutilisation.

## Thématiques actuelles

### 01 — HTML / CSS

La partie HTML / CSS suit une progression basée sur des cours, des exercices et des travaux pratiques.

```text
01 — HTML / CSS
 │
 ├── 01_html_css.pdf
 │      Cours et exercices — bases du HTML et du CSS
 │
 ├── 02_ajout_css.pdf
 │      Cours et exercices — ajout et mise en forme avec CSS
 │
 ├── 03_tp_boutique.pdf
 │      TP — création d'un site de vente de produits informatiques
 │
 ├── 04_boites_css.pdf
 │      Cours et exercices — modèle de boîte CSS
 │
 │      → Ces notions permettent de finaliser le TP Boutique
 │
 ├── 05_formulaires_html.md
 │      Cours et exercices — formulaires HTML
 │
 ├── 06_tp_boutique_evolution_inscription_connexion_panier.pdf
 │      TP — évolution du site Boutique avec ajout de  fonctionnalité
 │
 └── 07_regex_pour_html.pdf
        Cours et exercices — expressions régulières appliquées au HTML
```

### 02 — Python

Supports et ressources consacrés à la programmation en Python.

### 03 — NAO

Ressources et travaux pratiques autour du robot NAO.

### 04 — Anglais

Travaux pratiques et ressources liés à la co-animation d'anglais (professionnel), notamment autour de situations de dépannage et de communication avec un client.

## Organisation du dépôt

```text
.
├── 01_HTML_CSS/
├── 02_Python/
├── 03_NAO/
└── 04_Anglais/
```

Le contenu de ce dépôt est **évolutif** et peut varier au fil de la formation.

Les documents peuvent être ajoutés, déplacés ou retirés en fonction des besoins. Les consignes ponctuelles, les exemples de code et autres éléments temporaires peuvent être ajoutés au dépôt pendant les séances, puis retirés lorsqu'ils ne sont plus nécessaires.

Il est donc normal que certains fichiers ou dossiers soient présents pendant une période donnée, puis supprimés ou réorganisés ultérieurement.

---
