<?php
$server_name = "localhost";
$user_name = "root";
$password = "";

// Spécifier le nom de la base de données
$database_name = "mesdonnees";

// Création de la connexion en spécifiant les détails de la connexion
$connection = mysqli_connect($server_name, $user_name, $password,$database_name);

// requête sql pour insérer une ligne dans la table Tableau1
$query = "INSERT INTO Tableau1 (id,nom, numero) VALUES (1,'Carnus',12)";
if (mysqli_query($connection, $query)) {
  echo "Enregistrement inséré avec succès";
} else {
  echo "Erreur :" . mysqli_error($connection);
}

// Fermer la connexion
mysqli_close($connection);
?>