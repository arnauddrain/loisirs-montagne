<?php 
	session_start();
	// var_dump($_SESSION);
	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
		header("Location: auth.php");
	}
	include("../cnx.php");
	// var_dump($row);
	//var_dump($_POST);
	$rq = " SELECT * FROM t_gazette ORDER BY annee_gaz DESC ";
	// echo $rq;
	$result = $mysqli->query($rq);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Gestion gazette - Loisirs Montagne</title>
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
			<h2>Liste des gazettes</h2>
			<div class="bg_block">
				<p class="ajouter"><a href="ajout_gaz.php">ajouter une gazette</a></p>
				<table>
					<tr>
						<th>Id</th>
						<th>Année</th>
						<th>Voir</th>
						<th>Supprimer</th>
					</tr>
					<?php 
						while ($row=$result->fetch_object()) {
					 ?>
						<tr>
							<td><?php echo $row->id_gaz; ?></td>
							<td><?php echo $row->annee_gaz; ?>	</td>
							<td class="bt_voir"><a href="../gazette/<?php echo $row->annee_gaz ?>-<?php echo $row->id_gaz; ?>.pdf" class="voir" target="blank">voir</a></td>
							<td class="bt_sup"><?php if($_SESSION["role"] == 1) { ?><a href="sup_gaz.php?id_gaz=<?php echo $row->annee_gaz ?>-<?php echo $row->id_gaz; ?>" class="sup">supprimer</a><?php } else { ?><p class="noacces">accès interdit</p><?php } ?></td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</section>
 	 <?php 
 	 	include("footer.php");
 	 ?>
 </body>
 </html>