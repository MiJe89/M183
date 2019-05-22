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
	<h1>Statuswechsel von Anmeldung zu Webshop</h1>
	Sie wurden als Benutzer mit der Nummer <?php echo $_SESSION['userid'] ?> erfolgreich angemeldet. <br>
	Ihre jetzige Session <?php echo session_id() ?> wird beendet.<br>
	Sie erhalten in unserem Webshop eine neue Session.<br> 
	<input type="submit" value="OK">
	</form>
	
</body>
</html>

<?php
}	
?>