<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    // updating into the database
    foreach ($_POST['lang_value'] as $key => $val) {
        $arr[$key] = $val;
    }

    for ($i = 1; $i <= count($arr); $i++) {
        $statement = $pdo->prepare("UPDATE tbl_language SET lang_value=? WHERE lang_id=?");
        $statement->execute(array($arr[$i], $i));
    }
    $success_message = 'Les paramètres de la langue ont été mis à jour avec succès.';
}

$i = 0;
$statement = $pdo->prepare("SELECT * FROM tbl_language");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $i++;
    $lang_ids[$i] = $row['lang_value'];
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Paramètre de la langue</h1>
    </div>
</section>


<?php
$statement = $pdo->prepare("SELECT * FROM tbl_language");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
}
?>

<section class="content">

    <div class="row">
        <div class="col-md-12">

            <?php if ($error_message) : ?>
                <div class="callout callout-info">
                    <p>
                        <?php echo $error_message; ?>
                    </p>
                </div>
            <?php endif; ?>

            <?php if ($success_message) : ?>
                <div class="callout callout-warning">
                    <p><?php echo $success_message; ?></p>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post">

                <h3 style="font-size:20px;font-weight:500;">De base</h3>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">€<span>:</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[1]" value="<?php echo $lang_ids[1]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Recherche produit <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[2]" value="<?php echo $lang_ids[2]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Recherche<span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[3]" value="<?php echo $lang_ids[3]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Envoyer <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[4]" value="<?php echo $lang_ids[4]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Mettre à jour <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[5]" value="<?php echo $lang_ids[5]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Lire la suite <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[6]" value="<?php echo $lang_ids[6]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">En série <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[7]" value="<?php echo $lang_ids[7]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Photo <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[8]" value="<?php echo $lang_ids[8]; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <h3 style="font-size:20px;font-weight:500;">Connexion</h3>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Connexion <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[9]" value="<?php echo $lang_ids[9]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Espace Client <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[10]" value="<?php echo $lang_ids[10]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Cliquer pour vous identifier <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[11]" value="<?php echo $lang_ids[11]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Retour à la page de connexion <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[12]" value="<?php echo $lang_ids[12]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Se connecter en tat que <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[13]" value="<?php echo $lang_ids[13]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Déconnecter <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[14]" value="<?php echo $lang_ids[14]; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <h3 style="font-size:20px;font-weight:500;">S'inscrire</h3>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">S'inscrire <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[15]" value="<?php echo $lang_ids[15]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Incription client <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[16]" value="<?php echo $lang_ids[16]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Enregistrement avec succès <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[17]" value="<?php echo $lang_ids[17]; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <h3 style="font-size:20px;font-weight:500;">Panier & Paiement</h3>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Panier du Client <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[18]" value="<?php echo $lang_ids[18]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Voir le panier <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[19]" value="<?php echo $lang_ids[19]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Mettre à jour le panier <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[20]" value="<?php echo $lang_ids[20]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Ajouter au panier <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[154]" value="<?php echo $lang_ids[154]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Retour au panier <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[21]" value="<?php echo $lang_ids[21]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Payer <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[22]" value="<?php echo $lang_ids[22]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Paiement <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[23]" value="<?php echo $lang_ids[23]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Se connecter pour effectuer le paiement <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[160]" value="<?php echo $lang_ids[160]; ?>">
                            </div>
                        </div>

                    </div>
                </div>

                <h3 style="font-size:20px;font-weight:500;">Paiement</h3>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Commandes <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[24]" value="<?php echo $lang_ids[24]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Historique du commande <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[25]" value="<?php echo $lang_ids[25]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Détails du commande <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[26]" value="<?php echo $lang_ids[26]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Date & Heure du paiement <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[27]" value="<?php echo $lang_ids[27]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label"> ID Transaction <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[28]" value="<?php echo $lang_ids[28]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Montant à payer <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[29]" value="<?php echo $lang_ids[29]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Statut du paiement <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[30]" value="<?php echo $lang_ids[30]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Méthode de paiement <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[31]" value="<?php echo $lang_ids[31]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">ID du paiement <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[32]" value="<?php echo $lang_ids[32]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Paiement <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[33]" value="<?php echo $lang_ids[33]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Sélectionnez le mode de paiement <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[34]" value="<?php echo $lang_ids[34]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Sélectionnez une méthode <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[35]" value="<?php echo $lang_ids[35]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">PayPal <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[36]" value="<?php echo $lang_ids[36]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Stripe <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[37]" value="<?php echo $lang_ids[37]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Dépôt à la banque <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[38]" value="<?php echo $lang_ids[38]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Numéro de la carte <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[39]" value="<?php echo $lang_ids[39]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Cryptogramme <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[40]" value="<?php echo $lang_ids[40]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Mois <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[41]" value="<?php echo $lang_ids[41]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Année <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[42]" value="<?php echo $lang_ids[42]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Envoyer<span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[43]" value="<?php echo $lang_ids[43]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Informations sur les transactions <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[44]" value="<?php echo $lang_ids[44]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Inclure correctement l'identifiant de transaction et d'autres informations <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[45]" value="<?php echo $lang_ids[45]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Payer <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[46]" value="<?php echo $lang_ids[46]; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <h3 style="font-size:20px;font-weight:500;">Produit</h3>
                <div class="box box-info">
                    <div class="box-body">

                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Nom du produit <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[47]" value="<?php echo $lang_ids[47]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Détails du produit <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[48]" value="<?php echo $lang_ids[48]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Relations produits <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[155]" value="<?php echo $lang_ids[155]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Voir tous les produits en relation <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[156]" value="<?php echo $lang_ids[156]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Catégories <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[49]" value="<?php echo $lang_ids[49]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Catégorie: <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[50]" value="<?php echo $lang_ids[50]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Tous les produits secondaires <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[51]" value="<?php echo $lang_ids[51]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Sélectionnez la taille <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[52]" value="<?php echo $lang_ids[52]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Taille <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[157]" value="<?php echo $lang_ids[157]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Sélectionnez la couleur <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[53]" value="<?php echo $lang_ids[53]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Couleur <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[158]" value="<?php echo $lang_ids[158]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Prix <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[159]" value="<?php echo $lang_ids[159]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Prix du produit <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[54]" value="<?php echo $lang_ids[54]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Quantité <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[55]" value="<?php echo $lang_ids[55]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">En rupture de stock <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[56]" value="<?php echo $lang_ids[56]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Partagez <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[57]" value="<?php echo $lang_ids[57]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Paratgez le produit <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[58]" value="<?php echo $lang_ids[58]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Description du produit <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[59]" value="<?php echo $lang_ids[59]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Aucun produit trouvé <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[153]" value="<?php echo $lang_ids[153]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Bienfaits <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[60]" value="<?php echo $lang_ids[60]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Conditions <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[61]" value="<?php echo $lang_ids[61]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Conditions de retour <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[62]" value="<?php echo $lang_ids[62]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Commentaires <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[63]" value="<?php echo $lang_ids[63]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Commentaires <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[64]" value="<?php echo $lang_ids[64]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Avis <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[65]" value="<?php echo $lang_ids[65]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Ajouter un commentaire <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[66]" value="<?php echo $lang_ids[66]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Envoyer <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[67]" value="<?php echo $lang_ids[67]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Vous avez déjà donné une note ! <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[68]" value="<?php echo $lang_ids[68]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">L'évaluation a été soumise avec succès ! <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[163]" value="<?php echo $lang_ids[163]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Vous devez vous connecter pour donner un avis<span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[69]" value="<?php echo $lang_ids[69]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Aucune description trouvée <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[70]" value="<?php echo $lang_ids[70]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Aucune fonctionnalité trouvée <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[71]" value="<?php echo $lang_ids[71]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Conditions non trouvées <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[72]" value="<?php echo $lang_ids[72]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Conditions de retour non trouvées <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[73]" value="<?php echo $lang_ids[73]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Aucun avis n'a été trouvé <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[74]" value="<?php echo $lang_ids[74]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Nom du client <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[75]" value="<?php echo $lang_ids[75]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Commentaire <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[76]" value="<?php echo $lang_ids[76]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Commentaires <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[77]" value="<?php echo $lang_ids[77]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Evaluation <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[78]" value="<?php echo $lang_ids[78]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Avant <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[79]" value="<?php echo $lang_ids[79]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Suivant <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[80]" value="<?php echo $lang_ids[80]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Détails sous-total <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[81]" value="<?php echo $lang_ids[81]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Total <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[82]" value="<?php echo $lang_ids[82]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Gestion <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[83]" value="<?php echo $lang_ids[83]; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <h3 style="font-size:20px;font-weight:500;">Facturation & Livraison</h3>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Frais de livraison <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[84]" value="<?php echo $lang_ids[84]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Continuer <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[85]" value="<?php echo $lang_ids[85]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Adresse Facturation <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[161]" value="<?php echo $lang_ids[161]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Mettre à jour l'adresse de facturation <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[86]" value="<?php echo $lang_ids[86]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Adresse de livraison <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[162]" value="<?php echo $lang_ids[162]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Mettre à jour l'adresse de livraison <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[87]" value="<?php echo $lang_ids[87]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Mettre à jour toutes les infos <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[88]" value="<?php echo $lang_ids[88]; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <h3 style="font-size:20px;font-weight:500;">Tableau de bord</h3>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Tableau de bord <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[89]" value="<?php echo $lang_ids[89]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Bienvenue au tableau de bord <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[90]" value="<?php echo $lang_ids[90]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Retour au tableau de bord <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[91]" value="<?php echo $lang_ids[91]; ?>">
                            </div>
                        </div>
                    </div>
                </div>


                <h3 style="font-size:20px;font-weight:500;">Abonnement</h3>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Abonnement <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[92]" value="<?php echo $lang_ids[92]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">S'abonner au Newsletter <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[93]" value="<?php echo $lang_ids[93]; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <h3 style="font-size:20px;font-weight:500;">Email</h3>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Email <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[94]" value="<?php echo $lang_ids[94]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Entrer votre adresse Email <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[95]" value="<?php echo $lang_ids[95]; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <h3 style="font-size:20px;font-weight:500;">Mot de passe</h3>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Mot de passe <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[96]" value="<?php echo $lang_ids[96]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Mot de passe oublié <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[97]" value="<?php echo $lang_ids[97]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Retaper le mot de passe <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[98]" value="<?php echo $lang_ids[98]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Changer le mot de passe <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[99]" value="<?php echo $lang_ids[99]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Nouveau mot de passe <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[100]" value="<?php echo $lang_ids[100]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Retaper le mot de passe <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[101]" value="<?php echo $lang_ids[101]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Change Password <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[149]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[149]; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>



                <h3 style="font-size:20px;font-weight:500;">Client</h3>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Nom <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[102]" value="<?php echo $lang_ids[102]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">livreur<span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[103]" value="<?php echo $lang_ids[103]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Téléphone <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[104]" value="<?php echo $lang_ids[104]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Adresse <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[105]" value="<?php echo $lang_ids[105]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Pays <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[106]" value="<?php echo $lang_ids[106]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Ville <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[107]" value="<?php echo $lang_ids[107]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Rue<span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[108]" value="<?php echo $lang_ids[108]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Code Postal <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[109]" value="<?php echo $lang_ids[109]; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <h3 style="font-size:20px;font-weight:500;">Autres infos</h3>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Qui sommes-nous? <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[110]" value="<?php echo $lang_ids[110]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Galleries <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[111]" value="<?php echo $lang_ids[111]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Populaires <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[112]" value="<?php echo $lang_ids[112]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Recents <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[113]" value="<?php echo $lang_ids[113]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Contact <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[114]" value="<?php echo $lang_ids[114]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Formulaire de conatact <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[115]" value="<?php echo $lang_ids[115]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Adresse Domicile <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[116]" value="<?php echo $lang_ids[116]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Mise à jour du profil <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[117]" value="<?php echo $lang_ids[117]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Envoyer un message <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[118]" value="<?php echo $lang_ids[118]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Message <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[119]" value="<?php echo $lang_ids[119]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Maps <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="lang_value[120]" value="<?php echo $lang_ids[120]; ?>">
                            </div>
                        </div>
                    </div>
                </div>





                <h3 style="font-size:20px;font-weight:500;">Messages d'erreurs</h3>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Félicitations ! Le paiement a été effectué avec réussi. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[121]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[121]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">
                                Les informations de facturation & de livraison ont été modifiés avec succès. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[122]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[122]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Le nom du client ne peut pas être vide. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[123]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[123]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Le numéro télépohne ne peut pas être vide. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[124]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[124]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">
                                L'adresse ne peut pas être vide. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[125]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[125]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Vous devez obligatoirement sélectionner un pays. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[126]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[126]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">C
                                Il ne peut pas être vide. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[127]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[127]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Il ne peut pas être vide. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[128]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[128]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Il ne peut pas être vide. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[129]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[129]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">
                                Les informations du profil ont été modifiés avec succès. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[130]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[130]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">L'Email ne peut pas être vide <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[131]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[131]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">L'e-mail et/ou le mot de passe ne peuvent pas être vides. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[132]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[132]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">'adresse de messagerie ne correspond pas. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[133]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[133]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">
                                L'adresse e-mail doit être valide. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[134]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[134]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">L'adresse mail existe déjà. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[147]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[147]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">
                                Votre adresse e-mail est introuvable . <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[135]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[135]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">
                                Veuillez vérifier votre e-mail et confirmer votre abonnement. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[136]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[136]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">
                                Votre email est vérifié avec succès. Vous pouvez maintenant vous connecter à notre site Web. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[137]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[137]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Le mot de passe ne peut pas être vide. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[138]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[138]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Les mots de passe ne correspondent pas. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[139]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[139]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">
                                Veuillez saisir le nouveau mot de passe et plus la confirmation. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[140]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[140]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Le mot de passe a été modifié avec succès. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[141]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[141]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">
                                Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien ci-dessous. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[142]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[142]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">DEMANDE DE RÉINITIALISATION DU MOT DE PASSE <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[143]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[143]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">
                                Le délai de réinitialisation du mot de passe (24 heures) a expiré. Veuillez réinitialiser votre mot de passe à nouveau. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[144]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[144]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Un lien de confirmation est envoyé à votre adresse e-mail. Vous y trouverez les informations de réinitialisation du mot de passe. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[145]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[145]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Le mot de passe est réinitialisé avec succès. Vous pouvez maintenant vous connectez. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[146]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[146]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Désolé! Votre compte est inactif. Veuillez contacter l'administrateur. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[148]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[148]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">Mail de confirmation d'inscription pour VOTRE SITE WEB. <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[150]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[150]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">
                                Merci pour votre inscription! Votre compte a été créé. Pour activer votre compte, cliquez sur le lien ci-dessous : <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[151]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[151]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label">
                                Votre inscription est terminée. Veuillez vérifier votre adresse e-mail pour suivre le processus pour activer votre compte <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea name="lang_value[152]" class="form-control" cols="30" rows="10" style="height:70px;"><?php echo $lang_ids[152]; ?></textarea>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-4 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Mettre à jour</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>



        </div>
    </div>

</section>

<?php require_once('footer.php'); ?>