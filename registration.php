<?php require_once('header.php'); ?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_registration = $row['banner_registration'];
}
?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    if (empty($_POST['cust_name'])) {
        $valid = 0;
        $error_message .= 'Le champs ne doit pas être vide';
    }

    if (empty($_POST['cust_email'])) {
        $valid = 0;
        $error_message .= 'Le champs ne doit pas être vide' . "<br>";
    } else {
        if (filter_var($_POST['cust_email'], FILTER_VALIDATE_EMAIL) === false) {
            $valid = 0;
            $error_message .= 'Entrer un Email valide' . "<br>";
        } else {
            $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_email=?");
            $statement->execute(array($_POST['cust_email']));
            $total = $statement->rowCount();
            if ($total) {
                $valid = 0;
                $error_message .= 'Le champs ne doit pas être vide' . "<br>";
            }
        }
    }

    if (empty($_POST['cust_phone'])) {
        $valid = 0;
        $error_message .= 'Le champs ne doit pas être vide' . "<br>";
    }

    if (empty($_POST['cust_address'])) {
        $valid = 0;
        $error_message .= 'Le champs ne doit pas être vide' . "<br>";
    }

    if (empty($_POST['cust_country'])) {
        $valid = 0;
        $error_message .= 'Le champs ne doit pas être vide' . "<br>";
    }

    if (empty($_POST['cust_city'])) {
        $valid = 0;
        $error_message .= 'Le champs ne doit pas être vide' . "<br>";
    }

    if (empty($_POST['cust_state'])) {
        $valid = 0;
        $error_message .= 'Le champs ne doit pas être vide' . "<br>";
    }

    if (empty($_POST['cust_zip'])) {
        $valid = 0;
        $error_message .= 'Le champs ne doit pas être vide' . "<br>";
    }

    if (empty($_POST['cust_password']) || empty($_POST['cust_re_password'])) {
        $valid = 0;
        $error_message .= 'Le champs ne doit pas être vide' . "<br>";
    }

    if (!empty($_POST['cust_password']) && !empty($_POST['cust_re_password'])) {
        if ($_POST['cust_password'] != $_POST['cust_re_password']) {
            $valid = 0;
            $error_message .= 'Mot de passe invalide' . "<br>";
        }
    }

    if ($valid == 1) {

        $token = md5(time());
        $cust_datetime = date('Y-m-d h:i:s');
        $cust_timestamp = time();

        // saving into the database
        $statement = $pdo->prepare("INSERT INTO tbl_customer (
                                        cust_name,
                                        cust_cname,
                                        cust_email,
                                        cust_phone,
                                        cust_country,
                                        cust_address,
                                        cust_city,
                                        cust_state,
                                        cust_zip,
                                        cust_b_name,
                                        cust_b_cname,
                                        cust_b_phone,
                                        cust_b_country,
                                        cust_b_address,
                                        cust_b_city,
                                        cust_b_state,
                                        cust_b_zip,
                                        cust_s_name,
                                        cust_s_cname,
                                        cust_s_phone,
                                        cust_s_country,
                                        cust_s_address,
                                        cust_s_city,
                                        cust_s_state,
                                        cust_s_zip,
                                        cust_password,
                                        cust_token,
                                        cust_datetime,
                                        cust_timestamp,
                                        cust_status
                                    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute(array(
            strip_tags($_POST['cust_name']),
            strip_tags($_POST['cust_cname']),
            strip_tags($_POST['cust_email']),
            strip_tags($_POST['cust_phone']),
            strip_tags($_POST['cust_country']),
            strip_tags($_POST['cust_address']),
            strip_tags($_POST['cust_city']),
            strip_tags($_POST['cust_state']),
            strip_tags($_POST['cust_zip']),
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            md5($_POST['cust_password']),
            $token,
            $cust_datetime,
            $cust_timestamp,
            1
        ));



        $success_message =  'Votre inscription est terminée. Vous pouvez maitenenant vous connectez avec vos identifiants';
    }
}
?>

<div class="page-banner" style="background-color:#444;background-image: url(assets/uploads/<?php echo $banner_registration; ?>);">
    <div class="inner">
        <h1>Espace Client : Inscription</h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-content">



                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">

                                <?php
                                if ($error_message != '') {
                                    echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $error_message . "</div>";
                                }
                                if ($success_message != '') {
                                    echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $success_message . "</div>";
                                }
                                ?>

                                <div class="col-md-6 form-group">
                                    <label for="">Nom :</label>
                                    <input type="text" class="form-control" name="cust_name" placeholder="Entrer votre nom">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Prénom :</label>
                                    <input type="text" class="form-control" name="cust_cname" placeholder="Entrer votre prénom">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Email : </label>
                                    <input type="email" class="form-control" name="cust_email" placeholder="contact12@gmail.com">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Téléphone : </label>
                                    <input type="text" class="form-control" name="cust_phone" placeholder="+33 567890456">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="">Adresse : </label>
                                    <textarea name="cust_address" class="form-control" cols="30" rows="10" style="height:70px;" placeholder="Entrer votre adresse de domicile"></textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Pays :</label>
                                    <select name="cust_country" class="form-control select2">
                                        <option value="">Selectionnez votre pays</option>
                                        <?php
                                        $statement = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_name ASC");
                                        $statement->execute();
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                        ?>
                                            <option value="<?php echo $row['country_id']; ?>"><?php echo $row['country_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="">Ville :</label>
                                    <input type="text" class="form-control" name="cust_city" placeholder="Votre ville">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Rue / Bis : </label>
                                    <input type="text" class="form-control" name="cust_state" placeholder="23 rue / 34 Bis">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Code Postal : </label>
                                    <input type="text" class="form-control" name="cust_zip" placeholder="345000">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Mot de passe :</label>
                                    <input type="password" class="form-control" name="cust_password" placeholder="Entrer votre mot de passe">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Confirmation mot de passe :</label>
                                    <input type="password" class="form-control" name="cust_re_password" placeholder="Confirmer votre mot de passe">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""></label>
                                    <input type="submit" class="btn btn-warning" value="S'inscrire" name="form1">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>