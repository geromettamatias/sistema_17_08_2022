<?php
                  
                  include_once '../../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();
                  session_start();
                  $cicloLectivo=$_SESSION['cicloLectivoFina'];


                  $cat="";


                  $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo`";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($data1 as $da1t) { 
                    $nombre=$da1t['nombre'];

                     $cat.="<option value='".$nombre."' >".$nombre."</option>";


                  }

                  $cat.="<option value='TODAS LAS COLUMNAS' >TODAS LAS COLUMNAS</option>";

                  echo $cat;

?>