<?php
    $panier = $_COOKIE["panier"];

    $total  = 0;
    $total += $panier["Portable"];
    $total += $panier["Chargeur"];
    $total += $panier["Disque"];
    $total += $panier["Câble"];

    $prix = 0;
    $prix += $panier["Portable"]*500;
    $prix += $panier["Chargeur"]*25;
    $prix += $panier["Disque"]*100;
    $prix += $panier["Câble"]*10;
?>

<html>
<head>
	<title>Le total du panier</title>
</head>
<body style="background-color: #fff; margin: 50px;">
	<p align="center">Le nombre d'article de votre panier : <?php echo $total ?>.</p>

    <p align="center">Le montant de votre panier : <?php echo $prix ?>.</p>

	<p align="center"><a href="cookie_ajout.php">Modifier mon panier</a></p>
	<p align="center"><a href="cookie_init.php">Vider mon panier</a></p>
</body>
</html>