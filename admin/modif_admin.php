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
		if(isset($_GET["id_admin"]) AND $_GET["id_admin"] != ""){
			$id_admin = $_GET["id_admin"];
			$rq="SELECT * FROM t_admin WHERE id_admin = $id_admin";
			$result=$mysqli->query($rq);
			$row=$result->fetch_object();
			if($result->num_rows == 0){
				header("Location: index.php");
			}
			if(isset($_POST["modifier"]) AND $_POST["modifier"] == "modifier l'admin"){
				$old_pass_admin = mysqli_real_escape_string($mysqli, md5($_POST["old_pass_admin"].'!%!'));
				$pass_admin = mysqli_real_escape_string($mysqli, md5($_POST["pass_admin"].'!%!'));
				$conf_pass_admin = mysqli_real_escape_string($mysqli, md5($_POST["conf_pass_admin"].'!%!'));
				$role_admin = mysqli_real_escape_string($mysqli, $_POST["role_admin"]);
				if($_POST["old_pass_admin"] != ""){
					if( $old_pass_admin == "$row->pass_admin"){
						if($_POST["pass_admin"] != ""){
							if($_POST["pass_admin"] == $_POST["conf_pass_admin"]){
								$rq_update = " UPDATE t_admin SET pass_admin = '$pass_admin', role_admin = '$role_admin' WHERE id_admin = '$id_admin' ";
								// echo $rq_update;
								$result_update=$mysqli->query($rq_update);
								if($result_update == TRUE){
									$message = "<h1 class='good_alert'>L'administrateur a bien été modifié</h1>";
								}else{
									$message = "<h1 class='bad_alert'>Une erreur s'est produite</h1>";
								}
							}
							else{
								$message = "<h1 class='bad_alert'>Les mots de passe ne sont pas identiques</h1>";
							}
						} else{
							$message = "<h1 class='bad_alert'>Le champ mot de passe est vide</h1>";
						}
					} else {
						$message = "<h1 class='bad_alert'>Ancien mot de passe incorrect</h1>";
					}
				}else{
					//traiter rq update role
					$rq_update = " UPDATE t_admin SET  role_admin = '$role_admin' WHERE id_admin = '$id_admin' ";
					// echo $rq_update;
					$result_update=$mysqli->query($rq_update);
					if($result_update == TRUE){
						$message = "<h1 class='good_alert'>Le rôle administrateur a bien été modifié</h1>";
					}else{
						$message = "<h1 class='bad_alert'>Le rôle n'a pas pu être modifié</h1>";
					}
				}
			}
			$result=$mysqli->query($rq);
			$row=$result->fetch_object();
		}	
	else{
		header("Location: index.php");
	}


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Modification administrateur - Loisirs Montagne</title>
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
  				<h1>Modification de l'administrateur <?php echo $row->mail_admin; ?></h1><br>
  			</div>
  			<div class="textcenter">
  				<?php if(isset($message)){
  					echo $message;
  				} ?>
  			</div>
  		
  			<form action="" method="POST">
  				<input type="hidden" name="id_admin" value="<?php echo $row->id_admin; ?>">
  				<label for="old_pass_admin">Mot de passe actuel</label><br>
  					<input type="password" id="old_pass_admin" name="old_pass_admin" placeholder="Ancien mot de passe" value="" ><br>
  				<label for="pass_admin">Nouveau mot de passe</label><br>
  					<input type="password" id="pass_admin" name="pass_admin" placeholder="Nouveau mot de passe" value=""><br>
  					<input type="password" id="" name="conf_pass_admin" placeholder="Confirmation mot de passe" value=""><br>
  				<label for="role_admin">Rôle</label><br>
  					<select name="role_admin">
  						<option value="1" <?php if( $row->role_admin == 1 ){ echo "selected";} ?>>Super admin</option>
  						<option value="2" <?php if( $row->role_admin == 2 ){ echo "selected";} ?>>admin</option>
  					</select><br>
  				<input class="submit" type="submit" name="modifier" value="modifier l'admin">
  			</form>
  			<p class="back_p"><a href="gestion_admin.php" class="back">Retour</a></p>
  		</div>
  	</section>
  	<?php 
  		include("footer.php");
  	 ?>
 </body>
 </html>