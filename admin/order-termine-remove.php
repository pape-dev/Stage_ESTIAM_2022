<?php require_once('header.php'); ?>

<?php

// Supprimer de la tbl_payment
$statement = $pdo->prepare("DELETE FROM tbl_payement WHERE payement_status='Terminé'");
$statement->execute();

header('location: order-termine.php');
?>