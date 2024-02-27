<?php
	require('config.php');

	if(isset($_POST['submit'])){
		$nom = stripslashes($_POST['nom']);
		$nom = mysqli_real_escape_string($con, $nom);
		$prenom = stripslashes($_POST['prenom']);
		$prenom = mysqli_real_escape_string($con, $prenom);
		$mail = stripslashes($_POST['mail']);
		$mail = mysqli_real_escape_string($con, $mail);
		$mdp = stripslashes($_POST['mdp']);
		$mdp = mysqli_real_escape_string($con, md5($mdp));
	   $select = mysqli_query($con, "SELECT * FROM `etudiants` WHERE mail = '$mail' AND mdp = '$mdp'") or die('Erreur de requête');

	   if(mysqli_num_rows($select) > 0){
	      $message[] = 'Cet utilisateur existe déjà!';
	   }else{
	      mysqli_query($con, "INSERT INTO `etudiants`(nom, prenom, mail, mdp, date_ins, image) VALUES('$nom', '$prenom', '$mail', '$mdp', now(), 'profile.jpg')") or die('Erreur de requête');
	      $message[] = 'Compte créé avec succès!';
	      header('location:login.php');
	   }

	}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="stylesheet" href="styleR.css" />
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
	  href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap"
	  rel="stylesheet"
	/>
	<link
	  href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
	  rel="stylesheet"
	/>
	<title>Création de compte</title>
</head>

<body>
	<!-- +++++++++++++++++ -->
	<header>
		<!-- <a href="https://carnus.fr" target="_blank"><img src="logo1.pdf" alt="logo"></a> -->
		<img src="logo1.pdf" alt="logo">
		<nav>
			<ul class="nav_links">
				<li>
					<span class="nav-item active">
						<a href="index.php">
							<span class="icon">
								<i class="fa-regular fa-house"></i>
							</span>
							&nbsp; Accueil
						</a>
					</span>
				</li>
				<li>
					<span class="nav-item">
						<a href="index.php">
							<span class="icon">
								<i class="fa-solid fa-shop"></i>
							</span>
							&nbsp; Boutique
						</a>
					</span>
				</li>
				<li>
					<span class="nav-item">
						<a href="panier.php">
							<span class="icon">
								<span class="subicon">
									<?php if(isset($_SESSION['panier'])){ echo array_sum($_SESSION['panier']);}
									else echo 0;?>
								</span>
								<i class="fa-solid fa-cart-shopping"></i>
							</span>
							&nbsp; Panier
						</a>
					</span>
				</li>
				<li>
					<span class="nav-item">
						<a href="#">
							<span class="icon">
								<span class="subicon">1</span>
								<i class="fa-solid fa-bell"></i>
							</span>
							&nbsp; Notifications
						</a>
					</span>
				</li>
			<!-- </ul> -->
		</nav>

		<section class="cta">
			<div class="imgcirc" style="background-image: url('<?php if(isset($_SESSION['utilisateur'])){ echo $_SESSION['image'];}
				else echo "pp.png";?>'); background-position: -10% 50%; background-size: cover;">
			</div>
			<ul>
				<?php if(isset($_SESSION['utilisateur'])){ echo 
					'<a href="compte.php">
					<li class="sub-item">
					<span class="material-icons-outlined">
					grid_view </span>
					<p>Mon compte</p>
					</li></a>
					<a href="modif_c.php">
					<li class="sub-item">
						<span class="material-icons-outlined"> manage_accounts </span>
						<p>Modifier Profile</p>
					</li></a>
					<a href="logout.php">
					<li class="sub-item">
						<span class="material-icons-outlined"> logout </span>
						<p>Déconnexion</p>
					</li></a>' ;}
				else { echo 
					'<a href="login.php">
					<li class="sub-item">
					<span class="material-icons-outlined"> login </span>
					<p>Se connecter</p>
					</li></a>
					
					<a href="register.php">
					<li class="sub-item">
						<span class="material-icons-outlined"> person_add </span>
						<p>Créer un compte</p>
					</li></a>
					' ;} ?>
			</ul>
		</section>
		</ul>
	</header>

	<!-- +++++++++++++++++ -->

	<?php
	if(isset($message)){
		foreach($message as $message){
			echo '<div class="MessageErreur" onclick="this.remove();">'.$message.'</div>';
		}
	}
	?>
	
	<?php
	if(!isset($_POST['submit'])) {
		?>
		<form class="box" action="" method="post">
			<h1 class="box-logo box-title"><a href="https://carnus.fr/" target="_blank"><img src="logo1.pdf" width="240px" alt=""></a></h1>
			<h1 class="box-title">Inscription <i class="fa-solid fa-user-plus"></i></h1>
			<input type="text" class="box-input" name="nom" placeholder="Nom" required />
			<input type="text" class="box-input" name="prenom" placeholder="Prénom" required />
			<input type="email" class="box-input" name="mail" placeholder="Adresse Mail" required />
			<input type="password" class="box-input" name="mdp" placeholder="Mot de passe" required />
			<input type="submit" name="submit" value="Envoyer" class="box-button" />
			<p class="box-register">Vous avez un compte ? <a href="login.php">Se connecter</a></p>
		</form>
	<?php 
	} ?>


	<footer class="footer">
	  	 <div class="container">
	  	 	<div class="row">
	  	 		<div class="footer-col">
	  	 			<h4>Carnus</h4>
	  	 			<ul>
	  	 				<li><a href="https://www.carnus.fr/formations/bts-cybersecurite-informatique-et-reseaux-electronique-option-informatique-et-reseaux/" target="_blank">BTS CIEL</a></li>
	  	 				<li><a href="https://carnus.fr" target="_blank">carnus.fr</a></li>
	  	 			</ul>
	  	 		</div>
	  	 		<div class="footer-col">
	  	 			<h4>Boutique</h4>
	  	 			<ul>
	  	 				<li><a href="index.php">Nos produits</a></li>
	  	 				<li><a href="#">Modes de paiement</a></li>
	  	 			</ul>
	  	 		</div>
	  	 		<div class="footer-col">
	  	 			<h4>Contact</h4>
	  	 			<ul>
	  	 				<li><a href="mailto:lycee@carnus.fr"><i class="fa-solid fa-envelope"></i>&nbsp;lycee@carnus.fr</a></li>
	  	 				<li><a href="tel:+33565733700"><i class="fa-solid fa-phone"></i>&nbsp;05 65 73 37 00</a></li>
	  	 			</ul>
	  	 		</div>
	  	 		<div class="footer-col">
	  	 			<h4>Nos réseaux</h4>
	  	 			<div class="social-links">
	  	 				<a href="https://www.facebook.com/lyceecarnus/" target="_blank"><i class="fab fa-facebook-f"></i></a>
	  	 				<!-- <a href="https://github.com/boudjelaba" target="_blank"><i class="fab fa-github"></i></a> -->
	  	 				<a href="https://www.instagram.com/instacharlescarnusrodez/" target="_blank"><i class="fab fa-instagram"></i></a>
	  	 				<a href="https://www.linkedin.com/company/charlescarnusrodez/?viewAsMember=true" target="_blank"><i class="fab fa-linkedin-in"></i></a>
	  	 			</div>
	  	 		</div>
	  	 	</div>
	  	 </div>
	  </footer>

</body>
</html>