<?php 
	include("cnx.php");
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Plan du site - Loisirs Montagne</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 </head>
 <body class="asso">
 	<?php 
 		include("header.php");
 		include("nav.php");
 	 ?>
	<div class="container article plandusite">
		<article class="col-12">
			<h2>Plan du site</h2>
			<div class="bg_block ">
					<div class="news">
						<ul>
							<li><a href="index.php" title="Accueil" >Accueil</a></li>
							<li><a href="association.php" title="L'association">L'association</a>
								<ul class="ul">
									<li><a href="association.php?#histoire" title="Histoire de l'association">Histoire de l'association</a></li>
									<li><a href="association.php?#conseil" title="Conseil d'administration">Le conseil d'administration</a></li>
									<li><a href="association.php?#ressources" title="Ressources">Ressources</a></li>
								</ul>
							</li>
							<li><a href="all_actualite.php" title="Actualités">Actualités</a></li>
							<li><a href="chalets.php" title="Les chalets" class="deroule">Les chalets</a>
								<ul class="ul">
									<li><a href="chalets.php?#entretien_renovation" title="Entretien et rénovation">Entretien et rénovation</a></li>
									<li><a href="chalets.php?#galerie_photo" title="Galerie photo">Galerie photo</a></li>
									<li><a href="chalets.php?#plan_coordo" title="Plan d'accès et coordonnées">Plan d'accès et coordonnées</a></li>
								</ul>
							</li>
							<li><a href="gazette.php" title="La gazette">La gazette</a></li>
							<li><a href="contact.php" title="Contact">Contact</a></li>
						</ul>
					</div>
			</div>
		</article><hr class="clear">
	</div>
 	 <?php 
 	 	include("footer.php");
 	  ?>
  <script type="text/javascript" src="js/lightbox2-master/dist/js/lightbox-plus-jquery.js"></script>
 <script type="text/javascript" src="js/lightbox2-master/dist/js/lightbox.js"></script>
 <script type="text/javascript" src="js/jquery.js" ></script>
  <script src="js/imagesloaded.pkgd.js" ></script>
 <script type="text/javascript" src="js/masonry.pkgd.min.js"></script>	  
 <script type="text/javascript" src="js/lightbox.js"></script>
 <script type="text/javascript" src="js/script.js" ></script>
 </body>
 </html>