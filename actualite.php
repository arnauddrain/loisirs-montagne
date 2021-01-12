<?php 
	include("cnx.php");
	if(isset ($_GET['id']) AND is_numeric($_GET['id'])){ // vérifiation que $_GET['id'] est bien un chiffre
		$id_act = $_GET["id"];
		// echo $id_act;
		$rq_act = " SELECT * FROM t_actualites WHERE id_act = $id_act ORDER BY date_act DESC LIMIT 3 ";
		// echo $rq_act;
		$result_act = $mysqli->query($rq_act);
		// var_dump($row);
		$row=$result_act->fetch_object();
	} else {
		header('Location: index.php');
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Accueil - Loisirs Montagne</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 </head>
 <body>
 	<?php 
 		include("header.php");
 		include("nav.php");
 	 ?>
	<div class="container article">
		<article class="col-12">
			<h2><?php echo $row->titre_act; ?></h2>
			<div class="bg_block page_actu">
					<div class="news">
						<div class="col-6">
							<p class="image"><img src="img/<?php echo $row->id_act; ?>.jpg" alt=""></p>
						</div>
						<div class="col-6">
							<p class="auteur">écrit part : <?php echo $row->auteur_act; ?></p>
							<p class="date"><?php echo $row->date_act; ?></p>	
							<hr class="sep_act">
							<div class="divtexte">
								<p class="texte"><?php echo $row->texte_act; ?></p>
							</div>
						</div><hr class="clear">
					</div>
			</div>
		</article><hr class="clear">
		<p class="suite"><a href="index.php">retour</a></p>
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