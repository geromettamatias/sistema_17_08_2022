
<style>

table.table-bordered{
border:1px solid black;

}
table.table-bordered > thead > tr > th{
border:1px solid black;
}
table.table-bordered > tbody > tr > td{
border:1px solid black;
}



table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}



</style>




 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION['cursoSeProfesor'])){
$cursoSeProfesor=$_SESSION['cursoSeProfesor'];

$cicloLectivo=$_SESSION['cicloLectivoFina'];

$idUsuario=$_SESSION["idUsuario"];

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

<input hidden=''  type="text" id="id_asignatura" value="<?php echo $idAsignatura; ?>">
<input hidden=''  type="text" id="id_curso" value="<?php echo $idCurso; ?>">
<input hidden=''  type="text" id="id_usuario" value="<?php echo $idUsuario; ?>">
<input hidden=''  type="text" id="id_cicloLectivo" value="<?php echo $cicloLectivo; ?>" >


 <input hidden=''  type="text" id="nombreAsignacion" value="<?php echo $nombreAsignacion; ?>">
<input hidden=''  type="text" id="nombreCurso" value="<?php echo $nombreCurso; ?>">

<div class="card card-danger card-outline">
<div class="card-header">
<h3 class="card-title">
  <i class="fas fa-edit"></i>
  PLANILLA DE CALIFICACIONES;  CURSO: <?php echo $nombreCurso; ?>; ASIGNATURA: <?php echo $nombreAsignacion; ?>
</h3>
</div>
<div class="card-body">



<form id="inpudProbar">




    <button type="button" id="irImprimir" class="btn btn-outline-info p-2" title="imprimir"><i class="fas fa-print"></i></button>

    <button type="button" class="btn btn-danger p-2 mensaje" title="GUARDAR LOS DATOS EDITADOS DE LA LIBRETA" onclick="mensaje(1)"><i class='fas fa-save'></i> GUARDAR </button>

    <button type="button" class="btn btn-danger p-2 mensaje"  title="Notificar a la institución que se finalizo la carga prevista" onclick="mensaje(2)"><i class='fas fa-handshake'></i> INFORMAR CARGA COMPLETA</button>    


    <button type="button" class="btn btn-success p-2 carga"  title="GUARDAR LOS DATOS EDITADOS DE LA LIBRETA" onclick="ingresarNotaBaseDato()"><i class='fas fa-save'></i> GUARDAR </button>

    <button type="button" class="btn btn-success p-2 carga"  title="Notificar a la institución que se finalizo la carga prevista" onclick="notificar_pre()"><i class='fas fa-handshake'></i> INFORMAR CARGA COMPLETA </button>

 
        <table id="tablaLibreta" class="table table-bordered border-primary table-sm">
        <thead class="text-center">
            <tr>
                                       
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
                    $descrip = array(); 
                    $contadorColumnas=0;
               

                    foreach($data1 as $dat1) {
                        $contador++;

                         array_push($preguntaDocente, $dat1['editarDocente']);

                         $nombreCo=$dat1['nombre'];
                         $descriF=$dat1['descri'];

                array_push($columnas, $dat1['nombre']);
                array_push($descrip, $dat1['descri']);
              
                                     
                ?>
                  <th> <span><div id="nombre-<?php echo $contadorColumnas; 
     $contadorColumnas++; ?>"><?php echo $nombreCo; ?></div></span>
    
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php 

            $colorFinal='';

            $contadorColores=0; 
            $consulta = "SELECT `libreta_digital_$cicloLectivo`.`id_libreta`, `datosalumnos`.`nombreAlumnos`, `datosalumnos`.`dniAlumnos`, `curso_$cicloLectivo`.`nombre` FROM `libreta_digital_$cicloLectivo` INNER JOIN `inscrip_curso_alumno_$cicloLectivo` ON `inscrip_curso_alumno_$cicloLectivo`.`idIns` = `libreta_digital_$cicloLectivo`.`idIns` INNER JOIN `datosalumnos` ON `datosalumnos`.`idAlumnos` = `inscrip_curso_alumno_$cicloLectivo`.`idAlumno` INNER JOIN `curso_$cicloLectivo` ON `curso_$cicloLectivo`.`idCurso` = `inscrip_curso_alumno_$cicloLectivo`.`idCurso` WHERE `libreta_digital_$cicloLectivo`.`idAsig` ='$idAsignatura' AND `curso_$cicloLectivo`.`nombre`= '$nombreCurso'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                           
            foreach($data as $dat) {

            $id_libretaF=$dat['id_libreta'];
            $nombre=$dat['nombreAlumnos'];
            $dniAlumnos=$dat['dniAlumnos'];
              if ($contadorColores<=6) {
                 $contadorColores++;

                 if ($contadorColores==1) {
                     $colorFinal='success';
                 }else{
                        if ($contadorColores==2) {
                            $colorFinal='primary';
                         }else{
                                 if ($contadorColores==3) {
                                    $colorFinal='secondary';
                                 }else{
                                    if ($contadorColores==4) {
                                        $colorFinal='danger';
                                     }else{
                                        if ($contadorColores==5) {
                                            $colorFinal='warning';
                                         }else{
                                            $colorFinal='info';
                                         }
                                     }
                                 }
                         }
                 }

             }else{
                $contadorColores=1;
                $colorFinal='success';
             }




         
            ?>
            <tr class="table-<?php echo $colorFinal; ?>">

                <td><?php echo $id_libretaF; ?></td>
                <td><?php echo $nombre; ?></td>
                <td><?php echo $dniAlumnos; ?></td>
            
                    <?php 
                    $nota='';
                    $contadoresF=0;
                    $contadoresDescrip=0;

                    $contenido='';

                    foreach ($columnas as &$Nombrecolum) {

                        $consulta = "SELECT  `$Nombrecolum` FROM `libreta_digital_$cicloLectivo` WHERE `id_libreta`= '$id_libretaF'";
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute();
                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                         foreach($data as $dat) {

                            $nota=$dat[$Nombrecolum];

                            $notaFinal = explode("||&||", $nota);
                            $cantidadNota=count($notaFinal);
                            $mensaje='';
                            $color='success';
                               
                            if ($nota=='undefined'){

                                $mensaje='';
                                $color='success';
                                $nota='';

                            }else{

                                if ($cantidadNota!=1){

                                    $mensaje='<FONT COLOR="red">ESTA CARGADO</FONT>';
                                    $color='danger';

                                }else{

                                    $mensaje='';
                                    $color='success';
                                }


                            }


                        }


                        if ($preguntaDocente[$contadoresF]=="SI") {
                            # code...
                             $contadoresF++;

                            if ($descrip[$contadoresDescrip]=='TEXTO') {

                                

                                $contenido.='<td><input type="text" class="form-control bg-dark-x border-0 cls" id="'.$id_libretaF.'-'.$contadoresF.'" value="'.$nota.'"></td>';

                            }else  if ($descrip[$contadoresDescrip]=='NUMERICO') {

                                $contenido.='<td><input type="number" class="form-control bg-dark-x border-0 cls" id="'.$id_libretaF.'-'.$contadoresF.'" value="'.$nota.'"></td>';
                    

                            }else  if ($descrip[$contadoresDescrip]=='INFORME') {


                                 if ($nota==''){
                                    $mensaje='';
                                    $color='success';

                                 }else{
                                    $mensaje='<FONT COLOR="red">ESTA CARGADO</FONT>';

                                    $color='danger';
                                 } 




                                $contenido.='<td><textarea hidden=""  type="text" rows="10" cols="50" class="form-control bg-dark-x border-0 cls" id="'.$id_libretaF.'-'.$contadoresF.'">'.$nota.'</textarea>


      <button id="boton'.$id_libretaF.'-mensaje-'.$contadoresF.'" onclick="pueba('.$id_libretaF.','.$contadoresF.')" type="button" class="btn btn-'.$color.'">
                                                             <i class="fas fa-edit"></i>
                                                            </button>


                                                    <button id="boton'.$id_libretaF.'-mensaje-'.$contadoresF.'" onclick="visualizar('.$id_libretaF.','.$contadoresF.')" type="button" class="btn btn-info">
                                                             <i class="fas fa-clipboard"></i>
                                                            </button>



                                         <div id="'.$id_libretaF.'-mensaje-'.$contadoresF.'">'.$mensaje.'</div>


                                          <input hidden="" id="datos'.$id_libretaF.$contadoresF.'"  value="'.$nombre.'||'.$dniAlumnos.'||'.$Nombrecolum.'" type="text" class="form-control bg-dark-x border-0 cls"> 


                                </td>';
                

                            }

                            $contadoresDescrip++;


                        }else{
                           

                                 # code...
                             $contadoresF++;

                            if ($descrip[$contadoresDescrip]=='TEXTO') {

                                

                                $contenido.='<td><input type="text" class="form-control bg-dark-x border-0 cls" id="'.$id_libretaF.'-'.$contadoresF.'" value="'.$nota.'" disabled></td>';

                            }else  if ($descrip[$contadoresDescrip]=='NUMERICO') {

                                $contenido.='<td><input type="number" class="form-control bg-dark-x border-0 cls" id="'.$id_libretaF.'-'.$contadoresF.'" value="'.$nota.'" disabled></td>';
                    

                            }else  if ($descrip[$contadoresDescrip]=='INFORME') {


                                 if ($nota==''){
                                    $mensaje='';
                                    $color='success';

                                 }else{
                                    $mensaje='<FONT COLOR="red">ESTA CARGADO</FONT>';

                                    $color='danger';
                                 } 







                                $contenido.='<td><textarea  hidden=""  type="text" rows="10" cols="50" class="form-control bg-dark-x border-0 cls" id="'.$id_libretaF.'-'.$contadoresF.'" disabled>'.$nota.'</textarea>




                                            

                                                    <button id="boton1'.$id_libretaF.'-mensaje-'.$contadoresF.'" onclick="visualizar('.$id_libretaF.','.$contadoresF.')" type="button" class="btn btn-info">
                                                             <i class="fas fa-clipboard"></i>
                                                            </button>



                                         <div id="'.$id_libretaF.'-mensaje-'.$contadoresF.'">'.$mensaje.'</div>


                                          <input hidden="" id="datos'.$id_libretaF.$contadoresF.'"  value="'.$nombre.'||'.$dniAlumnos.'||'.$Nombrecolum.'" type="text" class="form-control bg-dark-x border-0 cls"> 




                                </td>';
                

                            }

                            $contadoresDescrip++;






                     }


                    
                    }

                    echo $contenido;

                     ?>

                 
            </tr>
            <?php
                }
            ?>                                
        </tbody>        
       </table>                    


</form> 
<input hidden=''  id="contadorF" value="<?php echo $contador; ?>">


</div>
<!-- /.card -->
</div>







<div class="modal fade" id="modalCRUD_Pregunta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-xxl-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">

                <input type="text" class="form-control" id="id" hidden=''>
                <input type="text" class="form-control" id="idCarga" hidden=''>
                <input type="text" class="form-control" id="idDatos" hidden=''>
                           

                <?php

                    $infor='';
                    
                     $contador = '0';
                     $pregutas = '0';
                     $titulos = '0';
                     $pregunta_2='';
                     $pregunta_3='';
                     $datos= '';

                    $consulta = "SELECT `confi_informe_titulo_$cicloLectivo`.`id_titulo`, `confi_informe_titulo_$cicloLectivo`.`tituloGenera`, `confi_informe_$cicloLectivo`.`id_informe`, `confi_informe_$cicloLectivo`.`tipo`, `confi_informe_$cicloLectivo`.`titulo`, `confi_informe_$cicloLectivo`.`pregunta`, `confi_informe_$cicloLectivo`.`aclaracion`, `confi_informe_$cicloLectivo`.`respuestas_posible`, `confi_informe_$cicloLectivo`.`modalidad`, `confi_informe_$cicloLectivo`.`id_titologeneral` FROM `confi_informe_titulo_$cicloLectivo` INNER JOIN `confi_informe_$cicloLectivo` ON `confi_informe_$cicloLectivo`.`id_titologeneral`= `confi_informe_titulo_$cicloLectivo`.`id_titulo`";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $d2ata=$resultado->fetchAll(PDO::FETCH_ASSOC);
                 
                    foreach($d2ata as $d2at) {

                        $id_titulo=$d2at['id_titulo'];

                        
                        $tituloGenera=$d2at['tituloGenera'];
                        $titulo=$d2at['titulo'];
                        $pregunta=$d2at['pregunta'];
                        $aclaracion=$d2at['aclaracion'];
                        $respuestas_posible=$d2at['respuestas_posible'];

                        $id_informe=$d2at['id_informe'];

                        if ($pregunta_3=='') {
                             $datos.= $tituloGenera.'||'.$id_informe.'||'.$titulo.'||'.$pregunta.'||'.$aclaracion;

                             $pregunta_3='0';
                        }else{

                            $datos.= '&&'.$tituloGenera.'||'.$id_informe.'||'.$titulo.'||'.$pregunta.'||'.$aclaracion;

                        }

                        
  
                        $tipo=$d2at['tipo'];
                        
                        
                        $modalidad=$d2at['modalidad'];
                        $contador.=','.$id_informe; 
                        $pregutas.='||&||'.$pregunta;
                        $titulos.='||&||'.$tituloGenera;  
                        $pre=0;

                        $array = explode ( ',', $modalidad );
                        foreach ( $array as $palabra ) {
                            if (($palabra==$nombreCurso) || ($palabra=='TODOS')) {

                                $pre=1;
                            }
                        }
                        
                            if ($pre==1) {


                                if($pregunta_2!=$tituloGenera){

                                    $infor.='<center><B><h3><FONT COLOR="red">'.$tituloGenera.'</FONT></h3></B></center>';

                                    $pregunta_2=$tituloGenera;
                                }

                              
                                $infor.= '<h4>'.$titulo.'</h4>';

                                if ($tipo=='Pregunta Abierta') {
                                    

                                    $infor.= '<div class="form-group">
                <label for="pregnta'.$id_informe.'" class="col-form-label">*)'.$pregunta.'</label><br>'.$aclaracion.'
                <textarea  type="text" rows="8" cols="10" class="form-control" id="pregnta'.$id_informe.'"></textarea></div><hr>';
                                }else if($tipo=='Multiple Choice (Una respuesta)'){

                                $anex='';
                                $respuestas = explode ( '||', $respuestas_posible );
                                foreach ( $respuestas as $resp ) {

                                    $anex.='<option>'.$resp.'</option>';
                                }

                                    $infor.= '<div class="form-group">
                                    <label for="pregnta'.$id_informe.'" class="col-form-label">*)'.$pregunta.'</label><br>'.$aclaracion.'
                                    <select class="form-control" id="pregnta'.$id_informe.'">'.$anex.'
                                    </select>
                                    </div>';          

                            }else{

                                $anex='';
                                $respuestas = explode ( '||', $respuestas_posible );
                                foreach ( $respuestas as $resp ) {

                                    $anex.='<option>'.$resp.'</option>';
                                }

                                    $infor.= '<div class="form-group">
                                    <label for="pregnta'.$id_informe.'" class="col-form-label">*)'.$pregunta.'</label><br>'.$aclaracion.'
                                     
                                     <select id="pregnta'.$id_informe.'" class="form-select" multiple aria-label="multiple select example" multiple data-live-search="true">
                                     '.$anex.'
                                    </select>
                                    </div>';  


                            }

                        

                        
                     }


                       

                 }

                 if ($infor=='') {
                     echo 'SIN INFORME';
                 }else{
                     echo $infor;
                 }
                 
                ?>








                <!--  final -->



                <!-- inicio   -->



                            <?php

                    $infor='';
                    
                     $contador = '0';
                     $pregutas = '0';
                     $titulos = '0';
                     $pregunta_2='';
                     $pregunta_3='';
                     $datos_2= '';

                    $consulta = "SELECT `confi_informe_titulo_2_$cicloLectivo`.`id_titulo`, `confi_informe_titulo_2_$cicloLectivo`.`tituloGenera`, `confi_informe_2_$cicloLectivo`.`id_informe`, `confi_informe_2_$cicloLectivo`.`tipo`, `confi_informe_2_$cicloLectivo`.`titulo`, `confi_informe_2_$cicloLectivo`.`pregunta`, `confi_informe_2_$cicloLectivo`.`aclaracion`, `confi_informe_2_$cicloLectivo`.`respuestas_posible`, `confi_informe_2_$cicloLectivo`.`modalidad`, `confi_informe_2_$cicloLectivo`.`id_titologeneral` FROM `confi_informe_titulo_2_$cicloLectivo` INNER JOIN `confi_informe_2_$cicloLectivo` ON `confi_informe_2_$cicloLectivo`.`id_titologeneral`= `confi_informe_titulo_2_$cicloLectivo`.`id_titulo`";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $d2ata=$resultado->fetchAll(PDO::FETCH_ASSOC);
                 
                    foreach($d2ata as $d2at) {

                        $id_titulo=$d2at['id_titulo'];

                        
                        $tituloGenera=$d2at['tituloGenera'];
                        $titulo=$d2at['titulo'];
                        $pregunta=$d2at['pregunta'];
                        $aclaracion=$d2at['aclaracion'];
                        $respuestas_posible=$d2at['respuestas_posible'];

                        $id_informe=$d2at['id_informe'];

                        if ($pregunta_3=='') {
                             $datos_2.= $tituloGenera.'||'.$id_informe.'||'.$titulo.'||'.$pregunta.'||'.$aclaracion;

                             $pregunta_3='0';
                        }else{

                            $datos_2.= '&&'.$tituloGenera.'||'.$id_informe.'||'.$titulo.'||'.$pregunta.'||'.$aclaracion;

                        }

                        
  
                        $tipo=$d2at['tipo'];
                        
                        
                        $modalidad=$d2at['modalidad'];
                        $contador.=','.$id_informe; 
                        $pregutas.='||&||'.$pregunta;
                        $titulos.='||&||'.$tituloGenera;  
                        $pre=0;

                        $array = explode ( ',', $modalidad );
                        foreach ( $array as $palabra ) {
                            if (($palabra==$nombreCurso) || ($palabra=='TODOS')) {

                                $pre=1;
                            }
                        }
                        
                            if ($pre==1) {


                                if($pregunta_2!=$tituloGenera){

                                    $infor.='<br><hr><hr><center><B><h3><FONT COLOR="red">'.$tituloGenera.'</FONT></h3></B></center>';

                                    $pregunta_2=$tituloGenera;
                                }

                              
                                $infor.= '<h4>'.$titulo.'</h4>';

                                if ($tipo=='Pregunta Abierta') {
                                    

                                    $infor.= '<div class="form-group">
                <label for="pregnta_2'.$id_informe.'" class="col-form-label">*)'.$pregunta.'</label><br>'.$aclaracion.'
                <textarea  type="text" rows="8" cols="10" class="form-control" id="pregnta_2'.$id_informe.'"></textarea></div><hr>';
                                }else if($tipo=='Multiple Choice (Una respuesta)'){

                                $anex='';
                                $respuestas = explode ( '||', $respuestas_posible );
                                foreach ( $respuestas as $resp ) {

                                    $anex.='<option>'.$resp.'</option>';
                                }

                                    $infor.= '<div class="form-group">
                                    <label for="pregnta_2'.$id_informe.'" class="col-form-label">*)'.$pregunta.'</label><br>'.$aclaracion.'
                                    <select class="form-control" id="pregnta_2'.$id_informe.'">'.$anex.'
                                    </select>
                                    </div>';          

                            }else{

                                $anex='';
                                $respuestas = explode ( '||', $respuestas_posible );
                                foreach ( $respuestas as $resp ) {

                                    $anex.='<option>'.$resp.'</option>';
                                }

                                    $infor.= '<div class="form-group">
                                    <label for="pregnta_2'.$id_informe.'" class="col-form-label">*)'.$pregunta.'</label><br>'.$aclaracion.'
                                     
                                     <select id="pregnta_2'.$id_informe.'" class="form-select" multiple aria-label="multiple select example" multiple data-live-search="true">
                                     '.$anex.'
                                    </select>
                                    </div>';  


                            }

                        

                        
                     }


                       

                 }

                 if ($infor=='') {
                     echo 'SIN INFORME';
                 }else{
                     echo $infor;
                 }
                 
                ?>


            </div>


            <input type="text" class="form-control"  value="<?php echo $datos_2; ?>" id="datos_2" hidden=''>

            <input type="text" class="form-control"  value="<?php echo $datos; ?>" id="datos" hidden=''>
               
            <div class="modal-footer">
                <button class="btn btn-dark" onclick="agregar_editar ()"> <i class='fas fa-save'></i> Guardar</button>
            </div>
     
    </div>
  </div>
</div>






<div class="modal fade" id="modalCRUD_informe" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-xxl-down">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
                         
            <div class="modal-body">

             <div id="informeFinal"></div>


            </div>

            
                      
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
     
    </div>
  </div>
</div>



 <script type="text/javascript">


 

$('#imagenProceso').hide();
$('#cargaCiclo').hide();



var tablaLibreta = $('#tablaLibreta').DataTable({ 

"destroy":true,
scrollX:        "400px",   
scrollY:        "200px",


paging:         false,
fixedColumns: false,
// fixedColumns:   {
//     leftColumns: 2//Le indico que deje fijas solo las 2 primeras columnas
// },




language: {
lengthMenu: "Display _MENU_ records per page",
zeroRecords: "Nothing found - sorry",
info: "Showing page _PAGE_ of _PAGES_",
infoEmpty: "No records available",
search: "Buscador",
searchPlaceholder: "Buscar",
loadingRecords: "Cargando...",
processing: "Procesando....",
paginate: {
first: "primero",
last: "ultimo",
next: "siguiente",
previous: "anterior"
},
infoFiltered: "(filtered from _MAX_ total records)"
},
}); 

probar_boton();

$("#tablaLibreta_filter input").keyup(function(){
     //lo que tarda en descargar el input
    setTimeout(function(){
            probar_boton();
    }, 1); 
});

$("#tablaLibreta_filter input").click(function(){
    //lo que tarda en descargar el input
    setTimeout(function(){
            probar_boton();
    }, 1);   
});


function probar_boton(){
    
     buscador_notas_alumnos=$('#tablaLibreta_filter input').val();
   
     if(buscador_notas_alumnos.length==0){
    
         $('.mensaje').hide();
         $('.carga').show();



     }else{

        $('.mensaje').show();
        $('.carga').hide();

     }

}


function mensaje(tipo){
    
    if (tipo==1) {
         toastr.error('Se debe borrar el contenido del buscador para poder guardar los datos completos');
     }else{
          toastr.error('Se debe borrar el contenido del buscador para poder informar a la institución de la finalización de dicha carga');  
     }
}



var fila; //capturar la fila para editar o borrar el registro
 

$('#irImprimir').click(function(e) {
e.preventDefault();         
 window.open('modulos/gestionAcademicaAlumno/notas/librebretaDigitalImprimir.php', '_blank');

    });










$( ".cls" ).keyup(function() {

// reasigno Variables
var arrayIdeLibreta =[];
var arrayNotasCompletas =[];
var nombresColumnas=[];
var notas ='';
var nombresC='';
var contrador=0;

// recorro la tabla por filas
tablaLibreta.rows().data().each(function (value) {

// obtengo el valor de cada fila
var libreta= value[0];

//  copiar los nombres de los encabesados en un array
if (contrador!=1) {

    for (var i = 0; i < value.length - 3; i++) {
        nombresC = $('#nombre-'+i).html();
        nombresColumnas.push(nombresC);
        contrador=1; 
    }

}
//  copiar el id de cada asignatura
arrayIdeLibreta.push(libreta);

for (var i = 1; i < value.length - 2; i++) {

    //  copio cada nota o texto en un array
    ideElemento=libreta+'-'+(i);
    notas = $('#'+ideElemento).val();
    arrayNotasCompletas.push(notas);

}

});


 contComas= nombresColumnas.length;
// muestro por consola
console.log(nombresColumnas);
console.log(arrayIdeLibreta);
console.log(arrayNotasCompletas);
console.log(contComas);

});













function ingresarNotaBaseDato() {

$.blockUI({ 
                        message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                        css: { 
                        border: 'none', 
                        padding: '15px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5, 
                        color: '#fff' 
                    } }); 


// reasigno Variables
var arrayIdeLibreta =[];
var arrayNotasCompletas =[];
var nombresColumnas=[];
var notas ='';
var nombresC='';
var contrador=0;

// recorro la tabla por filas
tablaLibreta.rows().data().each(function (value) {

// obtengo el valor de cada fila
var libreta= value[0];

//  copiar los nombres de los encabesados en un array
if (contrador!=1) {

    for (var i = 0; i < value.length - 3; i++) {
        nombresC = $('#nombre-'+i).html();
        nombresColumnas.push(nombresC);
        contrador=1; 
    }

}
//  copiar el id de cada asignatura
arrayIdeLibreta.push(libreta);

for (var i = 1; i < value.length - 2; i++) {

    //  copio cada nota o texto en un array
    ideElemento=libreta+'-'+(i);
    notas = $('#'+ideElemento).val();
    arrayNotasCompletas.push(notas);

}

});


contComas= nombresColumnas.length;
// muestro por consola
console.log(nombresColumnas);
console.log(arrayIdeLibreta);
console.log(arrayNotasCompletas);
console.log(contComas);

$.ajax({
type:"post",
data:{nombresColumnas:nombresColumnas, arrayIdeLibreta:arrayIdeLibreta, arrayNotasCompletas:arrayNotasCompletas, contComas:contComas},
url:'modulos/gestionAcademicaAlumno/notas/elementos/crud_Notas_LibretaDigital.php',
success:function(r){

    toastr.info('Se guardo con exito');

    $.unblockUI();
}
});






} 


 





function visualizar(id_libretaF,contadoresF) {



datos=$('#'+id_libretaF+'-'+contadoresF).val();


if (datos=='') {
 
 datos='<b>SIN CARGA</b>';
}

$('#informeFinal').html(datos);

  $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("INFORME"); 
    $("#modalCRUD_informe").modal("show"); 


}




function pueba(id_libretaF,contadoresF) {



  $('#id').val(id_libretaF+'-'+contadoresF);
  $('#idCarga').val(id_libretaF+'-mensaje-'+contadoresF);

 
  dt=$('#datos'+id_libretaF+contadoresF).val();

  console.log(dt);

  $('#idDatos').val(dt);




    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("CARGAR O MODIFICAR INFORME DEL ALUMNO"); 
    $("#modalCRUD_Pregunta").modal("show"); 


}




function agregar_editar(){

    $("#modalCRUD_Pregunta").modal("hide"); 

    idTex=$('#id').val();
    idCarga=$('#idCarga').val();
    datos=$('#datos').val();

     datos_2=$('#datos_2').val();



    nombreCurso=$('#nombreCurso').html();
    nombreAsignacion=$('#nombreAsignacion').html();
  
    datosFinal=$('#idDatos').val();
    datosF = datosFinal.split('||');

    nombreAlumnos=datosF[0];
    dniAlumnos=datosF[1];
    encabezado=datosF[1];

TablaFinal='';



titoLongitud = [];

tituloGe='';
dat='';
conta=0;
table='';
tito=[];
pre='0';
pre_2=0;
cont=0;

preguntassss='';

// separo por titulo Genera
datosSeparadoTitulo = datos.split('&&');
res='';
for (var i = 0; i < datosSeparadoTitulo.length; i++) {

    datosSeparado=datosSeparadoTitulo[i];


    datosPorElementos = datosSeparado.split('||');

    tituloGeneral=datosPorElementos[0];
    id_informe=datosPorElementos[1];
    titulo=datosPorElementos[2];
    pregunta=datosPorElementos[3];
    aclaracion=datosPorElementos[4];
    respuesta=$('#pregnta'+id_informe).val();

    
    titoLongitud = tito.push(tituloGeneral); 
  
        res+=titulo+'||'+pregunta+'||'+aclaracion+'||'+respuesta+'|&|';
   





}

nuevo='';
titulm_2='';
contador=0;
contar=0;
for (var i = 0; i < tito.length; i++) {
    
    titulm=tito[i];



 if (contador == 0) {
    titulm_2=titulm;
    contador=1;
    nuevo+=titulm+'||';
 }
  

if (titulm_2==titulm) {
    contar=contar+1;
 }else{

        nuevo+=contar+'||'+titulm+'||';
        contar=0;
        titulm_2=titulm;

 }


if (i+1 == tito.length) {
     nuevo+=contar+1;
}

}

 
            table+=`<table style="width:100%">`;


columnas = '0';
suma=0;
nuevoFi = nuevo.split('||');

table+=` <thead>`;

         for (var i = 0; i < nuevoFi.length; i++) {

            numero=parseInt(nuevoFi[i+1], 10);
            suma=suma+numero;
    
            
            i++;

            
        }

        table+=`<tr><th colspan="`+suma+`">

        <center><B><h3><FONT COLOR="red">INFORME EQUIPO DE ENSEÑANZA Y EVALUACIÓN<br>SECUNDARIA TÉCNICA</FONT></h3></B></center><br>


        </th></tr>

        </thead>
            <tbody class="letras">

            <tr>
                <td colspan="`+suma+`">
                <span style="font-size: 15px;"><b>Apellido/s y Nombre/s: </b>`+nombreAlumnos+`</span><br>
                                    <b>DNI: </b>`+dniAlumnos+`</span><br>
                                <span style="font-size: 15px;"><b>(CICLO BÁSICO/CICLO SUPERIOR/ESPECIALIDAD: </b>`+nombreCurso+`</span><br>

                                <span style="font-size: 15px;"><b>Asignatura: </b>`+nombreAsignacion+`</span><br>

                                <span style="font-size: 15px;"><b>Tipo: </b>`+encabezado+`</span><br>

                                <span style="font-size: 15px;"><b>Niveles de desempeño:</b></span><br>

                                <span style="font-size: 15px;"><b>ALTAMENTE LOGRADO los objetivos de aprendizaje esperados fueron superados.</b></span><br>

                                <span style="font-size: 15px;"><b>LOGRADO los objetivos de aprendizaje esperados fueron logrados.</b></span><br>

                                <span style="font-size: 15px;"><b>EN PROCESO los objetivos previstos no fueron alcanzados.</b></span><br>


                </td>
            </tr>
            <tr>

        `;


        for (var i = 0; i < nuevoFi.length; i++) {

            numero=parseInt(nuevoFi[i+1], 10);
        
            columnas+='||'+numero;
            table+=`<td colspan="`+numero+`"><center>`+nuevoFi[i]+`</center></td>`;
            i++;

            
        }


table+=`</tr>`;

resFi = res.split('|&|');

catp='';


 for (var i = 0; i < resFi.length; i++) {


     
            resg=resFi[i];
           
            resl = resg.split('||');

            contador=2;
            numero=0;
            

            for (var X = 0; X < resl.length; X++) {

                

                if (resl[X]!='') {

                           
                            catp+=`<td><h5><b><center>`+resl[X]+`</center></b><h5><br><br><b>`+resl[X+1]+`</b><br>`+resl[X+2]+`<br><br>RESPUESTA: <b>`+resl[X+3]+`</b></td>||`;


                        }

                        X=X+3;


                }
            
            }



colum = columnas.split('||');
columFFF = catp.split('||');
contadorFinalTO=0;

table+=`<tr>`;

for (var i = 0; i < colum.length; i++) {

    columF=parseInt(colum[i], 10);


    for (var K = 0; K < columF; K++) {

     
     
        table+=columFFF[contadorFinalTO];

        contadorFinalTO++;
       

    }
        
  

}

table+=`</tr>`;
     
    table+=`</tbody>        

</table><br>
<p>Estudiante incluida/o en Plan de Acompañamiento: SI/NO</p>
<p>En caso de respuesta afirmativa, indicar espacios que participan en el plan:</p>`;






TablaFinal+=table;





//  segunda hoja




 


titoLongitud = [];

tituloGe='';
dat='';
conta=0;
table='';
tito=[];
pre='0';
pre_2=0;
cont=0;

preguntassss='';



// separo por titulo Genera
datosSeparadoTitulo = datos_2.split('&&');
res='';
for (var i = 0; i < datosSeparadoTitulo.length; i++) {

    datosSeparado=datosSeparadoTitulo[i];


    datosPorElementos = datosSeparado.split('||');

    tituloGeneral=datosPorElementos[0];
    id_informe=datosPorElementos[1];
    titulo=datosPorElementos[2];
    pregunta=datosPorElementos[3];
    aclaracion=datosPorElementos[4];
    respuesta=$('#pregnta_2'+id_informe).val();

    
    titoLongitud = tito.push(tituloGeneral); 
  
        res+=titulo+'||'+pregunta+'||'+aclaracion+'||'+respuesta+'|&|';
   





}

nuevo='';
titulm_2='';
contador=0;
contar=0;
for (var i = 0; i < tito.length; i++) {
    
    titulm=tito[i];



 if (contador == 0) {
    titulm_2=titulm;
    contador=1;
    nuevo+=titulm+'||';
 }
  

if (titulm_2==titulm) {
    contar=contar+1;
 }else{

        nuevo+=contar+'||'+titulm+'||';
        contar=0;
        titulm_2=titulm;

 }


if (i+1 == tito.length) {
     nuevo+=contar+1;
}

}

  console.log(nuevo)









            table+=`<table style="width:100%">`;


columnas = '0';
suma=0;
nuevoFi = nuevo.split('||');

table+=` <thead>`;

         for (var i = 0; i < nuevoFi.length; i++) {

            numero=parseInt(nuevoFi[i+1], 10);
            suma=suma+numero;
    
            
            i++;

            
        }

        table+=`<tr><th colspan="`+suma+`">

        <center><B><h3><FONT COLOR="red">SEGUNDA PARTE</FONT></h3></B></center><br>


        </th></tr>

        </thead>
            <tbody class="letras">

            <tr>
                <td colspan="`+suma+`">
                <span style="font-size: 15px;"><b>Apellido/s y Nombre/s: </b>`+nombreAlumnos+`</span><br>
                                    <b>DNI: </b>`+dniAlumnos+`</span><br>
                                <span style="font-size: 15px;"><b>(CICLO BÁSICO/CICLO SUPERIOR/ESPECIALIDAD: </b>`+nombreCurso+`</span><br>


                </td>
            </tr>
            <tr>

        `;


        for (var i = 0; i < nuevoFi.length; i++) {

            numero=parseInt(nuevoFi[i+1], 10);
        
            columnas+='||'+numero;
            table+=`<td colspan="`+numero+`"><center>`+nuevoFi[i]+`</center></td>`;
            i++;

            
        }


table+=`</tr>`;

resFi = res.split('|&|');

catp='';


 for (var i = 0; i < resFi.length; i++) {


     
            resg=resFi[i];
           
            resl = resg.split('||');

            contador=2;
            numero=0;
            

            for (var X = 0; X < resl.length; X++) {

                

                if (resl[X]!='') {

                           
                            catp+=`<td><h5><b><center>`+resl[X]+`</center></b><h5><br><br><b>`+resl[X+1]+`</b><br>`+resl[X+2]+`<br><br>RESPUESTA: <b>`+resl[X+3]+`</b></td>||`;


                        }

                        X=X+3;


                }
            
            }



colum = columnas.split('||');
columFFF = catp.split('||');
contadorFinalTO=0;

table+=`<tr>`;

for (var i = 0; i < colum.length; i++) {

    columF=parseInt(colum[i], 10);


    for (var K = 0; K < columF; K++) {

     
     
        table+=columFFF[contadorFinalTO];

        contadorFinalTO++;
       

    }
        
  

}

table+=`</tr>`;
     
    table+=`</tbody>        

</table><br>
<p>Estudiante incluida/o en Plan de Acompañamiento: SI/NO</p>
<p>En caso de respuesta afirmativa, indicar espacios que participan en el plan:</p>`;



if (TablaFinal!='') {
    TablaFinal+='|&|&|&|&|&|&|&||&|&|&|';
}


if (datos_2!='') {
    TablaFinal+=table;

}



TablaFinal+='|&|&|&|&|&|&|&||&|&|&|';


$('#'+idTex).val(TablaFinal);
ingresarNotaBaseDato();

$('#'+idCarga).html('<FONT COLOR="red">ESTA CARGADO</FONT>');

var btn = $('#boton'+idCarga);
  
btn.removeClass('btn-success');
btn.addClass('btn-danger');



}


function notificar_pre() {
        Swal.fire({
          title: 'Notificación a la institución',
          text: "¿Está seguro de notificar a la institución de la carga realizada?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'SI'
        }).then((result) => {
          if (result.isConfirmed) {
                notificar()
          }
        })
}









function notificar(){



    
   $.ajax({
          url: "modulos/gestionAcademicaAlumno/notas/elementos/notificar.php",
          type: "POST",
          data: {},
          success: function(r){  



    ret=`<p>Para seleccionar múltiples opciones debe presionar la tecla Ctrl al mismo tiempo que va seleccionado con el mouse</p><select id="columSele" class="form-select" multiple aria-label="multiple select example" multiple data-live-search="true">
               
                `+r+`
                </select></div>`;
     

      Swal.fire({
              title: 'QUE COLUNA/S FINALIZO LA CARGA',
              html:ret, 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  columSele = $('#columSele').val();
              

                  finalizarVerificacion(columSele);
                                  
                }
        });




   }        
      });


}



function finalizarVerificacion(columSele){


$.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } });


id_asignatura=$('#id_asignatura').val();
id_curso=$('#id_curso').val();
id_usuario=$('#id_usuario').val();
id_cicloLectivo=$('#id_cicloLectivo').val();

conter='';

for (var i = 0; i < columSele.length; i++) {
 
    if (columSele.length==(i+1)) {

        conter+=columSele[i];

    }else{
         conter+=columSele[i]+'||';
    }

}


columSele=conter;

f = new Date();
fecha = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();


  $.ajax({
          url: "modulos/gestionAcademicaAlumno/notas/elementos/notificarFinal.php",
          type: "POST",
          data: {columSele:columSele,id_asignatura:id_asignatura,id_curso:id_curso,id_usuario:id_usuario,id_cicloLectivo:id_cicloLectivo,fecha:fecha},
          success: function(r){ 

            console.log(r);

            if (r==1) {
                toastr.info('Se notifico a la institución');
                $.unblockUI();
            }else{

                toastr.error('Problema con el servidor, comuníquese con la institución');
                $.unblockUI();
            }

             

           }        
      });



}



  
    $.unblockUI();

</script>



   <?php
                                }
                            ?> 
