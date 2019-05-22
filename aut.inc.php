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
	<h1>Status: Anmeldung</h1>
	E-Mail als Benutzerkonto:<br>
	<input type="text" size="40" maxlength="250" name="kto" value="<?php echo $kto ?>"><br><br>
	 
	Passwort:<br>
	<input type="password" size="40"  maxlength="250" name="passw"><br>
	 
	<input type="submit" name="anmelden" value="Anmelden"><br><br>

	<hr>
	Ich habe noch kein Konto und möchte eines registrieren.<br>
	<input type="submit" name="zumregistrieren" value="Zum Registrieren">
	</form> 
	
</body>
</html>

<?php
}	
?>