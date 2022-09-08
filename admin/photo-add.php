<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
	$valid = 1;

	if (empty($_POST['caption'])) {
		$valid = 0;
		$error_message .= "Le champs ne doit pas être vide<br>";
	}

	$path = $_FILES['photo']['name'];
	$path_tmp = $_FILES['photo']['tmp_name'];

	if ($path == '') {
		$valid = 0;
		$error_message .= "Selectionner une photo<br>";
	} else {
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$file_name = basename($path, '.' . $ext);
		if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
			$valid = 0;
			$error_message .= 'Extension valide jpg, jpeg, gif ou png <br>';
		}
	}

	if ($valid == 1) {

		// getting auto increment id for photo renaming
		$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_photo'");
		$statement->execute();
		$result = $statement->fetchAll();
		foreach ($result as $row) {
			$ai_id = $row[10];
		}

		// uploading the photo into the main location and giving it a final name
		$final_name = 'photo-' . $ai_id . '.' . $ext;
		move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

		// saving into the database
		$statement = $pdo->prepare("INSERT INTO tbl_photo (caption,photo) VALUES (?,?)");
		$statement->execute(array($_POST['caption'], $final_name));

		$success_message = 'La photo a été ajouté avec succès.';
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Nouvelle photo</h1>
	</div>
	<div class="content-header-right">
		<a href="photo.php" class="btn btn-primary btn-sm">Voir toutes les photos</a>
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

			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Nom<span>:</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="caption">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Modifier <span>:</span></label>
							<div class="col-sm-4" style="padding-top:6px;">
								<input type="file" name="photo">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-warning pull-left" name="form1">Envoyer</button>
							</div>
						</div>
					</div>
				</div>

			</form>


		</div>
	</div>

</section>

<?php require_once('footer.php'); ?>