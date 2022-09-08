<?php require_once('header.php'); ?>

<?php
// Privée de l'accès
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Vérification si l'identifiant est valide ou non
	$statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if ($total == 0) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php

// Supprimer de la  tbl_size
$statement = $pdo->prepare("DELETE FROM tbl_size WHERE size_id=?");
$statement->execute(array($_REQUEST['id']));

header('location: size.php');
?>