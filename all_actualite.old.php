<?php 
	include("cnx.php");

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Toutes les actualités - Loisirs Montagne</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 </head>
 <body>
 	<?php 
 		include("header.php");
 		include("nav.php");
 	 ?>
	<div class="container all_actualites">
		<article>
			<div class="bg_block">
				<div class="recherche">
					<p class="alerte">ne pas mettre d'accents</p><br>
					<form action="recherche.php" method="POST">
						<input class="recherche_texte" type="text" name="recherche" placeholder="Votre recherche">
						<input class="submit" type="submit" name="rechercher" value="rechercher">
					</form>
				</div>
			</div>
			<h2>Toutes les actualités</h2>
			<div class="bg_block bg_news">
				<?php 
						$rq_act = " SELECT * FROM t_actualites ORDER BY date_act";
						// echo $rq_act;
						$result_act = $mysqli->query($rq_act);
						// var_dump($row);
						while ($row=$result_act->fetch_object()){	
				 ?>
					<div class="news">
						<p class="anim_img"><img src="img/<?php echo $row->id_act; ?>.jpg" alt=""></p>
						<h3><?php echo substr($row->titre_act, 0, 45); ?>...</h3>
						<p class="auteur">écrit part : <?php echo $row->auteur_act; ?></p>
						<hr class="sep_act">
						<p class="texte"><?php echo substr(strip_tags($row->texte_act), 0, 600); ?>...</p>
						<div class="bot_act">
							<p class="date"><?php echo $row->date_act; ?></p>
							<p class="suite"><a href="actualite.php?id=<?php echo $row->id_act; ?>" title="Lire la suite">lire la suite</a></p>
						</div><hr class="clear sep_act2">
					</div>
					<?php 
						}
					 ?>
					</div><hr class="clear">
		</article> 
	</div>
 	 <?php 
 	 	include("footer.php");
 	  ?>
  <script type="text/javascript" src="js/lightbox2-master/dist/js/lightbox-plus-jquery.js"></script>
 <script type="text/javascript" src="js/lightbox2-master/dist/js/lightbox.js"></script>
 <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
 <script type="text/javascript" src="js/masonry.pkgd.min.js"></script>	  
 <script type="text/javascript" src="js/lightbox.js"></script>
 <script type="text/javascript" src="js/script.js" ></script>
 </body>
 </html>