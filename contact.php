<?php 
	include('cnx.php');

		if( isset( $_POST["envoyer"] ) AND $_POST["envoyer"] == "Envoyer"){
		$nom = $_POST["nom"];
		$email = $_POST["email"];
		$message = $_POST["message"];
		if($nom != "" AND $email != "" AND $message != ""){
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$texte = "<p style='font-weight:bold;'>Nom : $nom</p>";
			$texte .= "<p>Email : $email</p>";// Le .= va rajouter du contenu à l'ancienne valeur
			$texte .= "<p>Message : $message</p>";
			//echo $texte;
			// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html; charset=utf-8';

			// En-têtes additionnels
			$headers[] = "From: $nom <$email>";
			mail("simon.motelle@gmail.com", "Nouveau contact depyuis votre site internet", $texte, implode("\r\n", $headers) );
			} else {
				$message_alert = "L'adresse mail n'est pas valide";
			} 
		} else {
			$message_alert = "Tous les champs ne sont pas remplis";
		}
	}
 ?>

  <!DOCTYPE html>
  <html>
  <head>
  	<title>Contact - Loisirs Montagne</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width">
  	<link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  	<?php 
  		include("header.php");
  		include("nav.php");
  	 ?>
 	<div class="container contact">
 		<div class="titre_page">
 			<h1>Contactez-nous</h1>
 		</div>
 		<?php 
 		if(isset($message_alert)){
 		 ?>	
 		<div class="titre_page">
 			<h1 class="bad_alert">
 				<?php 
 					echo $message_alert;
 				 ?>
 			</h1>
 		</div>
 		<?php 
 		}
 		 ?>
 			<section>
		 		<form action="" method="POST" class="col-8 offset-2">
		 			<label for="">Votre nom</label><br>
		 			<input type="text" name="nom" placeholder="Votre nom" value="<?php if(isset($nom)){ echo $nom; } ?>" required><br>
		 			<label for="">Votre E-mail</label><p class="alerte">Si votre e-mail est invalide nous ne pourrons pas vous recontacter</p><br>
		 			<input type="email" name="email" placeholder="Votre email" value="<?php if(isset($email)){ echo $email; } ?>" required><br>
		 			<label for="">Votre message</label><br>
		 			<textarea name="message" placeholder="Votre message" required><?php if(isset($message)){ echo $message; } ?></textarea><br>
		 			<input class="submit" type="submit" name="envoyer" value="Envoyer">
		 		</form><hr class="clear">
 			</section>
 	</div>
  	 <?php 
  	 	include("footer.php");
  	  ?>
   <script type="text/javascript" src="js/lightbox2-master/dist/js/lightbox-plus-jquery.js"></script>
 <script type="text/javascript" src="js/lightbox2-master/dist/js/lightbox.js"></script>
 <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="js/imagesloaded.pkgd.js" ></script>
 <script type="text/javascript" src="js/masonry.pkgd.min.js"></script>	  
 <script type="text/javascript" src="js/lightbox.js"></script>
 <script type="text/javascript" src="js/script.js" ></script>
  </body>
  </html>