<?php 
	session_start();
	// var_dump($_SESSION);
	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
		header("Location: auth.php");
	}
	include("../cnx.php");
	if($_SESSION["role"] != 1){
		header("Location: gestion_gaz.php");
	}
	if(isset($_GET["id_gaz"]) AND $_GET["id_gaz"] != ""){
		$id_gaz_2 = $_GET["id_gaz"];
		// echo $id_gaz_2;
		$rq=" SELECT * FROM t_gazette WHERE annee_gaz-id_gaz = $id_gaz_2 ";
		// echo $rq;
		$result = $mysqli->query($rq);
		$row=$result->fetch_object();
	} else {
		header("Location: gestion_gazette.php");
	}
	if(isset($_GET["conf"]) AND $_GET["conf"] == 1){
		$conf_sup = $_GET["conf"];
		$rq_conf = " DELETE FROM t_gazette WHERE annee_gaz-id_gaz = $id_gaz_2 ";
		// echo $rq;
		$result_conf = $mysqli->query($rq_conf);
			if($result_conf == TRUE){
				$message = "<h1 class='good_alert'>La gazette à bien été supprimé</h1>";
				if(file_exists("../gazette/$row->annee_gaz-$row->id_gaz.pdf")){
					unlink("../gazette/$row->annee_gaz-$row->id_gaz.pdf");
				}
			} else {
				$message = "<h1 class='bad_alert'>La gazette n'a pas été supprimé</h1>";
			}
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Suppression d'une gazette</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width">
 	<link rel="stylesheet" type="text/css" href="../css/style.css">
 </head>
 <body class="admin">
 	<?php 
 		include("header.php");
 	 ?>
	<div class="container sup_act">
		<?php if(isset($message)){ echo $message; } ?>
		<?php 
			if(!isset($result_conf) OR $result_conf == FALSE){ 
		 ?>
		<div class="titre">
			<h1>Etes vous sûr de vouloir supprimer la gazette <?php echo $row->annee_gaz ?> ?</h1>
		</div>
		<p class="yesorno"><a href="sup_gaz.php?id_gaz=<?php echo $row->annee_gaz; ?>-<?php echo $row->id_gaz ?>&conf=1" class="yes">Oui</a><a href="gestion_gazette.php"  class="no">Non</a></p>
		<?php 
			} else {
		 ?>
		 <p class="back_p"><a class="back" href="gestion_cal.php">Retour</a></p>
		 <?php 
		 	}
		  ?>
	</div>
 	 <?php 
 	 	include("footer.php");
 	  ?>
 
 </body>
 </html>