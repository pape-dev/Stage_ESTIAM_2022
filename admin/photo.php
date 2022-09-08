<?php require_once('header.php'); ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Tableau des photos</h1>
	</div>
	<div class="content-header-right">
		<a href="photo-add.php" class="btn btn-primary btn-sm">Nouvelle photo</a>
	</div>
</section>


<section class="content">

	<div class="row">
		<div class="col-md-12">


			<div class="box box-warning">

				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>N°</th>
								<th>Nom</th>
								<th>Photo</th>
								<th>Gestion</th>
							</tr>
						</thead>
						<tbody>

							<?php
							$i = 0;
							$statement = $pdo->prepare("SELECT * FROM tbl_photo");
							$statement->execute();
							$result = $statement->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $row) {
								$i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row['caption']; ?></td>
									<td>
										<img src="../assets/uploads/<?php echo $row['photo']; ?>" width="140">
									</td>
									<td>
										<a href="photo-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-xs">Modifier</a>
										<a href="#" class="btn btn-info btn-xs" data-href="photo-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete">Supprimer</a>
									</td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
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
				Voulez-vous supprimer cette photo?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Nom</button>
				<a class="btn btn-warning btn-ok">Oui</a>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>