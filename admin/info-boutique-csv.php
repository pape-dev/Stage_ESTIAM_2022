<?php
include 'inc/config.php';
$now = gmdate("D, d M Y H:i:s");
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=info_list.csv');
$output = fopen("php://output", "w");
fputcsv($output, array('SL', 'Infos boutique'));
$statement = $pdo->prepare("SELECT * FROM tbl_settings");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    fputcsv($output, array($row['id'], $row['logo'], $row['footer_copiryght'], $row['contact_adress'], $row['contact_email'], $row['contact_phone']));
}
fclose($output);
