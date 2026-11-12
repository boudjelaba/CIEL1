## BTS CIEL-1

---

```php
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$_SESSION["visites"] = 0;
} else {
$_SESSION["visites"] = ($_SESSION["visites"] ?? 0) + 1;
}
?>
<p>Vous avez visité cette page <?= (int) $_SESSION["visites"] ?> fois.</p>
<form method="post"><button type="submit">Réinitialiser</button></form>
```

# Ressources de formation

Ce dépôt regroupe les ressources utilisées dans le cadre de la formation : supports de cours, exercices, travaux pratiques et documents complémentaires.

Les ressources sont organisées par thématique afin de faciliter leur consultation et leur réutilisation.

## Thématiques actuelles

### 01 — HTML / CSS

La partie HTML / CSS suit une progression basée sur des cours, des exercices et des travaux pratiques.

### 02 — Python

Supports et ressources consacrés à la programmation en Python.

### 04 — Anglais

Travaux pratiques et ressources liés à la co-animation d'anglais (professionnel), notamment autour de situations de dépannage et de communication avec un client.

### 05 — Programmation PHP / BDD

Supports et ressources consacrés à la programmation en PHP et aux bases de données (BDD).

## Organisation du dépôt

```text
.
├── 01_HTML_CSS/
├── 02_Python/
├── 04_Anglais/
└── 05_Programmation_PHP_BDD/
```

Le contenu de ce dépôt est **évolutif** et peut varier au fil de la formation.

Les documents peuvent être ajoutés, déplacés ou retirés en fonction des besoins. Les consignes ponctuelles, les exemples de code et autres éléments temporaires peuvent être ajoutés au dépôt pendant les séances, puis retirés lorsqu'ils ne sont plus nécessaires.

Il est donc normal que certains fichiers ou dossiers soient présents pendant une période donnée, puis supprimés ou réorganisés ultérieurement.

---
