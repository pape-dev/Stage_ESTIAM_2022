<?php require_once('header.php'); ?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Liste des sous-catégories</h1>
    </div>
    <div class="content-header-right">
        <a href="mid-category-add.php" class="btn btn-primary btn-sm">Nouvelle sous-catégorie</a>
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
                                <th>Nom sous-catégorie</th>
                                <th>Gestion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT * 
                                    FROM tbl_mid_category t1
                                    JOIN tbl_top_category t2
                                    ON t1.tcat_id = t2.tcat_id
                                    ORDER BY t1.mcat_id DESC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['mcat_name']; ?></td>
                                    <td>
                                        <a href="mid-category-edit.php?id=<?php echo $row['mcat_id']; ?>" class="btn btn-warning btn-xs">Modifier</a>
                                        <a href="#" class="btn btn-info btn-xs" data-href="mid-category-delete.php?id=<?php echo $row['mcat_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Supprimer</a>
                                    </td>
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
                <p>Voulez-vous supprimer cette sous-catégorie?</p>
                <p style="color:blue;">Attention !!! Tous les produits et catégories liés sous cette catégorie seront supprimés de tous les sections (le tableau des commandes, le tableau des paiements, le tableau des tailles, le tableau des couleurs, le tableau des notes, etc).</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Non</button>
                <a class="btn btn-warning btn-ok">Oui</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>