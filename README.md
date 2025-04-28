# ⬇️ <cite><font color="(0,68,88)">Informatique : CIEL-1</font></cite>

<a href="https://carnus.fr"><img src="https://img.shields.io/badge/Carnus%20Enseignement Supérieur-F2A900?style=for-the-badge" /></a>
<a href="https://carnus.fr"><img src="https://img.shields.io/badge/BTS%20CIEL-2962FF?style=for-the-badge" /></a>

```python
from datetime import datetime

def create_ics(event_data):
    ics_content = f"""BEGIN:VCALENDAR
VERSION:2.0
BEGIN:VEVENT
SUMMARY:{event_data['summary']}
DTSTART:{event_data['start']}
DTEND:{event_data['end']}
LOCATION:{event_data['location']}
DESCRIPTION:{event_data['description']}
END:VEVENT
END:VCALENDAR"""
    
    return ics_content

# Exemple d’événement
event = {
    "summary": "Journée Portes Ouvertes",
    "start": "20250427T100000Z",
    "end": "20250427T160000Z",
    "location": "Carnus Enseignement Supérieur, Avenue de Bourran, Rodez",
    "description": "Venez découvrir nos formations !"
}

ics_data = create_ics(event)

# Sauvegarde dans un fichier .ics
with open("JPO.ics", "w") as file:
    file.write(ics_data)
```
