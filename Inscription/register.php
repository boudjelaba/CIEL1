<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('config.php');
if (isset($_REQUEST['nom'], $_REQUEST['mail'], $_REQUEST['mot_de_passe'])){
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$nom = stripslashes($_REQUEST['nom']);
	$nom = mysqli_real_escape_string($conn, $nom); 
	// récupérer l'email et supprimer les antislashes ajoutés par le formulaire
	$mail = stripslashes($_REQUEST['mail']);
	$mail = mysqli_real_escape_string($conn, $mail);
	// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
	$mot_de_passe = stripslashes($_REQUEST['mot_de_passe']);
	$mot_de_passe = mysqli_real_escape_string($conn, $mot_de_passe);
	//requéte SQL + mot de passe crypté
    $query = "INSERT into `administrateurs` (nom, mail, mot_de_passe) VALUES ('$nom', '$mail', '".hash('sha256', $mot_de_passe)."')";
	// Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){
       echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
			 </div>";
    }
}else{
?>
<form class="box" action="" method="post">
	<h1 class="box-logo box-title"><a href="https://carnus.fr/" target="blank">Carnus Ens. Supérieur</a></h1>
    <h1 class="box-title">Inscription</h1>
	<input type="text" class="box-input" name="name" placeholder="Nom d'utilisateur" required />
    <input type="text" class="box-input" name="email" placeholder="Mail" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />
    <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
</form>
<?php } ?>
</body>
</html>