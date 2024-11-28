<?php
session_start();
require_once("config.php");

if (isset($_GET['action'])) {
  if ($_GET['action'] == "vider") {
    unset($_SESSION['panier']);
  }

  if ($_GET['action'] == "delete") {
    foreach ($_SESSION['panier'] as $key => $value) {
      if ($value['item_id'] == $_GET['id']) {
        unset($_SESSION['panier'][$key]);
      }
    }
  }
}

if (isset($_POST["update"])) {
  $upid = $_GET['upid'];
  // echo '<script>alert("Article existe déjà dans le panier")</script>';
  $acol = array_column($_SESSION['panier'], 'item_id');
  if (in_array($_GET['upid'], $acol)) {
    $_SESSION['panier'][$upid]['item_quantity'] = $_POST['item_quantity'];
  } else {
    $item = [
      'upid' => $upid,
      'item_quantity' => $_POST["item_quantity"]
    ];
    $_SESSION['panier'][$upid] = $item;
  }
  header("location: B_Pe.php");
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
    <li><a href="B_Be.php">Boutique</a></li>
    <li><a class="active" href="B_Pe.php">Panier <i class="fa-solid fa-cart-shopping"></i><span class="notification-number"><?php if(isset($_SESSION['panier'])){ echo count($_SESSION['panier']);}
      else echo 0;?></span></a></li>
  </ul>

  <h1>Panier</h1>

  <a href="B_Pe.php?action=vider">
    <button class="bouton vid">Vider le panier</button>
  </a>

  <table id="tableau">
    <tr>
      <th style="width:10%">Image</th>
      <th style="width:10%">Intitulé du produit</th>
      <th style="width:31%">Description</th>
      <th style="width:9%">Prix</th>
      <th style="width:16%">Quantité</th>
      <th style="width:12%">Prix total</th>
      <th style="width:12%">Action</th>
    </tr>
    <?php
    $total_g = 0;
    if (isset($_SESSION['panier'])) {
      $ic = 1; ?>
      <?php 
      foreach ($_SESSION['panier'] as $panier) { ?>
    <tr>
      <td>
        <img src="<?php echo $panier['item_image']?>" alt="produitp">
      </td>
      <td>
        <?= $panier['item_name']?>
      </td>
      <td>
        <?= $panier['item_description']?>
      </td>
      <td>
        <?=number_format($panier['item_price'],2,"."," ")?> &#8364;
      </td>
      <td>
        <form action="B_Pe.php?action=update&upid=<?php echo $panier['item_id']; ?>" method="POST" class="admin btn-edit">
          <input type="number" value="<?= $panier['item_quantity']?>" name="item_quantity" min="1" style="width: 50%"/>
          <input type="hidden" name="upid" value="<?= $panier['item_id']; ?>">
          <button class="bouton maj" name="update" ><i class="fa-regular fa-pen-to-square"></i>&nbsp; MàJ</button>
        </form>
      </td>
      <td>
        <?php echo number_format($panier['item_quantity'] * $panier['item_price'], 2, "."," "); ?> &#8364;
      </td>
      <td>
        <a href="B_Pe.php?action=delete&id=<?php echo $panier['item_id']; ?>"><button class="admin btn-supp"><i class="fa-regular fa-trash-can"></i></button></a>
      </td>
    </tr>
    <?php 
    $ic++;
    $total_g = $total_g + $panier['item_quantity'] * $panier['item_price'];
    } ?>
    <tr>
      <!-- <td></td>
      <td></td>
      <td></td>
      <td></td> -->
      <td colspan="5" style="text-align: right;"><span class="total">Prix total (TTC)</span></td>
      <td><span class="total"><?=number_format($total_g,2,"."," "); ?> &#8364;</span></td>
      <td><button class="bouton com">Commander</button></td>
    </tr>
    <?php }
    mysqli_close($connection);
    ?>
  </table>

</body>
</html>