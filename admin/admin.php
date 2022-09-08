<?php
//On récupère le fichier header
require_once('header.php'); ?>

<!--Création d'une une section-->
<section class="content-header">

    <!--le titre-->
    <div class="content-header-left">
        <Marquee>
            <h1>Liste des Administrateurs du site 42Shop</h1>
        </Marquee>
    </div>

    <!--Création des boutons à droite-->
    <!--btn-sm : la taille du bouton-->
    <div class="content-header-right">
        <a href="admin-remove.php" class="btn btn-info btn-sm">Suprimer</a>
        <a href="admin-csv.php" class="btn btn-warning btn-sm">Importer</a>
        <a href="admin-add.php" class="btn btn-warning btn-sm">Nouveau administrateur</a>
    </div>
</section>

<!--Création de la deuxième section-->
<section class="content">

    <!--définir les lignes-->
    <div class="row">

        <!--définir les colonnes-->
        <div class="col-md-12">

            <!--une ligne de séparation-->
            <div class="box box-warning">

                <!--le type de table-->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">

                        <!--les données de la table-->
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Email</th>
                                <th>Nom</th>
                                <th>Photo</th>
                                <th>Rôle</th>
                                <th>Téléphone</th>
                                <th>Gestion</th>
                            </tr>
                        </thead>

                        <!--le contenu-->
                        <tbody>

                            <!--Requête préparée-->
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_user");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC); //sous-forme de tableau associatif
                            foreach ($result as $row) {
                                $i++;
                            ?>

                                <!--Récupérer les données depuis la base de données-->
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['full_name']; ?></td>
                                    <td><?php echo $row['photo']; ?></td>
                                    <td><?php echo $row['role']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>

                                    <!--Création de deux boutons pour la gestion du tableau-->
                                    <td>
                                        <a href="#" class="btn btn-info btn-xs" data-href="admin-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete">supprimer</a>
                                        <a href="admin-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-xs">Modifier</a>
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

<!--Alerte avant la suppression-->
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