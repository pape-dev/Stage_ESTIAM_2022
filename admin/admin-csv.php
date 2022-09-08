<?php
//Inclure la base de données
include 'inc/config.php';

//Définir la date & l'heure
$now = gmdate("D, d M Y H:i:s");

//Le type de fichier
header('Content-Type: text/csv; charset=utf-8');

//le nom du fichier
header('Content-Disposition: attachment; filename=subscriber_list.csv');

//Formate une ligne en CSV et l'écrit dans un fichier
$output = fopen("php://output", "w");
fputcsv($output, array('SL', 'Liste Administrateurs'));

//Les données du fichier
$statement = $pdo->prepare("SELECT * FROM tbl_user");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    fputcsv($output, array($row['id'], $row['email'], $row['full_name'], $row['phone'], $row['role']));
}
fclose($output);
