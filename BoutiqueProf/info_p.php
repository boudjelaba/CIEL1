<?php

include 'config.php';
session_start();
$id_client = $_SESSION['id_client'];

if(!isset($id_client)){
  header('location:login.php');
};

if(isset($_GET['logout'])){
  unset($id_client);
  session_destroy();
  header('location:login.php');
};


$select_client = mysqli_query($con, "SELECT * FROM `etudiants` WHERE id = '$id_client'") or die('La requête a échoué');
if(mysqli_num_rows($select_client) > 0){
  $fetch_client = mysqli_fetch_assoc($select_client);
};

$nom = $fetch_client['nom'];
$prenom = $fetch_client['prenom'];
$mail = $fetch_client['mail'];
$id_com1 = $id_client;
$id_com2 = date("hidmy");
$id_com = array($id_com1,$id_com2);
$id_com = implode("", $id_com);

$panier_query = mysqli_query($con, "SELECT * FROM `panier` WHERE id_client = '$id_client'") or die('La requête a échoué');

$grand_total = 0;
if(mysqli_num_rows($panier_query) > 0){
  while($fetch_panier = mysqli_fetch_assoc($panier_query)){
    $sous_total = ($fetch_panier['prix'] * $fetch_panier['quantite']);
    $grand_total += $sous_total;
  }
}




if(isset($_POST['paiement'])){
  $ad1 = stripslashes($_POST['ad1']);
  $ad1 = mysqli_real_escape_string($con, $ad1);
  $ad2 = stripslashes($_POST['ad2']);
  $ad2 = mysqli_real_escape_string($con, $ad2);
  $ville = stripslashes($_POST['ville']);
  $ville = mysqli_real_escape_string($con, $ville);
  $code = stripslashes($_POST['code']);
  $code = mysqli_real_escape_string($con, $code);
  $pays = stripslashes($_POST['pays']);
  $pays = mysqli_real_escape_string($con, $pays);
  $tel = stripslashes($_POST['tel']);
  $tel = mysqli_real_escape_string($con, $tel);

  if ($grand_total != 0) {
  mysqli_query($con, "INSERT INTO `commande`(id_client, id_com, montant, nom, prenom, adresse1, adresse2, ville, code, pays, tel, etat) VALUES('$id_client', '$id_com', '$grand_total', '$nom', '$prenom', '$ad1', '$ad2', '$ville', '$code', '$pays', '$tel', 'En attente')") or die('Erreur de requête');
  // $message[] = 'Adresse de livraison enregistrée';

  // mysqli_query($con, "DELETE FROM `panier` WHERE id_client = '$id_client'") or die('La requête a échoué');

  }
  
  header('location:CB.php');

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="info_p.css" />
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
	<title>Info et paiement</title>
</head>
<body>


  <!-- +++++++++++++++++ -->

      <header>
          <!-- <a href="https://carnus.fr" target="_blank"><img src="logo1.pdf" alt="logo"></a> -->
          <img src="logo1.pdf" alt="logo">
          <nav>
              <ul class="nav_links">
                  <li>
                      <span class="nav-item">
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
                      <span class="nav-item active">
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




<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->




<br>
<div class="container">
  <div class="title">
      <h2>Informations de livraison et paiement</h2>
  </div>

  <?php
     $select_client = mysqli_query($con, "SELECT * FROM `etudiants` WHERE id = '$id_client'") or die('La requête a échoué');
     if(mysqli_num_rows($select_client) > 0){
        $fetch_client = mysqli_fetch_assoc($select_client);
     };
  ?>

<div class="d-flex">
  <form action="" method="post">
    <p> Client : <span><?php echo $fetch_client['nom'] . ' ' . $fetch_client['prenom']; ?></span> </p>
    <p> Mail : <span><?php echo $fetch_client['mail']; ?></span> </p><br>
<!--     <label>
      <span class="fname">Nom <span class="required">*</span></span>
      <input type="text" name="nom" placeholder="<?php echo $fetch_client['nom']; ?>">
    </label>
    <label>
      <span class="lname">Prénom <span class="required">*</span></span>
      <input type="text" name="prenom" placeholder="<?php echo $fetch_client['prenom']; ?>">
    </label> -->
    <label>
      <span>Adresse (rue) <span class="required">*</span></span>
      <input type="text" name="ad1" placeholder="N° et nom de rue" required>
    </label>
    <label>
      <span>&nbsp;</span>
      <input type="text" name="ad2" placeholder="Appartement (suite adresse). (optionnel)">
    </label>
    <label>
      <span>Ville <span class="required">*</span></span>
      <input type="text" name="ville" required> 
    </label>
    <label>
      <span>Code postal <span class="required">*</span></span>
      <input type="text" name="code" required> 
    </label>
    <label>
      <span>Pays <span class="required">*</span></span>
      <select name="pays" required>
        <option value="select">Selectionner un pays...</option>
        <option value="DEU">Allemagne</option>
        <option value="AND">Andorre</option>
        <option value="AUT">Autriche</option>
        <option value="BEL">Belgique</option>
        <option value="DNK">Denemark</option>
        <option value="ESP">Espagne</option>
        <option value="FIN">Finlande</option>
        <option value="FRA" selected>France</option>
        <option value="HUN">Hongrie</option>
        <option value="IRL">Irlande</option>
        <option value="ISL">Islande</option>
        <option value="ITA">Italie</option>
        <option value="LUX">Luxembourg</option>
        <option value="MCO">Monaco</option>
        <option value="NOR">Norvège</option>
        <option value="NLD">Pays-bas</option>
        <option value="POL">Pologne</option>
        <option value="PRT">Portugal</option>
        <option value="CZE">République Tchèque</option>
        <option value="GBR">Royaume-Uni</option>
        <option value="SRB">Serbie</option>
        <option value="SVK">Slovaquie</option>
        <option value="SVN">Slovénie</option>
        <option value="SWE">Suède</option>
        <option value="CHE">Suisse</option>
      </select>
    </label>
    <label>
      <span>Téléphone <span class="required">*</span></span>
      <input type="text" name="tel" required> 
    </label>
    <p><span class="required">*</span>
        Champ obligatoire.
    </p>
<!--     <label>
      <span>Adresse mail <span class="required">*</span></span>
      <input type="email" name="mail" placeholder="<?php echo $fetch_client['mail']; ?>"> 
    </label> -->
    <button type="submit" name="paiement" class="option-btn" style="width:160px; position: right;">Valider</button>
  </form>
  <div class="Yorder">
    <table>
      <tr>
        <th colspan="2">Votre commande</th>
      </tr>
      <?php
         $panier_query = mysqli_query($con, "SELECT * FROM `panier` WHERE id_client = '$id_client'") or die('La requête a échoué');
         $grand_total = 0;
         if(mysqli_num_rows($panier_query) > 0){
            while($fetch_panier = mysqli_fetch_assoc($panier_query)){
      ?>
      <tr>
        <td><?php echo $fetch_panier['nom']; ?> x <?php echo $fetch_panier['quantite']; ?> (Qté)</td>
        <td><?php echo $sous_total = ($fetch_panier['prix'] * $fetch_panier['quantite']); ?> €</td>
      </tr>
      <?php
         $grand_total += $sous_total;
            }
         } ?>
      <tr>
        <td>Total</td>
        <td><?php echo $grand_total; ?> €</td>
      </tr>
      <tr>
        <td>Frais de livraison</td>
        <td>Livraison gratuite</td>
      </tr>
    </table><br>
    <div>
      <input type="radio" name="dbt" value="dbt" checked> Carte bancaire <span>
      <img src="im1.png" alt="" width="80">
      </span>
    </div>
    <p>
        Votre commande sera expédiée le lendemain de la validation de votre commande.
    </p>
    <div>
      <input type="radio" name="dbt" value="cd" disabled> Paypal <span>
      <img src="https://upload.wikimedia.org/wikipedia/commons/archive/b/b5/20230314142950%21PayPal.svg" alt="" width="50">
      </span>
      <!-- https://upload.wikimedia.org/wikipedia/commons/archive/b/b5/20230314142950%21PayPal.svg -->
    </div>
    <p>
        Mode de paiement indisponible.
    </p>
    <!-- <button type="submit" name="paiement2">Paiement</button> -->
  </div>
 </div>
</div>

<br>

<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->

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