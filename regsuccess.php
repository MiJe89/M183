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
    <h1>Registrierung abgeschlossen</h1>

    Sie wurden erfolgreich registriert.<br>
    Ihr Account wurde mit dem Namen <?php echo $_SESSION['kto']; ?> angelegt.
    <hr>
    <br>
    Melden Sie sich mit Ihren Benutzerdaten an: <br>
	<input type="submit" name="zumanmelden" value="zur Anmeldung">
	</form>
	
</body>
</html>

<?php
}	
?>