<?php
$server_name = "localhost";
$user_name = "root";
$password = "";

// Spécifier le nom de la base de données
$database_name = "mesdonnees";

// Création de la connexion en spécifiant les détails de la connexion
$connection = mysqli_connect($server_name, $user_name, $password,$database_name);

// Requête sql pour sélectionner des colonnes particulières
// Sélectionner les colonnes id et nom
$query = "SELECT id,nom from Tableau1";

// Obtenir le résultat
$final = mysqli_query($connection, $query);

if (mysqli_num_rows($final) > 0) {
 // Obtenir la sortie de chaque ligne
  while($i = mysqli_fetch_assoc($final)) {
      // Obtenir les colonnes id et nom
    echo "ID : " . $i["id"]. "  <====> Nom : " . $i["nom"]. "<br>";
  }
} else {
  echo "Aucun résultat";
}

// Fermer la connexion
mysqli_close($connection);
?>