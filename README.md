# ⬇️ <cite><font color="(0,68,88)">CIEL-1</font></cite>

<a href="https://carnus.fr"><img src="https://img.shields.io/badge/Carnus%20Enseignement Supérieur-F2A900?style=for-the-badge" /></a>
<a href="https://carnus.fr"><img src="https://img.shields.io/badge/BTS%20CIEL-2962FF?style=for-the-badge" /></a>

[![Développement Web](https://img.shields.io/badge/HTML-CSS-yellow)](https://www.w3.org/)
[![PHP SQL](https://img.shields.io/badge/PHP-MySQL-8A2BE2)](https://www.php.net/)

https://codepen.io/justinklemm/pen/kyMjjv

https://codepen.io/TurkAysenur/pen/wvaGqXW

```html

@import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css);

:root{
    --color-primary: #7380ec; /* Bleu-violet */
    --color-white: #fff;
    --color-info: #7d8da1; /* Bleu-gris */
    --color-dark: #363949; /* Noir */
    --color-background: #f6f6f9; /* Gris très clair */
    --color-danger: #ff7782; /* Rouge-rose */
    --color-warning: #ff4500; /* orange */

    --border-radius-1: 0.4rem;
}

/*.dark-theme{*/
.dark{
    --color-white: #202528; /* Noir */
    --color-info: #f0f8ff; /* Blanc cassé */
    --color-dark: #edeffd; /* Gris très clair */
    --color-background: #181a1e; /* Noir */
    --color-danger: #cc5500; /* Rouge-rose */
    --color-warning: #ff4f00;


}

* {
  box-sizing: border-box;
  color: var(--color-dark);
}

body {
  font-family: Arial;
  padding: 10px;
  background: var(--color-background);
  color: var(--color-dark);
}

/* Style de la barre de navigation supérieure */
.topnav {
  overflow: hidden;
  background-color: var(--color-background);
}

/* Style des liens de la barre */
.topnav a {
  float: left;
  display: block;
  color: var(--color-info);
  text-align: center;
  padding: 2px 16px 10px 16px;
  text-decoration: none;
  margin-right: 5px;
}

/* Changer la couleur au survol */
.topnav a:hover {
  color: var(--color-info);
  transform: scale(1.1);
  transition: all 250ms ease-in;
}

.topnav i {
  color: var(--color-info);
}

.mode-switch {
  background-color: transparent;
  border: none;
  padding: 0;
  color: var(--color-white);
  display: flex;
  font-size: 24px;
}

/* Début : titre + logo */
.debut {
  padding: 30px;
  text-align: center;
  background-color: var(--color-white);
}

.debut h1 {
  font-size: 50px;
  margin: 0px 0px -20px 0px;
}

.debut p {
  margin: 24px 0px -10px 0px;
}

/* Image */
img{
  display: block;
  margin: auto;
}

/* Milieu */
.milieu {
  background-color: var(--color-white);
  padding: 20px;
  margin-top: 20px;
}

/* Bas de page */
.footer {
  padding: 10px;
  text-align: center;
  background: #24262b;
  margin-top: 20px;
}

.footer h2, h4 {
  color: white;
}

/*********** Réseaux sociaux *************/
.social-container {
  width: 400px;
  margin: auto;
  text-align: center;
}

.social-icons {
  padding: 0;
  list-style: none;
  margin: .5em;
}
.social-icons li {
  display: inline-block;
  margin: 0.15em;
  position: relative;
  font-size: 1.2em;
}
.social-icons i {
  color: #fff;
  position: absolute;
  left: 21px;
}
.social-icons a {
  width: 50px;
  height: 20px;
  border-radius: 100%;
  display: block;
}

/* Bouton */
.bouton {
  margin: 20px;
  display: block;
  padding: 15px 35px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  color: #fff;
  background-color: var(--color-danger);
  border: none;
  border-radius: 15px;
}

.bouton:hover {
  background-color: var(--color-warning);
}

```
