<?php
//Récupérer le fichier header
require_once('header.php');
?>

<!--on crée une section cliquable qui affiche tous les onglet-->
<section class="content-header">
	<h1>Menu</h1>
</section>

<?php
// on commence à établir les requêtes préparées : le formule, la requête, le nombre
//Récupérer le nombre d'enrégistrement de chaque table

//catégorie principale
$statement = $pdo->prepare("SELECT * FROM tbl_top_category");
$statement->execute();
$total_top_category = $statement->rowCount(); //renvoyer le nombre de lignes affectées par la dernière instruction

//Sous-catégorie
$statement = $pdo->prepare("SELECT * FROM tbl_mid_category");
$statement->execute();
$total_mid_category = $statement->rowCount();

//Catégorie liste
$statement = $pdo->prepare("SELECT * FROM tbl_end_category");
$statement->execute();
$total_end_category = $statement->rowCount();

//Produits
$statement = $pdo->prepare("SELECT * FROM tbl_product");
$statement->execute();
$total_product = $statement->rowCount();

//Clients
$statement = $pdo->prepare("SELECT * FROM tbl_customer");
$statement->execute();
$total_customers = $statement->rowCount();

//Liste abonnée
$statement = $pdo->prepare("SELECT * FROM tbl_subscriber");
$statement->execute();
$total_subscriber = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_shipping_cost");
$statement->execute();
$available_shipping = $statement->rowCount();

//Paiement terminé
$statement = $pdo->prepare("SELECT * FROM tbl_payment");
$statement->execute();
$total_order = $statement->rowCount();

//Administrateurs
$statement = $pdo->prepare("SELECT * FROM tbl_user");
$statement->execute();
$total_user = $statement->rowCount();

//QR
$statement = $pdo->prepare("SELECT * FROM tbl_faq");
$statement->execute();
$total_faq = $statement->rowCount();

//Taille produit
$statement = $pdo->prepare("SELECT * FROM tbl_size");
$statement->execute();
$total_size = $statement->rowCount();

//pays
$statement = $pdo->prepare("SELECT * FROM tbl_country");
$statement->execute();
$total_country = $statement->rowCount();

//couleur produit
$statement = $pdo->prepare("SELECT * FROM tbl_color");
$statement->execute();
$total_color = $statement->rowCount();

//Message client
$statement = $pdo->prepare("SELECT * FROM tbl_customer_message");
$statement->execute();
$total_customer_message = $statement->rowCount();

//Photos
$statement = $pdo->prepare("SELECT * FROM tbl_photo");
$statement->execute();
$total_photo = $statement->rowCount();


//Réseaux-sociaux
$statement = $pdo->prepare("SELECT * FROM tbl_social");
$statement->execute();
$total_social = $statement->rowCount();

?>

<section class="content">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- boite1-->
			<div class="small-box bg-red">
				<div class="inner">
					<a href="product.php" title="Voir la liste des produits du site" target="blank">
						<h3><?php echo $total_product; ?></h3>
					</a>
					<p>PRODUITS</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-android-cart"></i>
				</div>

			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- boite2 -->
			<div class="small-box bg-olive">
				<div class="inner">
					<a href="top-category.php" title="Voir la liste des catégories principales" target="blank">
						<h3><?php echo $total_top_category; ?></h3>
					</a>

					<p>CATÉGORIES PRINCIPALES</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-android-cart"></i>
				</div>

			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- boite3 -->
			<div class="small-box bg-blue">
				<div class="inner">
					<a href="mid-category.php" title="Voir la liste des sous-catégories" target="blank">
						<h3><?php echo $total_mid_category; ?></h3>
					</a>

					<p>SOUS-CATÉGORIES</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-android-cart"></i>
				</div>

			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- boite4-->
			<div class="small-box bg-black">
				<div class="inner">
					<a href="end-category.php" title="Voir la liste des sous-catégories" target="blank">
						<h3><?php echo $total_end_category; ?></h3>
					</a>

					<p>SOUS-CATÉGORIES SECONDAIRES</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-android-cart"></i>
				</div>

			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- boite5-->
			<div class="small-box bg-orange">
				<div class="inner">
					<a href="end-category.php" title="Voir la liste de toutes les catégories du site" target="blank">
						<h3><?php echo $total_end_category; ?></h3>
					</a>
					<p>LISTE DES CATÉGORIES</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-android-cart"></i>
				</div>

			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- boite6 -->
			<div class="small-box bg-black">
				<div class="inner">
					<a href="size.php" title="Voir toutes les tailles disponibles" target="blank">
						<h3><?php echo $total_size; ?></h3>
					</a>

					<p>TAILLES PRODUITS</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-arrow-down-b"></i>
				</div>

			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- boite7-->
			<div class="small-box bg-green">
				<div class="inner">
					<a href="color.php" title="Voir toutes les couleurs disponibles" target="blank">
						<h3><?php echo $total_color; ?></h3>
					</a>

					<p>COULEURS PRODUITS</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-arrow-down-b"></i>
				</div>

			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- boite8 -->
			<div class="small-box bg-orange">
				<div class="inner">
					<a href="country.php" title="Voir les pays du site" target="blank">
						<h3><?php echo $total_country; ?></h3>
					</a>

					<p>PAYS DU MONDE</p>
				</div>
				<div class="icon">
					<i class="fa fa-globe"></i>
				</div>

			</div>
		</div>


		<div class="col-lg-3 col-xs-6">
			<!-- boite9 -->
			<div class="small-box bg-black">
				<div class="inner">
					<a href="admin.php">
						<h3><?php echo $total_user; ?></h3>
					</a>

					<p>ADMINISTRATEURS</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-woman"></i>
				</div>

			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- boite10 -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<a href="customer.php">
						<h3><?php echo $total_customers; ?></h3>
					</a>

					<p>CLIENTS</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-woman"></i>
				</div>

			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- boite11 -->
			<div class="small-box bg-red">
				<div class="inner">
					<a href="subscriber.php" title="Voir la lliste des abonnés au newsletter" target="Blank">
						<h3><?php echo $total_subscriber; ?></h3>
					</a>

					<p>ABONNÉES NEWSLETTER</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-android-mail"></i>
				</div>

			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- boite12-->
			<div class="small-box bg-red">
				<div class="inner">
					<a href="customer-message.php" title="Voir les messages des clients" target="blank">
						<h3><?php echo $total_customer_message; ?></h3>
					</a>

					<p>MESSAGES DES CLIENTS</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-android-mail"></i>
				</div>

			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!--boite13 -->
			<div class="small-box bg-blue">
				<div class="inner">
					<a href="photo.php" title="Voir toutes les photos" target="blank">
						<h3><?php echo $total_photo; ?></h3>
					</a>

					<p>PHOTOS</p>
				</div>
				<div class="icon">
					<i class="fa fa-image"></i>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- boite14 -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<a href="order.php" title="Voir toutes les commandes" target="blank">
						<h3><?php echo $total_order; ?></h3>
					</a>

					<p>COMMANDES</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-android-cart"></i>
				</div>

			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- boite15 -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<a href="faq.php" title="Voir toutes les questions et r&ponses" target="blank">
						<h3><?php echo $total_faq; ?></h3>
					</a>

					<p>QUESTIONS & RÉPONSES</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-android-cart"></i>
				</div>

			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- boite16 -->
			<div class="small-box bg-black">
				<div class="inner">
					<a href="social-media.php" title="Voir les réseaux-sociaux disponibles" target="blank">
						<h3><?php echo $total_social; ?></h3>
					</a>

					<p>RÉSEAUX-SOCIAUX</p>
				</div>
				<div class="icon">
					<i class="ionicons ion-arrow-down-b"></i>
				</div>

			</div>
		</div>
	</div>


	</div>






	</div>

</section>

<?php require_once('footer.php'); ?>