<?php
	require('config.php');
	session_start();

	if(isset($_POST['submit'])){
		$mail = stripslashes($_POST['mail']);
		$mail = mysqli_real_escape_string($con, $mail);
		$mdp = stripslashes($_POST['mdp']);
		$mdp = mysqli_real_escape_string($con, md5($mdp));
		$select_c = mysqli_query($con, "SELECT * FROM `etudiants` WHERE mail = '$mail' AND mdp = '$mdp'") or die('Requête échouée');
		if(mysqli_num_rows($select_c) > 0){
			$row_c = mysqli_fetch_assoc($select_c);
			$_SESSION['id_client'] = $row_c['id'];
			header('location:index.php');
		}else{
			$message[] = 'Identifiants incorrects!';
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
	<title>Connexion</title>
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

	<form class="box" action="" method="post" name="login">
		<h1 class="box-logo box-title"><a href="https://carnus.fr/" target="_blank"><img src="logo1.pdf" width="240px" alt=""> </a></h1>
		<h1 class="box-title">Connexion <i class="fa-solid fa-arrow-right-to-bracket"></i></h1>
		<input type="email" class="box-input" name="mail" placeholder="Adresse Mail">
		<input type="password" class="box-input" name="mdp" placeholder="Mot de passe">
		<input type="submit" value="Connexion " name="submit" class="box-button">
		<p class="box-register">Vous n'avez pas de compte ? <a href="register.php">S'inscrire</a></p>
		<?php if (! empty($message)) { ?>
			<p class="MessageErreur"><?php echo $message; ?></p>
		<?php } ?>
	</form>





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