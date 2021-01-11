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
	if(isset($_POST["ajouter"]) AND $_POST["ajouter"] == "ajouter l'admin"){
		// var_dump($_POST);
		if (filter_var($_POST["mail_admin"], FILTER_VALIDATE_EMAIL)) { // PERMET DE VERIFIER LA VALIDITE SYNTHAXIQUE DE LADRESSE MAIL 
			$mail_admin = mysqli_real_escape_string($mysqli, $_POST["mail_admin"]);
			$pass_admin = mysqli_real_escape_string($mysqli, md5($_POST["pass_admin"].'!%!'));
			$conf_pass_admin = mysqli_real_escape_string($mysqli, md5($_POST["conf_pass_admin"].'!%!'));
			$role_admin = mysqli_real_escape_string($mysqli, $_POST["role_admin"]);
			if($mail_admin == "" OR $pass_admin == "" OR $role_admin == ""){
				$message_ajout = "<h1 class='bad_alert'>Veuillez remplir tous les champs obligatoire</h1>";
			}

			else{
				if($pass_admin == $conf_pass_admin){
					$rq = " INSERT INTO t_admin (mail_admin, pass_admin, role_admin) VALUES ( '$mail_admin', '$pass_admin', '$role_admin')";
					$result = $mysqli->query($rq);
				} 
				else{
					$message_ajout = "<h1 class='bad_alert'>les mots de passe ne correspondent pas</h1>";
				}
				if(isset($result) AND $result == TRUE){
					$message_ajout = "<h1 class='good_alert'>L'admin a bien été ajouté</h1>";
				}
				else{
					$message_ajout = "<h1 class='bad_alert'>Une erreur s'est produite</h1>";
				}
			}
		} else {
			$message_ajout = "<h1 class='bad_alert'>L'adresse mail n'est pas valide</h1>";
		}

	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajout d'un administrateur - Loisirs Montagne</title>
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
					 <h1>Ajout d'un administrateur</h1>
				 </div>
					<form action=""  method="POST" enctype="multipart/form-data">
						<label for="titre_act">Adresse mail</label>
						<p class="alerte">Requis</p><br>
								<input type="text" id="mail_admin" name="mail_admin" placeholder="Adresse mail" value="<?php if(isset( $_POST["mail_admin"])){ echo $_POST["mail_admin"]; } ?>" required><br>
						<label for="auteur_act">Mot de passe</label>
						<p class="alerte">Requis</p><br>
								<input type="password" id="pass_admin" name="pass_admin" placeholder="Mot de passe	" value="" required><br>
								<input type="password" id="conf_pass_admin" name="conf_pass_admin" placeholder="Confirmation du mot de passe" value="" required><br>
						<label for="texte_act">Role</label>
						<p class="alerte">Requis</p><br>
								<select name="role_admin" required>
									<option value="">Sélectionner un rôle</option>
									<option value="1">Super admin</option>
									<option value="2">admin</option>
								</select><br>
						<input class="submit" type="submit" name="ajouter" value="ajouter l'admin">
					</form>
					<?php 
						} else {
					 ?>
					 <p class="back_p"><a href="gestion_admin.php" class="back">Retour</a></p>
					 <?php 
					 	}
					  ?>
				</div>

			</section>
		 <?php 
		 	include("footer.php");
		  ?>
</body>
</html>