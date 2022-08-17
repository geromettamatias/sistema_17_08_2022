<?php
                  
                  include_once '../../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();

                  $cat="";


              
                  $consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` ORDER BY `ciclo`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $ciclo=$da1t['ciclo'];
                    $edicion=$da1t['edicion'];

                    if ($edicion=='SI') {
                      $cat.="<option value='".$ciclo."'>".$ciclo."</option>";
                    }

                     


                  }

                  echo $cat;

?>



    



