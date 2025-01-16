<?php
	require('config.php');
	session_start();

	$nom = $prenom = $mail = $mdp = "";
	$nom_err = $prenom_err = $mail_err = $mdp_err = "";

	if(isset($_POST['submit'])){
		/* Validation du nom */
		$input_nom = trim($_POST["nom"]);
		if(empty($input_nom)){
		    $nom_err = "Entrer un nom.";
		    $message[] = 'Entrer un nom.';
		} elseif(!filter_var($input_nom, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
		    $nom_err = "Entrer un nom valide.";
		    $message[] = 'Entrer un nom valide.';
		} else{
		    $nom = stripslashes($input_nom);
		    $nom = mysqli_real_escape_string($connection, $nom);
		}

		/* Validation du prenom */
		$input_prenom = trim($_POST["prenom"]);
		if(empty($input_prenom)){
		    $prenom_err = "Entrer un prénom.";
		    $message[] = 'Entrer un prénom.';
		} elseif(!filter_var($input_prenom, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
		    $prenom_err = "Entrer un prénom valide.";
		    $message[] = 'Entrer un prénom valide.';
		} else{
		    $prenom = stripslashes($input_prenom);
		    $prenom = mysqli_real_escape_string($connection, $prenom);
		}

		/* Validation du mail */
		$input_mail = trim($_POST["mail"]);
		if(empty($input_mail)){
		    $mail_err = "Entrer une adresse mail.";
		    $message[] = 'Entrer une adresse mail.';     
		} elseif(filter_var($input_mail,FILTER_VALIDATE_EMAIL)) {
		    $mail = stripslashes($input_mail);
		    $mail = mysqli_real_escape_string($connection, $mail);
		}

		/* Validation du mot de passe */
		$input_mdp = trim($_POST["mdp"]);
		if(empty($input_mdp)){
		    $mdp_err = "Entrer un mot de passe.";
		    $message[] = 'Entrer un mot de passe.';     
		} else{
		    $mdp = stripslashes($input_mdp);
		    $mdp = mysqli_real_escape_string($connection, md5($mdp));
		}

		/* verifiez les erreurs avant enregistrement */
		if(empty($nom_err) && empty($prenom_err) && empty($mail_err) && empty($mdp_err)){
			$select = mysqli_query($connection, "SELECT * FROM `register` WHERE mail = '$mail' AND mdp = '$mdp'") or die('Erreur de requête');
			if(mysqli_num_rows($select) > 0){
				$message[] = 'Cet utilisateur existe déjà!';
			}else{
				mysqli_query($connection, "INSERT INTO `register`(nom, prenom, mail, mdp) VALUES('$nom', '$prenom', '$mail', '$mdp')") or die('Erreur de requête');
				$message[] = 'Compte créé avec succès!';
				header('location:1_login.php');
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Page de création de compte</title>
</head>
<body>

	<ul>
		<li><a href="A_index.php">Page Index</a></li>
		<li><a href="A_register.php">Page de création de compte</a></li>
		<li><a href="A_login.php">Page de connexion</a></li>
	</ul>


	<?php
		if(isset($message) && isset($_POST['submit'])){
			foreach($message as $message){
				echo '<div class="MessageErreur" onclick="this.remove();">'.$message.'</div>';
			}
		}
	?>
	<form action="" method="post">
		<h1>Inscription </h1>
		<input type="text" name="nom" placeholder="Nom" required />
		<br><br>
		<input type="text" name="prenom" placeholder="Prénom" required />
		<br><br>
		<input type="email" name="mail" placeholder="Adresse Mail" required />
		<br><br>
		<input type="password" name="mdp" placeholder="Mot de passe" required />
		<br><br>
		<input type="submit" name="submit" value="Valider" />
		<br>
		<p>Vous avez un compte ? <a href="A_login.php">Se connecter</a></p>
	</form>


</body>
</html>