# <cite><font color="(0,68,88)">Informatique : CIEL-1</font></cite>

<a href="https://carnus.fr"><img src="https://img.shields.io/badge/Carnus%20Enseignement Supérieur-F2A900?style=for-the-badge" /></a>
<a href="https://carnus.fr"><img src="https://img.shields.io/badge/BTS%20CIEL-2962FF?style=for-the-badge" /></a>

---

```python
import os

BASE_DIR = "TP_Meteo_Python"

files = [
    "meteo_actuelle.py",
    "meteo_actuelle_V2.py",
    "meteo_code.py",
    "meteo_previsions.py",
    "meteo_qrcode.py",
    "README.md"
]

folders = [
    "images"
]

# Création du dossier principal
os.makedirs(BASE_DIR, exist_ok=True)

# Création des sous-dossiers
for folder in folders:
    path = os.path.join(BASE_DIR, folder)
    os.makedirs(path, exist_ok=True)

# Création des fichiers
for file in files:
    path = os.path.join(BASE_DIR, file)
    if not os.path.exists(path):
        with open(path, "w", encoding="utf-8") as f:
            f.write("")
```

---

```python
import barcode
from barcode.writer import ImageWriter

# Fonction pour valider le code produit
def validate_product_code(code):
    if not code or len(code) < 1:
        raise ValueError("Le code produit est vide ou invalide.")
    return code

try:
    # Informations du produit
    product_name = "MacBook Pro M4"
    product_reference = "R25MBP012"
    product_price = "2129.00 Euros"

    # Combinaison des informations pour le code-barres
    product_code = f"Produit: {product_name} | Ref: {product_reference} | Prix: {product_price}"
    validate_product_code(product_code)

    # Génération du code-barres (Code 128)
    upc = barcode.get('code128', product_code, writer=ImageWriter())

    # Options de personnalisation
    options = {
        'module_width': 0.2,  # Largeur des barres
        'module_height': 15.0,  # Hauteur des barres
        'font_size': 10,  # Taille de la police pour le texte
        'text_distance': 5.0,  # Distance entre le texte et les barres
        'background': 'white',  # Couleur de fond
        'foreground': 'black',  # Couleur des barres
        'write_text': True,  # Inclure le texte sous le code-barres
    }

    # Sauvegarde du code-barres en PNG
    filename = upc.save('barP', options=options)
    print(f"Code-barres généré et sauvegardé sous le nom : {filename}.png")

except ValueError as ve:
    print(f"Erreur de validation : {ve}")
except Exception as e:
    print(f"Une erreur est survenue : {e}")
```

---

```python
import qrcode
qr = qrcode.QRCode(
    version=1,
    error_correction=qrcode.constants.ERROR_CORRECT_L,
    box_size=10,
    border=4,
)
qr.add_data(" Journée Portes Ouvertes : Samedi 31 janvier 2026, 9h00-16h30"
            "\n Lieu : Carnus Enseignement Supérieur, Avenue de Bourran, Rodez"
            "\n Nos formations : BTS CIEL, BTS ERA, BTS GPME, DTS IMRT.")
qr.make(fit=True)
img = qr.make_image(fill_color="rgb(0,68,88)", back_color="#ffffe0")
img.save("qr_p2.png")
```
