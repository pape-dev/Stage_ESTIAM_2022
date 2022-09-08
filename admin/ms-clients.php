<?php require_once('header.php'); ?>

<section class="content-header">
    <div class="content-header-left">
        <Marquee>
            <h1>Messages des clients</h1>
        </Marquee>
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
                                <th>ID client</th>
                                <th>ID message</th>
                                <th>Sujet</th>
                                <th>Détails</th>
                                <th>Gestion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_customer_message");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['cust_id']; ?></td>
                                    <td><?php echo $row['customer_message_id']; ?></td>
                                    <td><?php echo $row['subject']; ?></td>
                                    <td><?php echo $row['order_detail']; ?></td>
                                    <td><a href="#" class="btn btn-info btn-xs" data-href="ms-clients-delete.php?id=<?php echo $row['customer_message_id']; ?>" data-toggle="modal" data-target="#confirm-delete">supprimer</a></td>
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
                Voulez-vous supprimer le message?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Non</button>
                <a class="btn btn-warning btn-ok">Oui</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>