<?php
$server_name = "localhost";
$user_name = "root";
$password = "";

// Spécifier le nom de la base de données
$database_name = "mesdonnees";

// Création de la connexion en spécifiant les détails de la connexion
$connection = mysqli_connect($server_name, $user_name, $password,$database_name);

// Requête sql pour créer une table nommée Tableau1 avec trois colonnes
$query = "CREATE TABLE  Tableau1(
id int,
nom varchar(255),
numero int
)";
if (mysqli_query($connection, $query)) {
  echo "La table est créée avec succès dans la base de données mesdonnees.";
} else {
  echo "Erreur :" . mysqli_error($connection);
}

// Fermer la connexion
mysqli_close($connection);
?>