<?php require_once('header.php'); ?>

<?php
// Empêcher l'accès direct de cette page.
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Vérifiez si l'identifiant est valide ou non
	$statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if ($total == 0) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php

// Supprimer une couleur 
$statement = $pdo->prepare("DELETE FROM tbl_color WHERE color_id=?");
$statement->execute(array($_REQUEST['id']));

header('location: color.php');
?>