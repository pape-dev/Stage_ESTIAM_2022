<?php require_once('header.php'); ?>

<?php
// Vérifier si le client est connecté ou non
if (!isset($_SESSION['customer'])) {
    header('location: ' . BASE_URL . 'logout.php');
    exit;
} else {
    // Si le client est connecté, mais que l'administrateur le rend inactif, forcez la déconnexion de cet utilisateur.
    $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_id=? AND cust_status=?");
    $statement->execute(array($_SESSION['customer']['cust_id'], 0));
    $total = $statement->rowCount();
    if ($total) {
        header('location: ' . BASE_URL . 'logout.php');
        exit;
    }
}
?>

<?php
if (isset($_POST['form1'])) {


    // update data into the database
    $statement = $pdo->prepare("UPDATE tbl_customer SET 
                            cust_b_name=?, 
                            cust_b_cname=?, 
                            cust_b_phone=?, 
                            cust_b_country=?, 
                            cust_b_address=?, 
                            cust_b_city=?, 
                            cust_b_state=?, 
                            cust_b_zip=?,
                            cust_s_name=?, 
                            cust_s_cname=?, 
                            cust_s_phone=?, 
                            cust_s_country=?, 
                            cust_s_address=?, 
                            cust_s_city=?, 
                            cust_s_state=?, 
                            cust_s_zip=? 

                            WHERE cust_id=?");
    $statement->execute(array(
        strip_tags($_POST['cust_b_name']),
        strip_tags($_POST['cust_b_cname']),
        strip_tags($_POST['cust_b_phone']),
        strip_tags($_POST['cust_b_country']),
        strip_tags($_POST['cust_b_address']),
        strip_tags($_POST['cust_b_city']),
        strip_tags($_POST['cust_b_state']),
        strip_tags($_POST['cust_b_zip']),
        strip_tags($_POST['cust_s_name']),
        strip_tags($_POST['cust_s_cname']),
        strip_tags($_POST['cust_s_phone']),
        strip_tags($_POST['cust_s_country']),
        strip_tags($_POST['cust_s_address']),
        strip_tags($_POST['cust_s_city']),
        strip_tags($_POST['cust_s_state']),
        strip_tags($_POST['cust_s_zip']),
        $_SESSION['customer']['cust_id']
    ));

    $success_message = 'Les informations de facturation & de livraison ont été modifiés avec succès.';

    $_SESSION['customer']['cust_b_name'] = strip_tags($_POST['cust_b_name']);
    $_SESSION['customer']['cust_b_cname'] = strip_tags($_POST['cust_b_cname']);
    $_SESSION['customer']['cust_b_phone'] = strip_tags($_POST['cust_b_phone']);
    $_SESSION['customer']['cust_b_country'] = strip_tags($_POST['cust_b_country']);
    $_SESSION['customer']['cust_b_address'] = strip_tags($_POST['cust_b_address']);
    $_SESSION['customer']['cust_b_city'] = strip_tags($_POST['cust_b_city']);
    $_SESSION['customer']['cust_b_state'] = strip_tags($_POST['cust_b_state']);
    $_SESSION['customer']['cust_b_zip'] = strip_tags($_POST['cust_b_zip']);
    $_SESSION['customer']['cust_s_name'] = strip_tags($_POST['cust_s_name']);
    $_SESSION['customer']['cust_s_cname'] = strip_tags($_POST['cust_s_cname']);
    $_SESSION['customer']['cust_s_phone'] = strip_tags($_POST['cust_s_phone']);
    $_SESSION['customer']['cust_s_country'] = strip_tags($_POST['cust_s_country']);
    $_SESSION['customer']['cust_s_address'] = strip_tags($_POST['cust_s_address']);
    $_SESSION['customer']['cust_s_city'] = strip_tags($_POST['cust_s_city']);
    $_SESSION['customer']['cust_s_state'] = strip_tags($_POST['cust_s_state']);
    $_SESSION['customer']['cust_s_zip'] = strip_tags($_POST['cust_s_zip']);
}
?>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php require_once('customer-sidebar.php'); ?>
            </div>
            <div class="col-md-12">
                <div class="user-content">
                    <?php
                    if ($error_message != '') {
                        echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $error_message . "</div>";
                    }
                    if ($success_message != '') {
                        echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $success_message . "</div>";
                    }
                    ?>
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Facturation</h3>
                                <div class="form-group">
                                    <label for="">Nom</label>
                                    <input type="text" class="form-control" name="cust_b_name" value="<?php echo $_SESSION['customer']['cust_b_name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Prénom</label>
                                    <input type="text" class="form-control" name="cust_b_cname" value="<?php echo $_SESSION['customer']['cust_b_cname']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Téléphone</label>
                                    <input type="text" class="form-control" name="cust_b_phone" value="<?php echo $_SESSION['customer']['cust_b_phone']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Pays</label>
                                    <select name="cust_b_country" class="form-control">
                                        <?php
                                        $statement = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_name ASC");
                                        $statement->execute();
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                        ?>
                                            <option value="<?php echo $row['country_id']; ?>" <?php if ($row['country_id'] == $_SESSION['customer']['cust_b_country']) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $row['country_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Adresse</label>
                                    <textarea name="cust_b_address" class="form-control" cols="30" rows="10" style="height:100px;"><?php echo $_SESSION['customer']['cust_b_address']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Ville</label>
                                    <input type="text" class="form-control" name="cust_b_city" value="<?php echo $_SESSION['customer']['cust_b_city']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Rue</label>
                                    <input type="text" class="form-control" name="cust_b_state" value="<?php echo $_SESSION['customer']['cust_b_state']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Code Postal</label>
                                    <input type="text" class="form-control" name="cust_b_zip" value="<?php echo $_SESSION['customer']['cust_b_zip']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Livraison</h3>
                                <div class="form-group">
                                    <label for="">Nom </label>
                                    <input type="text" class="form-control" name="cust_s_name" value="<?php echo $_SESSION['customer']['cust_s_name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Prénom</label>
                                    <input type="text" class="form-control" name="cust_s_cname" value="<?php echo $_SESSION['customer']['cust_s_cname']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Téléphone</label>
                                    <input type="text" class="form-control" name="cust_s_phone" value="<?php echo $_SESSION['customer']['cust_s_phone']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Pays</label>
                                    <select name="cust_s_country" class="form-control">
                                        <?php
                                        $statement = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_name ASC");
                                        $statement->execute();
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                        ?>
                                            <option value="<?php echo $row['country_id']; ?>" <?php if ($row['country_id'] == $_SESSION['customer']['cust_s_country']) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?php echo $row['country_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Adresse</label>
                                    <textarea name="cust_s_address" class="form-control" cols="30" rows="10" style="height:100px;"><?php echo $_SESSION['customer']['cust_s_address']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Ville</label>
                                    <input type="text" class="form-control" name="cust_s_city" value="<?php echo $_SESSION['customer']['cust_s_city']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Rue</label>
                                    <input type="text" class="form-control" name="cust_s_state" value="<?php echo $_SESSION['customer']['cust_s_state']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Code Postal</label>
                                    <input type="text" class="form-control" name="cust_s_zip" value="<?php echo $_SESSION['customer']['cust_s_zip']; ?>">
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-warning" value="Mettre à jour" name="form1">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>