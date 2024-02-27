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




if(isset($_POST['retour'])){
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <title>Facture</title>
    <style>
        form {
            display: inline-block;
/*            flex: 3;*/
        }
        span.select2-selection.select2-selection--single {
            border-radius: 0;
            padding: 0.25rem 0.5rem;
            padding-top: 0.25rem;
            padding-right: 0.5rem;
            padding-bottom: 0.25rem;
            padding-left: 0.5rem;
            height: auto;
        }
        /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }

            /* Firefox */
            input[type=number] {
            -moz-appearance: textfield;
            }
            [name="tax_percentage"],[name="discount_percentage"]{
                width:5vw;
            }
    </style>
</head>

<body>



<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->


<!-- <div id="demoB">
  <h1>Dummy Page</h1>
  <img src="http://site.com/demo.png">
  <p>Hello world.</p>
</div>
 
<input type="button" value="Print Above Section" onclick="printpart()">
<p>Rest of the page will not be printed.</p> -->


<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($id_client) ? "Facture": "Nouvelle facture" ?> </h3>
        <div class="card-tools">
            <button class="btn btn-sm btn-flat btn-success" id="print" type="button" onclick="printpart()"><i class="fa fa-print"></i> Imprimer</button>

            <form action="" method="post">
                <button type="submit" name="retour" class="option-btn" style="width:130px; position: right; font-size: 0.95em; font-weight:300;">Retour à la boutique</button>
            </form>


        </div>
	</div>
    
	<div class="card-body" id="out_print">
        <div class="row">
        <div class="col-6 d-flex align-items-center">
            <div>
                <p class="m-0">Site marchand : Carnus Enseignement Supérieur</p>
                <p class="m-0">Mail : admin@carnus.fr</p>
                <p class="m-0">Tél : 05 65 73 37 00</p>
            </div>
        </div>
        <div class="col-6">
            <center><img src="logo1.pdf" alt="" height="120px"></center>
            <h2 class="text-center"><b>BON DE COMMANDE</b></h2>
        </div>
        </div>
        <div class="row mb-2">
            <div class="col-6">
                <p class="m-0"><b>Client</b></p>

                <?php
                   $select_client = mysqli_query($con, "SELECT * FROM `etudiants` WHERE id = '$id_client'") or die('La requête a échoué');
                   if(mysqli_num_rows($select_client) > 0){
                      $fetch_client = mysqli_fetch_assoc($select_client);
                   };
                ?>

                <div>
                    <p class="m-0"><?php echo $fetch_client['nom'] . ' ' . $fetch_client['prenom']; ?></p>
                    <!-- <p class="m-0"><?php echo $supplier['address'] ?></p>
                    <p class="m-0"><?php echo $supplier['contact_person'] ?></p>
                    <p class="m-0"><?php echo $supplier['contact'] ?></p> -->
                    <p class="m-0"><?php echo $fetch_client['mail']; ?></p>
                </div>
            </div>
            <div class="col-6 row">
                <div class="col-6">
                    <p  class="m-0"><b>B.D.C. #:</b></p>
                    <p><b><?php echo $id_client . date("hidmy"); ?></b></p>
                </div>
                <div class="col-6">
                    <p  class="m-0"><b>Date De Création</b></p>
                    <p><b><?php echo date("d-m-Y"); ?></b></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered" id="item-list">
                    <colgroup>
                        <col width="10%">
                        <col width="10%">
                        <col width="20%">
                        <col width="30%">
                        <col width="15%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled" style="">
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Réf.</th>
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Nom</th>
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Image</th>
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Prix Unit. (€)</th>
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Quantité</th>
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Total (€)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           $panier_query = mysqli_query($con, "SELECT * FROM `panier` WHERE id_client = '$id_client'") or die('La requête a échoué');
                           $grand_total = 0;
                           if(mysqli_num_rows($panier_query) > 0){
                              while($fetch_panier = mysqli_fetch_assoc($panier_query)){
                        ?>
                        <tr class="po-item" data-id="">
                            <td class="align-middle p-0 text-center"><?php echo $fetch_panier['ref']; ?></td>
                            <td class="align-middle p-1"><?php echo $fetch_panier['nom']; ?></td>
                            <td class="align-middle p-1"> <img src="<?php echo $fetch_panier['image']; ?>" alt="" width="50px"></td>
                            <td class="align-middle p-1 item-description"><?php echo $fetch_panier['prix']; ?></td>
                            <td class="align-middle p-1"><?php echo $fetch_panier['quantite']; ?></td>
                            <td class="align-middle p-1 text-right total-price"><?php $sous_total = ($fetch_panier['prix'] * $fetch_panier['quantite']); echo number_format($sous_total, 2, '.', ''); ?></td>
                        </tr>
                        <?php
                        $grand_total += $sous_total;
                            }
                        }else{
                        echo '<tr><td style="padding:20px; text-transform:capitalize;color:var(--red);opacity:0.5" colspan="7">Aucun article commandé</td></tr>';
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-lightblue">
                            <tr>
                                <th class="p-1 text-right" colspan="5">Total T.T.C.</th>
                                <th class="p-1 text-right" id="sub_total"><?php echo number_format($grand_total, 2, '.', ''); ?></th>
                            </tr>
                            <tr>
                                <!-- <th class="p-1 text-right" colspan="5">Promotion (<?php echo isset($discount_percentage) ? $discount_percentage : 0 ?>%)
                                </th>
                                <th class="p-1 text-right"><?php echo isset($remise) ? number_format($t_r) : 0 ?></th> -->
                            </tr>
                            <?php $taux_tva = 20; ?>
                            <tr>
                                <th class="p-1 text-right" colspan="5">TVA (<?php echo isset($taux_tva) ? $taux_tva : 0 ?>%)</th>
                                <th class="p-1 text-right"><?php echo isset($taux_tva) ? number_format($taux_tva*$grand_total/100, 2, '.', '') : 0 ?></th>
                            </tr>
                            <tr>
                                <th class="p-1 text-right" colspan="5">Total H.T.</th>
                                <th class="p-1 text-right" id="total"><?php echo
                                number_format((100-$taux_tva)*$grand_total/100, 2, '.', '');?></th>
                            </tr>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-6">
                        <label for="notes" class="control-label">Notes</label>
                        <p><?php echo 'Exemplaire client' ?></p>
                    </div>
                    <div class="col-6">
                        <label for="status" class="control-label">Etat</label>
                        <br>
                        <?php 
                        $etat = 1;
                        switch($etat){
                            case 1:
                                echo "<span class='py-2 px-4 btn-flat btn-success'>Validée</span>";
                                break;
                            case 2:
                                echo "<span class='py-2 px-4 btn-flat btn-danger'>Refusée</span>";
                                break;
                            default:
                                echo "<span class='py-2 px-4 btn-flat btn-secondary'>En attente</span>";
                                break;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<!-- <table class="d-none" id="item-clone">
	<tr class="po-item" data-id="">
		<td class="align-middle p-1 text-center">
			<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
		</td>
		<td class="align-middle p-0 text-center">
			<input type="number" class="text-center w-100 border-0" step="any" name="qty[]"/>
		</td>
		<td class="align-middle p-1">
			<input type="text" class="text-center w-100 border-0" name="unit[]"/>
		</td>
		<td class="align-middle p-1">
			<input type="hidden" name="item_id[]">
			<input type="text" class="text-center w-100 border-0 item_id" required/>
		</td>
		<td class="align-middle p-1 item-description"></td>
		<td class="align-middle p-1">
			<input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]" value="0"/>
		</td>
		<td class="align-middle p-1 text-right total-price">0</td>
	</tr>
</table> -->



<!-- (B) THE JAVASCRIPT -->
<script>
function printpart () {
  var printwin = window.open("");
  printwin.document.write(document.getElementById("out_print").innerHTML);
  printwin.stop();
  printwin.print();
  printwin.close();
}
</script>




<!-- <script>
	$(function(){
        $('#print').click(function(e){
            e.preventDefault();
            start_loader();
            var _h = $('head').clone()
            var _p = $('#out_print').clone()
            var _el = $('<div>')
                _p.find('thead th').attr('style','color:black !important')
                _el.append(_h)
                _el.append(_p)
                
            var nw = window.open("","","width=1200,height=950")
                nw.document.write(_el.html())
                nw.document.close()
                setTimeout(() => {
                    nw.print()
                    setTimeout(() => {
                        end_loader();
                        nw.close()
                    }, 300);
                }, 200);
        })
    })
</script> -->




<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->
<!-- ******************************* -->



</body>
</html>