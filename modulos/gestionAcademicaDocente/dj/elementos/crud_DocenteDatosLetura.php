<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$idDocente = (isset($_POST['idDocente'])) ? $_POST['idDocente'] : '';

  
$consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente` FROM `datos_docentes` WHERE `idDocente`='$idDocente'";       
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;