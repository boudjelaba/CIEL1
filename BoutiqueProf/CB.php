<?php

// nom : CHARLES CARNUS
// N° : 5501 2345 6789 0123
// Date : 2028-01-01
// CVC : 123

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
?>

<?php
   $panier_query = mysqli_query($con, "SELECT * FROM `panier` WHERE id_client = '$id_client'") or die('La requête a échoué');
   $grand_total = 0;
   if(mysqli_num_rows($panier_query) > 0){
      while($fetch_panier = mysqli_fetch_assoc($panier_query)){
        $sous_total = ($fetch_panier['prix'] * $fetch_panier['quantite']);
        $grand_total += $sous_total;
            }
         }
          // echo $grand_total;
?>

<?php

  if(isset($_POST['payer'])){
    //$nom_cb = stripslashes($_POST['nom_cb']);
    //$nom_cb = mysqli_real_escape_string($con, $nom_cb);
    $nom_cb = $_POST['nom_cb'];
    //$numero_cb = stripslashes($_POST['numero_cb']);
    //$numero_cb = mysqli_real_escape_string($con, $numero_cb);
    $numero_cb = $_POST['numero_cb'];
    $date_cb = stripslashes($_POST['date_cb']);
    $date_cb = mysqli_real_escape_string($con, $date_cb);
    $date_cb = $_POST['date_cb'];
    //$cvc_cb = stripslashes($_POST['cvc_cb']);
    //$cvc_cb = mysqli_real_escape_string($con, $cvc_cb);
    $cvc_cb = $_POST['cvc_cb'];

    echo $nom_cb; echo '<br>';
    echo $numero_cb; echo '<br>';
    echo $date_cb; echo '<br>';
    echo $cvc_cb; echo '<br>';

    $select_cb = mysqli_query($con, "SELECT * FROM `cb` WHERE nom = '$nom_cb' AND numero = '$numero_cb' AND date_v = '$date_cb' AND cvc = '$cvc_cb'") or die('Requête échouée');
    if(mysqli_num_rows($select_cb) > 0){
      $row_cb = mysqli_fetch_assoc($select_cb);
      mysqli_query($con, "UPDATE commande SET etat = 'Validée' WHERE id_client = $id_client");
      header('location:fact0.php');
    }else{
      $message[] = 'Identifiants incorrects!';
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title></title>
	<style type="text/css">
		@import url("https://fonts.googleapis.com/css?family=Roboto:300,400,500");
* {
  margin: 0;
  box-sizing: border-box;
}

html {
  --card-color: #cacaca;
  --text-color: #e1e1e1;
}

body {
  font-family: "Roboto", sans-serif;
}

.tips {
  position: fixed;
  bottom: 0;
  width: 100%;
  height: 30px;
  background: #f1f1f1;
  line-height: 30px;
  font-size: 14px;
  padding: 2px 15px;
}

.container {
  position: absolute;
  display: flex;
  flex-direction: row;
  align-items: center;
  margin: auto;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  width: 680px;
}
.container .col1 {
  perspective: 1000;
  transform-style: preserve-3d;
}
.container .col1 .card {
  position: relative;
  width: 420px;
  height: 250px;
  margin-bottom: 85px;
  margin-right: 10px;
  border-radius: 17px;
  box-shadow: 0 5px 20px -5px rgba(0, 0, 0, 0.1);
  transition: all 1s;
  transform-style: preserve-3d;
}
.container .col1 .card .front {
  position: absolute;
  background: var(--card-color);
  border-radius: 17px;
  padding: 50px;
  width: 100%;
  height: 100%;
  transform: translateZ(1px);
  -webkit-transform: translateZ(1px);
  transition: background 0.3s;
  z-index: 50;
  background-image: repeating-linear-gradient(45deg, rgba(255, 255, 255, 0) 1px, rgba(255, 255, 255, 0.03) 2px, rgba(255, 255, 255, 0.04) 3px, rgba(255, 255, 255, 0.05) 4px), -webkit-linear-gradient(-245deg, rgba(255, 255, 255, 0) 40%, rgba(255, 255, 255, 0.2) 70%, rgba(255, 255, 255, 0) 90%);
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}
.container .col1 .card .front .type {
  position: absolute;
  width: 75px;
  height: 45px;
  top: 20px;
  right: 20px;
}
.container .col1 .card .front .type img {
  width: 100%;
  float: right;
}
.container .col1 .card .front .card_number {
  position: absolute;
  font-size: 26px;
  font-weight: 500;
  letter-spacing: -1px;
  top: 110px;
  color: var(--text-color);
  word-spacing: 3px;
  transition: color 0.5s;
}
.container .col1 .card .front .date {
  position: absolute;
  bottom: 40px;
  right: 55px;
  width: 90px;
  height: 35px;
  color: var(--text-color);
  transition: color 0.5s;
}
.container .col1 .card .front .date .date_value {
  font-size: 12px;
  position: absolute;
  margin-left: 22px;
  margin-top: 12px;
  color: var(--text-color);
  font-weight: 500;
  transition: color 0.5s;
}
.container .col1 .card .front .date:after {
  content: "MOIS / ANNEE";
  position: absolute;
  display: block;
  font-size: 7px;
  margin-left: 20px;
}
.container .col1 .card .front .date:before {
  content: "Expire \a Fin";
  position: absolute;
  display: block;
  font-size: 8px;
  white-space: pre;
  margin-top: 8px;
}
.container .col1 .card .front .fullname {
  position: absolute;
  font-size: 20px;
  bottom: 40px;
  color: var(--text-color);
  transition: color 0.5s;
}
.container .col1 .card .back {
  position: absolute;
  width: 100%;
  border-radius: 17px;
  height: 100%;
  background: var(--card-color);
  transform: rotateY(180deg);
}
.container .col1 .card .back .magnetic {
  position: absolute;
  width: 100%;
  height: 50px;
  background: rgba(0, 0, 0, 0.7);
  margin-top: 25px;
}
.container .col1 .card .back .bar {
  position: absolute;
  width: 80%;
  height: 37px;
  background: rgba(255, 255, 255, 0.7);
  left: 10px;
  margin-top: 100px;
}
.container .col1 .card .back .seccode {
  font-size: 13px;
  color: var(--text-color);
  font-weight: 500;
  position: absolute;
  top: 100px;
  right: 40px;
}
.container .col1 .card .back .chip {
  bottom: 45px;
  left: 10px;
}
.container .col1 .card .back .disclaimer {
  position: absolute;
  width: 65%;
  left: 80px;
  color: #f1f1f1;
  font-size: 8px;
  bottom: 55px;
}
.container .col2 input {
  display: block;
  width: 260px;
  height: 30px;
  padding-left: 10px;
  padding-top: 3px;
  padding-bottom: 3px;
  margin: 7px;
  font-size: 17px;
  border-radius: 20px;
  background: rgba(0, 0, 0, 0.05);
  border: none;
  transition: background 0.5s;
}
.container .col2 input:focus {
  outline-width: 0;
  background: rgba(31, 134, 252, 0.15);
  transition: background 0.5s;
}
.container .col2 label {
  padding-left: 8px;
  font-size: 15px;
  color: #444;
}
.container .col2 .ccv {
  width: 40%;
}
.container .col2 .buy {
  width: 260px;
  height: 50px;
  position: relative;
  display: block;
  margin: 20px auto;
  border-radius: 10px;
  border: none;
  background: #42C2DF;
  color: white;
  font-size: 20px;
  transition: background 0.4s;
  cursor: pointer;
}
.container .col2 .buy i {
  font-size: 20px;
}
.container .col2 .buy:hover {
  background: #3594A9;
  transition: background 0.4s;
}

.chip {
  position: absolute;
  width: 55px;
  height: 40px;
  background: #bbb;
  border-radius: 7px;
}
.chip:after {
  content: "";
  display: block;
  width: 35px;
  height: 25px;
  border-radius: 4px;
  position: absolute;
  top: 0;
  bottom: 0;
  margin: auto;
  background: #ddd;
}
	</style>
</head>
<body>


<div class="tips">
Numéro de carte de paiement : &nbsp; (4) VISA, &nbsp; (51 —> 55) MasterCard, &nbsp; (34-37) American Express
</div>

<div class="container">
  <div class="col1">
    <div class="card">
      <div class="front">
        <div class="type">
          <img class="bankid"/>
        </div>
        <span class="chip"></span>
        <span class="card_number">&#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; </span>
        <div class="date"><span class="date_value">MM/AAAA</span></div>
        <span class="fullname">NOM COMPLET</span>
      </div>
      <div class="back">
        <div class="magnetic"></div>
        <div class="bar"></div>
        <span class="seccode">&#x25CF;&#x25CF;&#x25CF;</span>
        <span class="chip"></span><span class="disclaimer">Cette carte est la propriété de la société Banque Carnus de Rodez. <br> Si trouvée, merci de le retourner à la Banque Carnus de Rodez - 12000 Rodez, Avenue de Saint Pierre </span>
      </div>
    </div>
  </div>
  <?php
  if(isset($message)){
    foreach($message as $message){
      echo '<div class="MessageErreur" onclick="this.remove();">'.$message.'</div>';
    }
  }
  ?>
  <form class="col2" method="post">
    <label>Numéro de carte</label>
    <input class="number" type="text" name="numero_cb" ng-model="ncard" maxlength="19" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
    <label>Nom du titulaire</label>
    <input class="inputname" type="text" name="nom_cb" placeholder=""/>
    <label>Date d'expiration</label>
    <input class="expire" type="text" name="date_cb" placeholder="MM /YYYY"/>
    <label>Numéro de sécurité</label>
    <input class="ccv" type="text" name="cvc_cb" placeholder="CVC" maxlength="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
    <button type="submit" class="buy" name="payer"><i class="fa-solid fa-lock"></i> &nbsp; Payer &nbsp; <?php echo $grand_total; ?> €</button>
    <?php if (! empty($message)) { ?>
      <p class="MessageErreur"><?php echo $message; ?></p>
    <?php } ?>
  </form>
</div>

<script type="text/javascript">
	// 4: VISA, 51 -> 55: MasterCard, 34-37: American Express


$(function(){
  
  var cards = [{
    nome: "mastercard",
    colore: "#0061A8",
    src: "https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png"
  }, {
    nome: "visa",
    colore: "#E2CB38",
    src: "https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2000px-Visa_Inc._logo.svg.png"
  }, {
    nome: "americanExpress",
    colore: "#108168",
    src: "https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/American_Express_logo.svg/600px-American_Express_logo.svg.png"
  }];
  
  var month = 0;
  var html = document.getElementsByTagName('html')[0];
  var number = "";
  
  var selected_card = -1;
  
  $(document).click(function(e){
    if(!$(e.target).is(".ccv") || !$(e.target).closest(".ccv").length){
      $(".card").css("transform", "rotatey(0deg)");
      $(".seccode").css("color", "var(--text-color)");
    }
    if(!$(e.target).is(".expire") || !$(e.target).closest(".expire").length){
      $(".date_value").css("color", "var(--text-color)");
    }
    if(!$(e.target).is(".number") || !$(e.target).closest(".number").length){
      $(".card_number").css("color", "var(--text-color)");
    }
    if(!$(e.target).is(".inputname") || !$(e.target).closest(".inputname").length){
      $(".fullname").css("color", "var(--text-color)");
    }
  });
  
  
  //Numéro de carte
  $(".number").keyup(function(event){
    $(".card_number").text($(this).val());
    number = $(this).val();
    
    if(parseInt(number.substring(0, 2)) > 50 && parseInt(number.substring(0, 2)) < 56){
      selected_card = 0;
    }else if(parseInt(number.substring(0, 1)) == 4){
      selected_card = 1;     
    }else if(parseInt(number.substring(0, 2)) == 34 || parseInt(number.substring(0, 2)) == 37){
      selected_card = 2; 
    }else{
      selected_card = -1; 
    }
    
    if(selected_card != -1){
      html.setAttribute("style", "--card-color: " + cards[selected_card].colore);  
      $(".bankid").attr("src", cards[selected_card].src).show();
    }else{
      html.setAttribute("style", "--card-color: #cecece");
      $(".bankid").attr("src", "").hide();
    }
    
    if($(".card_number").text().length === 0){
      $(".card_number").html("&#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF; &#x25CF;&#x25CF;&#x25CF;&#x25CF;");
    }

  }).focus(function(){
    $(".card_number").css("color", "white");
  }).on("keydown input", function(){
    
    $(".card_number").text($(this).val());
    
    if(event.key >= 0 && event.key <= 9){
      if($(this).val().length === 4 || $(this).val().length === 9 || $(this).val().length === 14){
        $(this).val($(this).val() +  " ");
      }
    }
  })
  
  //Nom du titulaire
  $(".inputname").keyup(function(){  
    $(".fullname").text($(this).val());  
    if($(".inputname").val().length === 0){
        $(".fullname").text("Nom complet");
    }
    return event.charCode;
  }).focus(function(){
    $(".fullname").css("color", "white");
  });
  
  //Code de sécurité
  $(".ccv").focus(function(){
    $(".card").css("transform", "rotatey(180deg)");
    $(".seccode").css("color", "white");
  }).keyup(function(){
    $(".seccode").text($(this).val());
    if($(this).val().length === 0){
      $(".seccode").html("&#x25CF;&#x25CF;&#x25CF;");
    }
  }).focusout(function() {
      $(".card").css("transform", "rotatey(0deg)");
      $(".seccode").css("color", "var(--text-color)");
  });
    
  
  //Date d'expiration
  $(".expire").keypress(function(event){
    if(event.charCode >= 48 && event.charCode <= 57){
      if($(this).val().length === 1){
          $(this).val($(this).val() + event.key + " / ");
      }else if($(this).val().length === 0){
        if(event.key == 1 || event.key == 0){
          month = event.key;
          return event.charCode;
        }else{
          $(this).val(0 + event.key + " / ");
        }
      }else if($(this).val().length > 2 && $(this).val().length < 9){
        return event.charCode;
      }
    }
    return false;
  }).keyup(function(event){
    $(".date_value").html($(this).val());
    if(event.keyCode == 8 && $(".expire").val().length == 4){
      $(this).val(month);
    }
    
    if($(this).val().length === 0){
      $(".date_value").text("MM / YYYY");
    }
  }).keydown(function(){
    $(".date_value").html($(this).val());
  }).focus(function(){
    $(".date_value").css("color", "white");
  });
});
</script>

</body>
</html>