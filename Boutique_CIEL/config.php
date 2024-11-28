<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$database_name = "boutique";

$connection = mysqli_connect($server_name, $user_name, $password, $database_name);

if(mysqli_connect_errno()){
	echo "Erreur de connexion".mysqli_connect_error();
}
?>