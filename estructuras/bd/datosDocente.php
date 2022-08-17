<?php
session_start();

if  (isset($_SESSION['idUsuario'])){


    $idUsuario=$_SESSION['idUsuario'];

include_once '../../modulos/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos` FROM `datos_docentes` WHERE `idDocente`='$idUsuario'";       
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;







}

