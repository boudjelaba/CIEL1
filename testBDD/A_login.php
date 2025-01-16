<?php
	require('config.php');
	session_start();

	if(isset($_POST['submit'])){
		$mail = stripslashes($_POST['mail']);
		$mail = mysqli_real_escape_string($connection, $mail);
		$mdp = stripslashes($_POST['mdp']);
		$mdp = mysqli_real_escape_string($connection, md5($mdp));
		$select_c = mysqli_query($connection, "SELECT * FROM `register` WHERE mail = '$mail' AND mdp = '$mdp'") or die('Requête échouée');
		if(mysqli_num_rows($select_c) > 0){
			$row_c = mysqli_fetch_assoc($select_c);
			$_SESSION['id_compte'] = $row_c['id'];
			$_SESSION['nom'] = $row_c['nom'];
			$_SESSION['prenom'] = $row_c['prenom'];
			$_SESSION['mail'] = $row_c['mail'];
			$_SESSION['mdp'] = $row_c['mdp'];
			header('location:A_index.php');
		}else{
			$message[] = 'Identifiants incorrects!';
		}
	}
?>

<!-- 
++++++ Compte ++++++
********************
********************
Mail : bts@carnus.fr
MDP : admin
********************
********************
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Page de Connexion</title>
</head>
<body>

	<ul>
		<li><a href="A_index.php">Page Index</a></li>
		<li><a href="A_register.php">Page de création de compte</a></li>
		<li><a href="A_login.php">Page de connexion</a></li>
	</ul>


	<?php
		if(isset($message)){
			foreach($message as $message){
				echo '<div class="MessageErreur" onclick="this.remove();">'.$message.'</div>';
			}
		}
	?>
	<form action="" method="post">
		<h1>Connexion </h1>
		<input type="text" name="mail" placeholder="Adresse Mail" required />
		<br><br>
		<input type="password" name="mdp" placeholder="Mot de passe" required />
		<br><br>
		<input type="submit" name="submit" value="Valider" />
		<br>
		<p>Vous n'avez pas de compte ? <a href="A_register.php">Créer un compte</a></p>
		<?php if (! empty($message)) { ?>
			<p class="MessageErreur"><?php echo $message; ?></p>
		<?php } ?>
	</form>



</body>
</html>