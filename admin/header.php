<?php
ob_start();
session_start();
include("inc/config.php");
include("inc/functions.php");
include("inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();
$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';

// On vérifie si l'administrateur est connecté ou pas
if (!isset($_SESSION['user'])) {
	header('location: login.php');
	exit;
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tableau de bord Administrateur</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/datepicker3.css">
	<link rel="stylesheet" href="css/all.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="css/jquery.fancybox.css">
	<link rel="stylesheet" href="css/AdminLTE.min.css">
	<link rel="stylesheet" href="css/_all-skins.min.css">
	<link rel="stylesheet" href="css/on-off-switch.css" />
	<link rel="stylesheet" href="css/summernote.css">
	<link rel="stylesheet" href="style.css">

</head>

<body class="hold-transition fixed skin-yellow sidebar-mini">

	<div class="wrapper">

		<header class="main-header">

			<!--la partie des onglets groupés-->
			<a href="index.php" class="logo">
				<span class="logo-lg ">ESTIAM E-Commerce</span>
			</a>

			<nav class="navbar navbar-static-top">

				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only"></span>
				</a>

				<span style="float:left;line-height:50px;font-weight:bolder;color:white;padding-left:400px;font-size:30px;">Tableau de bord Administrateur</span>
				<!-- barre en haut ... information de l'administrateur-->
				<div class="navbar-custom-menu bg-black">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">

								<!--image de profil-->
								<img src="../assets/uploads/<?php echo $_SESSION['user']['photo']; ?>" class="user-image" alt="User Image">

								<!--Générer le nom de l'administrateur depuis le BDD-->
								<span class="hidden-xs"><?php echo $_SESSION['user']['full_name']; ?></span>
							</a>

							<!--ajout des deux boutons : profil & déconnecter-->
							<ul class="dropdown-menu bg-warning">
								<li class="user-footer">
									<div>
										<a href="profile-edit.php" class="btn btn-success btn-flat">Profil</a>
									</div>
									<div>
										<a href="logout.php" class="btn btn-warning btn-flat">Déconnecter</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>

			</nav>
		</header>

		<!--Cherche la position de la dernière occurrence d'une sous-chaîne dans une chaîne-->

		<?php $cur_page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1); ?>
		<!-- la barre à gauche des onglets -->
		<!--la condition + l'icone + le texte-->
		<aside class="main-sidebar">
			<section class="sidebar">

				<ul class="sidebar-menu">

					<li class="treeview <?php if ($cur_page == 'index.php') {
											echo 'active';
										} ?>">
						<a href="index.php">
							<i class="fa fa-dashboard"></i> <span>Menu</span>
						</a>
					</li>


					<li class="treeview <?php if (($cur_page == 'settings.php')) {
											echo 'active';
										} ?>">
						<a href="settings.php">
							<i class="fa fa-sliders"></i> <span>Paramètre boutique</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'product.php') || ($cur_page == 'product-add.php') || ($cur_page == 'product-edit.php')) {
											echo 'active';
										} ?>">
						<a href="product.php">
							<i class="fa fa-cart-plus"></i> <span>Gestion des produits</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'size.php') || ($cur_page == 'size-add.php') || ($cur_page == 'size-edit.php')) {
											echo 'active';
										} ?>">
						<a href="size.php">
							<i class="fa fa-shopping-bag"></i> <span>Tailles</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'color.php') || ($cur_page == 'color-add.php') || ($cur_page == 'color-edit.php')) {
											echo 'active';
										} ?>">
						<a href="color.php">
							<i class="fa fa-shopping-bag"></i> <span>Couleurs</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'country.php') || ($cur_page == 'country-add.php') || ($cur_page == 'country-edit.php')) {
											echo 'active';
										} ?>">
						<a href="country.php">
							<i class="fa fa-shopping-bag"></i> <span>Pays</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'top-category.php') || ($cur_page == 'top-category-add.php') || ($cur_page == 'top-category-edit.php')) {
											echo 'active';
										} ?>">
						<a href="top-category.php">
							<i class="fa fa-shopping-bag"></i> <span>Catégroies principales</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'mid-category.php') || ($cur_page == 'mid-category-add.php') || ($cur_page == 'mid-category-edit.php')) {
											echo 'active';
										} ?>">
						<a href="mid-category.php">
							<i class="fa fa-shopping-bag"></i> <span>Sous-catégories</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'end-category.php') || ($cur_page == 'end-category-add.php') || ($cur_page == 'end-category-edit.php')) {
											echo 'active';
										} ?>">
						<a href="end-category.php">
							<i class="fa fa-shopping-bag"></i> <span>Liste des catégories</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'shipping-cost.php') || ($cur_page == 'shipping-cost-add.php') || ($cur_page == 'shipping-cost-edit.php')) {
											echo 'active';
										} ?>">
						<a href="shipping-cost.php">
							<i class="fa fa-shopping-bag"></i> <span>Frais livraison</span>
						</a>
					</li>


					<li class="treeview <?php if (($cur_page == 'order.php')) {
											echo 'active';
										} ?>">
						<a href="order.php">
							<i class="fa fa-sticky-note"></i> <span>Gestion des commandes</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'order-termine.php')) {
											echo 'active';
										} ?>">
						<a href="order-termine.php">
							<i class="fa fa-sticky-note"></i> <span>Commandes payées</span>
						</a>
					</li>


					<li class="treeview <?php if (($cur_page == 'slider.php')) {
											echo 'active';
										} ?>">
						<a href="slider.php">
							<i class="fa fa-picture-o"></i> <span>Gestion des publicités</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'service.php')) {
											echo 'active';
										} ?>">
						<a href="service.php">
							<i class="fa fa-list-ol"></i> <span>Partenaires</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'faq.php')) {
											echo 'active';
										} ?>">
						<a href="faq.php">
							<i class="fa fa-question-circle"></i> <span>Questions & Réponses</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'customer.php') || ($cur_page == 'customer-add.php') || ($cur_page == 'customer-edit.php')) {
											echo 'active';
										} ?>">
						<a href="customer.php">
							<i class="fa fa-user-plus"></i> <span>Gestion des clients</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'page.php')) {
											echo 'active';
										} ?>">
						<a href="page.php">
							<i class="fa fa-tasks"></i> <span>Configuration</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'social-media.php')) {
											echo 'active';
										} ?>">
						<a href="social-media.php">
							<i class="fa fa-globe"></i> <span>Réseaux-Sociaux</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'subscriber.php') || ($cur_page == 'subscriber.php')) {
											echo 'active';
										} ?>">
						<a href="subscriber.php">
							<i class="fa fa-hand-o-right"></i> <span>Liste d'abonnés</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'index.php') || ($cur_page == 'index.php')) {
											echo 'active';
										} ?>">
						<a href="index.php">
							<i class="fa fa-home"></i> <span>Accueil</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'admin.php') || ($cur_page == 'admin.php')) {
											echo 'active';
										} ?>">
						<a href="admin.php">
							<i class="fa fa-user-plus"></i> <span>Administrateurs</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'ms-clients.php') || ($cur_page == 'ms-clients.php')) {
											echo 'active';
										} ?>">
						<a href="ms-clients.php">
							<i class="fa fa-commenting-o"></i></i> <span>Messages Clients</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'info-boutique.php') || ($cur_page == 'info-boutique.php')) {
											echo 'active';
										} ?>">
						<a href="info-boutique.php">
							<i class="fa fa-user"></i> <span>Infos Boutique</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'photo.php') || ($cur_page == 'photo.php')) {
											echo 'active';
										} ?>">
						<a href="photo.php">
							<i class="fa fa-camera"></i> <span>Gestion des photos</span>
						</a>
					</li>

					<li class="treeview <?php if (($cur_page == 'logout.php') || ($cur_page == 'logout.php')) {
											echo 'active';
										} ?>">
						<a href="logout.php">
							<i class="fa fa-user"></i> <span>Déconnecter</span>
						</a>
					</li>

				</ul>
			</section>
		</aside>

		<div class="content-wrapper">