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
    <h1>Status: Abmeldung</h1>
    Sie wurden erfolgreich abgemeldet.<br>
    <input type="submit" name="zumanmelden" value="Ok">
    
    </form> 
</body>
</html>

<?php
}	
?>