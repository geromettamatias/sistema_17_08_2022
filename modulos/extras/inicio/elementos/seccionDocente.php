<?php 
	session_start();

	$cicloLectivoInicio=$_POST['cicloLectivoInicio'];
	$_SESSION['cicloLectivoInicio']=$cicloLectivoInicio;


if ((isset($_SESSION["idUsuario"]))){
   
   $idDocente=$_SESSION["idUsuario"];


	 include_once '../../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();


                  $consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente` FROM `datos_docentes` WHERE `idDocente`='$idDocente'";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $nombre=$da1t['nombre'];
                    $dni=$da1t['dni'];

                     
					$_SESSION['profesor']='Profesor: '.$nombre.'; DNI: '.$dni;


                  }
	

	echo '1';
}	

 ?>