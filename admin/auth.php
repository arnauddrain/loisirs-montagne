<?php 
	session_start();
	// var_dump($_SESSION);
	if(isset($_SESSION["admin"]) AND $_SESSION["admin"] == 'connecté' ){
		header("Location: index.php");
	}
	include("../cnx.php");
	if(isset($_POST["connecter"]) AND $_POST["connecter"] ==  "Se connecter"){
		$mail_admin = $_POST["email"];
		$pass_admin = md5($_POST["password"].'!%!');
		// echo $mail_admin;
		// echo $pass_admin;
		$rq= " SELECT * FROM t_admin WHERE '$mail_admin' = mail_admin AND '$pass_admin' = pass_admin ";
		// echo $rq;
		$result = $mysqli->query($rq);
		// var_dump($result);
		if($result->num_rows == 1){
			$row=$result->fetch_object();
			$_SESSION["admin"] = 'connecté';
			$_SESSION["mail"] = $mail_admin;
			$_SESSION["role"] = $row->role_admin;
			header("Location: index.php");
		} else {
			$message = "<h1 class='bad_alert'>E-mail ou mot de passe incorrect</h1>";
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Authentification ADMIN - Loisirs Montagne</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class="admin">
	<div class="container auth">
		<div class="titre">
			<h1>Veuillez vous connectez pour accéder à l'administration</h1>
		</div>
		<div class="textcenter">
			<?php 
				if(isset($message)){
					echo $message;
				}
			 ?>
		 </div>
		<div class="bg_auth">
			<form action="" method="POST">
				<label for="email">E-mail</label><br>
				<input type="mail" id="email" name="email" placeholder="Votre e-mail"><br>
				<label for="password">Mot de passe</label><br>
				<input type="password" id="password" name="password" placeholder="Votre mot de passe"><br>
				<input class="submit" type="submit" name="connecter" value="Se connecter">
			</form>
		</div>
	</div>
	<?php 
		include("footer.php");
	 ?>
</body>
</html>