<?php
$server_name = "localhost";
$user_name = "root";
$password = "";

$database_name = "mesdonnees";

$connection = mysqli_connect($server_name, $user_name, $password,$database_name);

// Supprimer l'enregistrement avec id - 5
$query = "DELETE FROM Tableau1 where id=5";

if (mysqli_multi_query($connection, $query)) {
  echo "Enregistrement supprimé avec succès";
} else {
  echo "Erreur:" . mysqli_error($connection);
}

mysqli_close($connection);
?>