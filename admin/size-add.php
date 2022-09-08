<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
	$valid = 1;

	if (empty($_POST['size_name'])) {
		$valid = 0;
		$error_message .= "Désolé !!! Le champs ne doit pas être vide<br>";
	} else {
		// Duplicate Category checking
		$statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_name=?");
		$statement->execute(array($_POST['size_name']));
		$total = $statement->rowCount();
		if ($total) {
			$valid = 0;
			$error_message .= "Désolé !!! Cette taille choisie existe déja<br>";
		}
	}

	if ($valid == 1) {

		// Saving data into the main table tbl_size
		$statement = $pdo->prepare("INSERT INTO tbl_size (size_name) VALUES (?)");
		$statement->execute(array($_POST['size_name']));

		$success_message = 'Bravo !!! La taille a été ajouté avec succès.';
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Nouvelle taille</h1>
	</div>
	<div class="content-header-right">
		<a href="size.php" class="btn btn-primary btn-sm">Liste des tailles</a>
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
							<label for="" class="col-sm-2 control-label">Taille <span>:</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="size_name" placeholder="Ex: XL">
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