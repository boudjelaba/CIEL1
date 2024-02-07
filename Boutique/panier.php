<?php 
   session_start();
   require_once("config.php");

   //supprimer les produits
   //si la variable sup (supprimer) existe
   if(isset($_GET['sup'])){
    $id_sup = $_GET['sup'] ;
    //suppression
    unset($_SESSION['panier'][$id_sup]);
   }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Panier</title>
    <link rel="stylesheet" href="style.css">
</head>
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
<body class="panier">
    <a href="index.php" class="link">Boutique</a>
    <section>
        <table>
            <tr>
                <th></th>
                <th>Image</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Action</th>
            </tr>
            <?php 
              $total = 0 ;
              // liste des produits
              //récupérer les clés du tableau session
              $ids = array_keys($_SESSION['panier']);
              //s'il n'y a aucune clé dans le tableau
              if(empty($ids)){
                echo "Votre panier est vide";
              }else {
                //si oui 
                $prods = mysqli_query($con, "SELECT * FROM produits WHERE id_prod IN (".implode(',', $ids).")");

                //lire les produit avec une boucle foreach
                foreach($prods as $prod):
                    //calculer le total ( prix unitaire * quantité) 
                    //et aditionner chaque résutats a chaque tour de boucle
                    $total = $total + $prod['prix'] * $_SESSION['panier'][$prod['id_prod']] ;
                ?>
                <tr>
                    <td></td>

                    <td><img src="<?php echo $prod['image']; ?>" width="50px" ></td>
                    <td><?=$prod['nom']?></td>
                    <td><?=$prod['prix']?>€</td>
                    <td><?=$_SESSION['panier'][$prod['id_prod']] // Quantité?></td>
                    <td><a href="panier.php?sup=<?=$prod['id_prod']?>"><i class="fa-solid fa-trash-can" style="color: red;"></i></a></td>
                </tr>

            <?php endforeach ;} ?>

            <tr class="total">
                <th>Total : <?=$total?>€</th>
            </tr>
        </table>
    </section>
</body>
</html>