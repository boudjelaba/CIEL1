<?php
// Informations d'identification
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_MOT_DE_PASSE', '');
define('DB_NAME', 'afficheur');
 
// Connexion � la base de donn�es MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_MOT_DE_PASSE, DB_NAME);
 
// V�rifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter � la base de donn�es! " . mysqli_connect_error());
}
?>