<?php
session_start();
require_once("config.php");

if(isset($_POST["ajouter"]))
{
  if(isset($_SESSION["panier"]))
  {
    $acol = array_column($_SESSION["panier"], "item_id");
    if(!in_array($_GET["id"], $acol))
    {
      // $count = count($_SESSION["panier"]);
      $item = array(
        'item_id'     =>  $_GET["id"],
        'item_name'     =>  $_POST["hidden_name"],
        'item_image'     =>  $_POST["hidden_image"],
        'item_price'    =>  $_POST["hidden_price"],
        'item_description'    =>  $_POST["hidden_description"],
        'item_quantity'   =>  $_POST["quantity"]
      );
      $_SESSION["panier"][$_GET["id"]] = $item;
    }
    else
    {
      $_SESSION['panier'][$_GET["id"]]['item_quantity'] += $_POST["quantity"];
      // echo '<script>alert("Article existe déjà dans le panier")</script>';
    }
  }
  else
  {
    $item = array(
      'item_id'     =>  $_GET["id"],
      'item_name'     =>  $_POST["hidden_name"],
      'item_image'     =>  $_POST["hidden_image"],
      'item_price'    =>  $_POST["hidden_price"],
      'item_description'    =>  $_POST["hidden_description"],
      'item_quantity'   =>  $_POST["quantity"]
    );
    $_SESSION["panier"][$_GET["id"]] = $item;
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="B_e.css">
	<title>Boutique de vente</title>
</head>
<body>

  <ul>
    <li><a class="active" href="B_Be.php">Boutique</a></li>
    <li><a href="B_Pe.php">Panier <i class="fa-solid fa-cart-shopping"></i><span class="notification-number"><?php if(isset($_SESSION['panier'])){ echo count($_SESSION['panier']);}
      else echo 0;?></span></a></li>
  </ul>

  <h1>Produits</h1>


  <table id="tableau">
    <tr>
      <th style="width:11%">Image</th>
      <th style="width:4%">ID</th>
      <th style="width:12%">Référence</th>
      <th style="width:15%">Intitulé du produit</th>
      <th style="width:37%">Description</th>
      <th style="width:9%">Prix</th>
      <th style="width:12%">Action</th>
    </tr>
    <?php
    $sql = "SELECT * FROM produits";
    $result = mysqli_query($connection,$sql);
    while ($i = mysqli_fetch_assoc($result)) {?>
    <tr>
      <td><img src="<?=$i["image"]?>" alt="produit"></td>
      <td><?=$i["id"]?></td>
      <td><?=$i["ref"]?></td>
      <td><?=$i["nom_p"]?></td>  
      <td><?=$i["description"]?></td>
      <td><?=number_format($i["prix"],2,"."," ")?> &#8364;</td>
      <td>
        <form action="B_Be.php?action=ajouter&id=<?=$i['id']?>" method="POST" class="admin">
          <input type="number" value="1" name="quantity" style="width: 40%"/>
          <input type="hidden" value="<?= $i['id'] ?>" name="id"/>
          <input type="hidden" value="<?= $i['nom_p'] ?>" name="hidden_name"/>
          <input type="hidden" value="<?= $i['image'] ?>" name="hidden_image"/>
          <input type="hidden" value="<?= $i['prix'] ?>" name="hidden_price"/>
          <input type="hidden" value="<?= $i['description'] ?>" name="hidden_description"/>
          <button class="admin btn-aj" name="ajouter">
            <i class="fa-solid fa-cart-plus" style="font-size:20px;"></i>
          </button>
        </form>
      </td>
    </tr>
    <?php }
    // mysqli_close($connection);
    ?>
  </table>





  <!-- /*#509d2a;/*#a1cc16;/*#f1425d;*/ -->


</body>
</html>