<!DOCTYPE html> 
<html> 

<?php
/*  Sollte diese Datei direkt aufgerufen werden, 
	wird man auf die Startseite weitergeleitet.
	(Ansonsten würde eine unerwünschte Fehlermeldung erzeugt.)
	Weitere Verbesserungen auf Webserver:
	* alle inc-Dateien in separaten Ordner, der für die Benutzer
	  nicht zugänglich ist. 
	* für Benutzer nur index.php zulassen
*/	
if (!isset($_SESSION['status'])) {
	header('Location: index.php');
exit;   

} else {
?> 

<head>
  <title><?php echo $titel ?></title> 
  <meta content="text/html; charset=utf-8">
</head> 
<body>

	<form method="post">
	<br><?php echo $errorMessage ?>
    <h1>Status: Webshop</h1>
    Willkommen im internen Bereich auf unserem Webshop!<br>
    <img src="webshop.jpg"><br>

    <hr>
    Sobald Sie den Webshop verlassen, erhalten Sie eine neue Session. Hier können Sie sich abmelden:<br>
    <input type="submit" name="abmelden" value="Abmelden"><br>
		<hr>
		Hier kommen sie zur Kontoverwaltung:<br>
		<input type="submit" name="kontoverwaltung" value="Kontoverwaltung">
		</form> 
</body>
</html>

<?php
}	
?>