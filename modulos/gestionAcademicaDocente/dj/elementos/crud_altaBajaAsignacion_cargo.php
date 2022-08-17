<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
$id_asig_cargo = (isset($_POST['id_asig_cargo'])) ? $_POST['id_asig_cargo'] : '';
$cargoF = (isset($_POST['cargoF'])) ? $_POST['cargoF'] : '';
$situacionRevistaF = (isset($_POST['situacionRevistaF'])) ? $_POST['situacionRevistaF'] : '';

$desdeF = (isset($_POST['desdeF'])) ? $_POST['desdeF'] : '';
$hastaF = (isset($_POST['hastaF'])) ? $_POST['hastaF'] : '';

$luneTurno = (isset($_POST['luneTurno'])) ? $_POST['luneTurno'] : '';
$marteTurno = (isset($_POST['marteTurno'])) ? $_POST['marteTurno'] : '';
$miercoleTurno = (isset($_POST['miercoleTurno'])) ? $_POST['miercoleTurno'] : '';
$jueveTurno = (isset($_POST['jueveTurno'])) ? $_POST['jueveTurno'] : '';
$vierneTurno = (isset($_POST['vierneTurno'])) ? $_POST['vierneTurno'] : '';

$lunesHorario = (isset($_POST['lunesHorario'])) ? $_POST['lunesHorario'] : '';
$martesHorario = (isset($_POST['martesHorario'])) ? $_POST['martesHorario'] : '';
$miercolesHorario = (isset($_POST['miercolesHorario'])) ? $_POST['miercolesHorario'] : '';
$juevesHorario = (isset($_POST['juevesHorario'])) ? $_POST['juevesHorario'] : '';
$viernesHorario = (isset($_POST['viernesHorario'])) ? $_POST['viernesHorario'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';




$lunesF=$luneTurno.'//'.$lunesHorario;
$martesF=$marteTurno.'//'.$martesHorario;
$miercolesF=$miercoleTurno.'//'.$miercolesHorario;
$juevesF=$jueveTurno.'//'.$juevesHorario;
$viernesF=$vierneTurno.'//'.$viernesHorario;


if ((isset($_SESSION['idUsuario']))){
   $idDocente=$_SESSION['idUsuario'];

$cicloLectivoFINAL=$_SESSION['cicloLectivo'];

                            

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL`(`id_asig_cargo`, `idDocente`, `cargo`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`) VALUES (null,'$idDocente','$cargoF','$situacionRevistaF','$desdeF','$hastaF','$lunesF','$martesF','$miercolesF','$juevesF','$viernesF')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

         $consulta = "SELECT `id_asig_cargo`, `idDocente`, `cargo`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes` FROM `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL` ORDER BY `id_asig_cargo` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
         foreach($data as $dat) {                                 
            $pre=$dat['id_asig_cargo'].'||'.$dat['cargo'].'||'.$dat['situacion'].'||'.$dat['desde'].'||'.$dat['hasta'].'||'.$dat['lunes'].'||'.$dat['martes'].'||'.$dat['miercoles'].'||'.$dat['jueves'].'||'.$dat['viernes'];
        }
      
        echo $pre;

        break; 

    case 2://baja
        $consulta = "DELETE FROM `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL` WHERE `id_asig_cargo`='$id_asig_cargo'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;

    case 3://baja

          $consulta = "UPDATE `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL` SET `cargo`='$cargoF',`situacion`='$situacionRevistaF',`desde`='$desdeF',`hasta`='$hastaF',`lunes`='$lunesF',`martes`='$martesF',`miercoles`='$miercolesF',`jueves`='$juevesF',`viernes`='$viernesF' WHERE `id_asig_cargo`='$id_asig_cargo'";            
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 



         $consulta = "SELECT `id_asig_cargo`, `idDocente`, `cargo`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes` FROM `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL`  WHERE `id_asig_cargo`='$id_asig_cargo'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
         foreach($data as $dat) {                                 
            $pre=$dat['id_asig_cargo'].'||'.$dat['cargo'].'||'.$dat['situacion'].'||'.$dat['desde'].'||'.$dat['hasta'].'||'.$dat['lunes'].'||'.$dat['martes'].'||'.$dat['miercoles'].'||'.$dat['jueves'].'||'.$dat['viernes'];
        }
      
        echo $pre;

        break; 

}




$conexion = NULL;

}    


