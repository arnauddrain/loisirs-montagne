<?php 
	include("cnx.php");
	$rq_cat = "SELECT * FROM t_cat";
	$result_cat = $mysqli->query( $rq_cat);

 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Calendrier des réservations - Loisirs Montagne</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php 
		include("header.php");
		include("nav.php");
	 ?>
	<section class="cal_resa">
		<div class="container">
			<div class="bg_info">
				<p class="info">Vous trouverez ci-dessous les périodes de réservation des chalets, informations de contact et tableau des tarifs. Certains séjours sont ouvert ; n'hésitez pas à vous rapprocher des organisateurs</p>
			</div>
			<div class="bg_block">
				
				<h3>Pour toutes informations sur les chalets, les possibilités et conditions de réservation, contactez les secretaires des chalets</h3>
				<div class="col-6 clot">
					<p>Pour le Clot Raffin :<br class="margin">
					<span>Alexandra</span><br>
					<span class="email">clot-raffin@loisirs-montagne.fr</span><br>
					<span class="number">06 60 53 53 28 / 04 74 88 81 27</span></p>
				</div>
				<div class="col-6 rochas">
				<p>Pour les Rochas :<br class="margin">
				<span>Mina</span><br>
				<span class="email">rochas@loisirs-montagne.fr</span><br>
				<span class="number">06 23 82 17 43 / 04 74 27 93 89</span></p>
			</div><hr class="clear">
			</div>
			<h2 id="resa">Réservations confirmées des chalets</h2>
			<div class="bg_block">
							<?php 
	 						while ( $row_cat = $result_cat->fetch_object() ) {
	 							$date = date("Y-m-d");
	 							$rq=" SELECT * FROM t_calendar INNER JOIN t_cat ON t_calendar.id_cat = t_cat.id_cat WHERE t_cat.id_cat = $row_cat->id_cat AND date_cal >= STR_TO_DATE('$date', '%Y-%m-%d') ORDER BY date_cal";
	 							// echo $rq;
	 							$result=$mysqli->query($rq);
	 						?>
		 						<?php 
		 						if($result->num_rows != 0) {
		 						 ?>
		 						 
					 			<div class="cat-<?php echo $row_cat->id_cat; ?> overflow_table">
					 				<div class="boutons">
						 				<h2><?php echo $row_cat->nom_cat; ?></h2>
					 				</div>
						 			<table>
						 				<tr >
						 					<th class="tr_color">Dâte</th>
						 					<th>Type de réservation</th>
						 					<th>Commentaire</th>
						 				</tr>
						 				<?php 
						 					
						 						// var_dump($result);
						 					while ($row=$result->fetch_object()){
						 				 ?>
						 				<tr>
						 					<td class="date_cal"><?php echo $row->date_cal; ?></td>
						 					<td class="titre_cal"><?php echo $row->titre_cal; ?></td>
						 					<td class="com_cal"><?php echo $row->com_cal; ?></td>
						 				</tr>
						 				<?php 
						 					}
						 				 ?>
						 			</table>
						 		</div>
						 		<?php 
						 		}
						 		 ?>
					 		<?php 
					 		}
					 		 ?>
			</div>
			<div class="bg_info">
				<p class="info_green">D’autres séjours sont actuellement en cours de réservation. Seule la secrétaire du chalet peut vous donner des informations sûres et précises sur les dates encore libres, n'hésitez pas à les contacter :)</p>
			</div>
			<?php 
				$rq_tarifs = "SELECT * FROM t_tarifs WHERE id_tarifs = 1";
				$result_tarifs = $mysqli->query($rq_tarifs);
				$row = $result_tarifs->fetch_object();
			 ?>
			 	<h2>Tarif 2018</h2>
			 	<div class="bg_block taxe_de_sejour">
			 		<div class="bg_texte">
			 			<h5>taxe de séjour</h5>
			 			<p class="texte">A compter du 1er janvier 2017, l’association est soumise au paiement de la taxe de séjour. Cette mesure est applicable au Clot Raffin qui entre dans la catégorie : "Meublés de tourisme et hébergements assimilés en attente de classement ou sans classement" et concerne les personnes âgées de 18 ans et plus. Pour Les Rochas, la Mairie de Champoléon n’applique pas la taxe de séjour.</p>
					</div>
					<div class="overflow_table">
						<table class="tarifs">
								<tr>
									<th colspan="3" class="adh">Adhésion Loisirs-Montagne<br>(Validité jusqu'à l'Assemblée Générale du 24 novembre 2018)</th>
								</tr>
								<tr>
									<th class="adh2">18 ans et plus</th>
									<td colspan="2" ><?php echo $row->adh_18plus; ?> €</td>
								</tr>
								<tr>
									<th class="adh2">16 à 18 ans/Etudiant/Demandeur d'emploi</th>
									<td colspan="2" ><?php echo $row->adh_1618; ?> €</td>
								</tr>
								<tr>
									<th class="adh2">Moins de 16 ans</th>
									<td colspan="2" ><?php echo $row->adh_moins16; ?> €</td>
								</tr>
							<tr>
								<th colspan="3" class="adh3">Nuitées</th>
							</tr>
							<tr>
								<th class="adh4">Minimun de paiement : 5 personnes/nuitées</th>
								<th class="adh4">Adhérent</th>
								<th class="adh4">Non adhérent</th>
							</tr>
							<tr>
								<th class="adh4">18 ans et plus</th>
								<td><?php echo $row->nuit_18plus_a; ?> €</td>
								<td><?php echo $row->nuit_18plus_na; ?> €</td>
							</tr>
							<tr>
								<th class="adh4">16 à 18 ans/Etudiant/Demandeur d'emploi</th>
								<td><?php echo $row->nuit_1618_a; ?> €</td>
								<td><?php echo $row->nuit_1618_na; ?> €</td>
							</tr>
							<tr>
								<th class="adh4">12 à 16 ans</th>
								<td><?php echo $row->nuit_1618_a; ?> €</td>
								<td><?php echo $row->nuit_1618_na; ?> €</td>
							</tr>
							<tr>
								<th class="adh4">3 à 12 ans</th>
								<td><?php echo $row->nuit_312_a; ?> €</td>
								<td><?php echo $row->nuit_312_na; ?> €</td>
							</tr>
							<tr>
								<th class="adh4">Moins de 3 ans</th>
								<td colspan="2"><?php echo $row->nuit_moins3; ?> €</td>
							</tr>
							<tr>
								<th class="adh4">Réduction famille nombreuse (s'appliquant à toute la famille)</th>
								<td colspan="2"><?php echo $row->nuit_famille; ?></td>
							</tr>
							<tr>
								<th colspan="3" class="adh5">AARHES à la réservation (obligatoire)<br>L'organisateur d'un séjour est obligatoirement adhérent</th>
							</tr>
							<tr>
								<th class="adh6">Pour un séjour, par semaine</th>
								<td colspan="2"><?php echo $row->arrhes_sejour; ?> €</td>
							</tr>
							<tr>
								<th class="adh6">Pour un weed-end</th>
								<td colspan="2"><?php echo $row->arrhes_we; ?> €</td>
							</tr>
							<tr>
								<th colspan="3" class="adh5">Taxe de séjour (Clot Raffin uniquement)</th>
							</tr>
							<tr>
								<th class="adh6">Par nuitée</th>
								<th colspan="2" class="adh6">Adhérent & non adhérent</th>
							</tr>
							<tr>
								<th class="adh6">18 ans et plus</th>
								<td colspan="2"><?php echo $row->taxe_18plus; ?> €</td>
							</tr>
						</table>
						</div>
				</div>


		</div>
	</section>
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