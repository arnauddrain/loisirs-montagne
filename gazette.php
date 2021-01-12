<?php 
	include("cnx.php");
	include("functions.php");
	$rq = " SELECT * FROM t_gazette ORDER BY annee_gaz DESC";
	$result = $mysqli->query($rq);
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Gazette - Loisirs Montagne</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 </head>
 <body>
 	<?php 
 		include("header.php");
 		include("nav.php");
 	 ?>
	<div class="container gazette">
		<article class="col-12">
			<div class="titre_page">
				<h1>La Gazette de Loisirs-Montagne</h1>
			</div>
			<div class="bg_block ">
					<div class="news">
						<p class="texte">
							Chaque hiver, nous éditons une Gazette que nous adressons à chaque foyer d’adhérents des deux dernières années.
						</p>
						<p class="texte">
							Cette publication contient toutes les informations de l’année écoulée : compte-rendu d’AG, composition du Conseil d’administration, bilan et projections des semaines travaux dans les chalets.
						</p>
						<p class="texte">
							C’est aussi la possibilité pour chacune et chacun de s’exprimer sur un sujet ou bien de faire le récit de son séjour.
						</p>
						<p class="texte textefin">	Enfin, c’est l’occasion d’informer sur les tarifs d’adhésion et de nuitée, de donner quelques petites recettes pour réserver l’un ou l’autre chalet, et tout autres petits trucs et conseils nécessaires et utiles au Loisirs-Montagnard.</p>
					</div>
			</div>
			<h2>Télécharger la Gazette</h2>
			<div class="bg_block">
				<?php 
					while($row=$result->fetch_object()){
				 ?>
				 <div class="ressources_pdf col-6">
					<p class="pdf"><a href="gazette/<?php echo $row->annee_gaz; ?>-<?php echo $row->id_gaz; ?>.pdf" download="Gazette année <?php echo $row->annee_gaz; ?>" title="Gazette année <?php echo $row->annee_gaz; ?>"><img src="pdf/ico_pdf.png" alt="<?php echo $row->annee_gaz; ?>" title="<?php echo $row->annee_gaz; ?>" ></a></p>
					<p class="nom_pdf"><a href="gazette/<?php echo $row->annee_gaz; ?>-<?php echo $row->id_gaz; ?>.pdf" download="Gazette année <?php echo $row->annee_gaz; ?>" title="Gazette année <?php echo $row->annee_gaz; ?>">Gazette année <?php echo $row->annee_gaz; ?> </a></p>
					<p class="description_pdf">document adobe acrobat</p>
				</div><hr class="clear">
				<?php 
					}
				 ?>
			</div>
	</div><hr class="clear">
 	 <?php 
		  include("footer.php");
		  include("scripts.php");
 	  ?>
 </body>
 </html>