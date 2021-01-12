<?php 
	include("cnx.php");

 ?>

 <!DOCTYPE html>
 <html lang="fr">
 <head>
 	<title>Toutes les actualités - Loisirs Montagne</title>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width">
 	<link rel="stylesheet" type="text/css" href="css/style.css">
 </head>
 <body>
 	<?php 
 		include("header.php");
 		include("nav.php");
 	 ?>
	<div class="container all_actualites">
		<article>
			<div class="bg_block">
				<div class="recherche">
					<p class="info_green">Ici vous pouvez rechercher un article précis grace à <b>un ou plusieurs mots présent</b> dans son <b>titre/texte ou nom d'auteur</b></p><br>
					<p class="alerte">ne pas mettre d'accents</p><br>
					<form action="all_actualite.php" id="form_recherche_actualites" method="POST">
						<input class="recherche_texte" type="text" name="recherche" id=recherche_actualites placeholder="Votre recherche">
					</form>
				</div>
			</div>
			<div id="content_actualites">

			</div>
		</article> 
	</div>
 	 <?php 
		  include("footer.php");
		  include("scripts.php");
 	  ?>
 </body>
 </html>