<?php
$con = mysqli_connect("localhost", "root","", "CIEL");
if(mysqli_connect_errno()){
	echo "Erreur de connexion".mysqli_connect_error();
}
?>