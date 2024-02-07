<?php
session_start();
require_once("config.php");
?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Boutique</title>
	<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>

<!-- +++++++++++++++++ -->

	<nav class="menu" id="nav">
		<span class="nav-item active">
			<span class="icon">
				<i class="fa-regular fa-house"></i>
			</span>
			<a href="indexR.php">Accueil</a>
		</span>
		<span class="nav-item">
			<span class="icon">
				<i class="fa-solid fa-basket-shopping"></i>
			</span>
			<a href="index.php">Boutique</a>
		</span>
		<span class="nav-item">
			<span class="icon">
				<i class="fa-solid fa-user-plus"></i>
			</span>
			<a href="register.php">Création de compte</a>
		</span>
		<span class="nav-item">
			<span class="icon">
				<i class="fa-solid fa-right-to-bracket"></i>
			</span>
			<a href="login.php">Connexion</a>
		</span>
		<span class="nav-item">
			<span class="icon">
				<span class="subicon"><?php if(isset($_SESSION['panier'])){ echo array_sum($_SESSION['panier']);}
else echo 0;?></span>
				<i class="fa-solid fa-cart-shopping"></i>
			</span>
			<a href="panier.php">Panier</a>
		</span>
		<span class="nav-item">
			<span class="icon">
				<span class="subicon">1</span>
				<i class="fa-solid fa-bell"></i>
			</span>
			<a href="#">Notifications</a>
		</span>
		<span class="nav-item">
			<span class="icon">
				<div class="imgcirc" style="background-image: url('profile.jpg'); background-position: -10% 50%; background-size: cover;"></div>
			</span>
			<a href="#"></a>
		</span>
	</nav>

<!-- +++++++++++++++++ -->


<!-- Produits -->

<div id="grille-produit">
	<div class="txt-titre">Produits</div>
	<?php
	$article = mysqli_query($con,"SELECT * FROM produits ORDER BY id_prod ASC");
	if (!empty($article)) { 
		while ($row = mysqli_fetch_array($article)) {
		
	?>
	<div class="item-produit">
		<form action="">
			<div class="image-produit">
				<img src="<?php echo $row["image"]; ?>" >
			</div>
			<div class="txt-produit">
				<div class="nom-produit"><?php echo $row["nom"]; ?></div>
				<div class="prix-produit"><?php echo "Prix : " . $row["prix"] . " €"; ?></div>
				<div class="action-panier">
					<input type="number" class="quantite-produit" name="quantity" value="1" min="0" max="20" />
					<a href="ajouter_panier.php?id_prod=<?php echo $row['id_prod'];?>" class="btnActionAjout">Ajouter au panier</a>
				</div>
			</div>
		</form>
	</div>
	<?php
		}
	} else {
		echo "Pas de produits.";
	}
	?>
</div>

</body>
</html>