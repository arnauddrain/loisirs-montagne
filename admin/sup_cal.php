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
	if(isset($_GET["id_cal"]) AND $_GET["id_cal"] != ""){
		$id_cal = $_GET["id_cal"];
		$rq = " SELECT * FROM t_calendar WHERE id_cal = '$id_cal' ";
		// echo $rq;
		$result=$mysqli->query($rq);
		$row = $result->fetch_object();
	} else {
		header("Location: gestion_cal.php");
	}
	if(isset($_GET["conf"]) AND $_GET["conf"] == 1){
		$conf_sup = $_GET["conf"];
		$rq_conf = " DELETE FROM t_calendar WHERE id_cal = '$id_cal' ";
		// echo $rq_conf;
		$result_conf = $mysqli->query($rq_conf);
			if($result_conf == TRUE){
					$message = "<h2 class='good_alert'>L'évènement <?php echo $row->titre_cal; ?> a bien été supprimé</h1>";
				} else{
					$message = "<h2 class='bad_alert'>L'évènement <?php echo $row->titre_cal; ?> n'a pas été supprimé</h1>";
			}
	}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Suppression d'un évènement - Loisirs Montagne</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width">
 	<link rel="stylesheet" type="text/css" href="../css/style.css">
 </head>
 <body class="admin">
 	<?php 
 		include("header.php");
 	 ?>
	<div class="containaer sup_act">
		<?php if(isset($message)){ echo $message; } ?>
		<?php if(!isset($result_conf)){ ?>
		<div class="titre">
			<h1>Etes vous sûr de vouloir supprimer l'évènement "<?php echo $row->titre_cal; ?>" ?</h1>
		</div>
		<p class="yesorno"><a href="sup_cal.php?id_cal=<?php echo $row->id_cal; ?>&conf=1" class="yes">Oui</a><a href="gestion_cal.php" class="no">Non</a></p>
		<?php } else { ?>
		<p><a class="back" href="gestion_cal.php">Retour</a></p>
		<?php } ?>
	</div>
 	 <?php 
 	 	include("footer.php");
 	  ?>
 </body>
 </html>