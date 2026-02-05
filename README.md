# <cite><font color="(0,68,88)">Informatique : CIEL-1</font></cite>

<a href="https://carnus.fr"><img src="https://img.shields.io/badge/Carnus%20Enseignement Supérieur-F2A900?style=for-the-badge" /></a>
<a href="https://carnus.fr"><img src="https://img.shields.io/badge/BTS%20CIEL-2962FF?style=for-the-badge" /></a>

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
