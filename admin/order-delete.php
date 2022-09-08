<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Vérification si l'identifiant est valide ou non
	$statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if ($total == 0) {
		header('location: logout.php');
		exit;
	} else {
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row) {
			$payment_id = $row['payment_id'];
			$payment_status = $row['payment_status'];
			$shipping_status = $row['shipping_status'];
		}
	}
}
?>

<?php

if (($payment_status == 'Terminé') && ($shipping_status == 'Terminé')) :
// Pas de retour en stock
else :
	// Retour en stock
	$statement = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_id=?");
	$statement->execute(array($payment_id));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row) {
		$statement1 = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
		$statement1->execute(array($row['product_id']));
		$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result1 as $row1) {
			$p_qty = $row1['p_qty'];
		}
		$final = $p_qty + $row['quantity'];
		$statement1 = $pdo->prepare("UPDATE tbl_product SET p_qty=? WHERE p_id=?");
		$statement1->execute(array($final, $row['product_id']));
	}
endif;

// Supprimer de la tbl_order
$statement = $pdo->prepare("DELETE FROM tbl_order WHERE payment_id=?");
$statement->execute(array($payment_id));

// Supprimer de la tbl_payment
$statement = $pdo->prepare("DELETE FROM tbl_payment WHERE id=?");
$statement->execute(array($_REQUEST['id']));

header('location: order.php');
?>