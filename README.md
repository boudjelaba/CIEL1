# <cite><font color="(0,68,88)">Informatique : CIEL-1</font></cite>

<a href="https://carnus.fr"><img src="https://img.shields.io/badge/Carnus%20Enseignement Supérieur-F2A900?style=for-the-badge" /></a>
<a href="https://carnus.fr"><img src="https://img.shields.io/badge/BTS%20CIEL-2962FF?style=for-the-badge" /></a>

---

```javascript
window.onload = function () {
    document.getElementById("download")
        .addEventListener("click", () => {
            const facture = this.document.getElementById("facture");
            console.log(facture);
            console.log(window);
            var opt = {
                margin: 1,
                filename: 'facture.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(facture).set(opt).save();
        })
}
```
