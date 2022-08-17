<?php

                             include_once '../../bd/conexion.php';
                              $objeto = new Conexion();
                              $conexion = $objeto->Conectar();

                              session_start();

                  
                            $idDocente=$_SESSION['idUsuario'];

                            
                            $cicloLectivoFINAL=$_SESSION['cicloLectivoInicio'];
                            $profesor=$_SESSION['profesor'];


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
  text-align: center;
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
    size: legal landscape;
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
  text-align: center;
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

 





            <h1>DECLARACIÓN JURADA DE CARGO</h1>
<h2><?php echo $profesor; ?></h2>

<h2>Declaración Horas Catedras</h2>    
<br>
                             <table id="customers" style='font-size: 12px;text-align: center; width:100%'>
                         <thead>
                            <tr>
                            
                                <th>N°</th>
                                <th>CURSOS</th> 
                                <th>ASIGNATURA</th>
                                <th>SITUACIÓN</th>
                                <th>LUNES</th>
                                <th>MARTES</th>
                                <th>MIERCOLES</th>
                                <th>JUEVES</th>
                                <th>VIERNES</th>
                                <th>DESDE</th>
                                <th>HASTA</th> 
                                <th>OBSER</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            
                            
                            $consulta = "SELECT `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsig`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsignatura`, `plan_datos_asignaturas`.`nombre`, `curso_$cicloLectivoFINAL`.`idCurso`, `curso_$cicloLectivoFINAL`.`nombre` AS 'nombreCurso',`asignacion_asignatura_docente_$cicloLectivoFINAL`.`situacion`,`asignacion_asignatura_docente_$cicloLectivoFINAL`.`desde`,`asignacion_asignatura_docente_$cicloLectivoFINAL`.`hasta`,`asignacion_asignatura_docente_$cicloLectivoFINAL`.`obserbaci` FROM `asignacion_asignatura_docente_$cicloLectivoFINAL` INNER JOIN `plan_datos_asignaturas` ON `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsignatura` = `plan_datos_asignaturas`.`idAsig` INNER JOIN `curso_$cicloLectivoFINAL` ON `curso_$cicloLectivoFINAL`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idCurso`WHERE `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                                
                            foreach($data as $dat) { 




                              $idAsignatura=$dat['idAsignatura'];
                              $idCurso=$dat['idCurso'];




                              $Lunes='';
                              $Martes='';
                              $Miercoles='';
                              $Jueves='';
                              $Viernes='';




$consulta = "SELECT `idDescrip`, `idAsignatura`, `dia`, `horario`, `corresponde`, `curso`, `idCurso` FROM `descripasig_2021` WHERE `idAsignatura`='$idAsignatura' AND `idCurso` ='$idCurso' ORDER BY `dia`, `horario`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach($dat1a as $da1t) { 

  $dia=$da1t['dia'];
  $horario=$da1t['horario'];



  if ($dia=='LUNES') {
    $Lunes.='<br>'.$horario;
                        
  }else if ($dia=='MARTES') {
    $Martes.='<br>'.$horario;
       
  }else if ($dia=='MIERCOLES') {
    $Miercoles.='<br>'.$horario;
       
  }else if ($dia=='JUEVES') {
    $Jueves.='<br>'.$horario;
       
  }else{
    $Viernes.='<br>'.$horario;
       
  }



}





                            ?>
                            <tr>
                             
                                <td><?php echo $dat['idAsig'] ?></td>
                                <td><?php echo $dat['nombreCurso'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['situacion'] ?></td>
                                <td><?php 

                                if ($Lunes=='') {
                                  echo '----';
                                }else{
                                  echo $Lunes;
                                }

                                 ?></td>
                                <td><?php

                                if ($Martes=='') {
                                  echo '----';
                                }else{
                                  echo $Martes;
                                }

                                 ?></td>
                                <td><?php

                                if ($Miercoles=='') {
                                  echo '----';
                                }else{
                                  echo $Miercoles;
                                }

                                 ?></td>
                                <td><?php

                                if ($Jueves=='') {
                                  echo '----';
                                }else{
                                  echo $Jueves;
                                }
                                 ?></td>
                                <td><?php

                                if ($Viernes=='') {
                                  echo '----';
                                }else{
                                  echo $Viernes;
                                }
                                 ?></td>
                                <td><?php echo $dat['desde'] ?></td>
                                <td><?php echo $dat['hasta'] ?></td>
                                <td><?php echo $dat['obserbaci'] ?></td>

                              
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>                 
                       </table>   

                       <br>
<h2>Declaración Cargos</h2>  
<br>

                        <table id="customers" style='font-size: 12px;text-align: center; width:100%'>
                         <thead>
                           <tr>
                         
                                <th>N°</th>
                                <th>CARGO</th> 
                                <th>SITUACIÓN</th>
                                <th>DESDE</th>
                                <th>HASTA</th>
                                <th>LUNES</th>
                                <th>MARTES</th>
                                <th>MIERCOLES</th>
                                <th>JUEVES</th>
                                <th>VIERNES</th> 
                
                            </tr>
                        </thead>
                         <tbody>
                            <?php

                            
                            
                            $consulta = "SELECT `id_asig_cargo`, `idDocente`, `cargo`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes` FROM `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL` WHERE `idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $da1ta=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                                
                            foreach($da1ta as $d1at) {                                                        
                            ?>
                            <tr>
                             
                                <td><?php echo $d1at['id_asig_cargo'] ?></td>
                                <td><?php echo $d1at['cargo'] ?></td>
                                <td><?php echo $d1at['situacion'] ?></td>
                                <td><?php echo $d1at['desde'] ?></td>
                                <td><?php echo $d1at['hasta'] ?></td>
                                <td><?php 


                                $lunes = explode("//", $d1at['lunes']);

                                echo $lunes[1]; 

                                 ?></td>
                                <td><?php 

                                $martes = explode("//", $d1at['martes']);

                                echo $martes[1]; 

                                ?></td>
                                <td><?php 

                                $miercoles = explode("//", $d1at['miercoles']);

                                echo $miercoles[1]; 


                                ?></td>
                                <td><?php 

                                $jueves = explode("//", $d1at['jueves']);

                                echo $jueves[1]; 

                                 ?></td>
                                <td><?php 

                                $viernes = explode("//", $d1at['viernes']);

                                echo $viernes[1];

                                ?></td>


                             
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>              
                       </table>                    
      

<br>


                       <br>
<h2>Declaración Cargos</h2>  
<br>

                        <table id="customers" style='font-size: 12px;text-align: center; width:100%'>
                         <thead>
                           <tr>
                         
                                <th>N°</th>
                                <th>CARGO</th> 
                                <th>SITUACIÓN</th>
                                <th>DESDE</th>
                                <th>HASTA</th>
                                <th>LUNES</th>
                                <th>MARTES</th>
                                <th>MIERCOLES</th>
                                <th>JUEVES</th>
                                <th>VIERNES</th> 
                
                            </tr>
                        </thead>
                         <tbody>
                            <?php

                            
                            
                            $consulta = "SELECT `id_asig_proyecto`, `idDocente`, `cHoras`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `licencia` FROM `asignacion_asignatura_docente_proyecto_$cicloLectivoFINAL` WHERE `idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $da1ta=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                                
                            foreach($da1ta as $d1at) {                                                        
                            ?>
                            <tr>
                             
                                <td><?php echo $d1at['id_asig_proyecto'] ?></td>
                                <td><?php echo $d1at['cHoras'] ?></td>
                                <td><?php echo $d1at['situacion'] ?></td>
                                <td><?php echo $d1at['desde'] ?></td>
                                <td><?php echo $d1at['hasta'] ?></td>
                                <td><?php 


                                $lunes = explode("//", $d1at['lunes']);

                                echo $lunes[1]; 

                                 ?></td>
                                <td><?php 

                                $martes = explode("//", $d1at['martes']);

                                echo $martes[1]; 

                                ?></td>
                                <td><?php 

                                $miercoles = explode("//", $d1at['miercoles']);

                                echo $miercoles[1]; 


                                ?></td>
                                <td><?php 

                                $jueves = explode("//", $d1at['jueves']);

                                echo $jueves[1]; 

                                 ?></td>
                                <td><?php 

                                $viernes = explode("//", $d1at['viernes']);

                                echo $viernes[1];

                                ?></td>


                             
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>              
                       </table>                    
      

<br>

<hr>
<br><br>

<div style="float:left;width: 50%;"><span>___________________________________</span></div>

<div style="float:left;width: 50%;"><span>____________________________</span></div>

<div style="float:left;width: 50%;"><span>Firma y Sello de la institución</span></div>

<div style="float:left;width: 50%;"><span>Notificación</span></div>
























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

