<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$res='';
$idActa = (isset($_POST['idActa'])) ? $_POST['idActa'] : '';



        $consulta = "SELECT actas_examen_datos.idAsignatura, plan_datos_asignaturas.nombre AS 'nombreAsignatura', actas_examen_datos.precentacion, actas_examen_datos.finalizacion, actas_examen_datos.docente1, datos_docentes1.nombre AS 'docente1Nombre',datos_docentes1.dni AS 'docente1dni', actas_examen_datos.docente2, datos_docentes2.nombre AS 'docente2Nombre', datos_docentes2.dni AS 'docente2dni', actas_examen_datos.docente3, datos_docentes3.nombre AS 'docente3Nombre', datos_docentes3.dni AS 'docente3dni', plan_datos_asignaturas.idPlan, plan_datos_asignaturas.ciclo FROM actas_examen_datos INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = actas_examen_datos.idAsignatura INNER JOIN datos_docentes AS datos_docentes1 ON datos_docentes1.idDocente = actas_examen_datos.docente1 INNER JOIN datos_docentes AS datos_docentes2 ON datos_docentes2.idDocente = actas_examen_datos.docente2 INNER JOIN datos_docentes AS datos_docentes3 ON datos_docentes3.idDocente = actas_examen_datos.docente3 WHERE actas_examen_datos.idActa='$idActa'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
      
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                
                            $idAsignatura=$dat['idAsignatura'];
                            $precentacion=$dat['precentacion'];
                            $finalizacion=$dat['finalizacion'];

                            $docente1=$dat['docente1'];
                            $docente2=$dat['docente2'];
                            $docente3=$dat['docente3'];

                            $nombreAsignatura=$dat['nombreAsignatura'];
                            
                            $docente1Nombre=$dat['docente1Nombre'];
                            $docente2Nombre=$dat['docente2Nombre'];
                            $docente3Nombre=$dat['docente3Nombre'];

                            $docente1dni=$dat['docente1dni'];
                            $docente2dni=$dat['docente2dni'];
                            $docente3dni=$dat['docente3dni'];

                            $idPlan=$dat['idPlan'];
                            $ciclo=$dat['ciclo'];

                                $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }
                          
                       
                          
                            $res= $idAsignatura.'||'.$precentacion.'||'.$docente1.'||'.$docente2.'||'.$docente3.'||'.$finalizacion.'||'.$ciclo.'--'.$nombreAsignatura.'--'.$idPlan.'||'.$docente1Nombre.'--'.$docente1dni.'||'.$docente2Nombre.'--'.$docente2dni.'||'.$docente3Nombre.'--'.$docente3dni;
                        }

                        echo $res;
     

$conexion = NULL;