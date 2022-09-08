<?php require_once('header.php'); ?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Infos Boutique</h1>
    </div>
    <div class="content-header-right">
        <a href="info-boutique-remove.php" class="btn btn-info btn-sm">Suprimer</a>
        <a href="info-boutique-csv.php" class="btn btn-warning btn-sm">Importer CSV</a>
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
                                <th>Logo</th>
                                <th>Adresse</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Gestion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_settings");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['logo']; ?></td>
                                    <td><?php echo $row['footer_copyright']; ?></td>
                                    <td><?php echo $row['contact_address']; ?></td>
                                    <td><?php echo $row['contact_email']; ?></td>
                                    <td><?php echo $row['contact_phone']; ?></td>
                                    <td><a href="#" class="btn btn-info btn-xs" data-href="info-boutique-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete">supprimer</a></td>
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
                Voulez-vous le supprimer?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Non</button>
                <a class="btn btn-warning btn-ok">Oui</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>