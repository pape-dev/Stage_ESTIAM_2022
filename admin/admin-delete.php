<?php require_once('header.php'); ?>

<?php
// On vérifie la connexion
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Vérification si l'identifiant est valide ou pas
    $statement = $pdo->prepare("SELECT * FROM tbl_user WHERE id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php

// Supprimer de la tbl_user
$statement = $pdo->prepare("DELETE FROM tbl_user WHERE id=?");
$statement->execute(array($_REQUEST['id']));

header('location: admin.php');
?>