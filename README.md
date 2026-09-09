
## Rôle des sélecteurs CSS `*`, `html` et `body`

### 1. Le sélecteur universel `*`

Le sélecteur `*` permet de cibler **tous les éléments** de la page.  
On l’utilise surtout pour :

- Réinitialiser certains styles par défaut (marges, padding, etc.).
- Appliquer des styles globaux comme la police ou la couleur du texte.

Exemple :

```css
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}
```

---

### 2. Le sélecteur `html`

Le sélecteur `html` cible l’élément racine de la page (la balise `<html>`).  
Il est souvent utilisé pour :

- Définir la taille de police de base (pour utiliser facilement les unités `rem`).
- Gérer le comportement de défilement de la page.
- Appliquer un fond ou une couleur à toute la page.

Exemple :

```css
html {
  font-size: 16px;
  scroll-behavior: smooth;
  background: #f5f5f5;
  height: 100%;
}
```

---

### 3. Le sélecteur `body`

Le sélecteur `body` cible la balise `<body>`, qui contient tout le contenu visible de la page.  
On l’utilise pour :

- Définir la police, la taille et la couleur du texte par défaut.
- Ajouter un fond, des marges ou du padding globaux.
- Styliser l’ensemble du contenu visible.

Exemple :

```css
body {
  font-family: system-ui, sans-serif;
  font-size: 1rem;
  line-height: 1.5;
  color: #222;
  background: #fff;
  margin: 0;
  padding: 0;
}
```

---

### Conclusion

- `*` : tous les éléments (styles très globaux ou réinitialisation).  
- `html` : élément racine (configuration de base du document).  
- `body` : contenu principal (styles par défaut pour le texte et le fond).

Dans chacun de ces sélecteurs, on peut utiliser **toutes les propriétés CSS** (color, background, margin, padding, font, display, etc.), en fonction de ce qu’on veut styliser.

---
---

## 1\. Background uni

```html
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Background simple</title>

  <style>
      body {
          background-color: lightblue;
      }
  </style>
</head>

<body>
  <h1>Background uni</h1>
  <p>Le fond de la page est bleu clair.</p>
</body>
</html>
```

## 2\. Background dégradé

```html
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Background dégradé</title>

  <style>
      body {
          background: linear-gradient(to right, #4facfe, #00f2fe);
      }
  </style>
</head>

<body>
  <h1>Background dégradé</h1>
  <p>Le fond passe progressivement du bleu au cyan.</p>
</body>
</html>
```

On peut également faire un dégradé vertical :

```css
body {
  background: linear-gradient(to bottom, #ff7e5f, #feb47b);
}
```

## 3\. Background avec une image

```html
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Background image</title>

  <style>
      body {
          background-image: url("img/logo3.png");
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;
      }
  </style>
</head>

<body>
  <h1>Background avec une image</h1>
  <p>L'image occupe tout l'arrière-plan.</p>
</body>
</html>
```

Les propriétés importantes sont :

- `background-color` : couleur de fond
- `background` \+ `linear-gradient()` : dégradé
- `background-image` : image de fond
- `background-size: cover` : l'image couvre toute la zone
- `background-position: center` : centre l'image
- `background-repeat: no-repeat` : empêche la répétition de l'image

---


```html
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Les backgrounds en CSS</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin: 30px;
        }

        .conteneur {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            padding: 20px;
        }

        .exemple {
            width: 300px;
            height: 200px;
            padding: 20px;
            box-sizing: border-box;
            color: white;
            border-radius: 15px;
        }

        /* 1. Background uni */
        .uni {
            background-color: #3498db;
        }

        /* 2. Background dégradé */
        .degrade {
            background: linear-gradient(
                135deg,
                #8e2de2,
                #4a00e0
            );
        }

        /* 3. Background image */
        .image {
            background-image: url("img/logo3.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>

    <h1>Les différents backgrounds en CSS</h1>

    <div class="conteneur">

        <div class="exemple uni">
            <h2>Background uni</h2>
            <p>
                Une simple couleur avec
                <strong>background-color</strong>.
            </p>
        </div>

        <div class="exemple degrade">
            <h2>Background dégradé</h2>
            <p>
                Un dégradé créé avec
                <strong>linear-gradient()</strong>.
            </p>
        </div>

        <div class="exemple image">
            <h2>Background image</h2>
            <p>
                Une image utilisée comme arrière-plan.
            </p>
        </div>

    </div>

</body>
</html>
```

