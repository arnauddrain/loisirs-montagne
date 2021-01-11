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
	if(isset($_GET["id_admin"]) AND $_GET["id_admin"] != ""){
		$id_admin = $_GET["id_admin"];
		$rq="SELECT * FROM t_admin WHERE id_admin = $id_admin";
		// echo $rq;
		$result=$mysqli->query($rq);
		$row = $result->fetch_object();
	}
	else{
		header("Location: gestion_admin.php");
	}

	if(isset($_GET["conf"]) AND $_GET["conf"] == 1){
		$conf_sup = $_GET["conf"];
		$rq_conf = "DELETE FROM t_admin WHERE id_admin = $id_admin";
		// echo $rq_conf;
		$result_conf=$mysqli->query($rq_conf);
			if($result_conf == TRUE){
				$message = "<h2 class='good_alert'>L'administrateur <?php echo $row->mail_admin; ?> a bien été supprimé</h1>";
			} else{
				$message = "<h2 class='bad_alert'>L'administrateur <?php echo $row->mail_admin; ?> n'a pas été supprimé</h1>";
			}
	}


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Suppression d'un administrateur - Loisirs Montagne</title>
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
				if(!isset($result_conf)){
			?>
				<div class="titre">
					<h1>Etes vous sûr de vouloir supprimer l'administrateur <?php echo $row->mail_admin; ?> ?</h1>
				</div>
				<p class="yesorno"><a href="sup_admin.php?id_admin=<?php echo $row->id_admin; ?>&conf=1" class="yes">oui</a><a href="gestion_admin.php" class="no">non</a></p>
			<?php 
				} else {
			?>
			<p><a class="back" href="gestion_admin.php">Retour</a></p>
			<?php 
				}
			 ?>
		</div>
 	 <?php 
 	 	include("footer.php");
 	  ?>
 </body>
 </html>