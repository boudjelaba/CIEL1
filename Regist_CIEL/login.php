<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<?php
	require('config.php');
	session_start();

	if (isset($_POST['utilisateur'])){
		$utilisateur = stripslashes($_REQUEST['utilisateur']);
		$utilisateur = mysqli_real_escape_string($conn, $utilisateur);
		$mdp = stripslashes($_REQUEST['mdp']);
		$mdp = mysqli_real_escape_string($conn, $mdp);
		$query = "SELECT * FROM `utilisateurs` WHERE utilisateur='$utilisateur' and mdp='".hash('sha256', $mdp)."'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
		if($rows==1){
			$_SESSION['utilisateur'] = $utilisateur;
			header("Location: index.php");
		}else{
			$message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
		}
	}
	?>
	<form class="box" action="" method="post" name="login">
		<h1 class="box-logo box-title"><a href="https://carnus.fr/" target="_blank"><img src="logo3.pdf" width="240px" alt=""> </a></h1>
		<h1 class="box-title">Connexion <i class="fa-solid fa-arrow-right-to-bracket"></i></h1>
		<input type="text" class="box-input" name="utilisateur" placeholder="Nom d'utilisateur">
		<input type="password" class="box-input" name="mdp" placeholder="Mot de passe">
		<input type="submit" value="Connexion " name="submit" class="box-button">
		<p class="box-register">Vous n'avez pas de compte ? <a href="register.php">S'inscrire</a></p>
		<?php if (! empty($message)) { ?>
			<p class="MessageErreur"><?php echo $message; ?></p>
		<?php } ?>
	</form>
</body>
</html>