# <cite><font color="(0,68,88)">Informatique : CIEL-1</font></cite>

<a href="https://carnus.fr"><img src="https://img.shields.io/badge/Carnus%20Enseignement Supérieur-F2A900?style=for-the-badge" /></a>
<a href="https://carnus.fr"><img src="https://img.shields.io/badge/BTS%20CIEL-2962FF?style=for-the-badge" /></a>

---

## QR code avec logo et couleur

```python
import qrcode
from PIL import Image

# Chemin vers l'image du logo
Logo_img = 'logo.png'

# Ouverture du logo
logo = Image.open(Logo_img)

# Largeur souhaitée du logo dans le QR code
basewidth = 100

# Calcul du ratio pour garder les proportions du logo
wpercent = (basewidth / float(logo.size[0]))
hsize = int((float(logo.size[1]) * float(wpercent)))

# Redimensionnement du logo avec un filtre
logo = logo.resize((basewidth, hsize), Image.Resampling.LANCZOS)

# Création de l'objet QR code avec correction d'erreur
QRcode = qrcode.QRCode(
    version=None,  # taille automatique
    error_correction=qrcode.constants.ERROR_CORRECT_H,
    box_size=10,   # taille des pixels
    border=4       # marge (important pour scan)
)

# Donnée à encoder dans le QR code (URL)
url = 'https://www.carnus.fr/'

# Ajout des données au QR code
QRcode.add_data(url)

# Génération de la matrice du QR code
QRcode.make()

# Couleur du QR code (hexadécimal)
QRcolor = '#0f8c43'

# Création de l'image du QR code avec couleur
QRimg = QRcode.make_image(
    fill_color=QRcolor, back_color="white"
).convert('RGB')  # Conversion en RGB pour manipulation

# Calcul de la position pour centrer le logo dans le QR code
pos = (
    (QRimg.size[0] - logo.size[0]) // 3,
    (QRimg.size[1] - logo.size[1]) // 4
)

# Insertion du logo au centre du QR code
QRimg.paste(logo, pos)
# QRimg.paste(logo, pos, mask=logo)

# Sauvegarde de l'image finale
QRimg.save('QR_code.png')

print('QR code généré')
```
