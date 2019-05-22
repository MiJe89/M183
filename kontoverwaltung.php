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
    <h1>Status: Kontoverwaltung</h1>
		Willkommen im Bereich der Kontoverwaltung!<br>
		<br>
		Hier kommen Sie zurück zum Webshop:<br>
		<input type="submit" name="web" value="Zurück">
		<hr>
		Hier sind Ihre Kontodaten:<br>
		***<br>

		<?php

		echo "Benutzerkonto: ".$user['kto']."<br>";
		echo "Vorname: ".$user['vorname']."<br>";
		echo "Nachname: ".$user['nachname']."<br>";
		echo "Erstellt am: ".$user['created_at']."<br>";
		echo "Zuletzt Aktualisiert: ".$user['updated_at']."<br>";
		if($user['aclallaccounts'] == "R"){
			echo "Benutzerrechte: ".$user['aclallaccounts']."<br>";
		}	
		echo "***<br>";

		if($user['aclallaccounts'] == "R"){

			foreach($users as $user){
				echo "Benutzerkonto: ".$user['kto']."<br>";
				echo "Vorname: ".$user['vorname']."<br>";
				echo "Nachname: ".$user['nachname']."<br>";
				echo "Erstellt am: ".$user['created_at']."<br>";
				echo "Zuletzt Aktualisiert: ".$user['updated_at']."<br>";
				if($user['aclallaccounts'] == "R"){
					echo "Benutzerrechte: ".$user['aclallaccounts']."<br>";
				}
				echo "***<br>";
			}
		}
		?>

</body>
</html>

<?php
}	
?>