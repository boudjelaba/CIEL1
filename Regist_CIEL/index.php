<?php
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	if(!isset($_SESSION["utilisateur"])){
		header("Location: login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<div class="succes">
		<h1><i class="fa-solid fa-id-card"></i> Bienvenue <?php echo $_SESSION['utilisateur']; ?> !</h1>
		<p>Votre page d'accueil.</p>
		<a href="logout.php">Déconnexion <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
	</div>
</body>
</html>