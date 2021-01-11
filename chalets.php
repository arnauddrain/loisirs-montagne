<?php 
	include("cnx.php");
	include("functions.php");
 ?>

 <!DOCTYPE html>
 <html lang="fr">
 <head>
 	<title>Accueil - Loisirs Montagne</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 	<link href="css/lightbox.css" rel="stylesheet">
 	<script type="text/javascript" src="js/lightbox2-master/dist/js/lightbox-plus-jquery.js"></script>
 	<script type="text/javascript" src="js/lightbox2-master/dist/js/lightbox.js"></script>
 </head>
 <body>
 	<?php 
 		include("header.php");
 		include("nav.php");
 	 ?>
	<div class="container chalets">
		<article class="col-12">
			<div class="titre_page">
				<h1>Les chalets de Loisirs-Montagne</h1>
			</div>
			<h2>Présentation</h2>
			<div class="bg_block ">
					<div class="news">
						<p class="texte">
							Depuis sa création en 1969, grâce au « Clot Raffin », l’association est présente dans les Hautes-Alpes, en Oisans. Au tout début des années 1970, elle a acquis « Les Rochas », une ancienne ferme d’alpage située à Champoléon, dans la vallée du Champsaur.
						</p>
						<p class="texte textefin">	C’est ainsi que Loisirs-Montagne s’est implantée au Nord et au Sud du Parc National des Ecrins, et a fondé ses valeurs.</p>
					</div>
			</div>
			<h2>Le Clot Raffin - 1820m</h2>
			<div class="bg_block pres_chalet">

					<div class="news news-2">
						<div class="col-6">
							<?php 
							$presentation = 'presentation_clot';
							$nom_presentation = 'Présentation Clot Raffin';
								echo afficher_grande_image( $presentation,  $nom_presentation);
							?>
							<div class="anim_img">	
								<?php 
									echo afficher_petites_images( $presentation,  $nom_presentation);
								?>
							</div>
						</div>
						<!-- <p class="image_pres_chalet"><img src="img/presentation_clot.png" alt="Le Clot Raffin"></p> -->
						<div class="col-6">
							<p class="texte">
							Le Clot Raffin est un hameau perché au-dessus du Chazelet, sur la commune de La Grave.
							</p>
							<p class="texte">
								À l’origine, seule l’association était présente, les autres habitations étant en ruines. Depuis, au fil des ans, toutes les maisons ont été restaurées et sont désormais habitées par une dizaine de voisins autour desquels la vie s’organise.						</p>
							<p class="texte">
								Le Clot Raffin est planté sur une butte où la verdure est assez rase, et qui offre une vue imprenable sur la Meije et le Râteau. Volontairement sommaires, les aménagements du chalet sont d’un confort tout à fait convenable, bien que l’électricité y soit absente : une cuisine équipée d’une gazinière grand modèle, une pièce à vivre très conviviale, une grande salle dédiée à l’animation des grandes soirées et aux réunions, une salle de bain très confortable avec douches et toilettes, et puis une terrasse qui donne sur un panorama exceptionnel du massif de la Meije.</p>
							<p class="texte">
								Tourné sur la haute-montagne, le Clot Raffin est le départ de grandes courses, notamment dans le massif des Ecrins. C’est aussi, alentours, une foultitude de randonnées pour les amateurs de moyenne montagne.
							</p>
							<p class="texte">
								Sans oublier que Le Chazelet, petite station familiale, permet, en période hivernale, de folles descentes à ski depuis le chalet.
							</p>
							<p class="texte textefin">
								Le Clot Raffin est un espace où les adeptes de l’authentique trouveront toujours leur compte. La capacité d’accueil du chalet est de 19 personnes.</p>
						</div><hr class="clear">
					</div>
			</div>
			<h2>Les Rochas - 1385m</h2>
			<div class="bg_block ">
					<div class="news news-2">
						<div class="col-6">
							<p class="texte">
							Jadis vivaient aux Rochas un berger et toute sa famille. Grâce à l’action de Loisirs-Montagne, le chalet est devenu un espace de bien-être et de ressourcement, un lieu de rencontres toutes aussi inattendues les unes que les autres, où la convivialité et la tolérance règnent en maître.
							</p>
							<p class="texte">
								Le chalet est relativement isolé et protégé par une végétation luxuriante. Les randonneurs et autres gens de passage s’y font rares.</p>
							<p class="texte">
								Eloigné du monde consumériste, d’un confort rustique, le chalet dispose d’une superbe salle voûtée où nous prenons nos repas et partageons des soirées souvent très animées ; d’un grand espace dans la grange, aménagé pour y dormir et y recevoir les grands rassemblements de fête ; de couchages de style « châlits » en dortoirs collectifs - on peut aussi planter sa tente ; de sanitaires équipés de douches et de WC secs, …</p>
							<p class="texte">
								Des envies simples, collectives ou individuelles; c'est, selon chacun, lire un livre, se balader, visiter, pique-niquer, jouer aux cartes, bricoler, ne rien faire du tout...

							</p>
							<p class="texte">
								Des activités montagnardes : balades botaniques et animalières, randonnées alentours et dans le Parc National des Ecrins, dans la vallée de Champoléon, sur Prapic ou le Valgaudemar.
							</p>
							<p class="texte textefin">
								La capacité d’accueil du chalet est de 19 personnes.</p>
						</div>
						<div class="col-6">
							<?php 
							$presentation = 'presentation_rochas';
							$nom_presentation = 'Présentation Rochas';
								echo afficher_grande_image2( $presentation,  $nom_presentation);
							?>
							<div class="anim_img">	
								<?php 
									echo afficher_petites_images2( $presentation,  $nom_presentation);
								?>
							</div>
						</div><hr class="clear">
					</div>
			</div>
			<div class="titre_page">
				<h1 id="entretien_renovation">Entretien et rénovation</h1>
			</div>
			<div class="bg_block">
				<div class="news entretien">
					<p class="texte">
						Maintenir les chalets en état et améliorer les conditions d’accueil sont une préoccupation majeure et permanente. D’abord parce-que les exigences de la Commission de Sécurité l’exigent, mais aussi parce-que ces vieilles bâtisses, marquées par le temps, doivent régulièrement être entretenues
					</p>
					<p><img src="img/presentation_renovation-1.jpg" alt="Présentation rénovation"></p>
					<p class="texte">
						L’eau, élément essentiel, vital, que nous allons puiser là-bas, plus haut … est bien évidemment un facteur déterminant de la vie dans les chalets. Mais aussi les treuils, que nous surveillons au plus près, car sans ces machines, rares seraient celles et ceux qui accepteraient de tout monter sur leur dos.
					</p>
					<p class="texte">
						Il faut donc, chaque année depuis 49 ans, ouvrir la caisse à outils et s’atteler à la tâche. C’est un investissement important, tant en gros sous qu’en gros bras, mais ça a sans nul doute contribué à la longévité de l’association.
					</p>
					<p class="texte">
						Là se retrouvent les bricoleurs de toujours et ceux du dimanche. Dans une ambiance toujours très sympa se mêlent les générations, dans une atmosphère printanière qui réveille les vallées. Il y a de la place pour tous : les pros de la perceuse, du tire-fort, de la machette et de la tronçonneuse, les soucieux du bien-être de nos couchages, les merveilleux de la louche et de la poêle qui se donneront à fonds pour satisfaire les appétits les plus féroces.
					</p>
					<p class="float_r"><img src="img/presentation_renovation-2.jpg" alt="Présentation rénovation"></p>
					<p class="texte">
						Ah ça, pour sûr, les délicats du marteau et de la machine à coudre ont des soucis à se faire … mais ils peuvent apprendre, comme tout un chacun ; les plus aguerris pourront les accompagner et leur enseigner quelques petits rudiments de bricolages.
					</p>
					
					<p class="texte">
						Et puis, ce rendez-vous, c’est la réouverture des chalets pour une nouvelle saison, c’est le temps des retrouvailles. L’ambiance est toujours propice pour faire la fête, partager l’apéro, sortir les instruments et chanter, danser… Vous êtes toutes et tous les bienvenus !
					</p>
					<p class="texte">
						Jusque-là organisée sur un grand week-end, cette période annuelle a été étendue à 5/7 jours pour, d’une part se donner les moyens de réaliser la foultitude de petits et grands travaux, d’autre part pour permettre au plus grand nombre d’y participer.
					</p>
					<p class="texte textefin">
						Si cela vous intéresse, que vous veniez 1, 3 ou 7 jours, ne cherchez plus, contactez les responsables de ces bonnes joyeusetés, amenez vos amis et venez prêter main forte.
					</p>
				</div><hr class="clear">
			</div>
			<?php 
			$debut = 0;
			$nbr_afficher = 8;
			$page = 1;
				// echo $precedent;
				$rq_nbr = "SELECT * FROM t_galerie";
				$result_nbr = $mysqli->query($rq_nbr);
				$rq_galerie = "SELECT * FROM t_galerie ORDER BY id_img ASC LIMIT $debut, $nbr_afficher";
				$result_galerie = $mysqli->query($rq_galerie);
				// var_dump($result_galerie) ;
			 ?>
			 <div class="titre_page">
			 	<h1 id="galerie_photo">Galerie photo des travaux</h1>
			 </div>
			<div class="bg_block bg_block_galerie">
				<div id="galerie_travaux" class="news news-3 galerie_photo_div">
					<?php 
						while ($row = $result_galerie->fetch_object()){
					 ?>
					<div class="col-3 galerie_photo">
						<p class="anim_img"><a href="img/galerie_photo/travaux_rochas_2014-<?php echo $row->id_img; ?>.jpg" data-lightbox="travaux_rochas_2014-"><img src="img/galerie_photo/travaux_rochas_2014-<?php echo $row->id_img; ?>-small.jpg" alt="<?php echo $row->desc_img; ?>" title="<?php echo $row->desc_img; ?>" ></a></p>
					</div>
					<?php 
						}
						if($result_nbr->num_rows > $page * $nbr_afficher){
							?>
							<div class="suivant">
								<a class="nope" href="page=<?php echo $page+1; ?>" id="suivant"></a>
							</div>
							<?php
						}
						if($page != 1){
							?>
							<div class="précedent">
								<a class="nope" href="page=<?php echo $page-1; ?>" id="precedent"></a>
							</div>
							<?php
						}
					 ?>
		
				</div><hr class="clear">
			</div>
			<div class="titre_page">
				<h1 id="plan_coordo">Plan et coordonnées</h1>
			</div>
			<div class="bg_block">
				<div class="news news-2 plan_coordo">
					<div style="width: 100%"><iframe width="100%" height="400" src="https://maps.google.com/maps?width=100%&amp;height=400&amp;hl=en&amp;coord=45.057851,6.276868&amp;q=Le%20Clot%20Raffin%2005320%20LA%20GRAVE+(Le%20Cl%C3%B4t%20Raffin)&amp;ie=UTF8&amp;t=&amp;z=11&amp;iwloc=A&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div><br />
					<div>
						<p class="coordo">
							Le Clot Raffin 05320 LA GRAVE – Tél : 04 76 79 28 43
							GPS : Latitude : 45.057851 | Longitude : 6.276868
						</p>
					</div>
					<div style="width: 100%"><iframe width="100%" height="400" src="https://maps.google.com/maps?width=100%&amp;height=400&amp;hl=en&amp;coord=44.709845,6.265283&amp;q=Les%20Rochas%20%E2%80%93%20LES%20MARTINS%2005260%20CHAMPOLEON+(Les%20Rochas)&amp;ie=UTF8&amp;t=&amp;z=11&amp;iwloc=A&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div><br />
					<div>
						<p class="coordo coordo2">
							Les Rochas – LES MARTINS 05260 CHAMPOLEON – 04 92 55 95 65
							GPS : Latitude : 44.709845 - Longitude : 6.265283
						</p>
					</div>
				</div>
			</div>
	</article>
	</div><hr class="clear">
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