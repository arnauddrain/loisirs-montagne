<?php 
	session_start();
	// var_dump($_SESSION);
	if(!isset($_SESSION["admin"]) OR $_SESSION["admin"] != 'connecté' ){
		header("Location: auth.php");
	}
	include("../cnx.php");
	// var_dump($row);
	//var_dump($_POST);
	if(isset($_POST["modifier"]) AND $_POST["modifier"] == "modifier"){
		$adh_18plus = mysqli_real_escape_string($mysqli, $_POST["adh_18plus"]);
		$adh_1618 = mysqli_real_escape_string($mysqli, $_POST["adh_1618"]);
		$adh_moins16 = mysqli_real_escape_string($mysqli, $_POST["adh_moins16"]);
		$nuit_18plus_a = mysqli_real_escape_string($mysqli, $_POST["nuit_18plus_a"]);
		$nuit_18plus_na = mysqli_real_escape_string($mysqli, $_POST["nuit_18plus_na"]);
		$nuit_1618_a = mysqli_real_escape_string($mysqli, $_POST["nuit_1618_a"]);
		$nuit_1618_na = mysqli_real_escape_string($mysqli, $_POST["nuit_1618_na"]);
		$nuit_1216_a = mysqli_real_escape_string($mysqli, $_POST["nuit_1216_a"]);
		$nuit_1216_na = mysqli_real_escape_string($mysqli, $_POST["nuit_1216_na"]);
		$nuit_312_a = mysqli_real_escape_string($mysqli, $_POST["nuit_312_a"]);
		$nuit_312_na = mysqli_real_escape_string($mysqli, $_POST["nuit_312_na"]);
		$nuit_moins3 = mysqli_real_escape_string($mysqli, $_POST["nuit_moins3"]);
		$nuit_famille = mysqli_real_escape_string($mysqli, $_POST["nuit_famille"]);
		$arrhes_sejour = mysqli_real_escape_string($mysqli, $_POST["arrhes_sejour"]);
		$arrhes_we = mysqli_real_escape_string($mysqli, $_POST["arrhes_we"]);
		$taxe_18plus = mysqli_real_escape_string($mysqli, $_POST["taxe_18plus"]);

		$rq_update="UPDATE t_tarifs SET adh_18plus = '$adh_18plus', adh_1618 = '$adh_1618', adh_moins16 = '$adh_moins16', nuit_18plus_a = '$nuit_18plus_a', nuit_18plus_na = '$nuit_18plus_na', nuit_1618_a = '$nuit_1618_a', nuit_1618_na = '$nuit_1618_na', nuit_1216_a = '$nuit_1216_a', nuit_1216_na ='$nuit_1216_na', nuit_312_a = '$nuit_312_a', nuit_moins3 = '$nuit_moins3', nuit_famille = '$nuit_famille', arrhes_sejour = '$arrhes_sejour', arrhes_we = '$arrhes_we', taxe_18plus = '$taxe_18plus' WHERE id_tarifs = 1";
		// echo $rq_update;
		$result_update = $mysqli->query($rq_update);
		// var_dump($result_update);
		if($result_update == TRUE){
			$message_update = "<h1 class='good_alert'>Le tableau des tarifs a bien été modifié</h1>";
		}
		else{
			$message_update = "<h1 class='bad_alert'>Une erreur s'est produite</h1>";
		}
	}
	$rq = "SELECT * FROM t_tarifs WHERE id_tarifs = 1";
	$result = $mysqli->query($rq);
	$row = $result->fetch_object();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion tarifs - Loisirs Montagne</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class="admin">
		<?php 
			include("header.php");
		 ?>
		
			<?php 
				if(isset($message_update)){
					?> 
						<div class="container alert">
							<?php
								echo $message_update;
							?>	
						</div>
					<?php
				}
		 	?>
		 
		 <section>
		 	<div class="container bg_block">
		 		<div class="titre">
		 			<h1>Modification tableau des tarifs</h1>
		 		</div>
				<form action="" method="POST">
					<table class="tarifs">
							<tr>
								<th colspan="3" class="adh">Adhésion Loisirs-Montagne<br>(Validité jusqu'à l'Assemblée Générale du 24 novembre 2018)</th>
							</tr>
							<tr>
								<th class="adh2">18 ans et plus</th>
								<td colspan="2" ><input type="number" name="adh_18plus" placeholder="" value="<?php echo $row->adh_18plus; ?>"></td>
							</tr>
							<tr>
								<th class="adh2">16 à 18 ans/Etudiant/Demandeur d'emploi</th>
								<td colspan="2" ><input type="number" name="adh_1618" placeholder="" value="<?php echo $row->adh_1618; ?>"></td>
							</tr>
							<tr>
								<th class="adh2">Moins de 16 ans</th>
								<td colspan="2" ><input type="number" name="adh_moins16" placeholder="" value="<?php echo $row->adh_moins16; ?>"></td>
							</tr>
						<tr>
							<th colspan="3" class="adh3">Nuitées</th>
						</tr>
						<tr>
							<th class="adh4">minimun de paiement : 5personnes/nuitées</th>
							<th class="adh4">Adhérent</th>
							<th class="adh4">Non adhérent</th>
						</tr>
						<tr>
							<th class="adh4">18 ans et plus</th>
							<td><input type="number" name="nuit_18plus_a" placeholder="" value="<?php echo $row->nuit_18plus_a; ?>"></td>
							<td><input type="number" name="nuit_18plus_na" placeholder="" value="<?php echo $row->nuit_18plus_na; ?>"></td>
						</tr>
						<tr>
							<th class="adh4">16 à 18 ans/Etudiant/Demandeur d'emploi</th>
							<td><input type="number" name="nuit_1618_a" placeholder="" value="<?php echo $row->nuit_1618_a; ?>"></td>
							<td><input type="number" name="nuit_1618_na" placeholder="" value="<?php echo $row->nuit_1618_na; ?>"></td>
						</tr>
						<tr>
							<th class="adh4">12 à 16 ans</th>
							<td><input type="number" name="nuit_1216_a" placeholder="" value="<?php echo $row->nuit_1618_a; ?>"></td>
							<td><input type="number" name="nuit_1216_na" placeholder="" value="<?php echo $row->nuit_1618_na; ?>"></td>
						</tr>
						<tr>
							<th class="adh4">3 à 12 ans</th>
							<td><input type="number" name="nuit_312_a" placeholder="" value="<?php echo $row->nuit_312_a; ?>"></td>
							<td><input type="number" name="nuit_312_na" placeholder="" value="<?php echo $row->nuit_312_na; ?>"></td>
						</tr>
						<tr>
							<th class="adh4">Moins de 3 ans</th>
							<td colspan="2"><input type="number" name="nuit_moins3" placeholder="" value="<?php echo $row->nuit_moins3; ?>"></td>
						</tr>
						<tr>
							<th class="adh4">Réduction famille nombreuse (s'appliquant à toute la famille)</th>
							<td colspan="2"><textarea name="nuit_famille" placeholder=""><?php echo $row->nuit_famille; ?></textarea></td>
						</tr>
						<tr>
							<th colspan="3" class="adh5">AARHES à la réservation (obligatoire)<br>L'organisateur d'un séjour est obligatoirement adhérent</th>
						</tr>
						<tr>
							<th class="adh6">Pour un séjour, par semaine</th>
							<td colspan="2"><input type="number" name="arrhes_sejour" placeholder="" value="<?php echo $row->arrhes_sejour; ?>"></td>
						</tr>
						<tr>
							<th class="adh6">Pour un weed-end</th>
							<td colspan="2"><input type="number" name="arrhes_we" placeholder="" value="<?php echo $row->arrhes_we; ?>"></td>
						</tr>
						<tr>
							<th colspan="3" class="adh5">Taxe de séjour (Clof Raffin uniquement)</th>
						</tr>
						<tr>
							<th class="adh6">Par nuitées</th>
							<th colspan="2" class="adh6">Adhérent & non adhérent</th>
						</tr>
						<tr>
							<th class="adh6">18 ans et plus</th>
							<td colspan="2"><input type="number" name="taxe_18plus" placeholder="" value="<?php echo $row->taxe_18plus; ?>"></td>
						</tr>
						<tr>
							<td colspan="3"><input class="submit" type="submit" name="modifier" value="modifier"></td>
						</tr>
					</table>
				</form>
			</div>
		 </section>
		 <?php 
		 	include("footer.php");
		  ?>
</body>
</html>