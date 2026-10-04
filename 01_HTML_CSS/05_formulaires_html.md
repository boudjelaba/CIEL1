# Les formulaires HTML

## Introduction

Les formulaires HTML permettent à un utilisateur de **saisir et transmettre des informations** : contact, inscription, connexion, recherche, réservation, questionnaire, etc.

Les principales balises sont :

- `<form>` : définit le formulaire ;
- `<label>` : décrit un champ ;
- `<input>` : crée différents types de champs ;
- `<select>` et `<option>` : proposent une liste de choix ;
- `<textarea>` : permet de saisir un texte long ;
- `<button>` : crée notamment les boutons d'envoi et de réinitialisation.

HTML permet également de réaliser une première **validation des données directement dans le navigateur**.

---

## 1\. La balise `<form>`

La balise `<form>` délimite le formulaire :

```html
<form>
    ...
</form>
```

Elle peut notamment utiliser les attributs `action` et `method`.

### `action`

Indique la destination vers laquelle les données sont envoyées.

```html
<form action="traitement.html">
```

Dans ce cours, aucun traitement serveur ne sera mis en place.

### `method`

Indique la méthode HTTP utilisée lors de l'envoi.

- `GET` : les données sont ajoutées à l'URL ;
- `POST` : les données sont transmises dans le corps de la requête.

```html
<form action="#" method="post">
```

---

## 2\. Les champs `<input>`

La balise `<input>` permet de créer différents types de champs grâce à l'attribut `type`.

| Type | Utilisation |
| --- | --- |
| `text` | Texte |
| `email` | Adresse électronique |
| `password` | Mot de passe |
| `number` | Nombre |
| `date` | Date |
| `tel` | Téléphone |
| `radio` | Un choix parmi plusieurs |
| `checkbox` | Une ou plusieurs cases |
| `submit` | Bouton d'envoi |

Exemples :

```html
<input type="text">
<input type="email">
<input type="password">
<input type="number">
```

### Les attributs importants

#### `name`

Identifie la donnée lors de l'envoi du formulaire.

```html
<input type="text" name="prenom">
```

#### `id` et `<label>`

L'attribut `id` identifie un élément dans la page. Il permet notamment d'associer un `<label>` au champ.

```html
<label for="prenom">Prénom :</label>
<input type="text" id="prenom" name="prenom">
```

Le `for` du `<label>` doit correspondre au `id` du champ.

Cette association améliore notamment l'accessibilité et permet de cliquer sur le libellé pour sélectionner le champ.

#### `value`

Définit la valeur associée à un élément, notamment pour les boutons radio et les cases à cocher.

```html
<input type="radio"
       id="premiere"
       name="annee"
       value="1">
<label for="premiere">1ère année</label>
```

#### `placeholder`

Affiche une indication dans un champ.

```html
<input type="text"
       id="prenom"
       name="prenom"
       placeholder="Charles">
```

Le `placeholder` est une indication : **il ne remplace pas le `<label>`**.

---

## 3\. Boutons radio et cases à cocher

### Boutons radio

Les boutons `radio` permettent de sélectionner **un seul choix** parmi plusieurs.

Les boutons appartenant au même groupe doivent avoir le même `name`.

```html
<input type="radio"
       id="un"
       name="annee"
       value="1">
<label for="un">1ère année</label>

<input type="radio"
       id="deux"
       name="annee"
       value="2">
<label for="deux">2ème année</label>
```

Ici, `name="annee"` indique que les deux boutons appartiennent au même groupe.

### Cases à cocher

Les `checkbox` permettent de sélectionner **plusieurs choix**.

```html
<input type="checkbox"
       id="html"
       name="technologies"
       value="html">
<label for="html">HTML</label>

<input type="checkbox"
       id="css"
       name="technologies"
       value="css">
<label for="css">CSS</label>
```

---

## 4\. Les listes déroulantes

Les balises `<select>` et `<option>` permettent de proposer une liste de choix.

```html
<label for="dep">Département :</label>

<select id="dep" name="dep">
    <option value="aveyron">Aveyron</option>
    <option value="tarn">Tarn</option>
    <option value="lot">Lot</option>
    <option value="autre">Autre</option>
</select>
```

L'attribut `selected` permet de définir le choix sélectionné par défaut :

```html
<option value="tarn" selected>Tarn</option>
```

---

## 5\. Les boutons

La balise `<button>` permet notamment de créer des boutons d'envoi et de réinitialisation.

```html
<button type="submit">Envoyer</button>
<button type="reset">Réinitialiser</button>
```

- `submit` : demande l'envoi du formulaire ;
- `reset` : remet les champs dans leur état initial.

---

## 6\. Exemple : formulaire étudiant

Créer un formulaire permettant de saisir un prénom, une adresse mail, un âge, une année d'étude et un département.

```html
<form action="#" method="post">

    <div>
        <label for="prenom">Prénom :</label>
        <input type="text"
               id="prenom"
               name="prenom"
               placeholder="Charles">
    </div>

    <div>
        <label for="mail">Adresse mail :</label>
        <input type="email"
               id="mail"
               name="mail"
               placeholder="lycee@carnus.fr">
    </div>

    <div>
        <label for="age">Âge :</label>
        <input type="number"
               id="age"
               name="age"
               placeholder="19">
    </div>

    <fieldset>
        <legend>Année d'étude</legend>

        <input type="radio"
               id="un"
               name="annee"
               value="1"
               checked>
        <label for="un">1ère année</label>

        <input type="radio"
               id="deux"
               name="annee"
               value="2">
        <label for="deux">2ème année</label>
    </fieldset>

    <div>
        <label for="dep">Département :</label>

        <select id="dep" name="dep">
            <option value="aveyron">Aveyron</option>
            <option value="tarn" selected>Tarn</option>
            <option value="lot">Lot</option>
            <option value="autre">Autre</option>
        </select>
    </div>

    <button type="submit">Envoyer</button>

</form>
```

### Travail demandé

Tester le formulaire dans un navigateur et modifier les différentes valeurs. Observer le comportement des champs.

---

## 7\. La validation HTML

Un formulaire peut imposer certaines contraintes sur les données saisies.

Par exemple :

- un champ peut être obligatoire ;
- un nombre peut être limité à un intervalle ;
- une saisie peut avoir une longueur minimale ou maximale ;
- une valeur peut devoir respecter un modèle particulier.

HTML permet d'effectuer ces contrôles directement dans le navigateur.

**Remarque :** cette validation ne remplace pas la validation côté serveur. Dans une application réelle, les données reçues par le serveur doivent également être vérifiées.

---

## 8\. Les principaux attributs de validation

| Attribut | Fonction |
| --- | --- |
| `required` | Champ obligatoire |
| `minlength` | Nombre minimal de caractères |
| `maxlength` | Nombre maximal de caractères |
| `min` | Valeur minimale |
| `max` | Valeur maximale |
| `step` | Pas d'un champ numérique |
| `pattern` | Modèle que la valeur doit respecter |
| `autocomplete` | Aide le navigateur à proposer des valeurs |

### `required`

Rend un champ obligatoire :

```html
<input type="text"
       id="prenom"
       name="prenom"
       required>
```

### `min` et `max`

Définissent les limites d'un nombre :

```html
<input type="number"
       id="age"
       name="age"
       min="15"
       max="35">
```

L'âge doit être compris entre 15 et 35.

### `minlength` et `maxlength`

Contrôlent la longueur d'une saisie :

```html
<input type="text"
       id="prenom"
       name="prenom"
       minlength="2"
       maxlength="20">
```

### `step`

Définit le pas d'un champ numérique :

```html
<input type="number"
       min="0"
       step="0.01">
```

Ce réglage permet notamment de saisir des valeurs décimales au centième.

---

## 9\. L'attribut `pattern` et les expressions régulières (`regex`)

`pattern` permet d'imposer un modèle à la valeur saisie.

Exemple :

```html
<input type="text"
       id="code"
       name="code"
       pattern="[A-Z]{3}[0-9]{3}"
       required>
```

La valeur doit comporter **3 lettres majuscules suivies de 3 chiffres**.

Valides :

```
ABC123
XYZ456
```

Invalide :

```
abc123
```

Une expression régulière (**regex**) décrit un ensemble de chaînes de caractères correspondant à une règle.

| Élément | Signification |
| --- | --- |
| `[A-Z]` | Lettre majuscule |
| `[a-z]` | Lettre minuscule |
| `[0-9]` | Chiffre |
| `+` | Une ou plusieurs occurrences |
| `*` | Zéro ou plusieurs occurrences |
| `{2}` | Exactement 2 occurrences |
| `{2,}` | Au moins 2 occurrences |
| `{2,5}` | De 2 à 5 occurrences |
| `^` | Début de la valeur |
| `$` | Fin de la valeur |

### Exemple : validation d'un prénom

On peut autoriser les lettres, espaces, apostrophes et tirets, avec une longueur maximale de 20 caractères :

```html
<input type="text"
       id="prenom"
       name="prenom"
       required
       maxlength="20"
       pattern="[A-Za-zÀ-ÖØ-öø-ÿ '-]+">
```

### Outils pour tester les expressions régulières (regex)

#### RegExr

Pour créer, tester et mieux comprendre une expression régulière, vous pouvez utiliser l'outil en ligne **[RegExr](https://regexr.com/)**

L'outil permet de :

- saisir une expression régulière ;
- tester différentes chaînes de caractères ;
- voir immédiatement les correspondances ;
- consulter une explication des différents éléments de l'expression.

 **Exemple :**

 Saisir le motif :

```text
[A-Z]{3}[0-9]{3}
```

 Puis tester :

```text
ABC123
XYZ456
abc123
ABC12
```

Les deux premières valeurs correspondent au motif, contrairement aux deux dernières.

**Conseil :** testez toujours une expression régulière avec plusieurs valeurs, notamment des valeurs valides et invalides, avant de l'utiliser dans un formulaire HTML.

#### Regex101

**[Regex101](https://regex101.com/)**  est un autre outil en ligne permettant de tester des expressions régulières. Son interface est plus riche et donc plus complexe que celle de RegExr. Il propose notamment une explication détaillée du motif et une référence des différentes constructions disponibles.

---

## 10\. Validation d'une adresse électronique

Le type `email` permet déjà au navigateur d'effectuer une vérification de base du format.

```html
<input type="email"
       id="mail"
       name="mail"
       required>
```

Il n'est généralement pas nécessaire d'utiliser une expression régulière complexe pour une adresse électronique.

---

## 11\. Exemple : formulaire avec validation

Améliorer le formulaire étudiant en ajoutant les contraintes suivantes :

- prénom obligatoire et limité à 20 caractères ;
- adresse mail obligatoire ;
- âge compris entre 15 et 35 ans ;
- une année d'étude doit être sélectionnée.

```html
<form action="#" method="post">

    <div>
        <label for="prenom">Prénom :</label>
        <input type="text"
               id="prenom"
               name="prenom"
               required
               maxlength="20"
               placeholder="Charles">
    </div>

    <div>
        <label for="mail">Adresse mail :</label>
        <input type="email"
               id="mail"
               name="mail"
               required
               placeholder="lycee@carnus.fr">
    </div>

    <div>
        <label for="age">Âge :</label>
        <input type="number"
               id="age"
               name="age"
               min="15"
               max="35"
               required>
    </div>

    <fieldset>
        <legend>Année d'étude</legend>

        <input type="radio"
               id="un"
               name="annee"
               value="1"
               required>
        <label for="un">1ère année</label>

        <input type="radio"
               id="deux"
               name="annee"
               value="2">
        <label for="deux">2ème année</label>
    </fieldset>

    <div>
        <label for="dep">Département :</label>

        <select id="dep" name="dep">
            <option value="aveyron">Aveyron</option>
            <option value="tarn">Tarn</option>
            <option value="lot">Lot</option>
            <option value="autre">Autre</option>
        </select>
    </div>

    <button type="submit">Envoyer</button>
    <button type="reset">Réinitialiser</button>

</form>
```

### Test

Tester les situations suivantes :

- prénom vide ;
- âge inférieur à 15 ;
- âge supérieur à 35 ;
- adresse mail incorrecte ;
- aucune année d'étude sélectionnée.

Observer les messages affichés par le navigateur.

---

## 12\. Formulaire de connexion

Un formulaire de connexion contient généralement un identifiant ou une adresse mail et un mot de passe.

```html
<form action="#" method="post">

    <label for="mail">Adresse mail :</label>
    <input type="email"
           id="mail"
           name="mail"
           required
           autocomplete="username">

    <label for="mdp">Mot de passe :</label>
    <input type="password"
           id="mdp"
           name="mdp"
           required
           minlength="8"
           autocomplete="current-password">

    <button type="submit">Se connecter</button>

</form>
```

Ici :

- `required` rend les champs obligatoires ;
- `type="email"` vérifie le format de base de l'adresse ;
- `minlength="8"` impose au moins 8 caractères ;
- `autocomplete` indique au navigateur le type de donnée attendu.

---

## 13\. Exercices

### Exercice 1 : formulaire d'inscription

Créer un formulaire contenant :

- nom ;
- prénom ;
- adresse mail ;
- téléphone ;
- date de naissance ;
- mot de passe ;
- confirmation du mot de passe ;
- année d'étude ;
- département ;
- acceptation des conditions d'utilisation.

Contraintes :

- nom, prénom, mail, téléphone et date de naissance obligatoires ;
- mot de passe obligatoire et d'au moins 8 caractères ;
- une année d'étude doit être sélectionnée ;
- les conditions d'utilisation doivent être acceptées.

Utiliser les attributs HTML de validation appropriés.

---

### Exercice 2 : formulaire de contact

Créer un formulaire contenant :

- nom ;
- prénom ;
- adresse mail ;
- sujet ;
- message ;
- bouton « Envoyer » ;
- bouton « Réinitialiser ».

Contraintes :

- les champs d'identification sont obligatoires ;
- l'adresse mail utilise `type="email"` ;
- le message contient entre 20 et 500 caractères.

Utiliser `<textarea>` :

```html
<label for="message">Message :</label>

<textarea id="message"
          name="message"
          required
          minlength="20"
          maxlength="500"></textarea>
```

---

### Exercice 3 : formulaire de recherche

Créer un formulaire permettant de rechercher un produit avec :

- un champ de recherche ;
- une catégorie ;
- un prix minimum ;
- un prix maximum ;
- un bouton « Rechercher ».

Exemple :

```html
<label for="prix-min">Prix minimum :</label>

<input type="number"
       id="prix-min"
       name="prix-min"
       min="0"
       step="0.01">
```

---

### Exercice 4 : validation d'un mot de passe

#### Introduction

Les mots de passe sont un exemple concret de validation que vous avez probablement déjà rencontré.

Lors de la création d'un compte ou de la modification d'un mot de passe, un site peut demander par exemple :

- un nombre minimal de caractères ;
- au moins une lettre majuscule ;
- au moins un chiffre ;
- au moins un caractère spécial.

Ces règles sont souvent affichées sous forme de messages tels que :

> « Le mot de passe doit contenir au moins 12 caractères. »

> « Le mot de passe doit contenir au moins une majuscule. »

Dans cet exercice, nous allons reproduire ce type de contrainte avec **HTML et une expression régulière**.

L'objectif est de comprendre comment une regex peut traduire des règles que vous rencontrez régulièrement lors de l'utilisation de sites web.

**Objectif :** comprendre comment une expression régulière peut combiner plusieurs contraintes de validation.

Créer un champ permettant à l'utilisateur de saisir un mot de passe.

Le mot de passe doit respecter les règles suivantes :

- contenir au moins **12 caractères** ;
- contenir au moins **une lettre majuscule** ;
- contenir au moins **un chiffre** ;
- contenir au moins **un caractère spécial**.

Utiliser l'attribut `pattern` pour effectuer cette validation.

#### Exemple de départ

```html
<label for="mdp">Mot de passe :</label>

<input type="password"
       id="mdp"
       name="mdp"
       required
       pattern="A compléter">
```

<details>
<summary>Afficher la solution</summary>

```html
<label for="mdp">Mot de passe :</label>

<input type="password"
       id="mdp"
       name="mdp"
       required
       pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{12,}$">
```
</details>

#### Travail demandé

1. Rechercher et construire une expression régulière permettant de respecter les contraintes.
2. Tester cette expression avec **[RegExr](<https://regexr.com/>)**.
3. Modifier le champ HTML pour utiliser cette expression avec `pattern`.
4. Tester le formulaire avec plusieurs mots de passe valides et invalides.

#### Exemples à tester

| Mot de passe | Résultat attendu |
| --- | --- |
| `Bonjour123!` | ✖️ Trop court |
| `bonjour123!@#` | ✖️ Pas de majuscule |
| `Bonjourabcdef!` | ✖️ Pas de chiffre |
| `Bonjour123456` | ✖️ Pas de caractère spécial |
| `Bonjour123!@#` | ✔️ Valide |

---

## 14\. Conclusion

Les formulaires HTML permettent de recueillir des informations saisies par l'utilisateur.

Les principales balises sont :

```html
<form>
<label>
<input>
<select>
<option>
<textarea>
<button>
```

Les principaux attributs étudiés sont :

```text
id
name
value
placeholder
required
min
max
minlength
maxlength
pattern
autocomplete
```

La validation HTML permet de contrôler certaines données dans le navigateur.

Exemples :

```html
<input type="email" required>
```

Adresse électronique obligatoire.

```html
<input type="number" min="15" max="35">
```

Nombre compris entre 15 et 35.

```html
<input type="text"
       required
       minlength="2"
       maxlength="20">
```

Saisie obligatoire de 2 à 20 caractères.

**Remarque :** la validation HTML améliore l'expérience utilisateur, mais elle ne constitue pas une sécurité suffisante. Les données doivent également être contrôlées côté serveur avant toute utilisation ou sauvegarde.

---
