<?php 
	session_start();
	// var_dump($_SESSION);
	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
		header("Location: auth.php");
	}
	include("../cnx.php");
	if(isset($_POST["ajouter"]) AND $_POST["ajouter"] == "ajouter la gazette"){
		// var_dump($_FILES);
		$annee_gaz = mysqli_real_escape_string($mysqli, $_POST["annee_gaz"]);
		$rq = " INSERT INTO t_gazette (annee_gaz) VALUES ('$annee_gaz') ";
		// echo $rq;
		if($annee_gaz == "" OR $_FILES["pdf"]["name"] == ""){
			$message_ajout = "<h1 class='bad_alert'>Tout les champs ne sont pas remplis</h1>";
		} else {
			$result = $mysqli->query($rq);
			if($result == TRUE){
				$message_ajout = "<h1 class='good_alert'>La gazette $annee_gaz a bien été ajouté</h1>";
			}
			$id_gaz = $mysqli->insert_id;
			// echo $id_gaz;
			$pdf = $_FILES["pdf"];
			// var_dump($pdf);
			if($pdf["type"] == 'application/pdf'){
				move_uploaded_file($pdf["tmp_name"], "../gazette/$annee_gaz-$id_gaz.pdf");
			}
		}
	}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Ajout d'une gazette - Loisirs Montagne</title>
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
 	 		<div class="alert">
 	 			<?php if(isset($message_ajout)){
 	 				echo $message_ajout;
 	 			} ?>
 	 		</div>
 	 		<?php 
 	 			if(!isset($result) OR $result == FALSE){
 	 		 ?>
 	 		<div class="titre">
 	 			<h1>Ajout d'une gazette</h1>
 	 		</div>
 	 		<form action="" method="POST" enctype="multipart/form-data">
 	 			<label for="annee_gaz">Gazette année ...</label><br>
 	 				<input type="number" id="annee_gaz" name="annee_gaz" placeholder="Gazette année ..." value="<?php if(isset($_POST["annee_gaz"])){ echo $annee_gaz; } ?>"><br>
 	 			<label for="">Fichier pdf</label><br>
 	 				<input type="file" name="pdf" accept="application/pdf"><br>
 	 				<input class="submit" type="submit" name="ajouter" value="ajouter la gazette">
 	 		</form>
 	 		<?php } else { ?>
 			<p class="back_p"><a class="back" href="gestion_gazette.php">Retour</a></p> 			
			<?php } ?>
 	 	</div>
 	 </section>

 	 <?php 
 	 	include("footer.php");
 	  ?>
 
 </body>
 </html>