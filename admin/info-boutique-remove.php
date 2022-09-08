<?php require_once('header.php'); ?>

<?php

// Delete from tbl_subscriber
$statement = $pdo->prepare("DELETE FROM tbl_settings");
$statement->execute();

header('location: info-boutique.php');
?>