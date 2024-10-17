<?php
$server_name = "localhost";
$user_name = "root";
$password = "";

$database_name = "mesdonnees";

$connection = mysqli_connect($server_name, $user_name, $password, $database_name);

// Supprimer tous les enregistrements
$query = "TRUNCATE table Tableau1";


if (mysqli_multi_query($connection, $query)) {
  echo "Suppression réussis";
} else {
  echo "Erreur:" . mysqli_error($connection);
}

mysqli_close($connection);
?>