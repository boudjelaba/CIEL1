# ⬇️ <cite><font color="(0,68,88)">CIEL-1</font></cite>

<a href="https://carnus.fr"><img src="https://img.shields.io/badge/Carnus%20Enseignement Supérieur-F2A900?style=for-the-badge" /></a>
<a href="https://carnus.fr"><img src="https://img.shields.io/badge/BTS%20CIEL-2962FF?style=for-the-badge" /></a>

[![Développement Web](https://img.shields.io/badge/HTML-CSS-yellow)](https://www.w3.org/)
[![PHP SQL](https://img.shields.io/badge/PHP-MySQL-8A2BE2)](https://www.php.net/)

https://codepen.io/justinklemm/pen/kyMjjv

https://codepen.io/TurkAysenur/pen/wvaGqXW

```js


var mode = document.getElementById("icone");

let darkMode = localStorage.getItem('dark');

const enableDarkMode = () => {
  document.body.classList.add('dark');
  localStorage.setItem('dark', 'enabled');
  icone.classList = "fa-solid fa-sun";
}

const disableDarkMode = () => {
  document.body.classList.remove('dark');
  localStorage.setItem('dark', null);
  icone.classList = "fa-solid fa-moon";
}

if (darkMode === 'enabled') {
  enableDarkMode();
}

mode.addEventListener('click', () => {
  darkMode = localStorage.getItem('dark');   
  if (darkMode !== 'enabled') {
    enableDarkMode(); 
  } else {  
    disableDarkMode(); 
  }
});

```
