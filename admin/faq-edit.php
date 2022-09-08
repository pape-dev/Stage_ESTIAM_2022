<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
	$valid = 1;

	if (empty($_POST['faq_title'])) {
		$valid = 0;
		$error_message .= 'Désolé !!! Le champs titre ne doit pas être vide<br>';
	}

	if (empty($_POST['faq_content'])) {
		$valid = 0;
		$error_message .= 'Désolé !!! Le champs description ne doit pas être vide<br>';
	}

	if ($valid == 1) {

		$statement = $pdo->prepare("UPDATE tbl_faq SET faq_title=?, faq_content=? WHERE faq_id=?");
		$statement->execute(array($_POST['faq_title'], $_POST['faq_content'], $_REQUEST['id']));


		$success_message = 'Bravo !!! Une QR a été ajouté avec succès';
	}
}
?>

<?php
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Vérification si l'identifiant est valide ou non
	$statement = $pdo->prepare("SELECT * FROM tbl_faq WHERE faq_id=?");
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
		<h1>Modiciation QR</h1>
	</div>
	<div class="content-header-right">
		<a href="faq.php" class="btn btn-primary btn-sm">Liste des QR</a>
	</div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_faq WHERE faq_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$faq_title = $row['faq_title'];
	$faq_content = $row['faq_content'];
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
							<label for="" class="col-sm-2 control-label">Titre <span>:</span></label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="faq_title" value="<?php echo $faq_title; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Réponse<span>:</span></label>
							<div class="col-sm-9">
								<textarea class="form-control" name="faq_content" id="editor1" style="height:140px;"><?php echo $faq_content; ?></textarea>
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