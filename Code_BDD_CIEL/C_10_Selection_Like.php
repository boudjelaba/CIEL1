<?php
$server_name = "localhost";
$user_name = "root";
$password = "";

$database_name = "mesdonnees";

$connection = mysqli_connect($server_name, $user_name, $password,$database_name);

// Nom qui commence par 'C' et de longueur - 6
$query = "SELECT * from Tableau1 where nom like 'C_____'";

$final = mysqli_query($connection, $query);

if (mysqli_num_rows($final) > 0) {
  while($i = mysqli_fetch_assoc($final)) {
    echo "ID : " . $i["id"]. "  <----> Nom : " . $i["nom"]."  <----> Numéro : " . $i["numero"]. "<br>";
  }
} else {
  echo "Aucun résultat";
}

echo "<br>";
echo "<br>";

// Nom qui se termine par 's' et de longueur - 7
$query1 = "SELECT * from Tableau1 where nom like '______s'";

$final1 = mysqli_query($connection, $query1);

if (mysqli_num_rows($final1) > 0) {
  while($j = mysqli_fetch_assoc($final1)) {
    echo "ID : " . $j["id"]. "  <----> Nom : " . $j["nom"]."  ----> Numéro : " . $j["numero"]. "<br>";
  }
} else {
  echo "Aucun résultat";
}

mysqli_close($connection);
?>