<?php 
	session_start();
	include("../cnx.php");
	// var_dump($_SESSION);
	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
		header("Location: auth.php");
	}
	if($_SESSION["role"] != 1){
		header("Location: index.php");
	}
	$rq="SELECT * FROM t_admin ORDER BY role_admin ASC";
	$result=$mysqli->query($rq);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Gestion admin - Loisirs Montagne</title>
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
	 	 	<h2>Liste des admins</h2>
	 	 	<div class="bg_block">
	 	 		<p class="ajouter"><a href="ajout_admin.php">ajouter un admin</a></p>
	 	 		<table>
	 	 			<tr>
		 	 			<th>ID</th>
		 	 			<th>Mail</th>
		 	 			<th>Password</th>
		 	 			<th>Role</th>
		 	 			<th>Modifier</th>
		 	 			<th>Supprimer</th>
	 	 			</tr>
	 	 			<?php 
	 	 				while($row=$result->fetch_object()){
	 	 			?>
	 	 			<tr>
	 	 				<td><?php echo $row->id_admin; ?></td>
	 	 				<td><?php echo $row->mail_admin; ?></td>
	 	 				<td><?php echo $row->pass_admin; ?></td>
	 	 				<td><?php echo $row->role_admin; ?></td>
	 	 				<td><a href="modif_admin.php?id_admin=<?php echo $row->id_admin; ?>" class="modif">modifier</a></td>
	 	 				<td><a href="sup_admin.php?id_admin=<?php echo $row->id_admin; ?>" class="sup">supprimer</a></td>
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