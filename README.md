```php
<?php
echo "Validation : adresse mail <br> <br>";
$mail = "lycee(.carnus)@carn//us.fr";
echo $mail;
echo "<br>";
$mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
echo $mail;
echo "<br>";
if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    echo "{$mail}: Adresse mail valide"."<br>";
}
else{
    echo "{$mail}: Adresse mail non valide"."<br>";
}
echo "<br>";
echo "-------------------------------------";
echo "<br>";
?>


<?php
$mail1 = 'debut._-fin1@carnus.fr';
$mail2 ='debut.fin@2carnus.fr';
$mail3 ='debut.fin3@carnus,fr';
$mail4 ='debut.fin@4carnus,fr';
$mail5 ='debut.fin5@carnus.frfr';
function validationMail($mail) {
    $regex = "/^([a-zA-Z0-9\.\-\_]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
    echo preg_match($regex, $mail) ? "Cette adresse mail  '$mail'  : est valide"."<br>" :"Cette adresse mail  '$mail'  : est non valide"."<br>";
}
validationMail($mail1);
validationMail($mail2);
validationMail($mail3);
validationMail($mail4);
validationMail($mail5);
echo "<br>";
echo "<br>";
echo "**********************************************";
echo "<br>";
echo "<br>";
?>

<!--  -->
<!--  -->
<!--  -->

<?php
echo "Validation : mot de passe (1er programme ) <br><br>";

function validationMDP($mdp) {
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/'; 
    // Au moins une lettre minuscule.
    // Au moins une lettre MAJUSCULE.
    // Au moins un chiffre
    // Au moins un caractère spécial.
    // Longueur min 8 caractères.  
    echo preg_match($regex, $mdp) ? "Ce mot de passe  '$mdp'  : est valide"."<br>" :"Ce mot de passe  '$mdp'  : est non valide"."<br>";
}

$mdp1 = "Test1@";
$mdp2 = "test1@test2@";
$mdp3 = "test1@Test2@";
$mdp4 = "Test_Test@45";
$mdp5 = "Ab12'.,;:!?$£+-*÷_àéèëê()[]{}#&@45";

validationMDP($mdp1);
validationMDP($mdp2);
validationMDP($mdp3);
validationMDP($mdp4);
validationMDP($mdp5);
?>

<?php
echo "<br>";
echo "-------------------------------------";
echo "<br> Validation : mot de passe (2ème programme) <br><br>";

function validationMDP2($mdp2) {
    $regex2 = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\#\?\!\@\$\%\^\&\*\-]).{8,}$/';
    // Au moins une lettre MAJUSCULE.
    // Au moins une lettre minuscule.
    // Au moins un chiffre
    // Au moins un caractère spécial parmi # ? ! @ $ % ^ & * -
    // Longueur min 8 caractères.
    echo preg_match($regex2, $mdp2) ? "Ce mot de passe  '$mdp2'  : est valide"."<br>" :"Ce mot de passe  '$mdp2'  : est non valide"."<br>";
}

$mdp21 = "Test1@";
$mdp22 = "test1@test2@";
$mdp23 = "test1@Test2@";
$mdp24 = "Testé)Test45";
$mdp25 = "Ab12'.,;:!?$£+-*÷_àéèëê()[]{}#&@45";

validationMDP2($mdp21);
validationMDP2($mdp22);
validationMDP2($mdp23);
validationMDP2($mdp24);
validationMDP2($mdp25);
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
