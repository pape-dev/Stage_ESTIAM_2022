<?php require_once('header.php'); ?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Liste des catégories principales</h1>
    </div>
    <div class="content-header-right">
        <a href="top-category-add.php" class="btn btn-primary btn-sm">Nouvelle catégorie principale</a>
    </div>
</section>


<section class="content">

    <div class="row">
        <div class="col-md-12">


            <div class="box box-warning">

                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom</th>
                                <th>Ajouter au menu?</th>
                                <th>Gestion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_top_category ORDER BY tcat_id DESC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['tcat_name']; ?></td>
                                    <td>
                                        <?php
                                        if ($row['show_on_menu'] == 1) {
                                            echo 'Oui';
                                        } else {
                                            echo 'Non';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="top-category-edit.php?id=<?php echo $row['tcat_id']; ?>" class="btn btn-warning btn-xs">Modifier</a>
                                        <a href="#" class="btn btn-info btn-xs" data-href="top-category-delete.php?id=<?php echo $row['tcat_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Supprimer</a>
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
                <p>Voulez-vous supprimer cette catégorie principale?</p>
                <p style="color:red;">Attention !!! Tous les produits et catégories liés sous cette catégorie seront supprimés de tous les sections (le tableau des commandes, le tableau des paiements, le tableau des tailles, le tableau des couleurs, le tableau des notes, etc).</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Non</button>
                <a class="btn btn-warning btn-ok">Oui</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>