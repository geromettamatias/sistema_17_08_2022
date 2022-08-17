<?php 
	session_start();

	$curso=$_POST['curso'];
	$_SESSION['curso']=$curso;

	echo $curso;
	


 ?>