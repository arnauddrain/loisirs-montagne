<?php 
	include("cnx.php");


	if(isset($_POST["envoyer"]) AND $_POST["envoyer"] == 'Envoyer'){
		$secret = $env['captcha_secret'];

		$response =  $_POST["g-recaptcha-response"];
		// var_dump($_POST);
		$remoteip = $_SERVER['REMOTE_ADDR'];
		// var_dump($remoteip);
		$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
		    . $secret
		    . "&response=" . $response
		   . "&remoteip=" . $remoteip ;

		$decode = json_decode(file_get_contents($api_url), true);
		// var_dump($decode);
		if($decode['success'] == TRUE){
			if($_POST["nom_or"] != "" AND $_POST["mail_or"] != "" AND $_POST["com_or"] != ""){
				if (filter_var($_POST["mail_or"], FILTER_VALIDATE_EMAIL)) { 
					$nom_or = mysqli_real_escape_string($mysqli, $_POST["nom_or"]);
					$mail_or = mysqli_real_escape_string($mysqli, $_POST["mail_or"]);
					$com_or = mysqli_real_escape_string($mysqli, $_POST["com_or"]);
					$date_or = date("Y/m/d");

					$rq = " INSERT INTO t_livre_or (nom_or, mail_or, com_or, pub_or, date_or) VALUES ('$nom_or', '$mail_or', '$com_or', '1', '$date_or') ";
					// echo $rq;
					$result=$mysqli->query($rq);
					if(isset($result) AND $result == TRUE){
						$message_ajout = "<h1 class='good_alert'>Votre témoignage à bien été envoyé, il sera vérifié prochainement</h1>";
					} else {
						$message_ajout = "<h1 class='bad_alert'>Une erreur s'est produite</h1>";
					}
				} else {
					$message_ajout = "<h1 class='bad_alert'>L'adresse mail n'est pas valide</h1>";
				}
			} else {
				$message_ajout = "<h1 class='bad_alert'>Tous les champs ne sont pas remplis</h1>";
			}
		} else {
			$message_ajout = "<h1 class='bad_alert'>Merci de cocher 'Je ne suis pas un robot'</h1>";
		}
	}
 ?>
 <!DOCTYPE html>
 <html lang="fr">
 <head>
 	<title>Livre d'or - Loisirs Montagne</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
 </head>
 <body>
 	<?php 
 		include("header.php");
 		include("nav.php");
 	?>
 	<section class="livre_or">
 		<div class="container">
 			<div class="col-12">
 				<div class="alert">
 					<?php if(isset($message_ajout)){ echo $message_ajout; } ?>
 				</div>
 				<?php 
 					if(!isset($result) OR $result == FALSE){
 				 ?>
 				<h2 class="titre_page">Livre d'or</h2>
 				<div class="bg_block">
 					<form action="livre_or.php" method="POST">
 						<label for="nom_or">Votre nom*</label><br>
 						<input type="text" id="nom_or" name="nom_or" placeholder="Votre nom" value="<?php if(isset($_POST["nom_or"])){ echo $_POST["nom_or"]; }?>" required ><br>
 						<label for="mail_or">Votre mail*</label><p class="alerte">votre mail ne sera pas visible pour les autres visiteurs</p><br>
 						<input type="email" id="mail_or" name="mail_or" placeholder="Votre e-mail" value="<?php if(isset($_POST["mail_or"])){ echo $_POST["mail_or"]; }?>"><br>
 						<label for="com_or">Votre commentaire*</label><br>
 						<textarea name="com_or" id="com_or" placeholder="Votre commentaire"	 ><?php if(isset($_POST["com_or"])){ echo $_POST["com_or"]; }?></textarea>
 						<p class="nochoice">*champs obligatoire</p>
	 					<div class="g-recaptcha" data-sitekey="6LdkPXUUAAAAAJF4v2x-e4H82EaICnNnYzkHz8p9"></div>
 						<input class="submit" type="submit" name="envoyer" value="Envoyer">
 					</form>
 				</div>
 				<?php 
 					} else {
 				 ?>
 				 <p class="back_p"><a href="index.php" class="back">Retour</a></p>
 				 <?php 
 				 	}
 				  ?>
 				<h2>Témoignages des adhérents et des sympathisants</h2>
 				<div class="bg_block bg_tem">
 					<?php 
 						$rq_tem = " SELECT * FROM t_livre_or WHERE pub_or = '2' ORDER BY date_or DESC  ";
 						$result_tem = $mysqli->query($rq_tem);
 						while($row=$result_tem->fetch_object()){
 					 ?>
 					<div class="temoignage">
 						<h3><?php echo $row->nom_or; ?></h3>
 						<p class="date"><?php echo $row->date_or; ?></p>
 						<div class="bg_texte">
 							<p class="texte"><?php echo $row->com_or; ?></p>
 						</div>
 					</div>
 					<?php 
 						}
 					 ?>
 				</div>
 			</div>
 		</div>
 	</section><hr class="clear">
 	<?php 
 		include("footer.php");
 	 ?>
 <script type="text/javascript" src="js/lightbox2-master/dist/js/lightbox-plus-jquery.js"></script>
 <script type="text/javascript" src="js/lightbox2-master/dist/js/lightbox.js"></script>
 <script type="text/javascript" src="js/jquery.js" ></script>
  <script src="js/imagesloaded.pkgd.js" ></script>
 <script type="text/javascript" src="js/masonry.pkgd.min.js"></script>	  
 <script type="text/javascript" src="js/lightbox.js"></script>
 <script type="text/javascript" src="js/script.js" ></script>
 </body>
 </html>