<?php
/* 	Die Objektvariable für den DB-Zugriff wird in einer
	Include-Datei festgelegt. Ändern sich die Parameter für 
	den DB-Zugriff, muss dies nur an einer Stelle nachgetragen werden.
*/		
$pdo = new PDO('mysql:host=localhost;dbname=m183', 'root', '');
?>