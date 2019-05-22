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
	<h1>Status: Registrierung</h1>
	E-Mail als Benutzerkonto:<br>
	<input type="text" size="40" maxlength="250" name="kto"><br><br>
	 
	Passwort:<br>
	<input type="password" size="40"  maxlength="250" name="passw"><br><br>

  Passwort wiederholen:<br>
	<input type="password" size="40" maxlength="250" name="passw2"><br><br>

    <input type="submit" name="registrieren" value="Registrieren"><br><br>

    <hr>
	Zurück zur Startseite:<br>
	<input type="submit" name="zumanmelden" value="zur Anmeldung">
	</form> 
	
</body>
</html>

<?php
}	
?>