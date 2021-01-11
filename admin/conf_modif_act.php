<?php 
	session_start();
	// var_dump($_SESSION);
	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
		header("Location: auth.php");
	}
	include("../cnx.php");
	include("../functions.php");
	if(isset($_POST["modifier"]) AND $_POST["modifier"] == "modifier l'article"){
		$id_act = mysqli_real_escape_string($mysqli, $_POST["id_act"]);
		$titre_act = mysqli_real_escape_string($mysqli, $_POST["titre_act"]);
		$auteur_act = mysqli_real_escape_string($mysqli, $_POST["auteur_act"]);
		$texte_act = mysqli_real_escape_string($mysqli, $_POST["texte_act"]);

		$rq="UPDATE t_actualites SET titre_act = '$titre_act', auteur_act = '$auteur_act', texte_act = '$texte_act' WHERE id_act = '$id_act' ";
		// echo $rq
		$result=$mysqli->query($rq);
		$image = $_FILES["image"];
		if($image["type"]== 'image/jpeg'){
			recadrage($image["tmp_name"], "../img/$id_act.jpg", 550, 365);
			// PENSER A MODIFIER TAILLE IMAGE
		}
	}
	else{
		header("Location: index.php");
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Confirmation modification d'article - Loisirs Montagne</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class="admin">
		<?php 
			include("header.php");
		 ?>
		 <div class="container">
		 	<div class="conf_sup_act">
			 	<?php 
			 		if($result == TRUE){
			 	 ?>
			 	<h2 class='good_alert'>L'article a bien été modifié</h2>
				<?php 
					}else{
				?>
				<h2 class='bad_alert'>L'article n'a pas été modifié</h2>
				<?php
					}
				 ?>
				 <p><a class="back" href="index.php">Retour</a></p>
			 </div>
		</div>
		 <?php 
		 	include("footer.php");
		  ?>


</body>
</html>