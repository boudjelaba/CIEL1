<?php
	require('config.php');
	session_start();

	if(isset($_POST['submit'])){
	   $nom = trim($_POST["nom"]);
	   $nom = stripslashes($nom);
	   $nom = mysqli_real_escape_string($connection, $nom);

	   $prenom = trim($_POST["prenom"]);
	   $prenom = stripslashes($prenom);
	   $prenom = mysqli_real_escape_string($connection, $prenom);

	   $mail = trim($_POST["mail"]);
	   $mail = stripslashes($mail);
	   $mail = mysqli_real_escape_string($connection, $mail);

	   $mdp = trim($_POST["mdp"]);
	   $mdp = stripslashes($mdp);
	   $mdp = mysqli_real_escape_string($connection, md5($mdp));


	   $select = " SELECT * FROM register WHERE mail = '$mail' && mdp = '$mdp' ";
	   $result = mysqli_query($connection, $select);
	   if(mysqli_num_rows($result) > 0){
	      $error[] = 'Ce compte existe déjà!';
	   }else{
	   	$insert = "INSERT INTO register(nom, prenom, mail, mdp) VALUES('$nom','$prenom','$mail','$mdp')";
	   	mysqli_query($connection, $insert);
	   	header('location:A_login.php');
	    }
	};
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