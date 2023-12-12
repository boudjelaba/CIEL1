<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "afficheur";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion impossible: " . $conn->connect_error);
}

//Requête SQL
$sql = "SELECT * FROM photos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $dir= "" . $row["image"]. "";
       echo" <div class='content section' style='max-width:500px;'>
             <img class='slides' src='$dir' style=width:100%></div>";
    }
} else {
    echo "Galerie photo vide";
}
?>

<html>
<body>
<script>
var index = 0;
slideshow();
function slideshow() {
  var i;
  var x = document.getElementsByClassName("slides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  index++;
  if (index > x.length) {index = 1}    
  x[index-1].style.display = "block";  
  setTimeout(slideshow, 3000); // Changement de photo toutes les 3 secondes
}
</script>
</body>
</html>

