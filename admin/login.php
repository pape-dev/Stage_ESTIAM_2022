<?php
ob_start();
session_start();
include("inc/config.php");
include("inc/functions.php");
include("inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();
$error_message = '';

if (isset($_POST['form1'])) {

	if (empty($_POST['email']) || empty($_POST['password'])) {
		$error_message = 'Le champs ne doit pas être vide<br>';
	} else {

		$email = strip_tags($_POST['email']);
		$password = strip_tags($_POST['password']);

		$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE email=?");
		$statement->execute(array($email));
		$total = $statement->rowCount();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		if ($total == 0) {
			$error_message .= 'Adresse Email non valide<br>';
		} else {
			foreach ($result as $row) {
				$row_password = $row['password'];
			}

			if ($row_password != md5($password)) {
				$error_message .= 'Mot de passe non valide<br>';
			} else {

				$_SESSION['user'] = $row;
				header("location: index.php");
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Connexion</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/datepicker3.css">
	<link rel="stylesheet" href="css/all.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="css/AdminLTE.min.css">
	<link rel="stylesheet" href="css/_all-skins.min.css">

	<link rel="stylesheet" href="style.css">
</head>

<body class="hold-transition login-page sidebar-mini">

	<div class="login-box">
		<div class="login-logo">
			<b>Espace Administrateur</b>
		</div>
		<div class="login-box-body">
			<p class="login-box-msg">Accéder au tableau de bord de l'administrateur</p>

			<?php
			if ((isset($error_message)) && ($error_message != '')) :
				echo '<div class="error">' . $error_message . '</div>';
			endif;
			?>

			<form action="" method="post">
				<?php $csrf->echoInputField(); ?>
				<div class="form-group has-feedback">
					<input class="form-control" placeholder="Entrer votre adresse Email" name="email" type="email" autocomplete="off" autofocus>
				</div>
				<div class="form-group has-feedback">
					<input class="form-control" placeholder="Entrer votre mot de passe" name="password" type="password" autocomplete="off" value="">
				</div>
				<div class="row">
					<div class="col-xs-8"></div>
					<div class="col-xs-4">
						<input type="submit" class="btn btn-warning btn-block btn-flat login-button" name="form1" value="Connexion">
					</div>
				</div>
			</form>
		</div>
	</div>


	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/select2.full.min.js"></script>
	<script src="js/jquery.inputmask.js"></script>
	<script src="js/jquery.inputmask.date.extensions.js"></script>
	<script src="js/jquery.inputmask.extensions.js"></script>
	<script src="js/moment.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/icheck.min.js"></script>
	<script src="js/fastclick.js"></script>
	<script src="js/jquery.sparkline.min.js"></script>
	<script src="js/jquery.slimscroll.min.js"></script>
	<script src="js/app.min.js"></script>
	<script src="js/demo.js"></script>

</body>

</html>