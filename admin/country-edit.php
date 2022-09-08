<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
	$valid = 1;

	if (empty($_POST['country_name'])) {
		$valid = 0;
		$error_message .= "Désolé!!! Le champs du pays ne peut pas être vide <br>";
	} else {

		// // Vérification en cas de doublons
		$statement = $pdo->prepare("SELECT * FROM tbl_country WHERE country_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row) {
			$current_country_name = $row['country_name'];
		}

		$statement = $pdo->prepare("SELECT * FROM tbl_country WHERE country_name=? and country_name!=?");
		$statement->execute(array($_POST['country_name'], $current_country_name));
		$total = $statement->rowCount();
		if ($total) {
			$valid = 0;
			$error_message .= 'Désolé !!! Le nom du pays choisi existe déjà <br>';
		}
	}

	if ($valid == 1) {
		// Mise à jour du pays
		$statement = $pdo->prepare("UPDATE tbl_country SET country_name=? WHERE country_id=?");
		$statement->execute(array($_POST['country_name'], $_REQUEST['id']));

		$success_message = 'Bravo !!! le pays a été modifié avec succès..';
	}
}
?>

<?php
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_country WHERE country_id=?");
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
		<a href="country.php" class="btn btn-primary btn-sm">Liste des pays</a>
	</div>
</section>


<?php
foreach ($result as $row) {
	$country_name = $row['country_name'];
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
							<label for="" class="col-sm-2 control-label">Nom du pays <span>:</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="country_name" value="<?php echo $country_name; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Modifier</button>
							</div>
						</div>

					</div>

				</div>

			</form>



		</div>
	</div>

</section>

<!--Confirmation suppression-->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Confirmation</h4>
			</div>
			<div class="modal-body">
				Voulez-vous supprimer ce pays?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">Non</button>
				<a class="btn btn-dark btn-ok">Oui</a>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>