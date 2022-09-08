<?php require_once('header.php'); ?>

<?php
// Accès privée
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Vérification si l'identifiant est valide ou pas
	$statement = $pdo->prepare("SELECT * FROM tbl_subscriber WHERE subs_active=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if ($total == 0) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php

// Supprimer de la tbl_subscriber
$statement = $pdo->prepare("DELETE FROM tbl_subscriber WHERE subs_active=?");
$statement->execute(array($_REQUEST['subs_active']));

header('location: subscriber.php');
?>