<?php
// niveau de rapport d'erreurs
ini_set('error_reporting', E_ALL);

// fusion horaire
date_default_timezone_set("Europe/Paris");

// host
$dbhost = 'localhost';

// nom de la base de données
$dbname = 'ecommerceweb';

// BDD username
$dbuser = 'root';

// BDD password
$dbpass = '';

// Definir base url
define("BASE_URL", "");

// Getting Admin url
define("ADMIN_URL", BASE_URL . "admin" . "/");

try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
	echo "Connection error :" . $exception->getMessage();
}
