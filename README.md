# <cite><font color="(0,68,88)">Informatique : CIEL-1</font></cite>

<a href="https://carnus.fr"><img src="https://img.shields.io/badge/Carnus%20Enseignement Supérieur-F2A900?style=for-the-badge" /></a>
<a href="https://carnus.fr"><img src="https://img.shields.io/badge/BTS%20CIEL-2962FF?style=for-the-badge" /></a>

---

```html
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dashboard Supervision</title>
<link rel="stylesheet" href="style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<h1>Dashboard Supervision</h1>
<div id="machines"></div>
<canvas id="cpuChart" width="400" height="200"></canvas>
<script src="script.js"></script>
</body>
</html>
```

```javascript
const machinesDiv = document.getElementById("machines");
const ctx = document.getElementById("cpuChart").getContext("2d");
let cpuChart;

async function fetchData() {{
    const response = await fetch("http://127.0.0.1:5000/data");
    const data = await response.json();

    machinesDiv.innerHTML = "";
    let labels = [];
    let cpuValues = [];
    data.forEach(machine => {{
        const div = document.createElement("div");
        div.textContent = `{{machine.machine}} - Temp: {{machine['{temp_field}']}}°C - CPU: {{machine['{cpu_field}']}}%`;
        div.style.color = machine['{temp_field}'] > 60 ? "red" : "black";
        machinesDiv.appendChild(div);
        labels.push(machine.machine);
        cpuValues.push(machine['{cpu_field}']);
    }});

    if(cpuChart) cpuChart.destroy();
    cpuChart = new Chart(ctx, {{
        type: 'bar',
        data: {{
            labels: labels,
            datasets: [{{
                label: 'CPU (%)',
                data: cpuValues,
                backgroundColor: 'rgba(54, 162, 235, 0.5)'
            }}]
        }}
    }});
}}

fetchData();
setInterval(fetchData, 5000);
```

```python
import os
import json
import random
from datetime import datetime
import shutil

# -------- IDENTITE --------
name = input("Nom ou identifiant : ").strip()
seed = sum(ord(c) for c in name)
random.seed(seed)

# -------- CONFIG --------
machines = ["alpha", "beta", "gamma", "delta"]
machine_count = random.randint(3, 4)

temp_field = random.choice(["temperature", "temp", "t"])
cpu_field = random.choice(["cpu", "cpu_load", "usage"])

# -------- CREATION DOSSIERS --------
base_dir = f"projet_{name}"
for sub in ["backend", "frontend", "data"]:
    os.makedirs(os.path.join(base_dir, sub), exist_ok=True)

# -------- GENERATION JSON --------
data_list = []
for _ in range(machine_count):
    data_list.append({
        "machine": random.choice(machines),
        temp_field: random.randint(20, 80),
        cpu_field: random.randint(0, 100),
        "timestamp": datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    })

json_file = os.path.join(base_dir, "data", f"data_{name}.json")
with open(json_file, "w") as f:
    json.dump(data_list, f, indent=4)
```

