```php
<?php
  $nom = valid_donnees($_POST["nom"]);
  $prenom = valid_donnees($_POST["prenom"]);
  $mail = valid_donnees($_POST["mail"]);
  $mdp = valid_donnees($_POST["mdp"]);

  function valid_donnees($donnees){
    // echo $donnees;
    // echo "<br>";
    $donnees = trim($donnees);
    // echo $donnees;
    // echo "<br>";
    $donnees = stripslashes($donnees);
    // echo $donnees;
    // echo "<br>";
    $donnees = htmlspecialchars($donnees);
    // echo $donnees;
    // echo "<br>";
    return $donnees;
  }

  /*Si les champs nom, prenom, mail et mdp ne sont pas vides et si les donnees ont bien la forme attendue...*/
  if (!empty($nom) && !empty($prenom) && !empty($mail) && !empty($mdp)
    && strlen($nom) <= 20 && strlen($prenom) <= 20
    //&& preg_match("/^[a-zA-Z '-çàâäéèêëîïôöù]+$/",$nom)
    //&& preg_match("/^[a-zA-Z '-çàâäéèêëîïôöù]+$/",$prenom)
    && filter_var($mail, FILTER_VALIDATE_EMAIL)){

    try{
      echo "Dans le formulaire, vous avez fourni les informations suivantes : <br>";
      echo 'Nom : '.$_POST["nom"].'<br>';
      echo 'Prénom : '.$_POST["prenom"].'<br>';
      echo 'Adresse Mail : ' .$_POST["mail"].'<br>';
      echo 'Mot de passe : ' .$_POST["mdp"].'<br><br><br>';
    }
    catch(PDOException $e){
      echo 'Erreur : '.$e->getMessage();
    }
  } 
  else {
    echo "inscrption validée";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire</title>
</head>
<body>
  <h2>Formulaire de création de compte</h2>
  <form action="" method="post">
    <ul>
      <li>
        <label for="name">Nom&nbsp;:</label>
        <input type="text" id="nom" name="nom" required pattern="^[A-Za-z '-]+$" maxlength="20" />
      </li>
      <li>
        <label for="name">Prénom : </label>
        <input type="text" id="prenom" name="prenom" />
      </li>
      <li>
        <label for="name">Mail :</label>
        <input type="email" id="mail" name="mail" required />
      </li>
      <li>
        <label for="name">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required />
      </li>
    </ul>
    <button type="submit">Valider</button>
  </form>
</body>
</html>
?>



```

# ⬇️ <cite><font color="(0,68,88)">CIEL-1</font></cite>

<a href="https://carnus.fr"><img src="https://img.shields.io/badge/Carnus%20Enseignement Supérieur-F2A900?style=for-the-badge" /></a>
<a href="https://carnus.fr"><img src="https://img.shields.io/badge/BTS%20CIEL-2962FF?style=for-the-badge" /></a>

[![Développement Web](https://img.shields.io/badge/HTML-CSS-yellow)](https://www.w3.org/)
[![PHP SQL](https://img.shields.io/badge/PHP-MySQL-8A2BE2)](https://www.php.net/)

[![Robot NAO](https://img.shields.io/badge/Robot%20NAO-f2003c)](https://www.aldebaran.com/fr/nao)
[![C++ Arduino](https://img.shields.io/badge/Arduino-teal)](https://docs.arduino.cc/)
[![ESP32](https://img.shields.io/badge/ESP32-green)](https://www.espressif.com/en/products/socs/esp32)
[![RPi](https://img.shields.io/badge/Paspberry%20Pi-1b4d3e)](https://www.raspberrypi.com/)

[![C CPP](https://img.shields.io/badge/C-C++-7b68ee)](https://www.cpp.org/)
[![Python Versions](https://img.shields.io/badge/Python-3-blue)](https://www.python.org/)
[![PS CMD](https://img.shields.io/badge/>__ps->\__cmd-bebebe)](https://www.carnus.fr/)
[![JS JSON](https://img.shields.io/badge/JS-JSON-cb410b)](https://www.carnus.fr/)

[![GitHub git](https://img.shields.io/badge/GitHub-git-fd5800)](https://www.carnus.fr/)
[![Markdown](https://img.shields.io/badge/M%20⬇-191970)](https://www.carnus.fr/)

[![Visual Studio Code](https://img.shields.io/badge/Visual%20Studio%20Code-2a52be)](https://www.carnus.fr/)
[![Code Blocks](https://img.shields.io/badge/Code::Blocks-008000)](https://www.carnus.fr/)
[![Jupyter](https://img.shields.io/badge/Jupyter%20NoteBook-ff8c00)](https://www.carnus.fr/)


```html
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h2>Dates</h2>
	<pre>date("format")</pre>
	<ul>	
		<li>d - The day of the month (from 01 to 31)</li>
		<li>D - A textual representation of a day (three letters)</li>
		<li>j - The day of the month without leading zeros (1 to 31)</li>
		<li>l (lowercase 'L') - A full textual representation of a day</li>
		<li>z - The day of the year (from 0 through 365)</li>
		<li>F - A full textual representation of a month (January through December)</li>
		<li>m - A numeric representation of a month (from 01 to 12)</li>
		<li>Y - A four digit representation of a year</li>
		<li>y - A two digit representation of a year</li>
		<li>a - Lowercase am or pm</li>
		<li>A - Uppercase AM or PM</li>
		<li>h - 12-hour format of an hour (01 to 12)</li>
		<li>H - 24-hour format of an hour (00 to 23)</li>
		<li>i - Minutes with leading zeros (00 to 59)</li>
		<li>s - Seconds, with leading zeros (00 to 59)</li>
	</ul>
	<ul>
		<li><?php echo date("d"); ?></li>
	</ul>

</body>
</html>
```
