<?php 
	include("cnx.php");
	$debut = 0;
	$nbr_afficher = 8;
	$page = 1;
	if(isset($_POST["page"])){
		$page = $_POST["page"];
		$debut = ($page -1) * $nbr_afficher;
	}
	$rq_nbr = "SELECT * FROM t_galerie";
	$result_nbr = $mysqli->query($rq_nbr);
	$rq = "SELECT * FROM t_galerie ORDER BY id_img ASC LIMIT $debut, $nbr_afficher ";
	$result = $mysqli->query($rq);

			while ($row = $result->fetch_object()){
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
				<div class="precedent">
					<a class="nope" href="page=<?php echo $page-1; ?>" id="precedent"></a>
				</div>
				<?php
			}

 ?>