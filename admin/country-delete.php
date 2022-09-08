<?php require_once('header.php'); ?>

<?php
// Empêcher l'accès direct de cette page.
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Vérifiez si l'identifiant est valide ou non
	$statement = $pdo->prepare("SELECT * FROM tbl_country WHERE country_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if ($total == 0) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php

// Supprimer un pays dans la table pays > country
$statement = $pdo->prepare("DELETE FROM tbl_country WHERE country_id=?");
$statement->execute(array($_REQUEST['id']));

header('location: country.php');
?>