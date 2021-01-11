<?php 
	session_start();
	// var_dump($_SESSION);
	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
		header("Location: auth.php");
	}
	include("../cnx.php");
	$rq = " SELECT * FROM t_livre_or ORDER BY  pub_or, date_or ASC ";
	$result = $mysqli->query($rq);
	if(isset($_GET["conf"]) AND ( $_GET["conf"] == 2 OR $_GET["conf"] == 1 ) ){ // PUBLIER
		$id_or = $_GET["id_or"];
		$conf_or = $_GET["conf"];
		// echo $conf_or;
		// echo $id_or; 
		$rq_pub = " UPDATE t_livre_or SET pub_or = $conf_or WHERE id_or = $id_or ";
		$result_pub = $mysqli->query($rq_pub);
		if($result_pub == TRUE){
			header("Location: gestion_livre_or.php");
		}
		// echo $rq_pub;
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Gestion livre d'or - Loisirs Montagne</title>
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
			<h2>Liste des témoignages</h2>
			<div class="bg_block">
				<table>
					<tr>
						<th>Nom - Mail</th>
						<th>Date</th>
						<th>Commentaire</th>
						<th>Publier</th>
						<th>Dépublier</th>
					</tr>
					<?php 
						while (	$row=$result->fetch_object()) {
					 ?>
					<tr>
						<td class="auteur"><?php echo $row->nom_or; ?><br><?php echo $row->mail_or; ?></td>
						<td class="id"><?php echo $row->date_or; ?></td>
						<td><?php echo $row->com_or; ?></td>
						<td>
							<?php if($row->pub_or == 2) { } else {?>
							<?php if($_SESSION["role"] == 1 ) { ?><a class="modif" href="gestion_livre_or.php?id_or=<?php echo $row->id_or; ?>&conf=2">publier</a><?php }else{ ?><p class="noacces">accès interdit</p><?php } ?>
						<?php } ?>
						</td>
						<td>
							<?php if($row->pub_or == 1) { } else {?>
							<?php if($_SESSION["role"] == 1 ) { ?><a class="sup" href="gestion_livre_or.php?id_or=<?php echo $row->id_or; ?>&conf=1">dépublier</a><?php }else{ ?><p class="noacces">accès interdit</p><?php } ?>
							<?php } ?>
						</td>
					</tr>
					<?php 
						}
					 ?>
				</table>
			</div>
		</div>
	</section>
 	 <?php 
 	 	include("footer.php");
 	  ?>
 
 </body>
 </html>