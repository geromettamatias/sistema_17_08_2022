<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E.E.T. N° 16</title>
<style type="text/css">



.customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:140%;

  background-image: url("../../../../elementos/logo_LIBR.png");
  background-size: 30%;
  background-repeat: no-repeat;

  background-position:center;
}

.customers td, .customers th {
  border: 2px solid #031C44;
  padding: 2px;
}

.customers th {
  padding-top: 2px;
  padding-bottom: 2px;
 

}




.boton_personalizado{
    text-decoration: none;
    padding: 2px;
    font-weight: 600;
    font-size: 20px;
    color: #ffffff;
    background-color: #1883ba;
    border-radius: 6px;
    border: 2px solid #0016b0;
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
    size: legal landscape;
    margin: 1cm;  /* this affects the margin in the printer settings */


}

header, footer, nav, aside {
  display: none;
}

#ocultarBotonImpri {
  display: none;
}


.customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:120%;
  
}

.customers td, .customers th {
  border: 2px solid #031C44;
  padding: 2px;
   
}

.customers th {
  padding-top: 2px;
  padding-bottom: 2px;
 

}

.letras{
  color:#000000;
}

.NOTA_0{
  color:#000000;
}


h1 {
  text-align: left;
}


p {
  text-align: justify;
}

</style>


              





</div>



<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

$contadorColumnaFinalTo=0;
if (isset($_SESSION['cursoSeProfesor'])){
$cursoSeProfesor=$_SESSION['cursoSeProfesor'];

$cicloLectivo=$_SESSION['cicloLectivoFina'];

 $idUsuario=$_SESSION["idUsuario"];
        $dni=$_SESSION["dni"];
        $nombre=$_SESSION["nombre"];
        $cargo=$_SESSION["cargo"];
        $nivelCurso=$_SESSION["nivelCurso"];
        $operacion=$_SESSION["operacion"];
      




 
$consulta = "SELECT `asignacion_asignatura_docente_$cicloLectivo`.`idCurso`, `asignacion_asignatura_docente_$cicloLectivo`.`idAsignatura`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso', `plan_datos_asignaturas`.`nombre` AS 'nombreAsignacion' FROM `asignacion_asignatura_docente_$cicloLectivo` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivo`.`idCurso` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `asignacion_asignatura_docente_$cicloLectivo`.`idAsignatura` WHERE `asignacion_asignatura_docente_$cicloLectivo`.`idAsig` = '$cursoSeProfesor'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($dat1a as $da1t) { 
            $idCurso=$da1t['idCurso'];
            $idAsignatura=$da1t['idAsignatura'];

            $nombreCurso=$da1t['nombreCurso'];
            $nombreAsignacion=$da1t['nombreAsignacion'];
        }



?>


                <span style='font-size: 14px; vertical-align:middle;'>APELLIDO Y NOMBRE: <?php echo $nombre; ?> <br> DNI: <?php echo $dni; ?><br> TIPO: <?php echo $cargo; ?></span>
                <hr>
                    <span style='font-size: 14px; vertical-align:middle;'>CURSO: <?php echo $nombreCurso; ?> <br> ASIGNATURA: <?php echo $nombreAsignacion; ?></span>
          

         
                        <table class="customers" style="width:100%">
                        <thead >
                            <tr style='font-size: 10px; vertical-align:middle;'>
                                                       
                                <th>N°</th> 
                                <th>APELLIDO Y NOMBRE</th>
                                <th>DNI</th>
                                <?php
                                    $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo`";
                                    $resultado = $conexion->prepare($consulta);
                                    $resultado->execute();
                                    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                    $contador=0;

                                    $columnas = array(); 
                                    $preguntaDocente = array(); 

                               

                                    foreach($data1 as $dat1) {
                                        $contador++;                                                        
                                ?>
                                <th><?php 

                                array_push($preguntaDocente, $dat1['editarDocente']);
                                array_push($columnas, $dat1['nombre']);
                              



                                echo $dat1['nombre'] ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                             $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `inscrip_curso_alumno_$cicloLectivo` ON `inscrip_curso_alumno_$cicloLectivo`.`idIns` = `libreta_digital_$cicloLectivo`.`idIns` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `libreta_digital_$cicloLectivo`.`idAsig` ='$idAsignatura' AND `curso_$cicloLectivo`.`nombre`= '$nombreCurso'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                           
                            foreach($data as $dat) {

                            $id_libretaF=$dat['id_libreta'];
                            $nombre=$dat['nombreAlumnos'];
                            $dniAlumnos=$dat['dniAlumnos'];
                            ?>
                            <tr style='font-size: 10px; vertical-align:middle;'>

                                <td><?php 


                                $contadorColumnaFinalTo++;

                                echo $contadorColumnaFinalTo;

                                 ?></td>
                                <td><?php echo $nombre; ?></td>
                                <td><?php echo $dniAlumnos; ?></td>
                            
                                    <?php 
                                    $nota=0;
                                
                                foreach ($columnas as &$Nombrecolum) {

                                        $consulta = "SELECT  `$Nombrecolum` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                         foreach($data as $dat) {

                                            $notaFinal=$dat[''.$Nombrecolum.''];

                                        }



                                    $nota = explode("||&||", $notaFinal);
                                    $contador=0;
                                    $var='';


                                    foreach ($nota as $not) {
                                        if ($contador==0) {
                                          $var.='<b>'.$not.':</b> ';
                                          $contador=1;
                                        }else{
                                          $var.=$not.'<br>';
                                          $contador=0;
                                        }
                                    }

                                    $cantidadNota=count($nota);

                             
                                     if ($cantidadNota==1) {
                                      
                                      
                                            if ($notaFinal=='3' || $notaFinal=='4' || $notaFinal=='5' || $notaFinal=='2' || $notaFinal=='1' || $notaFinal=='0') {
                                               echo '<td>EP</td>';
                                            }else{

                                                    if ($notaFinal=='undefined'){

                                                      echo '<td></td>';
                                                    }else{

                                                      echo '<td>'.$notaFinal.'</td>';
                                                    }
                                                
                                            }
                                    }else{
                                       echo '<td>'.$var.'</td>';
                                    }


                                }
                            
                            ?> 
                            </tr>
                            <?php
                                
                            }
                            ?>                                
                        </tbody>        
                       </table>                    






<br><br><br><br>



  <table  style="text-align: center;width:100%; font-size: 25px" >
                                <thead>
                                    <tr>
                                        <th>...............................</th>
                                        <th>...............................</th> 
                                        <th>...............................</th>                         
                                        
                                    </tr>
                                </thead>
                                 <tfoot>
                               
                            </tfoot>
                                <tbody>
                                 
                                    <tr>       
                                        <td>AUTORIDADES</td>
                                        <td>Sello de la Institución</td>
                                        <td>PROF: <?php 
                        




                   echo $_SESSION["nombre"].'<br>DNI: '.$_SESSION["dni"];



                                         ?></td>
                                    </tr>
                                 
                               


                                </tbody>

                               

                               </table>






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






