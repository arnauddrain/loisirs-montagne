<?php 
	include("cnx.php");
	$recherche = $_POST["recherche"];
	$debut = 0;
	$nbr_afficher = 3;
	$page = 1;
	if(isset($_POST["page"])){
		$page = $_POST["page"];
		$debut = ($page - 1) * $nbr_afficher;
	}
	$rq_nbr = "SELECT * FROM t_actualites WHERE titre_act LIKE '%$recherche%' OR texte_act LIKE '%$recherche%' OR auteur_act LIKE '%$recherche%' OR date_act LIKE '%$recherche%' ORDER BY date_act ";
	$result_nbr = $mysqli->query($rq_nbr);
	if($result_nbr->num_rows % $nbr_afficher != 0){
		$nombre_page = intval($result_nbr->num_rows / $nbr_afficher + 1);
	} 
	else {
		$nombre_page = intval($result_nbr->num_rows / $nbr_afficher);
	}
	$rq = "SELECT * FROM t_actualites WHERE titre_act LIKE '%$recherche%' OR texte_act LIKE '%$recherche%' OR auteur_act LIKE '%$recherche%' OR date_act LIKE '%$recherche%' ORDER BY date_act LIMIT $debut, $nbr_afficher ";
	$result = $mysqli->query($rq);
	////////////////////PAGINATION TOP////////////////
			?>
			<h2>Recherche dans toutes les actualités : <?php echo $recherche ?></h2>
			<div class="bg_block bg_news">
			<?php
				 if($nombre_page > 1){
			?>
			<ul class="pagination_top">
			 <div class="block_pagination">
			 <?php
			 if($page != 1){
			 	?>
			 		<li><a href="page=<?php echo $page-1; ?>" id="precedent_actualites">Précédent</a></li>
			 	<?php
			 }
			 if($nombre_page > 1){
			 	for($i = 1 ; $i <= $nombre_page ; $i++){
			 	?>
			 		<li><a href="page=<?php echo $i; ?>" class="numero_page_actualites<?php if($i == $page){echo ' actif';} ?>"><?php echo $i; ?></a></li>
			 	<?php
			 		}
			 }
			 if($result_nbr->num_rows > $page * $nbr_afficher){

			 	?>
			 		<li><a href="page=<?php echo $page+1; ?>" id="suivant_actualites">Suivant</a></li>
			 	<?php
			 }
			 ?>
			 </div>
			 </ul>
			 <?php
			 }
			 ////////////////////FIN PAGINATION TOP////////////////
			while ($row=$result->fetch_object()){	
	 ?>
		<div class="news">
			<p><img src="img/<?php echo $row->id_act; ?>.jpg" alt=""></p>
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
				////////////////////PAGINATION BOT////////////////
			 if($nombre_page > 1){
			?>
			<ul class="pagination">
			 <div class="block_pagination">
			 <?php
			 if($page != 1){
			 	?>
			 		<li><a href="page=<?php echo $page-1; ?>" id="precedent_actualites">Précédent</a></li>
			 	<?php
			 }
			 if($nombre_page > 1){
			 	for($i = 1 ; $i <= $nombre_page ; $i++){
			 	?>
			 		<li><a href="page=<?php echo $i; ?>" class="numero_page_actualites<?php if($i == $page){echo ' actif';} ?>"><?php echo $i; ?></a></li>
			 	<?php
			 		}
			 }
			 if($result_nbr->num_rows > $page * $nbr_afficher){

			 	?>
			 		<li><a href="page=<?php echo $page+1; ?>" id="suivant_actualites">Suivant</a></li>
			 	<?php
			 }
			 ?>
			 </div>
			 </ul>
			 <?php
			 }
			 	//////////////////// FIN PAGINATION BOT////////////////
			 ?>
			 </div>
			 <?php
?>