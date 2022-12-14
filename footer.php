<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$footer_about = $row['footer_about'];
	$contact_email = $row['contact_email'];
	$contact_phone = $row['contact_phone'];
	$contact_address = $row['contact_address'];
	$footer_copyright = $row['footer_copyright'];
	$total_recent_post_footer = $row['total_recent_post_footer'];
	$total_popular_post_footer = $row['total_popular_post_footer'];
	$newsletter_on_off = $row['newsletter_on_off'];
	$before_body = $row['before_body'];
}
?>


<?php if ($newsletter_on_off == 1) : ?>
	<section class="home-newsletter">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="single">
						<?php
						if (isset($_POST['form_subscribe'])) {

							if (empty($_POST['email_subscribe'])) {
								$valid = 0;
								$error_message1 .= "le champs ne doit pas être vide";
							} else {
								if (filter_var($_POST['email_subscribe'], FILTER_VALIDATE_EMAIL) === false) {
									$valid = 0;
									$error_message1 .= "l'adresse mail est invalide";
								} else {
									$statement = $pdo->prepare("SELECT * FROM tbl_subscriber WHERE subs_email=?");
									$statement->execute(array($_POST['email_subscribe']));
									$total = $statement->rowCount();
									if ($total) {
										$valid = 0;
										$error_message1 .= "Le champs ne doit pas être vide";
									} else {

										$key = md5(uniqid(rand(), true));

										// date
										$current_date = date('Y-m-d');

										// Time
										$current_date_time = date('Y-m-d H:i:s');

										// BDD Insert
										$statement = $pdo->prepare("INSERT INTO tbl_subscriber (subs_email,subs_date,subs_date_time,subs_hash,subs_active) VALUES (?,?,?,?,?)");
										$statement->execute(array($_POST['email_subscribe'], $current_date, $current_date_time, $key, 1));

										$success_message1 = "Votre abonnement est validé";
									}
								}
							}
						}
						if ($error_message1 != '') {
							echo "<script>alert('" . $error_message1 . "')</script>";
						}
						if ($success_message1 != '') {
							echo "<script>alert('" . $success_message1 . "')</script>";
						}
						?>
						<form action="" method="post">
							<?php $csrf->echoInputField(); ?>
							<h2>S'inscrire au Newsletter</h2>
							<div class="input-group">
								<input type="email" class="form-control" placeholder="Entrer votre Email" name="email_subscribe">
								<span class="input-group-btn">
									<button class="btn btn-warning" type="submit" name="form_subscribe">S'abonner</button>
								</span>
							</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>




<div class="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-md-12 copyright">
				<?php echo $footer_copyright; ?>
			</div>
		</div>
	</div>
</div>


<a href="#" class="scrollup">
	<i class="fa fa-angle-up"></i>
</a>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$stripe_public_key = $row['stripe_public_key'];
	$stripe_secret_key = $row['stripe_secret_key'];
}
?>

<script src="assets/js/jquery-2.2.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="https://js.stripe.com/v2/"></script>
<script src="assets/js/megamenu.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/owl.animate.js"></script>
<script src="assets/js/jquery.bxslider.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/rating.js"></script>
<script src="assets/js/jquery.touchSwipe.min.js"></script>
<script src="assets/js/bootstrap-touch-slider.js"></script>
<script src="assets/js/select2.full.min.js"></script>
<script src="assets/js/custom.js"></script>
<script>
	function confirmDelete() {
		return confirm("Souhaitez-vous supprimer ce produit??");
	}
	$(document).ready(function() {
		advFieldsStatus = $('#advFieldsStatus').val();

		$('#paypal_form').hide();
		$('#stripe_form').hide();
		$('#bank_form').hide();

		$('#advFieldsStatus').on('change', function() {
			advFieldsStatus = $('#advFieldsStatus').val();
			if (advFieldsStatus == '') {
				$('#paypal_form').hide();
				$('#stripe_form').hide();
				$('#bank_form').hide();
			} else if (advFieldsStatus == 'PayPal') {
				$('#paypal_form').show();
				$('#stripe_form').hide();
				$('#bank_form').hide();
			} else if (advFieldsStatus == 'Stripe') {
				$('#paypal_form').hide();
				$('#stripe_form').show();
				$('#bank_form').hide();
			} else if (advFieldsStatus == 'Dépôt banque') {
				$('#paypal_form').hide();
				$('#stripe_form').hide();
				$('#bank_form').show();
			}
		});
	});


	$(document).on('submit', '#stripe_form', function() {
		// createToken returns immediately - the supplied callback submits the form if there are no errors
		$('#submit-button').prop("disabled", true);
		$("#msg-container").hide();
		Stripe.card.createToken({
			number: $('.card-number').val(),
			cvc: $('.card-cvc').val(),
			exp_month: $('.card-expiry-month').val(),
			exp_year: $('.card-expiry-year').val()
			// name: $('.card-holder-name').val()
		}, stripeResponseHandler);
		return false;
	});
	Stripe.setPublishableKey('<?php echo $stripe_public_key; ?>');

	function stripeResponseHandler(status, response) {
		if (response.error) {
			$('#submit-button').prop("disabled", false);
			$("#msg-container").html('<div style="color: red;border: 1px solid;margin: 10px 0px;padding: 5px;"><strong>Error:</strong> ' + response.error.message + '</div>');
			$("#msg-container").show();
		} else {
			var form$ = $("#stripe_form");
			var token = response['id'];
			form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
			form$.get(0).submit();
		}
	}
</script>


<?php echo $before_body; ?>
</body>

</html>