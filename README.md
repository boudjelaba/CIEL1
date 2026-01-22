# <cite><font color="(0,68,88)">Informatique : CIEL-1</font></cite>

<a href="https://carnus.fr"><img src="https://img.shields.io/badge/Carnus%20Enseignement Supérieur-F2A900?style=for-the-badge" /></a>
<a href="https://carnus.fr"><img src="https://img.shields.io/badge/BTS%20CIEL-2962FF?style=for-the-badge" /></a>


---

```javascript
function generateQR(id, text) {
    const qr = new QRCodeStyling({
      width: 220,
      height: 220,
      data: text,
      margin: 5
    });
    qr.append(document.getElementById(id));
  }
```

