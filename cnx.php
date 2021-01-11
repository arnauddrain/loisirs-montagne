<?php 
	include("env.php");
	$mysqli = new mysqli($env['db']['host'], $env['db']['username'], $env['db']['password'], $env['db']['db']);
	if(mysqli_connect_errno()){
		printf("Echec de la connexion : %s\n", mysqli_connect_errno());
		exit();
	}
	if(!$mysqli->set_charset("utf8")){
		exit();
	}
 ?>
