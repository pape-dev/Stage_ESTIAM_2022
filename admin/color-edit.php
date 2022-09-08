<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
	$valid = 1;

	if (empty($_POST['color_name'])) {
		$valid = 0;
		$error_message .= "Désolé !!! Le champs de la couleur ne peut pas être vide";
	} else {
		// Vérification en cas de doublons
		$statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row) {
			$current_color_name = $row['color_name'];
		}

		$statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_name=? and color_name!=?");
		$statement->execute(array($_POST['color_name'], $current_color_name));
		$total = $statement->rowCount();
		if ($total) {
			$valid = 0;
			$error_message .= 'Désolé !!! Le nom de la couleur choisie existe déjà';
		}
	}

	if ($valid == 1) {
		// Mise à jour d'une couleur
		$statement = $pdo->prepare("UPDATE tbl_color SET color_name=? WHERE color_id=?");
		$statement->execute(array($_POST['color_name'], $_REQUEST['id']));

		$success_message = 'Bravo !!! la couleur a été modifié avec succès.';
	}
}
?>

<?php
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Vérifiaction si l'identifiant est valide ou non
	$statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id=?");
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
		<a href="color.php" class="btn btn-warning btn-sm">Liste des couleurs</a>
	</div>
</section>


<?php
foreach ($result as $row) {
	$color_name = $row['color_name'];
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
							<label for="" class="col-sm-2 control-label">Nom de la couleur <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="color_name" value="<?php echo $color_name; ?>">
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

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Confirmation</h4>
			</div>
			<div class="modal-body">
				Voulez-vous supprimer cette couleur?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" data-dismiss="modal">Non</button>
				<a class="btn btn-warning btn-ok">Oui</a>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>