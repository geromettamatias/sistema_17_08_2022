<?php
    include_once '../../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    session_start();
    if (isset($_SESSION['idIns'])){
        $idIns=$_SESSION['idIns'];


           $cicloLectivo=$_SESSION['cicloLectivoFina'];
        

        if ($idIns!=1){


                $c2onsulta = "SELECT `datosalumnos`.`idAlumnos`, `datosalumnos`.`nombreAlumnos`,  `datosalumnos`.`dniAlumnos`, `datosalumnos`.`cuilAlumnos`, `datosalumnos`.`domicilioAlumnos`, `datosalumnos`.`telefonoAlumnos`, `datosalumnos`.`nombreTutor`, `datosalumnos`.`dniTutor`,`datosalumnos`.`TelefonoTutor`, `curso_$cicloLectivo`.`nombre`,`plan_datos`.`numero`, `datosalumnos`.`fechaNa`, `datosalumnos`.`nLegajos`, `datosalumnos`.`nacido`, `datosalumnos`.`procedencia`, `datosalumnos`.`nacionalidadTutor` FROM `inscrip_curso_alumno_$cicloLectivo` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` INNER JOIN `plan_datos` ON `plan_datos`.`idPlan` = `datosalumnos`.`idPlanEstudio` WHERE `inscrip_curso_alumno_$cicloLectivo`.`idIns`='$idIns'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $idAlumno=$d2at['idAlumnos'];
                    $nombreAlumnos=$d2at['nombreAlumnos'];
                    $dniAlumnos=$d2at['dniAlumnos'];
                    $nombreCurso=$d2at['nombre'];



                    $fechaNa=$d2at['fechaNa'];
                    $nLegajo=$d2at['nLegajos'];
                    $nacionalidadAlumno=$d2at['nacido'];
                    $procedenciaAlumno=$d2at['procedencia'];
                    $nacionalidadTutor=$d2at['nacionalidadTutor'];



                    if ($fechaNa=='') {
                      $fechaNa='_________';
                    }
                    if ($nLegajo=='') {
                      $nLegajo='_________';
                    }
                    if ($nacionalidadAlumno=='') {
                      $nacionalidadAlumno='________________________________________________________';
                    }
                    if ($procedenciaAlumno=='') {
                      $procedenciaAlumno='______________________';
                    }
                    if ($nacionalidadTutor=='') {
                      $nacionalidadTutor='______________________';
                    }



                     $cuilAlumnos=$d2at['cuilAlumnos'];
                     $domicilioAlumnos=$d2at['domicilioAlumnos'];
                     $telefonoAlumnos=$d2at['telefonoAlumnos'];
                     $nombreTutor=$d2at['nombreTutor'];
                     $dniTutor=$d2at['dniTutor'];
                     $TelefonoTutor=$d2at['TelefonoTutor'];
                     $numero=$d2at['numero'];

                    
                 } 

                 $decimales = explode('...',$numero);


                  $provi = $decimales[0];
                  $provi2 = $decimales[1];
                  $nacional = $decimales[2];
                  $modalidad = $decimales[3];



              $Libro='_________';
              $Folio='_________';



         


              $auxiliar='____________________________';

              $piePagina='____________________________';

              $c2onsulta = "SELECT `idDatoExtraFicha`, `idAlumno`, `Libro`, `Folio`, `auxiliar`, `piePagina` FROM `datosficha_$cicloLectivo` WHERE `idAlumno`= '$idAlumno'";
                $r2esultado = $conexion->prepare($c2onsulta);
                $r2esultado->execute();
                $d2ata=$r2esultado->fetchAll(PDO::FETCH_ASSOC);

                foreach($d2ata as $d2at) {
                    $Libro=$d2at['Libro'];
                    $Folio=$d2at['Folio'];
               
                    $auxiliar=$d2at['auxiliar'];
                    $piePagina=$d2at['piePagina'];
                 } 







}}

                    
?>
















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 'Ficha digital de '.$nombreAlumnos; ?></title>

<style type="text/css">



.customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:120%;

  background-image: url("../../../../elementos/logo_LIBR.png");
  background-size: 40%;
  background-repeat: no-repeat;

  background-position:center;
}

.customers td, .customers th {
  border: 2px solid #031C44;
  padding: 1px;
}

.customers th {
  padding-top: 1px;
  padding-bottom: 1px;
 

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




.customers2 {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size:130%;

  background-image: url("../../../../elementos/logo_LIBR.png");
  background-size: 15%;
  background-repeat: no-repeat;

  background-position:center;
  
}

.customers2 td, .customers2 th {
  border: 2px solid #031C44;
  padding: 0px;
   
}

.customers2 th {
  padding-top: 1px;
  padding-bottom: 1px;
 

}

.border {
  border: red 5px dashed;
}

.Cuar{
  border: 2px solid #031C44;
}

</style>
</head>
<body>




<div id="ocultarBotonImpri" class="container ">
  <div class="row ">
    <div class="col-lg-12 p-4 ">
      <button class="boton_personalizado  print">Imprimir </button>
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
  font-size:130%;
  
}

.customers td, .customers th {
  border: 2px solid #031C44;
  padding: 1px;
   
}

.customers th {
  padding-top: 1px;
  padding-bottom: 1px;
 

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







.customers2 {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 90%;
  font-size:130%;

 background-image: url("../../../../elementos/logo_LIBR.png");
  background-size: 15%;
  background-repeat: no-repeat;

  background-position:center;
  
}

.customers2 td, .customers2 th {
  border: 2px solid #031C44;
  padding: 0px;
   
}

.customers2 th {
  padding-top: 1px;
  padding-bottom: 1px;
 

}

.border {
  border: red 5px dashed;
}

.Cuar{
  border: 2px solid #031C44;
}

</style>




<div class="letras" style="float:left;width: 95%;">

<span style='font-size: 16px;'>Alumno: <b><?php  echo $nombreAlumnos;?></b>; curso y división: <b><?php  echo $nombreCurso;?></b>   Libro: <b><?php  echo $Libro;?></b>; Folio: <b><?php  echo $Folio;?></b>; N° Legajo: <b><?php  echo $nLegajo;?></b><br>

Nacido en:<?php  echo $nacionalidadAlumno;?>;  DNI: <b><?php  echo $dniAlumnos;?></b>;  CUIL:<b><?php  echo $cuilAlumnos;?></b>;  Fecha de Nacimiento:<b><?php  echo $fechaNa;?></b>; T.E.A: <?php  echo $telefonoAlumnos;?><br>
Nombre del Tutor: <?php  echo $nombreTutor;?>; Nacionalidad: <?php  echo $nacionalidadTutor;?>;  DNI:<b><?php  echo $dniTutor;?></b> <br>
Domicilio: <?php  echo $domicilioAlumnos;?>; T.E.T: <?php  echo $TelefonoTutor;?>


</span>


</div>

<div class="letras" style="float:left;width: 5%;">

<table class="Cuar" >
   <thead class="letras">
                          <tr>
                                <th><span style='  font-size: 28px; text-transform: uppercase;'><?php  echo $cicloLectivo;?></span></th>
                                
                        

                            </tr>
                        </thead>
  
</table>


 


</div>

<br><br><br><br><br>

        <table  class="customers"  style="width:100%" >
                        <thead class="letras">
                          <tr>
                                <th style="width: 2%;"><span style='justify-content: center;  font-size: 15px;'  >Asignatura</span></th>
                                
                                <?php
                                    $consulta = "SELECT `idCabezera`, `nombre`, `descri`, `editarDocente`, `corresponde` FROM `cabezera_libreta_digital_$cicloLectivo`";
                                    $resultado = $conexion->prepare($consulta);
                                    $resultado->execute();
                                    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                    $contador=0;

                                    $columnas = array();

                                     $nom=0; 

                               

                                    foreach($data1 as $dat1) {
                                        $contador++; 

                                        $descri=$dat1['descri'];

                                        if ($descri=='INFORME') {
                                               array_push($columnas, $dat1['nombre']);
                                       
                                   

                                                                                      
                                ?>
                                <th  style="justify-content: center;width: 50%; height: 70px"><span style='justify-content: center;  font-size: 15px;'>
                                <?php echo $dat1['nombre']; ?></span></th>
                                <?php 
                                 } 
                                $nom++;


                           
                             }


?>


                            </tr>
                        </thead>
                        <tbody class="letras">

                            <?php 
                          
                            $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `plan_datos_asignaturas`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `plan_datos_asignaturas` ON `plan_datos_asignaturas`.`idAsig` = `libreta_digital_$cicloLectivo`.`idAsig` WHERE `libreta_digital_$cicloLectivo`.`idIns`='$idIns'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                           
                            foreach($data as $dat) {

                            $id_libretaF=$dat['id_libreta'];
                            $nombre=$dat['nombre'];
                           
                            ?>
                            <tr>

                              
                                <td ><span style='justify-content: center;  font-size: 10px;'><b><?php echo $nombre; ?></b></span></td>
                        
                            
                                    <?php 
                                    $notaFinal=0;
                                    $contadoresF=0;
                                    foreach ($columnas as &$Nombrecolum) {

                                         $consulta = "SELECT `id_libreta`, `$Nombrecolum` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                         foreach($data as $dat) {

                                            $notaFinal=$dat[''.$Nombrecolum.''];

                                        }



                                        $contadoresF++;
                                    ?>
                                    

                                    <td style='justify-content: center;'><span style='font-size: 12px; text-align: center;'><?php 




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

                                    if (($var=='') || ($nota=='undefined') || ($cantidadNota==1)) {
                                      echo 'SIN INFORME';
                                    }else{
                                       echo $var;
                                    }
        
                                


                                 ?></span></td>


                                    <?php

                                    
                                    }

                                     ?>

                          
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>


<br>

<div class="letras" style="float:left;width: 20%;">

<table class="Cuar" >
   <thead class="letras">
                          <tr>
                                <th><span style='  font-size: 15px; text-transform: uppercase; padding: 5px'><b>Promedio general:<br>..................con.................</b></span></th>
                                
                        

                            </tr>
                        </thead>
  
</table>


 


</div>

<div class="letras" style="float:left;width: 80%;">



<span style='font-size: 13px;'>

  Observaciones: NORMA JURISD. DE APROB. PLAN DE ESTUDIOS: <?php echo $provi; ?>; NORMA JURISD. DE RATIFICACIÓN DEL DICTAMEN: <?php echo $provi2; ?>; VALIDEZ NACIONAL otorgada por: <?php echo $nacional; ?> <br>
  <?php echo $piePagina; ?><br><br>

  <b>......................................................................Firma del Auxiliar Docente que entrega  ...........................................</b>


</span>



</div>


     
</div>           




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script type="text/javascript">

        $(".print").click(function() {
  window.print();
});
</script>   
</body>
</html>
