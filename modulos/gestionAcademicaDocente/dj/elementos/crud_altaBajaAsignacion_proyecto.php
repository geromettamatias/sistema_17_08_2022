<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
$id_asig_proyecto = (isset($_POST['id_asig_proyecto'])) ? $_POST['id_asig_proyecto'] : '';
$cHoras = (isset($_POST['cHoras'])) ? $_POST['cHoras'] : '';
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
$licencia = (isset($_POST['licencia'])) ? $_POST['licencia'] : '';




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
        $consulta = "INSERT INTO `asignacion_asignatura_docente_proyecto_$cicloLectivoFINAL`(`id_asig_proyecto`, `idDocente`, `cHoras`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `licencia`) VALUES (null,'$idDocente','$cHoras','$situacionRevistaF','$desdeF','$hastaF','$lunesF','$martesF','$miercolesF','$juevesF','$viernesF','$licencia')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

         $consulta = "SELECT `id_asig_proyecto`, `idDocente`, `cHoras`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `licencia` FROM `asignacion_asignatura_docente_proyecto_$cicloLectivoFINAL` ORDER BY `id_asig_proyecto` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
         foreach($data as $dat) {                                 
            $pre=$dat['id_asig_proyecto'].'||'.$dat['cHoras'].'||'.$dat['situacion'].'||'.$dat['desde'].'||'.$dat['hasta'].'||'.$dat['lunes'].'||'.$dat['martes'].'||'.$dat['miercoles'].'||'.$dat['jueves'].'||'.$dat['viernes'].'||'.$dat['licencia'];
        }
      
        echo $pre;

        break; 

    case 2://baja
        $consulta = "DELETE FROM `asignacion_asignatura_docente_proyecto_$cicloLectivoFINAL` WHERE `id_asig_proyecto`='$id_asig_proyecto'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;

    case 3://baja

          $consulta = "UPDATE `asignacion_asignatura_docente_proyecto_$cicloLectivoFINAL` SET `cHoras`='$cHoras',`situacion`='$situacionRevistaF',`desde`='$desdeF',`hasta`='$hastaF',`lunes`='$lunesF',`martes`='$martesF',`miercoles`='$miercolesF',`jueves`='$juevesF',`viernes`='$viernesF',`licencia`='$licencia' WHERE `id_asig_proyecto`='$id_asig_proyecto'";            
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 



         $consulta = "SELECT `id_asig_proyecto`, `idDocente`, `cHoras`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `licencia` FROM `asignacion_asignatura_docente_proyecto_$cicloLectivoFINAL`  WHERE `id_asig_proyecto`='$id_asig_proyecto'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
         foreach($data as $dat) {                                 
            $pre=$dat['id_asig_proyecto'].'||'.$dat['cHoras'].'||'.$dat['situacion'].'||'.$dat['desde'].'||'.$dat['hasta'].'||'.$dat['lunes'].'||'.$dat['martes'].'||'.$dat['miercoles'].'||'.$dat['jueves'].'||'.$dat['viernes'].'||'.$dat['licencia'];
        }
      
        echo $pre;

        break; 

}




$conexion = NULL;

}    


