<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
$idAsig = (isset($_POST['idAsig'])) ? $_POST['idAsig'] : '';
$idcursoAsig = (isset($_POST['idcursoAsig'])) ? $_POST['idcursoAsig'] : '';
$idAsignaturaAsig = (isset($_POST['idAsignaturaAsig'])) ? $_POST['idAsignaturaAsig'] : '';

$situacionRevista = (isset($_POST['situacionRevista'])) ? $_POST['situacionRevista'] : '';
$desde = (isset($_POST['desde'])) ? $_POST['desde'] : '';
$hasta = (isset($_POST['hasta'])) ? $_POST['hasta'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$obserbaci = (isset($_POST['obserbaci'])) ? $_POST['obserbaci'] : '';




if ((isset($_SESSION['idUsuario']))){
   $idDocente=$_SESSION['idUsuario'];

$cicloLectivoFINAL=$_SESSION['cicloLectivo'];


switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `asignacion_asignatura_docente_$cicloLectivoFINAL`(`idAsig`, `idDocente`, `idCurso`, `idAsignatura`, `situacion`, `desde`, `hasta`, `obserbaci`)  VALUES (null,'$idDocente','$idcursoAsig','$idAsignaturaAsig','$situacionRevista','$desde','$hasta','$obserbaci')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

         $consulta = "SELECT `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsig`, `plan_datos_asignaturas`.`nombre`, `curso_$cicloLectivoFINAL`.`nombre` AS 'nombreCurso', `asignacion_asignatura_docente_$cicloLectivoFINAL`.`situacion`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`desde`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`hasta`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`obserbaci` FROM `asignacion_asignatura_docente_$cicloLectivoFINAL` INNER JOIN `plan_datos_asignaturas` ON `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsignatura` = `plan_datos_asignaturas`.`idAsig` INNER JOIN `curso_$cicloLectivoFINAL` ON `curso_$cicloLectivoFINAL`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idCurso` ORDER BY `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsig` DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
         foreach($data as $dat) {                                 
            $pre=$dat['idAsig'].'||'.$dat['nombre'].'||'.$dat['nombreCurso'].'||'.$dat['situacion'].'||'.$dat['desde'].'||'.$dat['hasta'].'||'.$dat['obserbaci'];
        }
      
        echo $pre;

        break; 

    case 2://baja
        $consulta = "DELETE FROM `asignacion_asignatura_docente_$cicloLectivoFINAL` WHERE `idAsig`='$idAsig'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;

    case 4://editar

         $consulta = "UPDATE `asignacion_asignatura_docente_$cicloLectivoFINAL` SET `situacion`='$situacionRevista',`desde`='$desde',`hasta`='$hasta',`obserbaci`='$obserbaci' WHERE `idAsig`='$idAsig'";          
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

         $consulta = "SELECT `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsig`, `plan_datos_asignaturas`.`nombre`, `curso_$cicloLectivoFINAL`.`nombre` AS 'nombreCurso', `asignacion_asignatura_docente_$cicloLectivoFINAL`.`situacion`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`desde`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`hasta`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`obserbaci` FROM `asignacion_asignatura_docente_$cicloLectivoFINAL` INNER JOIN `plan_datos_asignaturas` ON `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsignatura` = `plan_datos_asignaturas`.`idAsig` INNER JOIN `curso_$cicloLectivoFINAL` ON `curso_$cicloLectivoFINAL`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idCurso` WHERE `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsig`='$idAsig'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
         foreach($data as $dat) {                                 
            $pre=$dat['idAsig'].'||'.$dat['nombre'].'||'.$dat['nombreCurso'].'||'.$dat['situacion'].'||'.$dat['desde'].'||'.$dat['hasta'].'||'.$dat['obserbaci'];
        }
      
        echo $pre;

        break; 
   

}




$conexion = NULL;

}    