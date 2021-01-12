<?php 
	include("cnx.php");
 ?>

 <!DOCTYPE html>
 <html lang="fr">
 <head>
 	<title>Accueil - Loisirs Montagne</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 	<link href="css/lightbox.css" rel="stylesheet">
 </head>
 <body>
 	<?php 
 		include("header.php");
 		include("nav.php");
 	 ?>
	<div class="container index">
		<div class="boutons col-12">
			<p><a href="devenir_membre.php" title="Devenir membre">devenir membre</a></p>
			<p><a class="resa" href="calendrier_reservation.php" title="Calendrier des réservations">calendrier des réservations</a></p>
			<p><a class="livreor" href="livre_or.php" title="Livre d'or">livre d'or</a></p>
		</div>
		<article class="col-12">
			<video poster="video/poster.jpg" controls preload src="video/video_lm.mp4"></video>
		</article>
		<article class="col-8">
			<h2>Actualités récentes</h2>
			<div class="bg_block bg_news">
				<?php 
						$rq_act = " SELECT * FROM t_actualites ORDER BY date_act DESC LIMIT 3 ";
						// echo $rq_act;
						$result_act = $mysqli->query($rq_act);
						// var_dump($row);
						while ($row=$result_act->fetch_object()){	
				 ?>
					<div class="news article_index">
						<p class="anim_img"><img src="img/<?php echo $row->id_act; ?>.jpg" alt=""></p>
						<h3><?php echo substr($row->titre_act, 0, 45); ?>...</h3>
						<p class="auteur">écrit part : <?php echo $row->auteur_act; ?></p>
						<hr class="sep_act">
						<p class="texte"><?php echo substr(strip_tags($row->texte_act), 0, 200); ?>...</p>
						<div class="bot_act">
							<p class="date"><?php echo $row->date_act; ?></p>
							<p class="suite"><a href="actualite.php?id=<?php echo $row->id_act; ?>" title="Lire la suite">lire la suite</a></p>
						</div><hr class="clear sep_act2">
					</div>
					<?php 
						}
					 ?>
					</div>
		</article>
		<article class="col-4">
			<h2>Agenda</h2>
			<div class="bg_block bg_agd">
				<?php 
					$rq_cal = " SELECT * FROM t_calendar ORDER BY date_cal DESC LIMIT 7 ";
					$result_cal = $mysqli->query($rq_cal);
					while($row=$result_cal->fetch_object()){
				 ?>
				<div class="agenda article_index">
					<p class="date"><a href="calendrier_reservation.php?#resa" title="Agenda des réservations"><?php echo $row->date_cal; ?></a></p>
					<h3><?php echo $row->titre_cal; ?></h3>
					<p class="com"><?php echo substr($row->com_cal, 0, 40); ?>...</p>
				</div><hr class="clear sep_act3">
				<?php 
					}
				 ?>
			 </div>
		</article><hr class="clear">
		<?php 
			$parPage = 8;
			$rqTotal = "SELECT * FROM t_galerie";
			$rq_galerie = "SELECT * FROM t_galerie ORDER BY id_img DESC  "; /*LIMIT $debut,$nombre*/
			$result_galerie = $mysqli->query($rq_galerie);
			// var_dump($result_galerie) ;
		 ?>
		 <div class="titre_page2">		 
		 	<h2 id="galerie_photo">Dernières photos</h2>
		 </div>
		<div class="dernieres_photo">
			<div class="news news-3 galerie_photo_div">
				<div class="grid galerie_photo">
				<?php 
					while ($row = $result_galerie->fetch_object()){
				 ?>
				
					<div class="grid-item grid-item--width2">
						<p class="anim_img"><a href="img/galerie_photo/<?php echo $row->nom_img; ?>-<?php echo $row->id_img; ?>.jpg" data-lightbox="travaux_rochas_2014-"><img src="img/galerie_photo/<?php echo $row->nom_img; ?>-<?php echo $row->id_img ?>.jpg" alt="<?php echo $row->desc_img; ?>" title="<?php echo $row->desc_img; ?>" ></a></p>
					</div>
				
				<?php 
					}
				 ?>
				 </div>
			</div><hr class="clear">
		</div>
	</div>
 	 <?php 
 	 	include("footer.php");
 	  ?>

 <script type="text/javascript" src="js/lightbox2-master/dist/js/lightbox-plus-jquery.js"></script>
 <script type="text/javascript" src="js/lightbox2-master/dist/js/lightbox.js"></script>
 <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
 <script src="js/imagesloaded.pkgd.js" ></script>
 <script type="text/javascript" src="js/masonry.pkgd.min.js"></script>	  
 <script type="text/javascript" src="js/lightbox.js"></script>
 <script type="text/javascript" src="js/script.js" ></script>
 </body>
 </html>