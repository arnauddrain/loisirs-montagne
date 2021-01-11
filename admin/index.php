<?php 
 	session_start();
 	// var_dump($_SESSION);
 	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
 		header("Location: auth.php");
 	}
	include("../cnx.php");
	$rq="SELECT * FROM t_actualites ORDER BY date_act DESC";
	// echo $rq;
	$result=$mysqli->query($rq);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion actualitées - Loisirs Montagne</title>
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
					<h2>Liste des actualitées</h2>
					<div class="bg_block">
						<p class="ajouter"><a href="ajout_act.php">ajouter une actualitée</a></p>
						<table>
							<tr>
								<th>ID</th>
								<th>Titre</th>
								<th>Texte</th>
								<th>Auteur</th>
								<th>Date</th>
								<th>Modifier</th>
								<th>Supprimer</th>
							</tr>
							<?php 
								while ($row=$result->fetch_object()){
							 ?>
							<tr>
								<td class="id"><?php echo $row->id_act; ?></td>
								<td class="titre"><?php echo $row->titre_act; ?></td>
								<td class="texte"><?php echo substr(nl2br($row->texte_act), 0, 128); ?>...</td>
								<td class="auteur"><?php echo $row->auteur_act; ?></td>
								<td class="date"><?php echo $row->date_act; ?></td>
								<td ><?php if($_SESSION["role"] == 1 ) { ?><a class="modif" href="modif_act.php?id_act=<?php echo $row->id_act; ?>">modifier</a><?php }else{ ?><p class="noacces">accès interdit</p><?php } ?></td>
								<td><?php if( $_SESSION["role"] == 1 ){ ?><a class="sup" href="sup_act.php?id_act=<?php echo $row->id_act; ?>">supprimer</a><?php } else { ?><p class="noacces">accès interdit</p><?php } ?></td>
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