<?php 
	session_start();

	$contadorAlumno=$_POST['contadorAlumno'];
	$_SESSION['contadorAlumno']=$contadorAlumno;

	$contador=$_POST['contador'];
	$_SESSION['contador']=$contador;



	echo '1';
	

 ?>