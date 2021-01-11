<?php 
	session_start();
	// var_dump($_SESSION);
	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
		header("Location: auth.php");
	}
	include("../cnx.php");
	include("../functions.php");
		if($_SESSION["role"] != 1){
			header("Location: index.php");
		}
	if(isset($_GET["id_cal"]) AND $_GET["id_cal"] != ""){
		$id_cal = $_GET["id_cal"];
		$rq = " SELECT * FROM t_calendar WHERE id_cal = $id_cal ";
		// echo $rq; 
		$result=$mysqli->query($rq);
		$row=$result->fetch_object();
		if($result->num_rows == 0){
			header("Location: gestion_cal.php");
		}
		if(isset($_POST["modifier"]) AND $_POST["modifier"] == "modifier l'évènement"){
			$id_cat = mysqli_real_escape_string($mysqli,$_POST["id_cat"]);
			$date_cal = mysqli_real_escape_string($mysqli,$_POST["date_cal"]);
			$titre_cal = mysqli_real_escape_string($mysqli,$_POST["titre_cal"]);
			$com_cal = mysqli_real_escape_string($mysqli,$_POST["com_cal"]);
			$rq_update = " UPDATE t_calendar SET id_cat = '$id_cat', date_cal = '$date_cal', titre_cal='$titre_cal', com_cal = '$com_cal' WHERE id_cal = '$id_cal'";
			// echo $rq;
			$result_update =$mysqli->query($rq_update);
				if($result_update == TRUE){
					$message = " <h1 class='good_alert'>L'évènement a bien été modifié</h1> ";
				} else {
					$message = "<h1 class='bad_alert'>Une erreur s'est produite</h1>";
				}
		}


	} else {
		header("Location: gestion_cal.php");
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Modification calendrier - Loisirs Montagne</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width">
 	<link rel="stylesheet" type="text/css" href="../css/style.css">
 </head>
 <body class="admin">
 	<?php 
 		include("header.php");
 	 ?>
 	 <section>
 	 	<div class="container modif_act">
 	 		<div class="titre">
 	 			<h1>Modification de l'évènement "<?php echo $row->titre_cal; ?>"</h1>
 	 		</div>
 	 		<div class="textcenter">
 	 			<?php 
 	 				if(isset($message)){
 	 					echo $message;
 	 				}
 	 			 ?>
 	 		</div>
			<?php 
				if(!isset($result_update) OR 	$result_update != TRUE){
			 ?>
 	 		<form action="" method="POST">
 	 			<input type="hidden" name="id_cal" value="">
 	 			<label for="id_cat">Catégorie évènement</label><br>
 	 				<select name="id_cat" id="id_cat" required>
 	 					<option value="">Sélectionner la catégorie</option>
 	 					<option value="1" <?php if( $row->id_cat == 1){ echo "selected"; } ?>>Les Rochas</option>
 	 					<option value="2" <?php if( $row->id_cat == 2){ echo "selected"; } ?>>Le Clot Raffin</option>
 	 					<option value="3" <?php if( $row->id_cat == 3){ echo "selected"; } ?>>Autre</option>
 	 				</select><br>
 	 			<label for="date_cal">Dâte de l'évènement</label><br>
 	 				<input type="date" id="date_cal" name="date_cal" placeholder="Dâte de l'évènement" value="<?php echo $row->date_cal; ?>"><br>
 	 			<label for="titre_cal">Titre de l'évènement</label><br>
 	 				<input type="text" id="titre_cal" name="titre_cal" placeholder="Titre de l'évènement" value="<?php echo $row->titre_cal; ?>"><br>
 	 			<label for="com_cal">Commentaire de lévènement</label><br>
 	 				<input type="text" id="com_cal" name="com_cal" placeholder="Commentaire de l'évènement" value="<?php echo $row->com_cal; ?>">
 	 			<input class="submit" type="submit" name="modifier" value="modifier l'évènement">
 	 		</form>
 	 		<?php 
 	 			}
 	 		 ?>
 	 		<p class="back_p"><a href="gestion_cal.php" class="back">Retour</a></p>
 	 	</div>
 	 </section>
 	 <?php 
 	 	include("footer.php");
 	  ?>
 </body>
 </html>