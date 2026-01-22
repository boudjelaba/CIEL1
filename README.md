# <cite><font color="(0,68,88)">Informatique : CIEL-1</font></cite>

<a href="https://carnus.fr"><img src="https://img.shields.io/badge/Carnus%20Enseignement Supérieur-F2A900?style=for-the-badge" /></a>
<a href="https://carnus.fr"><img src="https://img.shields.io/badge/BTS%20CIEL-2962FF?style=for-the-badge" /></a>


---

```html
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>QR Codes & Codes-barres – BTS CIEL</title>

<!-- QR Codes modernes (UTF-8 natif) -->
<script src="https://cdn.jsdelivr.net/npm/qr-code-styling@1.6.0/lib/qr-code-styling.js"></script>

<!-- Codes-barres -->
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

<style>
body {
  font-family: Arial, sans-serif;
  background: #f4f4f4;
  padding: 20px;
}

h1 {
  text-align: center;
}

.section {
  background: white;
  padding: 15px;
  margin-bottom: 20px;
  border-radius: 8px;
  box-shadow: 0 0 8px rgba(0,0,0,0.1);
}

.qrcode, svg {
  margin-top: 10px;
}
</style>
</head>

<body>

<h1>Démo QR Codes & Codes-barres<br>BTS CIEL</h1>

<div class="section">
<h2>1. QR Code simple</h2>
<div id="qr1" class="qrcode"></div>
</div>

<div class="section">
<h2>2. QR Code paragraphe</h2>
<div id="qr2" class="qrcode"></div>
</div>

<div class="section">
<h2>3. QR Code lien Internet</h2>
<div id="qr3" class="qrcode"></div>
</div>

<div class="section">
<h2>4. QR Code produit avec emoji</h2>
<div id="qr4" class="qrcode"></div>
</div>

<div class="section">
<h2>5. QR Code vCard</h2>
<div id="qr5" class="qrcode"></div>
</div>

<div class="section">
<h2>6. QR Code vEvent (agenda)</h2>
<div id="qr6" class="qrcode"></div>
</div>

<div class="section">
<h2>7. Code-barres Code 128</h2>
<svg id="barcode128"></svg>
</div>

<div class="section">
<h2>8. Code-barres EAN-13</h2>
<svg id="barcodeEAN"></svg>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

  /* === Fonction QR Code (UTF-8 natif) === */
  function generateQR(id, text) {
    const qr = new QRCodeStyling({
      width: 220,
      height: 220,
      data: text,
      margin: 5
    });
    qr.append(document.getElementById(id));
  }

  /* === QR Codes === */
  generateQR("qr1", "TP CIEL – QR Code simple");

  generateQR("qr2",
"Ce QR Code contient un paragraphe de texte.\nIl peut inclure des accents, des retours à la ligne et des caractères spéciaux."
  );

  generateQR("qr3", "https://www.education.gouv.fr");

  generateQR("qr4",
`📦 Produit : Raspberry Pi 5
💻 Processeur ARM
💰 Prix : 89 €
🏫 BTS CIEL`
  );

  generateQR("qr5",
`BEGIN:VCARD
VERSION:3.0
FN:Charles Dupont
ORG:Lycée CIEL
TEL:0565733700
EMAIL:contact@lycee.fr
END:VCARD`
  );

  generateQR("qr6",
`BEGIN:VCALENDAR
VERSION:2.0
BEGIN:VEVENT
SUMMARY:Journée Portes ouvertes
DTSTART:20260205T090000
DTEND:20260205T170000
LOCATION:Lycée CIEL
DESCRIPTION:Découverte des formations BTS
END:VEVENT
END:VCALENDAR`
  );

  /* === Codes-barres === */
  JsBarcode("#barcode128", "TP2026CIEL", {
    format: "CODE128",
    width: 2,
    height: 80,
    displayValue: true
  });

  JsBarcode("#barcodeEAN", "123456789012", {
    format: "EAN13",
    width: 2,
    height: 80,
    displayValue: true
  });

});
</script>

</body>
</html>

```

