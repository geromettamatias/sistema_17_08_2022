<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$idDocente = (isset($_POST['idDocente'])) ? $_POST['idDocente'] : '';
$contraseñaVieja = (isset($_POST['contraseñaVieja'])) ? $_POST['contraseñaVieja'] : '';
$nuevaContraseña = (isset($_POST['nuevaContraseña'])) ? $_POST['nuevaContraseña'] : '';

$contraseñaVieja_codificada= base64_encode($contraseñaVieja);

$nuevaContraseña_codificada= base64_encode($nuevaContraseña);






$consulta = "SELECT * FROM `datos_docentes` WHERE `idDocente`='$idDocente' AND `passwordDocente`='$contraseñaVieja_codificada'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
  
    $consulta = "UPDATE `datos_docentes` SET `passwordDocente`='$nuevaContraseña_codificada' WHERE `idDocente`='$idDocente'";  
     
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(); 


    session_start();


        $_SESSION["password"] = $nuevaContraseña_codificada;
      




	echo 1;
	$conexion = NULL;

}else{
    
    echo 2;
	$conexion = NULL;
}








   