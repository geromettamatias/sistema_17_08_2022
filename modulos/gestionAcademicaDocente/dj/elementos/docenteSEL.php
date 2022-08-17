<?php 
	session_start();

	$idDocente=$_POST['idUsuario'];
	$_SESSION['docenteSEL']=$idDocente;

	$cicloLectivoFina=$_POST['cicloLectivoFina'];
	$_SESSION['cicloLectivoFina']=$cicloLectivoFina;



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
	echo 1;
	


 ?>