<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$res='';
$idActa = (isset($_POST['idActa'])) ? $_POST['idActa'] : '';



        $consulta = "SELECT datos_docentes1.nombre AS 'docentePresidente', datos_docentes2.nombre AS 'docente1erSuplente', datos_docentes3.nombre AS 'docente2doSuplente' FROM actas_examen_datos INNER JOIN datos_docentes AS datos_docentes1 ON datos_docentes1.idDocente = actas_examen_datos.docente1 INNER JOIN datos_docentes AS datos_docentes2 ON datos_docentes2.idDocente = actas_examen_datos.docente2 INNER JOIN datos_docentes AS datos_docentes3 ON datos_docentes3.idDocente = actas_examen_datos.docente3 WHERE actas_examen_datos.idActa = '$idActa'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
      
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                
                            $docentePresidente=$dat['docentePresidente'];
                            $docente1erSuplente=$dat['docente1erSuplente'];
                            $docente2doSuplente=$dat['docente2doSuplente'];
                          
                            $res= $docentePresidente.'||'.$docente1erSuplente.'||'.$docente2doSuplente;
                        }

                        echo $res;
     

$conexion = NULL;