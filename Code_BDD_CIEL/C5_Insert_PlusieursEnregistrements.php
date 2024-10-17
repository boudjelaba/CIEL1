<?php
$server_name = "localhost";
$user_name = "root";
$password = "";

// Spécifier le nom de la base de données
$database_name = "mesdonnees";

// Création de la connexion en spécifiant les détails de la connexion
$connection = mysqli_connect($server_name, $user_name, $password,$database_name);

// Requête sql pour insérer 5 lignes dans la table Tableau1
$query = "INSERT INTO Tableau1 (id,nom,numero) VALUES (2,'Charles',2023);";
$query .= "INSERT INTO Tableau1 (id,nom,numero) VALUES (5,'Ville de Rodez',1120);";
$query .= "INSERT INTO Tableau1 (id,nom,numero) VALUES (3,'Lycée',20);";
$query .= "INSERT INTO Tableau1 (id,nom,numero) VALUES (4,'Informatique',100);";
$query .= "INSERT INTO Tableau1 (id,nom,numero) VALUES (6,'Réseaux',200)";

if (mysqli_multi_query($connection, $query)) {
  echo "Enregistrements insérés avec succès";
} else {
  echo "Erreur:" . mysqli_error($connection);
}

// Fermer la connexion
mysqli_close($connection);
?>