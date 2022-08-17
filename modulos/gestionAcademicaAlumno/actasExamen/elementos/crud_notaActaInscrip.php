<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$notaEsc = (isset($_POST['notaEsc'])) ? $_POST['notaEsc'] : '';
$notaOral = (isset($_POST['notaOral'])) ? $_POST['notaOral'] : '';

$promNumérico = (isset($_POST['promNumérico'])) ? $_POST['promNumérico'] : '';

$promLetra = (isset($_POST['promLetra'])) ? $_POST['promLetra'] : '';

$idInscripcion = (isset($_POST['idInscripcion'])) ? $_POST['idInscripcion'] : '';


   $consulta = "UPDATE `acta_examen_inscrip` SET `notaEsc`='$notaEsc',`notaOral`='$notaOral',`promNumérico`='$promNumérico',`promLetra`='$promLetra' WHERE `idInscripcion`='$idInscripcion'";  
     
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(); 



echo $idInscripcion;
$conexion = NULL;