<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<?php
	require('config.php');
	if (isset($_REQUEST['utilisateur'], $_REQUEST['mail'], $_REQUEST['mdp'])){
		// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
		$utilisateur = stripslashes($_REQUEST['utilisateur']);
		$utilisateur = mysqli_real_escape_string($conn, $utilisateur); 
		// récupérer l'adresse mail et supprimer les antislashes ajoutés par le formulaire
		$mail = stripslashes($_REQUEST['mail']);
		$mail = mysqli_real_escape_string($conn, $mail);
		// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
		$mdp = stripslashes($_REQUEST['mdp']);
		$mdp = mysqli_real_escape_string($conn, $mdp);
		//requéte SQL + mot de passe crypté
		$query = "INSERT into `utilisateurs` (utilisateur, mail, mdp)
		VALUES ('$utilisateur', '$mail', '".hash('sha256', $mdp)."')";
		// Exécute la requête sur la base de données
			$res = mysqli_query($conn, $query);
			if($res){
				echo "<div class='succes'>
				<h3>Vous êtes inscrit avec succès.</h3>
				<p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
				</div>";
			}
		}
		else {
			?>
			<form class="box" action="" method="post">
				<h1 class="box-logo box-title"><a href="https://carnus.fr/" target="_blank"><img src="logo3.pdf" width="240px" alt=""></a></h1>
				<h1 class="box-title">Inscription <i class="fa-solid fa-user-plus"></i></h1>
				<input type="text" class="box-input" name="utilisateur" placeholder="Nom d'utilisateur" required />
				<input type="text" class="box-input" name="mail" placeholder="Adresse Mail" required />
				<input type="password" class="box-input" name="mdp" placeholder="Mot de passe" required />
				<input type="submit" name="submit" value="Envoyer" class="box-button" />
				<p class="box-register">Vous avez un compte ? <a href="login.php">Se connecter</a></p>
			</form>
		<?php } ?>
	</body>
	</html>