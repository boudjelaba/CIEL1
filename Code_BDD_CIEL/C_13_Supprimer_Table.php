<?php
$server_name = "localhost";
$user_name = "root";
$password = "";

$database_name = "mesdonnees";

$connection = mysqli_connect($server_name, $user_name, $password, $database_name);

$query = "DROP table Tableau1";


if (mysqli_multi_query($connection, $query)) {
  echo "Supprimer avec succès";
} else {
  echo "Erreur:" . mysqli_error($connection);
}

mysqli_close($connection);
?>