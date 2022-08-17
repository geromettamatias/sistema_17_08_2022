<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$idAlumnos = (isset($_POST['idAlumnos'])) ? $_POST['idAlumnos'] : '';


$consulta="SELECT datosalumnos.idAlumnos, datosalumnos.nombreAlumnos, datosalumnos.dniAlumnos, datosalumnos.cuilAlumnos, datosalumnos.domicilioAlumnos, datosalumnos.emailAlumnos, datosalumnos.telefonoAlumnos, datosalumnos.discapasidadAlumnos,
datosalumnos.nombreTutor, datosalumnos.dniTutor, datosalumnos.TelefonoTutor, datosalumnos.idPlanEstudio, plan_datos.nombre, datosalumnos.fechaNa, datosalumnos.nLegajos, datosalumnos.nacido, datosalumnos.procedencia, datosalumnos.nacionalidadTutor FROM datosalumnos INNER JOIN plan_datos ON datosalumnos.idPlanEstudio= plan_datos.idPlan WHERE datosalumnos.idAlumnos='$idAlumnos'";       
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;