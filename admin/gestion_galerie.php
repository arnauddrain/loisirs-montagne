<?php 
	session_start();
	// var_dump($_SESSION);
	//STR_TO_DATE
	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
		header("Location: auth.php");
	}
	include("../cnx.php");
	include("../functions.php");
	$rq_cat = "SELECT * FROM t_galerie_cat";
	$result_cat = $mysqli->query($rq_cat);


	// var_dump($row);
	//var_dump($_POST);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Gestion galerie - Loisirs Montagne</title>
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
	 		<?php 
	 			// DEBUT TEST MODIF/SUP/AJOUT
	 			if(isset($_GET["ajout"])){
	 				// echo 'test';

	 				// DEBUT D'AJOUT D'UNE IMAGE
	 				if($_GET["ajout"] == 1){ 
	 					// echo 'ajout ça marche';
	 					if(isset($_POST["ajouter"]) AND $_POST["ajouter"] == "ajouter l'image"){
	 						// var_dump($_POST);
	 						$nom_img = mysqli_real_escape_string($mysqli, $_POST["nom_img"]);
	 						$desc_img = mysqli_real_escape_string($mysqli, $_POST["desc_img"]);
	 						$id_cat = mysqli_real_escape_string($mysqli, $_POST["id_cat"]);
	 						$rq_ajout = " INSERT INTO t_galerie (nom_img, desc_img, id_cat) VALUES ( '$nom_img', '$desc_img', '$id_cat')";
	 						// echo $rq;
	 						if($nom_img == "" OR $desc_img == "" OR $id_cat == "" OR $_FILES['image']['type'] == ""){
	 							$message_ajout = "<h1 class='bad_alert'>Veuillez remplir tout les champs</h1>";
	 						}
	 						else{
	 							$result_ajout = $mysqli->query($rq_ajout);
	 							if($result_ajout == TRUE){
	 								$message_ajout = "<h1 class='good_alert'>L'image a bien été ajouté</h1>";
	 							}
	 							$id_img = $mysqli->insert_id;// demande a MYSQLI de me retourner le dernier ID inséré
	 							$image = $_FILES["image"];
	 							// var_dump($image);
	 							if($image["type"] == 'image/jpeg'){
	 								recadrage($image["tmp_name"], "../img/galerie_photo/$nom_img-$id_img-small.jpg", 550, 365); // RECADRAGE PETITE IMAGE
	 								$chemin = "../img/galerie_photo/$nom_img-$id_img.jpg";
	 								move_uploaded_file($image["tmp_name"], "$chemin"); // Enregistrement image initiale
	 							}
	 						}
	 					}
	 		?> 
	 					 <section>
	 						 <div class="container">
	 						 	 <div class="alert">
	 							 <?php 
	 							 	if(isset($message_ajout)){
	 							 	echo $message_ajout;
	 							 	}
	 							  ?>
	 							</div>
	 							<?php 
	 								if(!isset($result_ajout) OR $result_ajout == FALSE){
	 							 ?>
	 							 <div class="titre">
	 								 <h1>Ajout d'une image</h1>
	 							 </div>
	 								<form action=""  method="POST" enctype="multipart/form-data">
	 									<label for="nom_img">Nom image</label>
	 									<p class="alerte">Requis - nom doit correspondre avec adresse image</p><br>
	 											<input type="text" id="nom_img" name="nom_img" placeholder="Nom image" value="<?php if(isset( $_POST["nom_img"])){ echo $_POST["nom_img"]; } ?>" required><br>
	 									<label for="desc_img">Description image</label>
	 									<p class="alerte">Requis</p><br>
	 											<input type="text" id="desc_img" name="desc_img" placeholder="Description" value="<?php if(isset( $_POST["desc_img"])){ echo $_POST["desc_img"]; } ?>" required><br>
	 									<label for="id_cat">Catégorie image</label>
	 									<p class="alerte">Requis</p><br>
	 										<select name="id_cat" id="id_cat" required>
	 											<option value="">Sélectionnez une catégorie</option>
	 											<option value="1">Travaux</option>
	 											<option value="2">Clot Raffin</option>
	 											<option value="3">Rochas</option>
	 										</select><br>
	 									<label>Image</label>
	 									<p class="alerte">Requis - UNIQUEMENT DU JPEG</p><br>
	 										<div class="bg_form">
	 											<input type="file" name="image" accept="image/jpeg"><br>
	 										</div>
	 									<input class="submit" type="submit" name="ajouter" value="ajouter l'image">
	 								</form>
	 								<?php 
	 									}
	 								 ?>
	 								 <p class="back_p"><a href="gestion_galerie.php" class="back">Retour</a></p>
	 							</div>

	 						</section> 
	 		<?php 
	 				} // FIN AJOUT D'UNE IMAGE


	 			} // FIN TEST MODIF/SUP/AJOUT
	 			else{
	 		 ?>
		 		<h2>Liste des galaries</h2>
		 		<div class="bg_block">
		 			 	 <div class="alert">
		 				 <?php 
		 				 	if(isset($message_delete)){
		 				 	echo $message_delete;
		 				 	}
		 				  ?>
		 				</div>
		 			<p class="ajouter"><a href="gestion_galerie.php?ajout=1">ajouter une image</a></p>
		 			<div class="bg_texte">
		 				<h5>attention</h5>
		 			<p class="alert">Il n'y a pas de confirmation pour supprimer une image, si vous cliquez sur SUPPRIMER la suppression sera définitive.</p>
		 			</div>
		 			<?php 
		 				while ( $row_cat = $result_cat->fetch_object() ) {	
		 			?>
		 			<div class="cat-<?php echo $row_cat->id_cat; ?>">
		 				<h2><?php echo $row_cat->nom_cat; ?></h2>
			 			<table>
			 				<tr >
			 					<th class="tr_color">adresse img</th>
			 					<th>Description image</th>
			 					<th>Petit aperçu</th>
			 					<th>Supprimer</th>
			 				</tr>
			 				<?php 
			 					$rq=" SELECT * FROM t_galerie INNER JOIN t_galerie_cat ON t_galerie.id_cat = t_galerie_cat.id_cat WHERE t_galerie_cat.id_cat = $row_cat->id_cat ORDER BY id_img DESC";
			 					// echo $rq;
			 					$result=$mysqli->query($rq);
			 					while ($row=$result->fetch_object()){
			 				 ?>
			 				<tr>
			 					<td class="date_cal"><?php echo $row->nom_img; ?>-<?php echo $row->id_img; ?></td>
			 					<td class="titre_cal"><?php echo $row->desc_img; ?></td>
			 					<td><img src="../img/galerie_photo/<?php echo $row->nom_img; ?>-<?php echo $row->id_img; ?>-small.jpg" alt="<?php echo $row->desc_img; ?>"></td>
			 					<?php 
			 					if(isset($_GET['sup']) AND $_GET['sup'] == 1 ) {

			 						if($_GET['id_img'] == $row->id_img){
			 					 ?>
			 					 <td class="validation_sup" id="validation_sup"><a class="sup oui" href="gestion_galerie.php?id_img=<?php echo $row->id_img; ?>&sup=2">oui</a>
			 					 	<a class="sup non" href="gestion_galerie.php">non</a></td>
			 					<?php
			 					}		 				
			 						elseif (($_GET['id_img']) != $row->id_img) {
			 							?>
			 							<td class="validation_sup"><?php if( $_SESSION["role"] == 1 ){ ?><a class="sup" href="gestion_galerie.php?id_img=<?php echo $row->id_img; ?>&sup=1&#validation_sup">supprimer</a><?php } else { ?><p class="noacces">accès interdit</p><?php } ?></td>
			 							<?php
			 						}
			 				} else {
			 					?>
									<td class="validation_sup"><?php if( $_SESSION["role"] == 1 ){ ?><a class="sup" href="gestion_galerie.php?id_img=<?php echo $row->id_img; ?>&sup=2">supprimer</a><?php } else { ?><p class="noacces">accès interdit</p><?php } ?></td>
			 					<?php
			 				}
			 				if(isset($_GET['sup']) AND $_GET['sup'] == 2){
			 					$id_img = $_GET["id_img"];
			 					// echo $id_act;
			 					$rq_delete="DELETE FROM t_galerie WHERE id_img = $id_img";
			 					// echo $rq;
			 					$result_delete = $mysqli->query($rq_delete);
			 					if(file_exists(("../img/galerie_photo/$row->nom_img-$id_img.jpg"))){
			 						unlink("../img/galerie_photo/$row->nom_img-$id_img.jpg");
			 					}
			 					if(file_exists(("../img/galerie_photo/$row->nom_img-$id_img-small.jpg"))){
			 						unlink("../img/galerie_photo/$row->nom_img-$id_img-small.jpg");	
			 					}
			 					header('Location: gestion_galerie.php');
			 				} 
			 					 ?>
			 				</tr>
			 				<?php 
			 					}
			 				 ?>
			 			</table>
			 		</div>
			 		<?php } ?>
		 		</div>
	 		<?php 
	 			}
	 		 ?>
	 	</div>
	 </section>
	 <?php 
	 	include("footer.php");
	  ?>
 
 </body>
 </html>