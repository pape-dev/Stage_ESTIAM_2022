<?php require_once('header.php'); ?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Tableau des paiements terminés</h1>
    </div>
    <div class="content-header-right">
        <a href="order-termine-csv.php" class="btn btn-warning btn-sm">Importer</a>
        <a href="order-termine-remove.php" class="btn btn-warning btn-sm">Vider</a>
    </div>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Code paiement</th>
                                <th>Nom du client</th>
                                <th>Email du client</th>
                                <th>Date paiement</th>
                                <th>Montant</th>
                                <th>Méthode de paiement</th>
                                <th>Statut du paiement</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE payment_status='Terminé'");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['payment_id']; ?></td>
                                    <td><?php echo $row['customer_name']; ?></td>
                                    <td><?php echo $row['customer_email']; ?></td>
                                    <td><?php echo $row['payment_date']; ?></td>
                                    <td><?php echo $row['paid_amount']; ?></td>
                                    <td><?php echo $row['payment_method']; ?></td>
                                    <td><?php echo $row['payment_status']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
            </div>
            <div class="modal-body">
                Voulez-vous supprimer ce tableau?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Non</button>
                <a class="btn btn-warning btn-ok">Oui</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>