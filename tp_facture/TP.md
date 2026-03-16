# TP – Création d’une facture HTML exportable en PDF

## Objectifs

* créer une page **HTML structurée**
* utiliser **CSS pour la mise en forme**
* manipuler un **tableau HTML**
* utiliser une **bibliothèque JavaScript**
* générer un **PDF à partir d’une page web**

Vous devez **reproduire une facture en HTML/CSS** à partir du modèle fourni : **facture_modele_V1.pdf** ou **facture_modele_V2.pdf**

La facture devra ensuite être **exportable en PDF** grâce à JavaScript.

### Structure du projet

Créer l’arborescence suivante :

```
📁 tp_facture/
│
├── 📄 facture.html
├── 📄 style.css
└── 📄 script.js
```

---

## Étape 1 : structure HTML

Créer le fichier **facture.html**.

Ajouter la structure de base :

```html
<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<title>Facture</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="facture">

<h1>Facture</h1>

</div>

</body>
</html>
```

Tester dans un navigateur.

## Étape 2 : informations de l'entreprise

Ajouter dans la facture les informations suivantes :

```
Apple France
Paris Opéra
12 rue Halévy
75009 Paris
01 44 83 42 00
apple@apple.com
```

* Utiliser une **liste HTML** :

```html
<ul>
<li>...</li>
</ul>
```

## Étape 3 : informations du client

Ajouter une section :

Titre :

```
Facturé à :
```

Puis les informations client.
```
Carnus Enseignement Supérieur
Avenue de Bourran
12000 Rodez
05 65 73 37 00
lycee@carnus.fr
```

## Étape 4 : création du tableau des produits

Créer un tableau contenant les colonnes suivantes :

| Description | Prix | Quantité | Total |

Utiliser :

```html
<table>
<tr>
<th>Description</th>
<th>Prix</th>
<th>Quantité</th>
<th>Total</th>
</tr>
...
</table>
```

Ajouter les **3 produits du modèle PDF** :

| Produit          | Prix   | Qté |
| ---------------- | ------ | --- |
| MacBook Pro      | 2100 € | 1   |
| Adaptateur USB-C | 65 €   | 1   |
| Magic Mouse      | 109 €  | 1   |

## Étape 5 : calcul des totaux

Ajouter sous le tableau :

```
Total HT : 2274 €
TVA (20%) : 454.80 €
Total TTC : 2728.80 €
```

## Étape 6 : mise en forme CSS

Créer le fichier : **style.css**.

Objectifs :

* centrer la facture
* ajouter une bordure
* améliorer la lisibilité du tableau
* mettre le titre **Facture** en couleur

Exemple :

```css
body{
font-family: Arial;
background-color:#eee;
}

.facture{
background:white;
padding:30px;
width:800px;
margin:auto;
border:1px solid #ccc;
}

h1{
color:#2c3e50;
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

td, th{
border:1px solid #ccc;
padding:8px;
text-align:left;
}
```

## Étape 7 : Bouton de génération PDF

Ajouter un bouton sous la facture :

```html
<button id="download">
Télécharger la facture en PDF
</button>
```

## Étape 8 : génération du PDF

Ajouter les bibliothèques dans le HTML `à l'intérieur de <head>...</head>` :

```html
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<script src="script.js"></script>
```

## Étape 9 : créer **script.js**

Ajouter le script permettant de télécharger la facture en PDF.

```javascript
// Lorsque l'utilisateur clique sur le bouton
document.getElementById("download").addEventListener("click", function(){

    // On sélectionne l'élément HTML contenant la facture
    const element = document.querySelector(".facture");

    // La bibliothèque html2pdf convertit le HTML en PDF
    html2pdf().from(element).save("facture.pdf");

});
```

Tester la génération du PDF.

## Partie 10 : Vérification finale

Votre page doit :

* ressembler au **PDF modèle**
* afficher correctement les informations
* générer un **PDF téléchargeable**

## Améliorations

### 1 - Ajouter un logo à la facture

Dans l’en-tête de la facture, ajouter le logo Carnus.

### 2 - Mettre la date automatiquement

Actuellement la date est écrite directement :

```html
Date : 16 mars 2026
```

Modifier :

```html
Date : <span id="date"></span>
```

Dans **script.js**

```javascript
// Date automatique (date de la facture)
let aujourdHui = new Date();
document.getElementById("date").textContent =
  aujourdHui.toLocaleDateString("fr-FR");
```

### 3 - Ajouter une nouvelle ligne produit

Ajouter :

| Produit        | Prix  | Quantité |
| -------------- | ----- | -------- |
| Magic Keyboard | 149 € | 1        |

### 4 - Amélioration du CSS pour l’impression

Ajouter :

```css
@media print {
	#download {
		display:none;
	}

	body {
		background:white;
	}
}
```

### 5 - Ajouter un numéro de facture automatique

```javascript
// Numéro de facture automatique
let numero = Math.floor(Math.random()*100000);
document.getElementById("numero").textContent = numero;
```

Dans le HTML :

```html
Facture n° <span id="numero"></span>
```

---

## Barème 

| Partie                  | Points |
| ----------------------- | ------ |
| Structure HTML          | 4      |
| Tableau produits        | 4      |
| Mise en forme CSS       | 4      |
| Informations facture    | 3      |
| Génération PDF          | 3      |
| Présentation / propreté | 2      |

Total : **/20**

---
