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
	if(isset($_POST["ajouter"]) AND $_POST["ajouter"] == "ajouter l'évènement"){
		$id_cat = mysqli_real_escape_string($mysqli, $_POST["id_cat"]);
		$date_cal = mysqli_real_escape_string($mysqli, $_POST["date_cal"]);
		$titre_cal = mysqli_real_escape_string($mysqli, $_POST["titre_cal"]);
		$com_cal = mysqli_real_escape_string($mysqli, $_POST["com_cal"]);
		if($id_cat == "" OR $date_cal == "" OR $titre_cal == ""){
			$message_ajout = "<h1 class='bad_alert'>Veuillez remplir tous champs obligatoire</h1>";
		} else {
			$rq = " INSERT INTO t_calendar (id_cat, date_cal, titre_cal, com_cal) VALUES ('$id_cat', '$date_cal', '$titre_cal', '$com_cal') ";
			// echo $rq;
			$result=$mysqli->query($rq);
		}
		if(isset($result) AND $result == TRUE){
				$message_ajout = "<h1 class='good_alert'>L'évènement a bien été ajouté</h1>";
			}
			else{
				$message_ajout = "<h1 class='bad_alert'>Une erreur s'est produite</h1>";
		}
		// var_dump($date_cal);
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Ajout d'un évènement - Loisirs Montagne</title>
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
 	 			<?php 
 	 				if(isset($message_ajout)){
 	 					echo $message_ajout;
 	 				}
 	 			 ?>
 	 		</div>
 	 		<?php 
 	 			if(!isset($result) OR $result == FALSE){
 	 		 ?>
 	 		<div class="titre">
 	 			<h1>Ajout d'un évènement</h1>
 	 		</div>
 	 		<form action="" method="POST">
 	 			<label for="id_cat">Id_cat de l'évènement</label>
 	 			<p class="alerte">Requis</p><br>
 	 				<select name="id_cat" id="id_cat" required>
 	 					<option value="">Sélectionnez une catégorie</option>
 	 					<option value="1">Les Rochas</option>
 	 					<option value="2">Le Clot Raffin</option>
 	 					<option value="3">Autre</option>
 	 				</select><br>
 	 			<label for="date_cal">Dâte de l'évènement</label>
 	 			<p class="alerte">Requis</p><br>
					<input type="date" id="date_cal" name="date_cal" value="<?php if(isset($_POST["date_cal"])){ echo $date_cal; } ?>" required ><br>
				<label for="titre_cal">Titre de l'évènement</label>
				<p class="alerte">Requis</p><br>
					<input type="text" id="titre_cal" name="titre_cal" placeholder="Titre de l'évènement" value="<?php if(isset($_POST["titre_cal"])) { echo $titre_cal ;} ?>" required><br>
				<label for="com_cal">Commentaire de l'évènement</label><br>
					<input type="text" id="com_cal" name="com_cal" value="<?php if(isset($_POST["com_cal"])) { echo $com_cal; } ?>" placeholder="Commentaire de l'évènement"><br>
				<input class="submit" type="submit" name="ajouter" value="ajouter l'évènement">
 	 		</form>
 	 		<?php 
 	 			} else {
 	 		 ?>
 	 		 <p class="back_p"><a href="gestion_cal.php" class="back">Retour</a></p>
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