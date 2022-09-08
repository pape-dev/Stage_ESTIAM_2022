<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Vérifiez si l'identifiant est valide ou non
	$statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if ($total == 0) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php

// Supprimer un client
$statement = $pdo->prepare("DELETE FROM tbl_customer WHERE cust_id=?");
$statement->execute(array($_REQUEST['id']));

//
$statement = $pdo->prepare("DELETE FROM tbl_rating WHERE cust_id=?");
$statement->execute(array($_REQUEST['id']));

header('location: customer.php');
?>