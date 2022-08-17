<?php
    include_once '../../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    session_start();



    if ((isset($_SESSION['idActa_inscriAlumno'])) && (isset($_SESSION['contadorAlumno'])) && (isset($_SESSION['contadorAlumno']))){
        $idActa_inscriAlumno=$_SESSION['idActa_inscriAlumno'];
        $contadorAlumno=$_SESSION['contadorAlumno'];
        $contador=$_SESSION['contador'];
        $contador++;


$cantidadNumero=25;

$contadorEscala=0;
$contaMenor=0;
$contaMayor=$cantidadNumero;
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E.E.T. N° 16</title>
<style type="text/css" >
 
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;

  font-size:140%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 8px;
  padding-bottom: 8px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}


.boton_personalizado{
    text-decoration: none;
    padding: 10px;
    font-weight: 600;
    font-size: 20px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
  }




.fechaTable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  text-align: center;
}

.fechaTable td, .fechaTable th {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center;
}



.fechaTable th {
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: left;
  background-color: #134CA9;
  color: white;
  text-align: center;
}

h1 {
  text-align: left;
}


p {
  text-align: justify;
}



.tablaFinal {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 80%;
  text-align: center;
}

.tablaFinal td, .tablaFinal th {
  border: 1px solid #ddd;
  padding: 5px;
  text-align: center;

}



.tablaFinal th {
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: left;
  text-align: center;
}




</style>
 
</head>
<body>

<div id="ocultarBotonImpri" class="container ">
  <div class="row ">
    <div class="col-lg-12 p-4 ">
      <button class="boton_personalizado  print">Imprimir</button>
    </div>
  </div>
</div>


<div class="imprimir" id="imprimir">
        <!-- Compiled and minified CSS -->

                <style type="text/css" media="print">
   @media print {
 
    #sidebar {
        display:none;
    } 
    main {
        float:none;
    } 
}

@page{    
    size: legal;
    margin: 1cm;  /* this affects the margin in the printer settings */

    

}

header, footer, nav, aside {
  display: none;
}

#ocultarBotonImpri {
  display: none;
}


#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:140%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 8px;
  padding-bottom: 8px;
  text-align: left;
  background-color: #4CAF50;
  color: white;

}





.fechaTable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  text-align: center;
}

.fechaTable td, .fechaTable th {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center;

}



.fechaTable th {
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: left;
  
  text-align: center;
}


.tablaFinal {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 80%;
  text-align: center;
}

.tablaFinal td, .tablaFinal th {
  border: 1px solid #ddd;
  padding: 5px;
  text-align: center;

}



.tablaFinal th {
  padding-top: 10px;
  padding-bottom: 10px;
  text-align: left;
  

  text-align: center;
}




h1 {
  text-align: left;
}


p {
  text-align: justify;
}

</style>

              
<?php
 
  for ($i=0; $i < $contador; $i++) { 




    if ($i != $contador) {



             $consulta = "SELECT actas_examen_datos.idActa,actas_examen_datos.tipo, plan_datos_asignaturas.ciclo, plan_datos_asignaturas.nombre AS 'nombreAsignatura', plan_datos_asignaturas.idPlan, actas_examen_datos.precentacion, actas_examen_datos.finalizacion, datos_docentes1.nombre AS 'docentePresidente', datos_docentes2.nombre AS 'docente1erSuplente', datos_docentes3.nombre AS 'docente2doSuplente' FROM actas_examen_datos INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = actas_examen_datos.idAsignatura INNER JOIN datos_docentes AS datos_docentes1 ON datos_docentes1.idDocente = actas_examen_datos.docente1 INNER JOIN datos_docentes AS datos_docentes2 ON datos_docentes2.idDocente = actas_examen_datos.docente2 INNER JOIN datos_docentes AS datos_docentes3 ON datos_docentes3.idDocente = actas_examen_datos.docente3 WHERE actas_examen_datos.idActa = '$idActa_inscriAlumno'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);



                            foreach($d1ata as $d1at) { 

                              

                            $idActa=$d1at['idActa'];
                            $tipo=$d1at['tipo'];
                            $ciclo=$d1at['ciclo'];
                            $idPlan=$d1at['idPlan'];
                            $nombreAsignatura=$d1at['nombreAsignatura'];
                            $precentacion=$d1at['precentacion'];
                            $finalizacion=$d1at['finalizacion'];



                            $date = date_create($precentacion);
                                $cadena_fecha_actual = date_format($date, 'd-m-Y');

                            $date_finalizacion = date_create($finalizacion);
                            $cadena_finalizacion = date_format($date_finalizacion, 'd-m-Y');



                            $docente1=$d1at['docentePresidente'];
                            $docente2=$d1at['docente1erSuplente'];
                            $docente3=$d1at['docente2doSuplente'];

                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }


                }

?>





<div style="page-break-before: always;">






                        <img src="../../../../elementos/cabesera.png">
           
                  <div style="float:left;width: 60%;"><h1><?php echo $tipo; ?></h1></div>


                  <div style="float:left;width: 40%;">


                    <table  class="fechaTable">
                                <thead>
                                    <tr>
                                 
                        
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Cierre</th>
                                                             
                                        
                                    </tr>
                                </thead>
                                 <tfoot>
                               
                            </tfoot>
                                <tbody>
                              
                                 
                                  
                                    <tr>
                                      
                             
                                        <td><?php echo $cadena_fecha_actual; ?></td>
                                        <td><?php echo $cadena_finalizacion; ?></td>
                                     
                                    </tr>


                                </tbody>

                               

                               </table>

                        </div>
            <br><br><br><br><br>
            <h1>E.E.T.N° 16  "1° DE MAYO"</h1>
            <h2>Periodo de intensificación de los aprendizajes:__________________________________________________</h2> 
            <h2>ASIGNATURA: <?php echo $nombreAsignatura; ?> --  AÑO: <?php echo $ciclo; ?></h2>


                                    
                                <table id="customers">
                                      <thead>
                                    <tr>
                                 
                                        <th style='width: 40px;' rowspan="2">N°</th> 
                                        <th rowspan="2">APELLIDO Y NOMBRE</th>
                                        <th style='width: 100px;' rowspan="2">DNI</th> 
                                        <th colspan="4">Calificaciones</th>

                                        
                                    </tr>

                                    <tr>
                                 
                                        <th>Esc</th> 
                                        <th>Oral</th>
                                        <th style='width: 100px;'>Prom.(numérico)</th> 
                                        <th style='width: 100px;'>Prom. (en letra)</th>
                                                                
                                        
                                    </tr>

                                </thead>
                                 <tfoot>
                               
                            </tfoot>
                                <tbody>
                               <?php  
                               $VP=0;
                                   $consulta = "SELECT acta_examen_inscrip.idInscripcion, datosalumnos.nombreAlumnos, datosalumnos.dniAlumnos, acta_examen_inscrip.notaEsc, acta_examen_inscrip.notaOral, acta_examen_inscrip.promNumérico, acta_examen_inscrip.promLetra FROM acta_examen_inscrip INNER JOIN datosalumnos ON datosalumnos.idAlumnos = acta_examen_inscrip.idAlumno WHERE acta_examen_inscrip.idActa = '$idActa_inscriAlumno'";
                                      $resultado = $conexion->prepare($consulta);
                                      $resultado->execute();
                                      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                      foreach($data as $dat) { 
                                        $contadorEscala++;



                                        if (($contaMenor<$contadorEscala)&&($contaMayor>=$contadorEscala)) {
                                        

                                      $VP++;

                             $idInscripcion=$dat['idInscripcion'];
                            $nombreAlumnos=$dat['nombreAlumnos'];
                            $dniAlumnos=$dat['dniAlumnos'];        
                            $notaEsc=$dat['notaEsc'];
                            $notaOral=$dat['notaOral'];
                            $promNumérico=$dat['promNumérico'];
                            $promLetra=$dat['promLetra'];



                                  
                                  ?>
                                 
                                    <tr>
                                      
                                      
                                 
                                        <td><?php echo $VP; ?></td>
                                        <td><?php echo $nombreAlumnos; ?></td>
                                        <td><?php echo $dniAlumnos; ?></td>
                                        <td><?php echo $notaEsc; ?></td>
                                        <td><?php echo $notaOral; ?></td>
                                        <td><?php echo $promNumérico; ?></td>
                                        <td><?php echo $promLetra; ?></td>

                                        
                                          </tr>
                                   <?php } }  

                                   $VP++;
                                   for ($j= $VP; $j < 26; $j++) { 
                                  ?> 
                                    <tr>
                                         <td><?php echo $j; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                  <?php } ?>




                                </tbody>

                               

                               </table>                    
                         
                         <h2>OBss:________________________________________________________________</h2>       
        
                          <div style="float:left;width: 50%; padding: 20px"><table  class="tablaFinal">
                                <thead>
                                    <tr>
                                        <th>Personal</th>
                                        <th>Firma</th> 
                                        <th>Aclaración</th>                         
                                        
                                    </tr>
                                </thead>
                                 <tfoot>
                               
                            </tfoot>
                                <tbody>
                                 
                                    <tr>
                             
                                        <td>Presidente</td>
                                        <td><?php echo $docente1; ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                             
                                        <td>1-Vocal</td>
                                        <td><?php echo $docente2; ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                             
                                        <td>2-Vocal</td>
                                        <td><?php echo $docente3; ?></td>
                                        <td></td>
                                    </tr>


                                </tbody>

                               

                               </table>
</div>

             
                  <div style="float:left;width: 30%; padding: 20px">


                    <table  class="tablaFinal">
                                 <thead>
                                    <tr>
                                        <th>Total de alumnos</th>
                                        <th style='width: 60px;'></th> 
                                                              
                                        
                                    </tr>
                                </thead>
                                 <tfoot>
                               
                            </tfoot>
                                <tbody>
                                 
                                    <tr>
                             
                                        <td>Aprobados</td>
                                        <td></td>
                                   
                                    </tr>
                                    <tr>
                             
                                        <td>Aplazados</td>
                                       
                                        <td></td>
                                    </tr>
                                    <tr>
                             
                                        <td>Ausentes</td>
                                      
                                        <td></td>
                                    </tr>


                                </tbody>

                               

                               </table>

                        </div>
                
                 
                   


</div>
<?php 
    
    }else{


             $consulta = "SELECT actas_examen_datos.idActa,actas_examen_datos.tipo, plan_datos_asignaturas.ciclo, plan_datos_asignaturas.nombre AS 'nombreAsignatura', plan_datos_asignaturas.idPlan, actas_examen_datos.precentacion, actas_examen_datos.finalizacion, datos_docentes1.nombre AS 'docentePresidente', datos_docentes2.nombre AS 'docente1erSuplente', datos_docentes3.nombre AS 'docente2doSuplente' FROM actas_examen_datos INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = actas_examen_datos.idAsignatura INNER JOIN datos_docentes AS datos_docentes1 ON datos_docentes1.idDocente = actas_examen_datos.docente1 INNER JOIN datos_docentes AS datos_docentes2 ON datos_docentes2.idDocente = actas_examen_datos.docente2 INNER JOIN datos_docentes AS datos_docentes3 ON datos_docentes3.idDocente = actas_examen_datos.docente3 WHERE actas_examen_datos.idActa = '$idActa_inscriAlumno'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);



                            foreach($d1ata as $d1at) { 

                              

                            $idActa=$d1at['idActa'];
                            $tipo=$d1at['tipo'];
                            $ciclo=$d1at['ciclo'];
                            $idPlan=$d1at['idPlan'];
                            $nombreAsignatura=$d1at['nombreAsignatura'];
                            
                            $precentacion=$d1at['precentacion'];
                            $finalizacion=$d1at['finalizacion'];



                            $date = date_create($precentacion);
                                $cadena_fecha_actual = date_format($date, 'd-m-Y');

                            $date_finalizacion = date_create($finalizacion);
                            $cadena_finalizacion = date_format($date_finalizacion, 'd-m-Y');

                            $docente1=$d1at['docentePresidente'];
                            $docente2=$d1at['docente1erSuplente'];
                            $docente3=$d1at['docente2doSuplente'];

                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }


                }

?>
 

<div>



                        <img src="../../cabesera.png">
           
                  <div style="float:left;width: 60%;"><h1><?php echo $tipo; ?></h1></div>


                  <div style="float:left;width: 40%;">

                    <table  class="fechaTable">
                                <thead>
                                    <tr>
                                 
                        
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Cierre</th>
                                                             
                                        
                                    </tr>
                                </thead>
                                 <tfoot>
                               
                            </tfoot>
                                <tbody>
                              
                                 
                                  
                                    <tr>
                                      
                             
                                        <td><?php echo $cadena_fecha_actual; ?></td>
                                        <td><?php echo $cadena_finalizacion; ?></td>
                                     
                                    </tr>


                                </tbody>

                               

                               </table>


        
                              </div>       

                   <br><br><br><br><br>
            <h1>E.E.T.N° 16  "1° DE MAYO"</h1>
            <h2>Periodo de intensificación de los aprendizajes:_______________________________________________________</h2> 
            <h2>ASIGNATURA: <?php echo $nombreAsignatura; ?> --  AÑO: <?php echo $ciclo; ?></h2>


                                <table id="customers">
                                <thead>
                                    <tr>
                                 
                                        <th style='width: 40px;' rowspan="2">N°</th> 
                                        <th rowspan="2">APELLIDO Y NOMBRE</th>
                                        <th style='width: 100px;' rowspan="2">DNI</th> 
                                        <th colspan="4">Calificaciones</th>

                                        
                                    </tr>

                                    <tr>
                                 
                                        <th>Esc</th> 
                                        <th>Oral</th>
                                        <th style='width: 100px;'>Prom.(numérico)</th> 
                                        <th style='width: 100px;'>Prom. (en letra)</th>
                                                                
                                        
                                    </tr>

                                </thead>
                                 <tfoot>
                               
                            </tfoot>
                                <tbody>
                               <?php  
                                $VP=0;
                                    $consulta = "SELECT acta_examen_inscrip.idInscripcion, datosalumnos.nombreAlumnos, datosalumnos.dniAlumnos, acta_examen_inscrip.notaEsc, acta_examen_inscrip.notaOral, acta_examen_inscrip.promNumérico, acta_examen_inscrip.promLetra FROM acta_examen_inscrip INNER JOIN datosalumnos ON datosalumnos.idAlumnos = acta_examen_inscrip.idAlumno WHERE acta_examen_inscrip.idActa = '$idActa_inscriAlumno'";
                                      $resultado = $conexion->prepare($consulta);
                                      $resultado->execute();
                                      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                      foreach($data as $dat) { 
                                        $contadorEscala++;
                                        
                                      
                                     if (($contaMenor<$contadorEscala)&&($contaMayor>=$contadorEscala)) {
                                        

                                     $VP++;    
                             $idInscripcion=$dat['idInscripcion'];
                            $nombreAlumnos=$dat['nombreAlumnos'];
                            $dniAlumnos=$dat['dniAlumnos'];        
                            $notaEsc=$dat['notaEsc'];
                            $notaOral=$dat['notaOral'];
                            $promNumérico=$dat['promNumérico'];
                            $promLetra=$dat['promLetra'];
                                  
                                  ?>
                                 
                                    <tr>
                                      
                                      
                                 
                                        <td><?php echo $VP; ?></td>
                                        <td><?php echo $nombreAlumnos; ?></td>
                                        <td><?php echo $dniAlumnos; ?></td>
                                        
                                        <td><?php echo $notaEsc; ?></td>
                                        <td><?php echo $notaOral; ?></td>
                                        <td><?php echo $promNumérico; ?></td>
                                        <td><?php echo $promLetra; ?></td>

                                        
                                        
                                         
                                          </tr>
                                   <?php } }  

                                   $VP++;
                                   for ($j= $VP; $j < 26; $j++) { 
                                  ?> 
                                    <tr>
                                        <td><?php echo $j; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                  <?php } ?>


                                </tbody>

                               

                                   </table>                    
                         
                         <h2>OB:________________________________________________________________</h2>       
        
                          <div style="float:left;width: 50%; padding: 20px"><table  class="tablaFinal">
                                <thead>
                                    <tr>
                                        <th>Personal</th>
                                        <th>Firma</th> 
                                        <th>Aclaración</th>                         
                                        
                                    </tr>
                                </thead>
                                 <tfoot>
                               
                            </tfoot>
                                <tbody>
                                 
                                    <tr>
                             
                                        <td>Presidente</td>
                                        <td><?php echo $docente1; ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                             
                                        <td>1-Vocal</td>
                                        <td><?php echo $docente2; ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                             
                                        <td>2-Vocal</td>
                                        <td><?php echo $docente3; ?></td>
                                        <td></td>
                                    </tr>


                                </tbody>

                               

                               </table>
</div>

             
                  <div style="float:left;width: 30%; padding: 20px">


                    <table  class="tablaFinal">
                                  <thead>
                                    <tr>
                                        <th>Total de alumnos</th>
                                        <th style='width: 60px;'></th> 
                                                              
                                        
                                    </tr>
                                </thead>
                                 <tfoot>
                               
                            </tfoot>
                                <tbody>
                                 
                                    <tr>
                             
                                        <td>Aprobados</td>
                                        <td></td>
                                   
                                    </tr>
                                    <tr>
                             
                                        <td>Aplazados</td>
                                       
                                        <td></td>
                                    </tr>
                                    <tr>
                             
                                        <td>Ausentes</td>
                                      
                                        <td></td>
                                    </tr>


                                </tbody>

                               

                               </table>

                        </div>
                
                 
                   


</div>


<?php 

   
    } 


$contaMenor=$contaMenor+$cantidadNumero;
$contaMayor=$contaMayor+$cantidadNumero;
$contadorEscala=0; 


  }
       
?>    

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>










 <script type="text/javascript">
$(document).ready(function(){

  $(".print").click(function(e){
    e.preventDefault();
     window.print();
  });





});



</script>



</body>
</html>






<?php } ?> 






