<?php 
	session_start();
	// var_dump($_SESSION);
	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
		header("Location: auth.php");
	}
	if( $_SESSION["role"] > 1 ){
		header("Location: index.php");
	}
	include("../cnx.php");
	if(isset($_GET["id_act"]) AND $_GET["id_act"] != ""){
		$id_act = $_GET["id_act"];
		// echo $id_act;
		$rq="SELECT * FROM t_actualites WHERE id_act = $id_act";
		// echo $rq;
		$result = $mysqli->query($rq);
		$row = $result->fetch_object();
	}
	else{
		header("Location: index.php");
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Suppression d'article - Loisirs Montagne</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class="admin">
		<?php 
			include("header.php");
		 ?>
		 <div class="container sup_act">
		 	<div class="titre">
				<h1>Etes vous sûr de vouloir supprimer cet article ?</h1>
			</div>
			<div class="sup_act2">
				<p><img src="../img/<?php echo $row->id_act; ?>.jpg" alt=""></p>
				<h2><?php echo $row->titre_act; ?></h2>
				<h3><?php echo $row->auteur_act; ?></h3>
				<p><?php echo substr(nl2br(strip_tags($row->texte_act)), 0, 256); ?>...</p>
				<hr class="clear">
			</div><hr class="clear">
			<p class="yesorno"><a href="conf_sup_act.php?id_act=<?php echo $row->id_act; ?>" class="yes">Oui</a><a href="index.php"  class="no">Non</a></p>
		</div>
		 <?php 
		 	include("footer.php");
		  ?>
</body>
</html>