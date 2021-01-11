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
		$rq="DELETE FROM t_actualites WHERE id_act = $id_act";
		// echo $rq;
		$result = $mysqli->query($rq);
		if(file_exists(("../img/$id_act.jpg"))){
			unlink("../img/$id_act.jpg");
		}
	}
	else{
		header("Location: index.php");
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Confirmation suppression d'article - Loisirs Montagne</title>
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
			 	<h2 class='good_alert'>L'article a bien été supprimé</h2>
				<?php 
					}else{
				?>
				<h2 class='bad_alert'>L'article n'a pas été supprimé</h2>
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