<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';

$domicilio = (isset($_POST['domicilio'])) ? $_POST['domicilio'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : '';
$passwordDocente = (isset($_POST['passwordDocente'])) ? $_POST['passwordDocente'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idDocente = (isset($_POST['idDocente'])) ? $_POST['idDocente'] : '';





switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `datos_docentes`(`nombre`, `dni`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`) VALUES ('$nombre','$dni','$domicilio','$email','$telefono','$titulo','$passwordDocente')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT `idDocente`, `nombre`, `dni`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente` FROM `datos_docentes` ORDER BY `idDocente` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE `datos_docentes` SET `nombre`='$nombre',`dni`='$dni',`domicilio`='$domicilio',`email`='$email',`telefono`='$telefono',`titulo`='$titulo',`passwordDocente`='$passwordDocente' WHERE `idDocente`='$idDocente'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT `idDocente`, `nombre`, `dni`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente` FROM `datos_docentes` WHERE `idDocente`='$idDocente'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM `datos_docentes` WHERE `idDocente`='$idDocente'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;