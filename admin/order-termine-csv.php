<?php
include 'inc/config.php';
$now = gmdate("D, d M Y H:i:s");
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=paiement-termine.csv');
$output = fopen("php://output", "w");
fputcsv($output, array('SL', 'Tableau des paiements terminés'));
$statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE payment_status='Terminé'");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    fputcsv($output, array($row['id'], $row['payment_id'], $row['payment_id'], $row['customer_name'], $row['customer_email'], $row['payment_date'], $row['paid_amount'], $row['payment_method'], $row['payment_status']));
}
fclose($output);
