<?php require_once('header.php'); ?>

<?php

//Vérifier s 'ils existent
if (isset($_POST['form1'])) {
    $valid = 1;

    //On vérifie si tous les champs sont remplis
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

    //Affichage si les champs sont remplis
    if ($valid == 1) {

        $statement = $pdo->prepare("INSERT INTO tbl_user (full_name,email, phone, password, photo, role) VALUES (?,?,?,?,?,?)");
        $statement->execute(array($_POST['full_name'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['photo'], $_POST['role']));

        $success_message = 'Un nouveau administrateur a été ajouté avec succès !!!';

        unset($_POST['full_name']);
        unset($_POST['email']);
        unset($_POST['photo']);
        unset($_POST['phone']);
        unset($_POST['password']);
        unset($_POST['role']);
    }
}
?>

<!--Page pour ajouter un nouveau administrateur-->
<!--section 1-->
<section class="content-header">
    <div class="content-header-left">
        <h1>Nouveau administrateur</h1>
    </div>
    <div class="content-header-right">
        <a href="admin.php" class="btn btn-warning btn-sm">Liste des administrateurs</a>
    </div>
</section>

<!--section 2 -->
<section class="content">

    <div class="row">
        <div class="col-md-12">

            <!--Affichage des messages d'erreur ou success-->
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

            <!--Création du formulaire d'ajout-->
            <form class="form-horizontal" action="" method="post">
                <div class="box box-warning">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nom & Prénom<span>:</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="full_name" value="<?php if (isset($_POST['full_name'])) {
                                                                                                                        echo $_POST['full_name'];
                                                                                                                    } ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Email<span>:</span></label>
                            <div class="col-sm-6">
                                <input type="email" autocomplete="off" class="form-control" name="email" value="<?php if (isset($_POST['email'])) {
                                                                                                                    echo $_POST['email'];
                                                                                                                } ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Téléphone<span>:</span></label>
                            <div class="col-sm-6">
                                <input type="number" autocomplete="off" class="form-control" name="phone" value="<?php if (isset($_POST['phone'])) {
                                                                                                                        echo $_POST['phone'];
                                                                                                                    } ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Mot de passe<span>:</span></label>
                            <div class="col-sm-6">
                                <input type="password" autocomplete="off" class="form-control" name="password" value="<?php if (isset($_POST['password'])) {
                                                                                                                            echo $_POST['password'];
                                                                                                                        } ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Rôle<span>:</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="role" value="<?php if (isset($_POST['role'])) {
                                                                                                echo $_POST['role'];
                                                                                            } ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Photo<span>:</span></label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" name="photo" value="<?php if (isset($_POST['photo'])) {
                                                                                                echo $_POST['photo'];
                                                                                            } ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-warning pull-left" name="form1">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>