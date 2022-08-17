<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$res='';
$idActa = (isset($_POST['idActa'])) ? $_POST['idActa'] : '';



        $consulta = "SELECT `idActa`, `tipo`, `idAsignatura`, `precentacion`, `docente1`, `docente2`, `docente3`, `finalizacion` FROM `actas_examen_datos` WHERE `idActa` = '$idActa'";
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
                          
                          
                            $res= $idAsignatura.'||'.$precentacion.'||'.$docente1.'||'.$docente2.'||'.$docente3.'||'.$finalizacion;
                        }

                        echo $res;
     

$conexion = NULL;