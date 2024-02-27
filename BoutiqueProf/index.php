<?php

include 'config.php';
session_start();
$id_client = $_SESSION['id_client'];

if(!isset($id_client)){
   header('location:login.php');
};

if(!isset($_SESSION['panier'])){
	$_SESSION['panier'] = array();
}

if(isset($_GET['logout'])){
   unset($id_client);
   session_destroy();
   header('location:login.php');
};

if(isset($_POST['ajouter_panier'])){
   $nom = $_POST['nom'];
   $ref = $_POST['ref'];
   $prix = $_POST['prix'];
   $image = $_POST['image'];
   $quantite = $_POST['quantite'];

   $select_panier = mysqli_query($con, "SELECT * FROM `panier` WHERE nom = '$nom' AND id_client = '$id_client'") or die('La requête a échoué');

   if(isset($_SESSION['panier'][$nom])){// si le produit est déjà dans le panier
        $_SESSION['panier'][$nom]++; //Représente la quantité 
    }else {
        //si non, on ajoute le produit
        $_SESSION['panier'][$nom]= 1;
    }

   if(mysqli_num_rows($select_panier) > 0){
      $message[] = 'Produit déjà ajouté au panier!';
   }else{
      mysqli_query($con, "INSERT INTO `panier`(id_client, nom, ref, prix, image, quantite) VALUES('$id_client', '$nom', '$ref', '$prix', '$image', '$quantite')") or die('La requête a échoué');
      $message[] = 'Produit ajouté au panier!';
   }

};

if(isset($_POST['update_panier'])){
   $update_qt = $_POST['panier_qt'];
   $update_id = $_POST['panier_id'];
   mysqli_query($con, "UPDATE `panier` SET quantite = '$update_qt' WHERE id = '$update_id'") or die('La requête a échoué');
   $message[] = 'La quantité du panier a été mise à jour avec succès!';
}

if(isset($_GET['supprimer'])){
   $supp_id = $_GET['supprimer'];
   mysqli_query($con, "DELETE FROM `panier` WHERE id = '$supp_id'") or die('La requête a échoué');
   header('location:index.php');
}
  
if(isset($_GET['vider'])){
   mysqli_query($con, "DELETE FROM `panier` WHERE id_client = '$id_client'") or die('La requête a échoué');
   header('location:index.php');
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
	<title>Boutique</title>
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
			<div class="imgcirc" style="background-image: url('<?php if(isset($_SESSION["id_client"])){ $select_compte = mysqli_query($con, "SELECT * FROM `etudiants` WHERE id = '$id_client'") or die('Requête échouée');
				if(mysqli_num_rows($select_compte) > 0){
					$fetch_compte = mysqli_fetch_assoc($select_compte);}; echo $fetch_compte["image"];}
				else {echo "pp.png";}?>'); background-position: -10% 50%; background-size: cover;">
			</div>
			<ul>
				<?php if(isset($_SESSION['id_client'])){ echo 
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


<div id="grille-produit">
	<?php
	$article = mysqli_query($con,"SELECT * FROM produits ORDER BY id_prod ASC")or die('La requête a échoué');
  if(mysqli_num_rows($article) > 0){
         while($fetch_produit = mysqli_fetch_assoc($article)){
	?>
	<form method="post" action="">
	<div class="item-produit">
		<div class="card__header">
			<div class="image-produit">
				<img src="<?php echo $fetch_produit["image"]; ?>" alt="card__image" class="card__image" width="600">
			</div>
		</div>
		<div class="card__body">
			<h4><?php echo $fetch_produit["nom"]; ?></h4>
			<span>Réf. <?php echo $fetch_produit["ref"]; ?></span>
			<h5><?php echo "Prix : " . $fetch_produit["prix"] . " €"; ?></h5>
		</div>
		<div class="card__footer">
			<input type="number" class="quantite-produit" name="quantite" value="1" min="0" max="20" />
			<input type="hidden" name="image" value="<?php echo $fetch_produit['image']; ?>">
			<input type="hidden" name="nom" value="<?php echo $fetch_produit['nom']; ?>">
			<input type="hidden" name="ref" value="<?php echo $fetch_produit['ref']; ?>">
			<input type="hidden" name="prix" value="<?php echo $fetch_produit['prix']; ?>">

			<input type="submit" value="Ajouter au panier" name="ajouter_panier" class="btnActionAjout">
    </div>
  </div>
  </form>

    <?php
    	}
    } else {
    	echo "Pas de produits.";
    }
    ?>

</div>










<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->

<!-- <div class="shopping-cart">

   <h1 class="heading">Panier</h1>

   <table>
      <thead>
         <th>image</th>
         <th>nom</th>
         <th>référence</th>
         <th>prix</th>
         <th>quantité</th>
         <th>prix total</th>
         <th>action</th>
      </thead>
      <tbody>
      <?php
         $panier_query = mysqli_query($con, "SELECT * FROM `panier` WHERE id_client = '$id_client'") or die('La requête a échoué');
         $grand_total = 0;
         if(mysqli_num_rows($panier_query) > 0){
            while($fetch_panier = mysqli_fetch_assoc($panier_query)){
      ?>
         <tr>
            <td><img src="<?php echo $fetch_panier['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_panier['nom']; ?></td>
            <td><?php echo $fetch_panier['ref']; ?></td>
            <td><?php echo $fetch_panier['prix']; ?> €</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="panier_id" value="<?php echo $fetch_panier['id']; ?>">
                  <input type="number" min="1" name="panier_qt" value="<?php echo $fetch_panier['quantite']; ?>">
                  <input type="submit" name="update_panier" value="update" class="option-btn">
               </form>
            </td>
            <td><?php echo $sous_total = ($fetch_panier['prix'] * $fetch_panier['quantite']); ?> €</td>
            <td><a href="index.php?supprimer=<?php echo $fetch_panier['id']; ?>" class="delete-btn" onclick="return confirm('supprimer article du panier?');">Supprimer</a></td>
         </tr>
      <?php
         $grand_total += $sous_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">Aucun article ajouté</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">grand total :</td>
         <td><?php echo $grand_total; ?> €</td>
         <td><a href="index.php?vider" onclick="return confirm('Tout supprimer du panier ?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Vider le panier</a></td>
      </tr>
   </tbody>
   </table>

   <div class="cart-btn">  
      <a href="#" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Passer la commande</a>
   </div>

</div> -->


<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->



<!-- <div class="table-users">
   <div class="theader">Panier</div>
   
   <table cellspacing="0">
      <tr>
         <th>Image</th>
         <th>Nom</th>
         <th>Référence</th>
         <th>Prix (unit.)</th>
         <th>Quantité</th>
         <th>Prix</th>
         <th>Action</th>
      </tr>
      <?php
         $panier_query = mysqli_query($con, "SELECT * FROM `panier` WHERE id_client = '$id_client'") or die('La requête a échoué');
         $grand_total = 0;
         if(mysqli_num_rows($panier_query) > 0){
            while($fetch_panier = mysqli_fetch_assoc($panier_query)){
      ?>

      <tr>
         <td><img src="<?php echo $fetch_panier['image']; ?>" height="100" alt=""></td>
         <td><?php echo $fetch_panier['nom']; ?></td>
         <td><?php echo $fetch_panier['ref']; ?></td>
         <td><?php echo $fetch_panier['prix']; ?> €</td>
         <td>
            <form action="" method="post">
               <input type="hidden" name="panier_id" value="<?php echo $fetch_panier['id']; ?>">
               <input type="number" class="quantite-produit2" min="1" name="panier_qt" value="<?php echo $fetch_panier['quantite']; ?>">
               <input type="submit" name="update_panier" value="modifier" class="option-btn">
            </form>
         </td>
         <td><?php echo $sous_total = ($fetch_panier['prix'] * $fetch_panier['quantite']); ?> €</td>
         <td><a href="index.php?supprimer=<?php echo $fetch_panier['id']; ?>" class="delete-btn" onclick="return confirm('supprimer article du panier?');">Supprimer</a></td>
      </tr>
      <?php
         $grand_total += $sous_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;color:var(--red);opacity:0.5" colspan="7">Aucun article dans le panier</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="5">Total TTC :</td>
         <td><?php echo $grand_total; ?> €</td>
         <td><a href="index.php?vider" onclick="return confirm('Tout supprimer du panier ?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Vider le panier</a></td>
      </tr>
   </table>

</div>

   <div class="cart-btn2">  
      <a href="#" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Passer la commande</a>
   </div> -->






















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