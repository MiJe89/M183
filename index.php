<?php

session_start();
include 'db.inc.php';
echo "Aktuelle Session: ".session_id()."<br>"."<br>"; 
$errorMessage = '';
$showFormular = TRUE;
$error = FALSE;

if (!isset($_SESSION['status'])) {
	$_SESSION['status'] = "aut";
	$_SESSION['angemeldet'] = FALSE; 
}

if ($_SESSION['status'] == "aut") {
	if (isset($_POST['zumregistrieren'])) {
		$_SESSION['status'] = "reg";
	} else {
		// im Normalfall bleibt man hier:
		$_SESSION['angemeldet'] = FALSE; 
	}
}

if ($_SESSION['status'] == "reg") {
	if (isset($_POST['zumanmelden'])) {
		$_SESSION['status'] = "aut";
	}
	else {
		// im Normalfall bleibt man hier:
		$_SESSION['angemeldet'] = FALSE; 
	}
}

if ($_SESSION['status'] == "web") {
	if(isset($_POST['kontoverwaltung'])){
		$_SESSION['status'] = "kontoverwaltung";
	}
	
	if (isset($_POST['abmelden'])) {
		$_SESSION['status'] = "abmelden";
	}
}

if($_SESSION['status'] == "kontoverwaltung"){
	if(isset($_POST['web'])){
		$_SESSION['status'] = "web";
	}
}

if($_SESSION['status'] == "abmelden"){
	if (isset($_POST['zumanmelden'])) {
		$_SESSION['status'] = "aut";
	}
}

switch ($_SESSION['status']) {
	case "aut":
		$titel = 'Authentifikation';
		$kto = (isset($_POST["kto"]) && is_string($_POST["kto"])) ? htmlspecialchars($_POST["kto"]) : "";
		$passw = (isset($_POST["passw"]) && is_string($_POST["passw"])) ? htmlspecialchars($_POST["passw"]) : "";
		
		if (isset($_POST['anmelden']))  {
			// Formular wurde bereits einmal ausgef�llt 
			if(strlen($kto) == 0) {
				$errorMessage = 'Bitte geben Sie ein Konto an. <br>';
				$error = true;
			} else {
				$statement = $pdo->prepare("SELECT id, kto, passw FROM user WHERE kto = :kto");
				$result = $statement->execute(array('kto' => $kto));
				$user = $statement->fetch();

				//�berpr�fung des Passworts: 
				if ($user == TRUE && password_verify($passw, $user['passw'])) {
					// Konto ist vorhanden und Passwort stimmt 
					$_SESSION['userid'] = htmlspecialchars($user['id']);
					$_SESSION['angemeldet'] = TRUE; 
					$_SESSION['status'] = "web";
					$_SESSION['kto'] = $kto;
					include 'aut2web.inc.php';
					// Beim n�chsten Durchgang ist eine neue Session gew�nscht: 
					session_regenerate_id();
					// nach der Anzeige des Statuswechsel soll der Rest nicht mehr angezeigt werden:
					$showFormular = false;
				} else {
			 		$errorMessage = "Eine Anmeldung war nicht m&ouml;glich. Haben Sie ein Konto? <br>";
			 	}
			}
		} 
		if($showFormular) {
			include 'aut.inc.php';
		}	
		break;
		
	case "reg":

	$titel = 'Registrierung';
	$passw = "";
	$passw_hash = "";

	$kto = (isset($_POST['kto']) && is_string($_POST['kto'])) ? htmlspecialchars($_POST['kto']) : "";

	$passw = (isset($_POST['passw']) && is_string($_POST['passw'])) ? htmlspecialchars($_POST['passw']) : "";

	$passw2 = (isset($_POST['passw2']) && is_string($_POST['passw2'])) ? htmlspecialchars($_POST['passw2']) : "";

if (isset($_POST['registrieren']))  {
	$_SESSION['ktoRegOK'] = FALSE;
	$_SESSION['passwRegOK'] = FALSE;

	if(strlen($kto) == 0) {
		$errorMessage = 'Bitte geben Sie ein Konto an. <br>';
		$error = true;
	}else {
		$_SESSION['ktoRegOK'] = TRUE;
		$kto = $_POST['kto'];
		$_SESSION['kto'] = $kto;

	}

	if($_POST['passw'] != $_POST['passw2'] || empty( $_POST['passw']) || empty($_POST['passw2']) ) {
		$errorMessage = 'Passwörter stimmen nicht überein. <br>';
		$error = true;
	}else{
		$passw = $_POST['passw'];
		$_SESSION['passwRegOK'] = TRUE;

	}

	if($_SESSION['ktoRegOK'] == TRUE && $_SESSION['passwRegOK'] == TRUE){

		$passw_hash = password_hash($passw, PASSWORD_DEFAULT);

		$statement = $pdo->prepare("INSERT INTO user (kto, passw) VALUES (:kto, :passw)");
		$result = $statement->execute(array('kto' => $kto, 'passw' => $passw_hash));

		include 'regsuccess.php';
		$showFormular = FALSE;
		$_SESSION['kto'] = $kto;
	}

} 
if($showFormular){
	include 'reg.php';
}
		break;

	case "web":

	$titel = "Webshop";
	
	include 'webshop.php';
	
	break;

	case "abmelden":
	include 'abmelden.php';
	session_regenerate_id();
	break;

	case "kontoverwaltung":

	$kto = $_SESSION['kto'];

	$stm = $pdo->prepare("SELECT * FROM user WHERE kto = :kto");
	$result = array('kto' => $kto);
	$stm->execute($result);
	$user = $stm->fetch();

	if($user['aclallaccounts'] == "R"){
		$stm2 = $pdo->prepare("SELECT * FROM user WHERE kto != :kto");
		$result2 = array('kto' => $kto);
		$stm2->execute($result2);
		$users = $stm2->fetchall();
	}

	include 'kontoverwaltung.php';

	break;
	
}
?>