<?php require_once('header.php'); ?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_checkout = $row['banner_checkout'];
}
?>

<?php
if (!isset($_SESSION['cart_p_id'])) {
    header('location: cart.php');
    exit;
}
?>

<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $banner_checkout; ?>)">
    <div class="overlay"></div>
    <div class="page-banner-inner">
        <h1>Paiement</h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php if (!isset($_SESSION['customer'])) : ?>
                    <p>
                        <a href="login.php" class="btn btn-md btn-Black">Veuillez-vous connecter pour effectuer le paiement</a>
                    </p>
                <?php else : ?>

                    <h3 class="special">Détails de la commande</h3>
                    <div class="cart">
                        <table class="table table-responsive table-hover table-bordered">
                            <tr>
                                <th><?php echo 'N°' ?></th>
                                <th>Photo</th>
                                <th>Nom du produit</th>
                                <th>Taile</th>
                                <th>Couleur</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th class="text-right">Total</th>
                            </tr>
                            <?php
                            $table_total_price = 0;

                            $i = 0;
                            foreach ($_SESSION['cart_p_id'] as $key => $value) {
                                $i++;
                                $arr_cart_p_id[$i] = $value;
                            }

                            $i = 0;
                            foreach ($_SESSION['cart_size_id'] as $key => $value) {
                                $i++;
                                $arr_cart_size_id[$i] = $value;
                            }

                            $i = 0;
                            foreach ($_SESSION['cart_size_name'] as $key => $value) {
                                $i++;
                                $arr_cart_size_name[$i] = $value;
                            }

                            $i = 0;
                            foreach ($_SESSION['cart_color_id'] as $key => $value) {
                                $i++;
                                $arr_cart_color_id[$i] = $value;
                            }

                            $i = 0;
                            foreach ($_SESSION['cart_color_name'] as $key => $value) {
                                $i++;
                                $arr_cart_color_name[$i] = $value;
                            }

                            $i = 0;
                            foreach ($_SESSION['cart_p_qty'] as $key => $value) {
                                $i++;
                                $arr_cart_p_qty[$i] = $value;
                            }

                            $i = 0;
                            foreach ($_SESSION['cart_p_current_price'] as $key => $value) {
                                $i++;
                                $arr_cart_p_current_price[$i] = $value;
                            }

                            $i = 0;
                            foreach ($_SESSION['cart_p_name'] as $key => $value) {
                                $i++;
                                $arr_cart_p_name[$i] = $value;
                            }

                            $i = 0;
                            foreach ($_SESSION['cart_p_featured_photo'] as $key => $value) {
                                $i++;
                                $arr_cart_p_featured_photo[$i] = $value;
                            }
                            ?>
                            <?php for ($i = 1; $i <= count($arr_cart_p_id); $i++) : ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <img src="assets/uploads/<?php echo $arr_cart_p_featured_photo[$i]; ?>" alt="">
                                    </td>
                                    <td><?php echo $arr_cart_p_name[$i]; ?></td>
                                    <td><?php echo $arr_cart_size_name[$i]; ?></td>
                                    <td><?php echo $arr_cart_color_name[$i]; ?></td>
                                    <td>€<?php echo $arr_cart_p_current_price[$i]; ?></td>
                                    <td><?php echo $arr_cart_p_qty[$i]; ?></td>
                                    <td class="text-right">
                                        <?php
                                        $row_total_price = $arr_cart_p_current_price[$i] * $arr_cart_p_qty[$i];
                                        $table_total_price = $table_total_price + $row_total_price;
                                        ?>
                                        €<?php echo $row_total_price; ?>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                            <tr>
                                <th colspan="7" class="total-text">sous-total</th>
                                <th class="total-amount">€<?php echo $table_total_price; ?></th>
                            </tr>
                            <?php
                            $statement = $pdo->prepare("SELECT * FROM tbl_shipping_cost WHERE country_id=?");
                            $statement->execute(array($_SESSION['customer']['cust_country']));
                            $total = $statement->rowCount();
                            if ($total) {
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    $shipping_cost = $row['amount'];
                                }
                            } else {
                                $statement = $pdo->prepare("SELECT * FROM tbl_shipping_cost");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    $shipping_cost = $row['amount'];
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="7" class="total-text">Frais de livraison</td>
                                <td class="total-amount"><?php echo $shipping_cost; ?></td>
                            </tr>
                            <tr>
                                <th colspan="7" class="total-text">Total</th>
                                <th class="total-amount">
                                    <?php
                                    $final_total = $table_total_price + $shipping_cost;
                                    ?>
                                    €<?php echo $final_total; ?>
                                </th>
                            </tr>
                        </table>
                    </div>



                    <div class="billing-address">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="special">Renseignements facture</h3>
                                <table class="table table-responsive table-bordered table-hover table-striped bill-address">
                                    <tr>
                                        <td>Nom</td>
                                        <td><?php echo $_SESSION['customer']['cust_b_name']; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Prénom</td>
                                        <td><?php echo $_SESSION['customer']['cust_b_cname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Téléphone</td>
                                        <td><?php echo $_SESSION['customer']['cust_b_phone']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Pays</td>
                                        <td>
                                            <?php
                                            $statement = $pdo->prepare("SELECT * FROM tbl_country WHERE country_id=?");
                                            $statement->execute(array($_SESSION['customer']['cust_s_country']));
                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $row) {
                                                echo $row['country_name'];
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Adresse</td>
                                        <td>
                                            <?php echo nl2br($_SESSION['customer']['cust_b_address']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ville</td>
                                        <td><?php echo $_SESSION['customer']['cust_b_city']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Rue</td>
                                        <td><?php echo $_SESSION['customer']['cust_b_state']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Code Postal</td>
                                        <td><?php echo $_SESSION['customer']['cust_b_zip']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h3 class="special">Infos client</h3>
                                <table class="table table-responsive table-bordered table-hover table-striped bill-address">
                                    <tr>
                                        <td>Nom</td>
                                        <td><?php echo $_SESSION['customer']['cust_s_name']; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Prénom</td>
                                        <td><?php echo $_SESSION['customer']['cust_s_cname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Téléphone</td>
                                        <td><?php echo $_SESSION['customer']['cust_s_phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pays</td>
                                        <td>
                                            <?php
                                            $statement = $pdo->prepare("SELECT * FROM tbl_country WHERE country_id=?");
                                            $statement->execute(array($_SESSION['customer']['cust_s_country']));
                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $row) {
                                                echo $row['country_name'];
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Adresse</td>
                                        <td>
                                            <?php echo nl2br($_SESSION['customer']['cust_s_address']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ville</td>
                                        <td><?php echo $_SESSION['customer']['cust_s_city']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Rue</td>
                                        <td><?php echo $_SESSION['customer']['cust_s_state']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Code Postal</td>
                                        <td><?php echo $_SESSION['customer']['cust_s_zip']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="cart-buttons">
                        <ul>
                            <li><a href="cart.php" class="btn btn-warning">Retour au panier</a></li>
                        </ul>
                    </div>

                    <div class="clear"></div>
                    <h3 class="special">Paiement</h3>
                    <div class="row">

                        <?php
                        $checkout_access = 1;
                        if (
                            ($_SESSION['customer']['cust_b_name'] == '') ||
                            ($_SESSION['customer']['cust_b_cname'] == '') ||
                            ($_SESSION['customer']['cust_b_phone'] == '') ||
                            ($_SESSION['customer']['cust_b_country'] == '') ||
                            ($_SESSION['customer']['cust_b_address'] == '') ||
                            ($_SESSION['customer']['cust_b_city'] == '') ||
                            ($_SESSION['customer']['cust_b_state'] == '') ||
                            ($_SESSION['customer']['cust_b_zip'] == '') ||
                            ($_SESSION['customer']['cust_s_name'] == '') ||
                            ($_SESSION['customer']['cust_s_cname'] == '') ||
                            ($_SESSION['customer']['cust_s_phone'] == '') ||
                            ($_SESSION['customer']['cust_s_country'] == '') ||
                            ($_SESSION['customer']['cust_s_address'] == '') ||
                            ($_SESSION['customer']['cust_s_city'] == '') ||
                            ($_SESSION['customer']['cust_s_state'] == '') ||
                            ($_SESSION['customer']['cust_s_zip'] == '')
                        ) {
                            $checkout_access = 0;
                        }
                        ?>
                        <?php if ($checkout_access == 0) : ?>
                            <div class="col-md-12">
                                <div style="color:blue;font-size:22px;margin-bottom:50px; text-align:center; font-weight:bolder;">
                                    Vous devez remplir toutes les informations de facturation et de livraison à partir de votre panneau de tableau de bord afin de valider la commande.
                                    <br><a href="customer-billing-shipping-update.php" style="color:yellow;text-decoration:none;">Pour le faire, cliquer sur ce lien</a>.
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="col-md-4">

                                <div class="row">

                                    <div class="col-md-12 form-group">
                                        <label for="">Mode de paiement :</label>
                                        <select name="payment_method" class="form-control select2" id="advFieldsStatus">
                                            <option value="">Choisir une méthode</option>
                                            <a href="" target="blank">
                                                <option value="PayPal">PayPal</option>
                                            </a>
                                            <a href="" target="blank">
                                                <option value="Bank Deposit">Carte Bancaire</option>
                                            </a>

                                            <a href="">
                                                <option value="Bank Deposit">Orange Money</option>
                                            </a>

                                            <a href="" target="blank">
                                                <option value="Bank Deposit">Wave</option>
                                            </a>

                                            <a href="" target="blank">
                                                <option value="Bank Deposit">RIA</option>
                                            </a>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <a href="https://www.paypal.com/fr/signin"><input type="submit" class="btn btn-warning" value="Payer" name="form1"></a>
                                    </div>







                                </div>


                            </div>
                        <?php endif; ?>

                    </div>


                <?php endif; ?>

            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>