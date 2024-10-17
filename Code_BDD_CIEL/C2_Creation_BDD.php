<?php
$server_name = "localhost";
$user_name = "root";
$password = "";

// Création de la connexion en spécifiant les détails de la connexion
$connection = mysqli_connect($server_name, $user_name, $password);

// Vérification de la connexion
if (!$connection) {
  die("Echec ". mysqli_connect_error());
}
echo "Connexion établie avec succès." . "\n";

// Requête sql pour créer une base de données nommée mesdonnees
$query = "CREATE DATABASE mesdonnees";
if (mysqli_query($connection, $query)) {
  echo "Une nouvelle base de données appelée mesdonnees est créée avec succès !";
} else {
  echo "Error:" . mysqli_error($connection);
}

mysqli_close($connection);
?>