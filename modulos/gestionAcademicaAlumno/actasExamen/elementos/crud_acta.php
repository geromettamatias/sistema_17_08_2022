<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$buscarTipo = (isset($_POST['buscarTipo'])) ? $_POST['buscarTipo'] : '';

$asignatura = (isset($_POST['asignatura'])) ? $_POST['asignatura'] : '';
$fechaActa = (isset($_POST['fechaActa'])) ? $_POST['fechaActa'] : '';


$idActa = (isset($_POST['idActa'])) ? $_POST['idActa'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$docente3 = (isset($_POST['docente3'])) ? $_POST['docente3'] : '';
$docente2 = (isset($_POST['docente2'])) ? $_POST['docente2'] : '';
$docente1 = (isset($_POST['docente1'])) ? $_POST['docente1'] : '';
$fechaActaCierre = (isset($_POST['fechaActaCierre'])) ? $_POST['fechaActaCierre'] : '';

$res='';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `actas_examen_datos`(`idActa`, `tipo`, `idAsignatura`, `precentacion`, `docente1`, `docente2`, `docente3`, `finalizacion`) VALUES (null,'$buscarTipo','$asignatura','$fechaActa','$docente1','$docente2','$docente3','$fechaActaCierre')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 


        $consulta = "SELECT actas_examen_datos.idActa, plan_datos_asignaturas.ciclo, plan_datos_asignaturas.nombre AS 'nombreAsignatura', plan_datos_asignaturas.idPlan, actas_examen_datos.precentacion, actas_examen_datos.finalizacion FROM actas_examen_datos INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = actas_examen_datos.idAsignatura ORDER BY actas_examen_datos.idActa DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
      
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                              

                            $idActa=$dat['idActa'];
                            $ciclo=$dat['ciclo'];
                            $idPlan=$dat['idPlan'];
                            $nombreAsignatura=$dat['nombreAsignatura'];
                            $precentacion=$dat['precentacion'];
                            $finalizacion=$dat['finalizacion'];


                            $date = date_create($precentacion);
                            $cadena_fecha_actual = date_format($date, 'd-m-Y');


                            $date_finalizacion = date_create($finalizacion);
                            $cadena_finalizacion = date_format($date_finalizacion, 'd-m-Y');


                            $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }


                            $res= $idActa.'||'.$ciclo.'--'.$nombreAsignatura.'--'.$idPlan.'||'.$cadena_fecha_actual.'||'.$cadena_finalizacion;
                        }

                        echo $res;
                            
        break;
    case 2: //modificación
        $consulta = "UPDATE `actas_examen_datos` SET `idAsignatura`='$asignatura', `precentacion`='$fechaActa',`docente1`='$docente1',`docente2`='$docente2',`docente3`='$docente3',`finalizacion`='$fechaActaCierre' WHERE `idActa`='$idActa'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  

  
          $consulta = "SELECT actas_examen_datos.idActa, actas_examen_datos.tipo, plan_datos_asignaturas.ciclo, plan_datos_asignaturas.idPlan, plan_datos_asignaturas.nombre AS 'nombreAsignatura', actas_examen_datos.precentacion, actas_examen_datos.finalizacion, datos_docentes1.nombre AS 'docentePresidente', datos_docentes2.nombre AS 'docente1erSuplente', datos_docentes3.nombre AS 'docente2doSuplente' FROM actas_examen_datos  INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = actas_examen_datos.idAsignatura INNER JOIN datos_docentes AS datos_docentes1 ON datos_docentes1.idDocente = actas_examen_datos.docente1 INNER JOIN datos_docentes AS datos_docentes2 ON datos_docentes2.idDocente = actas_examen_datos.docente2 INNER JOIN datos_docentes AS datos_docentes3 ON datos_docentes3.idDocente = actas_examen_datos.docente3 WHERE actas_examen_datos.idActa ='$idActa'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
      
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                              

                            $idActa=$dat['idActa'];
                         
                            $idPlan=$dat['idPlan'];
                            $ciclo=$dat['ciclo'];
                            
                
                            $nombreAsignatura=$dat['nombreAsignatura'];
                            $precentacion=$dat['precentacion'];
                            $finalizacion=$dat['finalizacion'];

                        
                            $date = date_create($precentacion);
                            $cadena_fecha_actual = date_format($date, 'd-m-Y');


                            $date_finalizacion = date_create($finalizacion);
                            $cadena_finalizacion = date_format($date_finalizacion, 'd-m-Y');


                            $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }


                            $res= $idActa.'||'.$ciclo.'--'.$nombreAsignatura.'--'.$idPlan.'||'.$cadena_fecha_actual.'||'.$cadena_finalizacion;
                        }

                        echo $res;

      
        break;        
    case 3://baja
        $consulta = "DELETE FROM `actas_examen_datos` WHERE `idActa`='$idActa'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


        $consulta = "DELETE FROM `acta_examen_inscrip` WHERE `idActa`='$idActa'";        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();


                                
        break;        
}

$conexion = NULL;