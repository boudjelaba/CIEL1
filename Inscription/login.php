<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('config.php');
session_start();

if (isset($_POST['nom'])){
	$nom = stripslashes($_REQUEST['nom']);
	$nom = mysqli_real_escape_string($conn, $nom);
	$mot_de_passe = stripslashes($_REQUEST['mot_de_passe']);
	$mot_de_passe = mysqli_real_escape_string($conn, $mot_de_passe);
    $query = "SELECT * FROM `administrateurs` WHERE nom='$nom' and mot_de_passe='".hash('sha256', $mot_de_passe)."'";
	$result = mysqli_query($conn,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
	if($rows==1){
	    $_SESSION['nom'] = $nom;
	    header("Location: index.php");
	}else{
		$message = "Nom d'utilisateur ou mot de passe incorrect.";
	}
}
?>
<form class="box" action="" method="post" name="login">
<h1 class="box-logo box-title"><a href="https://carnus.fr/">Carnus Ens. Supérieur</a></h1>
<h1 class="box-title">Connexion</h1>
<input type="text" class="box-input" name="name" placeholder="Nom de famille">
<input type="password" class="box-input" name="password" placeholder="Mot de passe">
<input type="submit" value="Connexion " name="submit" class="box-button">
<p class="box-register">Vous êtes nouveau ici ? <a href="register.php">S'inscrire</a></p>
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>
</body>
</html>