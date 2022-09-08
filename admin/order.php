<?php require_once('header.php'); ?>

<?php
$error_message = '';
if (isset($_POST['form1'])) {
    $valid = 1;
    if (empty($_POST['subject_text'])) {
        $valid = 0;
        $error_message .= 'Ne peut pas être vide\n';
    }
    if (empty($_POST['message_text'])) {
        $valid = 0;
        $error_message .= 'Ne peut pas être vide\n';
    }
    if ($valid == 1) {

        $subject_text = strip_tags($_POST['subject_text']);
        $message_text = strip_tags($_POST['message_text']);

        // Obteir Email de l'utilisateur
        $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_id=?");
        $statement->execute(array($_POST['cust_id']));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $cust_email = $row['cust_email'];
        }

        // Obtenir Email de l'administrateur
        $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $admin_email = $row['contact_email'];
        }

        $order_detail = '';
        $statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE payment_id=?");
        $statement->execute(array($_POST['payment_id']));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {

            if ($row['payment_method'] == 'PayPal') :
                $payment_details = '
Transaction Id: ' . $row['txnid'] . '<br>
        		';
            elseif ($row['payment_method'] == 'Stripe') :
                $payment_details = '
Transaction Id: ' . $row['txnid'] . '<br>
Card number: ' . $row['card_number'] . '<br>
Card CVV: ' . $row['card_cvv'] . '<br>
Card Month: ' . $row['card_month'] . '<br>
Card Year: ' . $row['card_year'] . '<br>
        		';
            elseif ($row['payment_method'] == 'Bank Deposit') :
                $payment_details = '
Transaction Details: <br>' . $row['bank_transaction_info'];
            endif;

            $order_detail .= '
Customer Name: ' . $row['customer_name'] . '<br>
Customer Email: ' . $row['customer_email'] . '<br>
Payment Method: ' . $row['payment_method'] . '<br>
Payment Date: ' . $row['payment_date'] . '<br>
Payment Details: <br>' . $payment_details . '<br>
Paid Amount: ' . $row['paid_amount'] . '<br>
Payment Status: ' . $row['payment_status'] . '<br>
Shipping Status: ' . $row['shipping_status'] . '<br>
Payment Id: ' . $row['payment_id'] . '<br>
            ';
        }

        $i = 0;
        $statement = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_id=?");
        $statement->execute(array($_POST['payment_id']));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $i++;
            $order_detail .= '
<br><b><u>Product Item ' . $i . '</u></b><br>
Product Name: ' . $row['product_name'] . '<br>
Size: ' . $row['size'] . '<br>
Color: ' . $row['color'] . '<br>
Quantity: ' . $row['quantity'] . '<br>
Unit Price: ' . $row['unit_price'] . '<br>
            ';
        }

        $statement = $pdo->prepare("INSERT INTO tbl_customer_message (subject,message,order_detail,cust_id) VALUES (?,?,?,?)");
        $statement->execute(array($subject_text, $message_text, $order_detail, $_POST['cust_id']));


        $success_message = 'Message envoyé.';
    }
}
?>
<?php
if ($error_message != '') {
    echo "<script>alert('" . $error_message . "')</script>";
}
if ($success_message != '') {
    echo "<script>alert('" . $success_message . "')</script>";
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Liste des commandes</h1>
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
                                <th>Client</th>
                                <th>Details du produit</th>
                                <th>
                                    Infos paiement
                                </th>
                                <th>Montant</th>
                                <th>Statut du paiement</th>
                                <th>Statut de l'expédition</th>
                                <th>Gestion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_payment ORDER by id DESC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                            ?>
                                <tr class="<?php if ($row['payment_status'] == 'Pending') {
                                                echo 'bg-r';
                                            } else {
                                                echo 'bg-g';
                                            } ?>">
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <b>Id:</b> <?php echo $row['customer_id']; ?><br>
                                        <b>Nom:</b><br> <?php echo $row['customer_name']; ?><br>
                                        <b>Email:</b><br> <?php echo $row['customer_email']; ?><br><br>
                                        <a href="#" data-toggle="modal" data-target="#model-<?php echo $i; ?>" class="btn btn-success btn-xs" style="width:100%;margin-bottom:4px;">Contact client</a>
                                        <div id="model-<?php echo $i; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" style="font-weight: bold; color:orange;">Message au client</h4>
                                                    </div>
                                                    <div class="modal-body" style="font-size: 14px">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="cust_id" value="<?php echo $row['customer_id']; ?>">
                                                            <input type="hidden" name="payment_id" value="<?php echo $row['payment_id']; ?>">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <td>Sujet</td>
                                                                    <td>
                                                                        <input type="text" name="subject_text" class="form-control" style="width: 100%;">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Message</td>
                                                                    <td>
                                                                        <textarea name="message_text" class="form-control" cols="30" rows="10" style="width:100%;height: 200px;"></textarea>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><input type="submit" value="Envoyer" name="form1"></td>
                                                                </tr>
                                                            </table>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Quitter</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        $statement1 = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_id=?");
                                        $statement1->execute(array($row['payment_id']));
                                        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result1 as $row1) {
                                            echo '<b>Produit:</b> ' . $row1['product_name'];
                                            echo '<br>(<b>Taille:</b> ' . $row1['size'];
                                            echo ', <b>Couleur:</b> ' . $row1['color'] . ')';
                                            echo '<br>(<b>Quantité:</b> ' . $row1['quantity'];
                                            echo ', <b>Prix:</b> ' . $row1['unit_price'] . ')';
                                            echo '<br><br>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($row['payment_method'] == 'PayPal') : ?>
                                            <b>Méthode de paiement:</b> <?php echo '<span style="color:blue;"><b>' . $row['payment_method'] . '</b></span>'; ?><br>
                                            <b>ID Paiement:</b> <?php echo $row['payment_id']; ?><br>
                                            <b>Date:</b> <?php echo $row['payment_date']; ?><br>
                                            <b>ID Transaction:</b> <?php echo $row['txnid']; ?><br>

                                        <?php elseif ($row['payment_method'] == 'Stripe') : ?>
                                            <b>Méthode de paiement:</b> <?php echo '<span style="color:black;"><b>' . $row['payment_method'] . '</b></span>'; ?><br>
                                            <b>Id paiement:</b> <?php echo $row['payment_id']; ?><br>
                                            <b>Date:</b> <?php echo $row['payment_date']; ?><br>
                                            <b>ID Transaction:</b> <?php echo $row['txnid']; ?><br>
                                            <b>Numéro de la carte:</b> <?php echo $row['card_number']; ?><br>
                                            <b>Code CVC:</b> <?php echo $row['card_cvv']; ?><br>
                                            <b>Date d'expiration:</b> <?php echo $row['card_month']; ?><br>
                                            <b>Année d'expiration:</b> <?php echo $row['card_year']; ?><br>

                                        <?php elseif ($row['payment_method'] == 'Bank Deposit') : ?>
                                            <b>Méthode de paiement:</b> <?php echo '<span style="color:red;"><b>' . $row['payment_method'] . '</b></span>'; ?><br>
                                            <b>ID Paiement:</b> <?php echo $row['payment_id']; ?><br>
                                            <b>Date:</b> <?php echo $row['payment_date']; ?><br>
                                            <b>Infos Transaction:</b> <br><?php echo $row['bank_transaction_info']; ?><br>
                                        <?php endif; ?>
                                    </td>
                                    <td>$<?php echo $row['paid_amount']; ?></td>
                                    <td>
                                        <?php echo $row['payment_status']; ?>
                                        <br><br>
                                        <?php
                                        if ($row['payment_status'] == 'En attente') {
                                        ?>
                                            <a href="order-change-status.php?id=<?php echo $row['id']; ?>&task=En attente" class="btn btn-warning btn-xs" style="width:100%;margin-bottom:4px;">En attente</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $row['shipping_status']; ?>
                                        <br><br>
                                        <?php
                                        if ($row['payment_status'] == 'Terminé') {
                                            if ($row['shipping_status'] == 'En attente') {
                                        ?>
                                                <a href="shipping-change-status.php?id=<?php echo $row['id']; ?>&task=terminé" class="btn btn-warning btn-xs" style="width:100%;margin-bottom:4px;">Terminé</a>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-xs" data-href="order-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete" style="width:100%;">Supprimer</a>
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
                Voulez-vous supprimer cette transaction?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Non</button>
                <a class="btn btn-warning btn-ok">Oui</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>