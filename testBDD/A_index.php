<?php
session_start();
require_once("config.php");

$id_compte = $_SESSION['id_compte'];

if(isset($_POST['logout'])){
   unset($id_compte);
   session_destroy();
   header('location:A_index.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Page Index</title>
</head>
<body>
	<ul>
		<li><a href="A_index.php">Page Index</a></li>
		<li><a href="A_register.php">Page de création de compte</a></li>
		<li><a href="A_login.php">Page de connexion</a></li>
	</ul>

	<?php if(isset($_SESSION['id_compte'])){ echo 
		'<h1>Bonjour ' . ' ' . $_SESSION["id_compte"] . ' ' . $_SESSION["nom"] . ' ' . $_SESSION["prenom"] . ' ' . $_SESSION["mail"] . ' ' . $_SESSION["mdp"] . '</h1>
		<h2> Bienvenue au site </h2>

		<a href="A_logout.php"><button> Déconnexion</button></a>
		
		';}
		else { echo 
			"<h1>Bonjour, vous n'êtes pas connecté.</h1> 
			<h2> Bienvenue au site </h2>

			<a href='A_login.php'><button> Connexion</button></a>
			";} ?>




</body>
</html>