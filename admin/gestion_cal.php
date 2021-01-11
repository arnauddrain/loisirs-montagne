<?php 
	session_start();
	// var_dump($_SESSION);
	//STR_TO_DATE
	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
		header("Location: auth.php");
	}
	include("../cnx.php");
	$rq_cat = "SELECT * FROM t_cat";
	$result_cat = $mysqli->query( $rq_cat);
	
	// var_dump($row);
	//var_dump($_POST);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Gestion calendrier - Loisirs Montagne</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width">
 	<link rel="stylesheet" type="text/css" href="../css/style.css">
 </head>
 <body class="admin">
	<?php 
		include("header.php");
	 ?>
	 <section>
	 	<div class="container">
	 		<h2>Liste des évènements</h2>
	 		<div class="bg_block">
	 			<p class="ajouter"><a href="ajout_cal.php">ajouter un évènement</a></p>
	 			<?php 
	 				while ( $row_cat = $result_cat->fetch_object() ) {
	 					
	 			?>
	 			<div class="cat-<?php echo $row_cat->id_cat; ?>">
	 				<h2><?php echo $row_cat->nom_cat; ?></h2>
		 			<table>
		 				<tr >
		 					<th class="tr_color">Dâte</th>
		 					<th>Titre</th>
		 					<th>Commentaire</th>
		 					<th>Modifier</th>
		 					<th>Supprimer</th>
		 				</tr>
		 				<?php 
		 					$date = date("Y-m-d");
		 					$rq=" SELECT * FROM t_calendar INNER JOIN t_cat ON t_calendar.id_cat = t_cat.id_cat WHERE t_cat.id_cat = $row_cat->id_cat AND date_cal >= STR_TO_DATE('$date', '%Y-%m-%d') ORDER BY date_cal";
		 					// echo $rq;
		 					$result=$mysqli->query($rq);
		 					$rq_delete = "DELETE FROM t_calendar WHERE t_calendar.id_cat = $row_cat->id_cat AND date_cal < STR_TO_DATE('$date', '%Y-%m-%d') ";
		 					$result_delete = $mysqli->query( $rq_delete );
		 					// echo $rq_delete;
		 					while ($row=$result->fetch_object()){
		 				 ?>
		 				<tr>
		 					<td class="date_cal"><?php echo $row->date_cal; ?></td>
		 					<td class="titre_cal"><?php echo $row->titre_cal; ?></td>
		 					<td class="com_cal"><?php echo $row->com_cal; ?></td>
		 					<td ><?php if($_SESSION["role"] == 1 ) { ?><a class="modif" href="modif_cal.php?id_cal=<?php echo $row->id_cal; ?>">modifier</a><?php }else{ ?><p class="noacces">accès interdit</p><?php } ?></td>
		 					<td><?php if( $_SESSION["role"] == 1 ){ ?><a class="sup" href="sup_cal.php?id_cal=<?php echo $row->id_cal; ?>">supprimer</a><?php } else { ?><p class="noacces">accès interdit</p><?php } ?></td>
		 				</tr>
		 				<?php 
		 					}
		 				 ?>
		 			</table>
		 		</div>
		 		<?php } ?>
	 		</div>
	 	</div>
	 </section>

	 <?php 
	 	include("footer.php");
	  ?>
 
 </body>
 </html>
