<?php
$server_name = "localhost";
$user_name = "root";
$password = "";

// Spécifier le nom de la base de données
$database_name = "mesdonnees";

// Création de la connexion en spécifiant les détails de la connexion
$connection = mysqli_connect($server_name, $user_name, $password,$database_name);

// Sélectionner toutes les colonnes de sorte que la colonne de nom commence par 'C'
$query = "SELECT * from Tableau1 where nom like 'C%'";

// Obtenir le résultat
$final = mysqli_query($connection, $query);

if (mysqli_num_rows($final) > 0) {
  echo "Noms qui commencent par 'C' : <br>";
 // Obtenir la sortie de chaque ligne
  while($i = mysqli_fetch_assoc($final)) {
      // Obtenir toutes les colonnes
    echo "ID : " . $i["id"]. "  <-==-> Nom : " . $i["nom"]."  <-==-> Numéro : " . $i["numero"]. "<br>";
  }
} else {
  echo "Aucun résultat";
}

// Nouvelle ligne
echo "<br>";
echo "<br>";

// Sélectionner toutes les colonnes dont la colonne de nom se termine par 'e'
$query1 = "SELECT * from Tableau1 where nom like '%e'";

# Obtenir le résultat
$final1 = mysqli_query($connection, $query1);

if (mysqli_num_rows($final1) > 0) {
  echo "Noms qui se terminent par 'e' : <br>";
 // Obtenir la sortie de chaque ligne
  while($j = mysqli_fetch_assoc($final1)) {
      // Obtenir toutes les colonnes
    echo "ID : " . $j["id"]. "  <-==-> Nom : " . $j["nom"]."  <-==-> Numéro : " . $j["numero"]. "<br>";
  }
} else {
  echo "Aucun résultat";
}

// Nouvelle ligne
echo "<br>";
echo "<br>";

// Sélectionne toutes les colonnes dont la colonne de nom contient 'ma'
$query2 = "SELECT * from Tableau1 where nom like '%ma%'";

# Obtenir le résultat
$final2 = mysqli_query($connection, $query2);

if (mysqli_num_rows($final2) > 0) {
  echo "Noms qui contiennent 'ma' : <br>";
 // Obtenir la sortie de chaque ligne
  while($k = mysqli_fetch_assoc($final2)) {
      // Obtenir toutes les colonnes
    echo "ID : " . $k["id"]. "  <-==-> Nom : " . $k["nom"]."  <-==-> Numéro: " . $k["numero"]. "<br>";
  }
} else {
  echo "Aucun résultat";
}

// Fermer la connexion
mysqli_close($connection);
?>