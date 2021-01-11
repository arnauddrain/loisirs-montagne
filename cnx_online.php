<?php 
	$mysqli = new mysqli("localhost", "motelle", "simon$2018","motelle");
	if(mysqli_connect_errno()){
		printf("Echec de la connexion : %s\n", mysqli_connect_errno());
		exit();
	}
	if(!$mysqli->set_charset("utf8")){
		exit();
	}
 ?>
