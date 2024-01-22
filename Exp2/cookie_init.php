<?php
	setcookie("panier[Portable]", 0);
	setcookie("panier[Chargeur]", 0);
	setcookie("panier[Disque]", 0);
	setcookie("panier[Câble]", 0);
	header("Location: cookie_ajout.php");
?>