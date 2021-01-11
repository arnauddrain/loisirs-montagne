<?php
	session_start();
	// var_dump($_SESSION);
	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
		header("Location: auth.php");
	}
	include("../cnx.php");
	include("../functions.php");

	if(isset($_POST["ajouter"]) AND $_POST["ajouter"] == "ajouter l'article"){
		// var_dump($_POST);
		$titre_act = mysqli_real_escape_string($mysqli, $_POST["titre_act"]);
		$auteur_act = mysqli_real_escape_string($mysqli, $_POST["auteur_act"]);
		$texte_act = mysqli_real_escape_string($mysqli, $_POST["texte_act"]);
		$date_act = date("Y/m/d");
		$rq = " INSERT INTO t_actualites (titre_act, auteur_act, texte_act, date_act) VALUES ( '$titre_act', '$auteur_act', '$texte_act', '$date_act')";
		// echo $rq;
		if($titre_act == "" OR $auteur_act == "" OR $texte_act == ""){
			$message_ajout = "<h1 class='bad_alert'>Veuillez remplir tout les champs</h1>";
		}
		else{
			$result = $mysqli->query($rq);
			if($result == TRUE){
				$message_ajout = "<h1 class='good_alert'>L'article a bien été ajouté</h1>";
			}
			$id_act = $mysqli->insert_id;// demande a MYSQLI de me retourner le dernier ID inséré
			$image = $_FILES["image"];
			// var_dump($image);
			if($image["type"] == 'image/jpeg'){
				recadrage($image["tmp_name"], "../img/$id_act.jpg", 550, 365);// TAILLE IMAGE A DEFINIR
			}
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajout d'un article - Loisirs Montagne</title>
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
					 <h1>Ajout d'un article</h1>
				 </div>
					<form action=""  method="POST" enctype="multipart/form-data">
						<label for="titre_act">Titre de l'article</label>
						<p class="alerte">Requis</p><br>
								<input type="text" id="titre_act" name="titre_act" placeholder="Titre" value="<?php if(isset( $_POST["titre_act"])){ echo $_POST["titre_act"]; } ?>" required><br>
						<label for="auteur_act">Auteur de l'article</label>
						<p class="alerte">Requis</p><br>
								<input type="text" id="auteur_act" name="auteur_act" placeholder="Prenom Nom" value="<?php if(isset( $_POST["auteur_act"])){ echo $_POST["auteur_act"]; } ?>" required><br>
						<label for="texte_act">Texte de l'article</label>
						<p class="alerte">Requis | Attention ne pas copier/coller un texte venant du WEB</p><br>
								<textarea name="texte_act" id="texte_act" placeholder="Texte" ><?php if(isset( $_POST["texte_act"])){ echo $_POST["texte_act"]; } ?></textarea><br>
						<label>Image de l'article</label>
							<div class="bg_form">
								<input type="file" name="image" accept="image/jpeg"><br>
							</div>
						<input class="submit" type="submit" name="ajouter" value="ajouter l'article">
					</form>
					<?php 
						}
					 ?>
					 <p class="back_p"><a href="index.php" class="back">Retour</a></p>
				</div>

			</section>
		 <?php 
		 	include("footer.php");
		  ?>
		<script src="../js/tinymce/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea', toolbar1: 'bold italic link numlist bullist', menubar: 'false', plugins: "textcolor, lists link,paste", block_formats : "Paragraphe=p;Titre 3=h3;Titre 4=h4;Titer 5=h5;Titre 6=h6" });</script>
</body>
</html>