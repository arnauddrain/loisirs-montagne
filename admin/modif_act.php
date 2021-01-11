<?php 
	session_start();
	// var_dump($_SESSION);
	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
		header("Location: auth.php");
	}
	include("../cnx.php");
	if(isset($_GET["id_act"]) AND $_GET["id_act"] != ""){
		$id_act = $_GET["id_act"];
		// echo $id_act;
		$rq="SELECT * FROM t_actualites WHERE id_act = $id_act";
		// echo $rq;
		$result = $mysqli->query($rq);
		$row = $result->fetch_object();
		// var_dump($row);
		if($result->num_rows == 0){
			header("Location: index.php");
		}
	}
	else{
		header("Location: index.php");
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Modification d'article - Loisirs Montagne</title>
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
				<h1>Modification de l'article</h1>
			</div>
				<form action="conf_modif_act.php"  method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id_act" value="<?php echo $row->id_act; ?>">
					<label for="titre_act">Titre de l'article</label><br>
							<input type="text" id="titre_act" name="titre_act" placeholder="Titre" value="<?php echo $row->titre_act; ?>" required><br>
					<label for="auteur_act">Auteur de l'article</label><br>
							<input type="text" id="auteur_act" name="auteur_act" placeholder="Prenom Nom" value="<?php echo $row->auteur_act; ?>" required><br>
					<label for="texte_act">Texte de l'article</label><br>
							<textarea name="texte_act" id="texte_act" placeholder="Texte" ><?php echo $row->texte_act; ?></textarea><br>
					<div class="img_modif">
						
						<label>Image de l'article</label>
						<p class="alerte">Attention l'image ajoutée remplacera l'image actuelle</p>
						<div class="bg_form">
								<input type="file" name="image" accept="image/jpeg"><br><hr class="clear">
							</div>
						<label>Image actuelle</label>
						<p><img src="../img/<?php echo $row->id_act; ?>.jpg" alt=""></p>
						
							
						</div>
					<input class="submit" type="submit" name="modifier" value="modifier l'article">
				</form>
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