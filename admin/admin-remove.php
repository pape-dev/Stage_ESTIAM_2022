<?php require_once('header.php'); ?>

<?php

// Supprimer tous les administrateurs
$statement = $pdo->prepare("DELETE FROM tbl_user");
$statement->execute();

header('location: admin.php');
?>