<?php require_once('header.php'); ?>

<?php
// Accès privée
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Vérification si l'identifiant est valide ou pas
    $statement = $pdo->prepare("SELECT * FROM tbl_customer_message");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php

// Supprimer de la tbl_customer_message
$statement = $pdo->prepare("DELETE FROM tbl_customer_message");
$statement->execute(array($_REQUEST['id']));

header('location: ms-clients.php');
?>