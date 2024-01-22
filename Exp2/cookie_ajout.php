<?php
		// Lecture du cookie
		$panier = $_COOKIE["panier"];

	switch ($_GET["ajout"])
	{
		case "Portable":
			$panier["Portable"]=$panier["Portable"]+1;
			setcookie("panier[Portable]",$panier["Portable"]);
			break;
		case "Chargeur":
			$panier["Chargeur"]++;
			setcookie("panier[Chargeur]",$panier["Chargeur"]);
			break;
		case "Disque":
			$panier["Disque"]++;
			setcookie("panier[Disque]",$panier["Disque"]);
			break;
		case "Câble":
			$panier["Câble"]++;
			setcookie("panier[Câble]",$panier["Câble"]);
			break;
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Panier</title>
</head>
<body style="background-color: #fff; margin: 50px;">
<table border="4" cellspacing="4" cellpadding="4" align="center">
	<tr align="center">
		<td>Ajouter</td>
		<td>Votre commande</td>
	</tr>
	<tr align="center">
		<td><a href="cookie_ajout.php?ajout=Portable">1 portable</a> (500 &#8364;)</td>
		<td><?php echo $panier["Portable"]?> Portable(s)</td>
	</tr>
	<tr align="center">
		<td><a href="cookie_ajout.php?ajout=Chargeur">1 chargeur</a> (25 &#8364;)</td>
		<td><?php echo $panier["Chargeur"]?> Chargeur(s)</td>
	</tr>
	<tr align="center">
		<td><a href="cookie_ajout.php?ajout=Disque">1 disque</a> (100 &#8364;)</td>
		<td><?php echo $panier["Disque"]?> Disque(s)</td>
	</tr>
	<tr align="center">
		<td><a href="cookie_ajout.php?ajout=Câble">1 c&acirc;ble</a> (10 &#8364;)</td>
		<td><?php echo $panier["Câble"]?> C&acirc;ble(s)</td>
	</tr>
</table>
<p align="center"><a href="cookie_init.php">Vider le panier</a></p>
<p align="center"><a href="cookie_calcul.php">Calculer le total</a></p>
</body>
</html>