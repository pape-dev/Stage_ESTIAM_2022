<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;

    if (empty($_POST['full_name'])) {
        $valid = 0;
        $error_message .= 'Le champs ne doit pas être vide<br>';
    }

    if (empty($_POST['email'])) {
        $valid = 0;
        $error_message .= 'Désolé !!! Le champs ne doit pas être vide<br>';
    }

    if (empty($_POST['phone'])) {
        $valid = 0;
        $error_message .= 'Désolé !!! Le champs ne doit pas être vide<br>';
    }

    if (empty($_POST['password'])) {
        $valid = 0;
        $error_message .= 'Désolé !!! Le champs ne doit pas être vide<br>';
    }

    if (empty($_POST['photo'])) {
        $valid = 0;
        $error_message .= 'Désolé !!! Le champs ne doit pas être vide<br>';
    }

    if (empty($_POST['role'])) {
        $valid = 0;
        $error_message .= 'Désolé !!! Le champs ne doit pas être vide<br>';
    }

    if ($valid == 1) {

        $statement = $pdo->prepare("UPDATE tbl_user SET full_name=?, email=?, phone=?, password=?, role=?, photo=? WHERE id=?");
        $statement->execute(array($_POST['full_name'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['role'],  $_POST['photo'], $_REQUEST['id']));


        $success_message = 'Bravo !!! Mise à jour du profil avec succès';
    }
}
?>

<?php
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Vérification si l'identifiant est valide ou non
    $statement = $pdo->prepare("SELECT * FROM tbl_user WHERE id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>
<section class="content-header">
    <div class="content-header-left">
        <h1>Modification</h1>
    </div>
    <div class="content-header-right">
        <a href="admin.php" class="btn btn-warning btn-sm">Liste des administrateurs</a>
    </div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $full_name = $row['full_name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $password = $row['password'];
    $role = $row['role'];
    $photo = $row['photo'];
}
?>

<section class="content">

    <div class="row">
        <div class="col-md-12">

            <?php if ($error_message) : ?>
                <div class="callout callout-info">
                    <p>
                        <?php echo $error_message; ?>
                    </p>
                </div>
            <?php endif; ?>

            <?php if ($success_message) : ?>
                <div class="callout callout-warning">
                    <p><?php echo $success_message; ?></p>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nom & Prénom <span>:</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="full_name" value="<?php echo $full_name; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Email <span>:</span></label>
                            <div class="col-sm-6">
                                <input type="email" autocomplete="off" class="form-control" name="email" value="<?php echo $email; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Téléphone <span>:</span></label>
                            <div class="col-sm-6">
                                <input type="number" autocomplete="off" class="form-control" name="phone" value="<?php echo $phone; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Mot de passe <span>:</span></label>
                            <div class="col-sm-6">
                                <input type="password" autocomplete="off" class="form-control" name="password" value="<?php echo $password; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Rôle <span>:</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="role" value="<?php echo $role; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Photo<span>:</span></label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" name="photo" value="<?php echo $photo; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-warning pull-left" name="form1">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>

<?php require_once('footer.php'); ?>