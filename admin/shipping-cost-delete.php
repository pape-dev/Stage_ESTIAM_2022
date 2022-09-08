<?php require_once('header.php'); ?>

<?php
// Privée de l'accès
if (!isset($_REQUEST['id'])) {
    header('location: shipping-cost.php');
    exit;
} else {
    // Vérification si l'identifiant est valide ou non
    $statement = $pdo->prepare("SELECT * FROM tbl_shipping_cost WHERE shipping_cost_id=?");
    $statement->execute(array($_REQUEST['shiping_cost_id']));
    $total = $statement->rowCount();
    if ($total == 0) {
        header('location: shipping_cost.php');
        exit;
    }
}
?>

<?php

// Supprimer de la  tbl_shipping_cost
$statement = $pdo->prepare("DELETE FROM tbl_shipping_cost WHERE shipping_cost_id=? AND country_name=?");
$statement->execute(array($_REQUEST['shipping_cost_id']));

header('location: shipping-cost.php');
?>

