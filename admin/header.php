<!-- nav administration = gestion actualitées - gestion tarifs - gestion réservations - gestion gazette -->
<header>
	<div class="container deco" >
		<p class="bienvenu">Bienvenue à toi <?php echo $_SESSION["mail"]; ?> le plus beau des administrateurs</p>
		<p><a href="deconnexion.php">Se déconnecter</a></p>
		<hr class="clear">
	</div>
	<nav>
		<div class="container">
			<ul>
				<li class="first"><a href="index.php">gestion actualitées</a></li>
				<li><a href="gestion_tarifs.php">gestion tarifs</a></li>
				<li><a href="gestion_cal.php">gestion calendrier</a></li>
				<li><a href="gestion_galerie.php">gestion galerie</a></li>
				<li><a href="gestion_gazette.php">gestion gazette</a></li>
				<li><a href="gestion_livre_or.php">gestion livre d'or</a></li>
				<?php if($_SESSION["role"] == 1) {?><li><a href="gestion_admin.php">gestion admin</a></li><?php } ?>
			</ul>
		</div>
	</nav>
</header>