<?php
$server_name = "localhost";
$user_name = "root";
$password = "";

// Spécifier le nom de la base de données
$database_name = "mesdonnees";

// Création de la connexion en spécifiant les détails de la connexion
$connection = mysqli_connect($server_name, $user_name, $password,$database_name);

// Sélectionner toutes les colonnes de sorte que la colonne de nom commence par 'C' et se termine par 's'
$query = "SELECT * from Tableau1 where nom like 'C%s'";

$final = mysqli_query($connection, $query);

if (mysqli_num_rows($final) > 0) {
  while($i = mysqli_fetch_assoc($final)) {
    echo "ID : " . $i["id"]. "  ----> Nom : " . $i["nom"]."  ----> Numéro : " . $i["numero"]. "<br>";
  }
} else {
  echo "Pas de résultat";
}



// Fermer la connexion
mysqli_close($connection);
?>