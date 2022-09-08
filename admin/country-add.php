<?php require_once('header.php'); ?>

<?php
//Déterminer si une variable est déclarée et est différente de null
if (isset($_POST['form1'])) {
	$valid = 1;

	//Déterminer si une variable est vide
	if (empty($_POST['country_name'])) {
		$valid = 0;
		$error_message .= "Désolé!!! Le champs du pays ne peut pas être vide";
	} else {
		// Vérifiaction en cas de doublons
		$statement = $pdo->prepare("SELECT * FROM tbl_country WHERE country_name=?");
		$statement->execute(array($_POST['country_name']));
		$total = $statement->rowCount();
		if ($total) {
			$valid = 0;
			$error_message .= "Désolé !!! Le nom du pays choisi existe déjà";
		}
	}

	if ($valid == 1) {

		// Ajouter un nouveau pays dans la table pays >country
		$statement = $pdo->prepare("INSERT INTO tbl_country (country_name) VALUES (?)");
		$statement->execute(array($_POST['country_name']));

		$success_message = 'Bravo !!! le pays a été ajouté avec succès.';
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Nouveau pays</h1>
	</div>
	<div class="content-header-right">
		<a href="country.php" class="btn btn-primary btn-sm">Voir les pays</a>
	</div>
</section>


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
								<input type="text" class="form-control" name="country_name" placeholder="Ex: France">
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