<?php require_once('header.php'); ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Liste des clients</h1>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th width="10">N°</th>
								<th width="180">Nom</th>
								<th width="150">Email </th>
								<th width="180">Adresse</th>
								<th>Status</th>
								<th width="100">Modifier</th>
								<th width="100">Supprimer</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 0;
							$statement = $pdo->prepare("SELECT * 
														FROM tbl_customer t1
														JOIN tbl_country t2
														ON t1.cust_country = t2.country_id
													");
							$statement->execute();
							$result = $statement->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $row) {
								$i++;
							?>
								<tr class="<?php if ($row['cust_status'] == 1) {
												echo 'bg-warning text-dark';
											} else {
												echo 'bg-transparent text-dark';
											} ?>">
									<td><?php echo $i; ?></td>
									<td><?php echo $row['cust_name']; ?></td>
									<td><?php echo $row['cust_email']; ?></td>
									<td>
										<?php echo $row['country_name']; ?><br>
										<?php echo $row['cust_city']; ?><br>
										<?php echo $row['cust_state']; ?>
									</td>
									<td><?php if ($row['cust_status'] == 1) {
											echo 'Active';
										} else {
											echo 'Inactive';
										} ?></td>
									<td>
										<a href="customer-change-status.php?id=<?php echo $row['cust_id']; ?>" class="btn btn-warning btn-xs">Modifier le Status</a>
									</td>
									<td>
										<a href="#" class="btn btn-info btn-xs" data-href="customer-delete.php?id=<?php echo $row['cust_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Supprimer</a>
									</td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
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
				<p>Voulez-vous supprimer ce client?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-dark" data-dismiss="modal">Non</button>
				<a class="btn btn-warning btn-ok">Oui</a>
			</div>
		</div>
	</div>
</div>


<?php require_once('footer.php'); ?>