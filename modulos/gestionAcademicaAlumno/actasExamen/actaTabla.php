<style type="text/css">
  @media screen and (max-width: 600px) {
       table {
           width:100%;
       }
       thead {
           display: none;
       }
       tr:nth-of-type(2n) {
           background-color: inherit;
       }
       tr td:first-child {
           background: #f0f0f0;
           font-weight:bold;
           font-size:1.3em;
       }
       tbody td {
           display: block;
           text-align:center;
       }
       tbody td:before {
           content: attr(data-th);
           display: block;
           text-align:center;
       }
}
</style>
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
    </style>
<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION['buscarTipo'])){
$buscarTipo=$_SESSION['buscarTipo'];




                                                        
        
      

$dni=$_SESSION['dni'];



 $c3onsulta = "SELECT `idDocente` FROM `datos_docentes` WHERE `dni`='$dni'";
        $r3esultado = $conexion->prepare($c3onsulta);
        $r3esultado->execute();
        $d3ata=$r3esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d3ata as $d3at) {
            $idDocente=$d3at['idDocente'];
           
         }





?>

 
<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                    Tipo de Acta: <?php echo $buscarTipo ?>
                </h3>
              </div>
              <div class="card-body">

            
        
                   <table id="tabla_acta" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>N°</th>
                                <th>ASIGNATURA</th>
                                <th>FECHA INICIO</th>
                                <th>FECHA CIERRE</th>

                                <th>INSCRIPCIONES</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                             $colorFinal='';

                            $contadorColores=0;  

                            $consulta = "SELECT actas_examen_datos.idActa, plan_datos_asignaturas.ciclo, plan_datos_asignaturas.nombre AS 'nombreAsignatura', plan_datos_asignaturas.idPlan, actas_examen_datos.precentacion, actas_examen_datos.finalizacion FROM actas_examen_datos INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = actas_examen_datos.idAsignatura WHERE actas_examen_datos.tipo = '$buscarTipo'  AND actas_examen_datos.docente1='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $d1ata=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($d1ata as $d1at) { 

                              

                            $idActa=$d1at['idActa'];
                            $ciclo=$d1at['ciclo'];
                            $idPlan=$d1at['idPlan'];
                            $nombreAsignatura=$d1at['nombreAsignatura'];
                            $precentacion=$d1at['precentacion'];
                            $finalizacion=$d1at['finalizacion'];


                                        $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos` WHERE `idPlan`='$idPlan'";
                                        $resultado = $conexion->prepare($consulta);
                                        $resultado->execute();
                                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($data as $dat) {

                                                $idPlan = $dat['nombre'];

                                        }



                            
                         

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
                                <td><?php echo $idActa ?></td>
                               
                                <td><?php echo $ciclo.'--'.$nombreAsignatura.'--'.$idPlan; ?> <button class="btn btn-info glyphicon glyphicon-pencil" title="PERSONAL DOCENTE ENCARGADO DE LA MESA" onclick="personalDocenteEncargo('<?php echo $idActa ?>')"> <i class="fas fa-user-tie"></i></button></td>
                                <td><?php

                                $date = date_create($precentacion);
                                $cadena_precentacion = date_format($date, 'd-m-Y');


                                 echo $cadena_precentacion; ?></td>

                                 <td><?php

                                $date_finalizacion = date_create($finalizacion);
                                $cadena_finalizacion = date_format($date_finalizacion, 'd-m-Y');


                                 echo $cadena_finalizacion; ?></td>
                                
                                <td><button class="btn btn-danger glyphicon glyphicon-pencil" title="INSCRIPCIONES A LA MESA" onclick="inscrpcionALUMNOS('<?php echo $idActa ?>')"><i class="fas fa-clipboard"></i></button></td>
                             
           
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table> 

               
              </div>
              <!-- /.card -->
            </div>










                                  
 


<script type="text/javascript">

$(document).ready(function(){

    
    var tabla_acta = $('#tabla_acta').DataTable({ 

    "destroy":true,    
  
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',       
        buttons:[ 
      {
        extend:    'excelHtml5',
        text:      '<i class="fas fa-file-excel"></i> ',
        titleAttr: 'Exportar a Excel',
        className: 'btn btn-success'
      },
      {
        extend:    'pdfHtml5',
        text:      '<i class="fas fa-file-pdf"></i> ',
        titleAttr: 'Exportar a PDF',
        className: 'btn btn-danger'
      },
      {
        extend:    'print',
        text:      '<i class="fa fa-print"></i> ',
        titleAttr: 'Imprimir',
        className: 'btn btn-info'
      },
    ]         
    });


$(document).on("click", ".btnEditar_Acta", function(){
    fila = $(this).closest("tr");


 
    idActa = parseInt(fila.find('td:eq(0)').text());


       $.blockUI({ 
        message: '<h1>Espere !!</h1>',
        css: { 
        border: 'none', 
        padding: '15px', 
        backgroundColor: '#000', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: .5, 
        color: '#fff' 
    } }); 



    


    $.ajax({
          type:"post",
          data:'idActa=' + idActa,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/actaEditarDatosPREfin.php',
          success:function(res){
         
            data = res.split('||');

                   
            asignatura = data[0];
            fechaActa = data[1];
            docente1 = data[2];
            docente2 = data[3];
            docente3 = data[4];

            fechaActaCierre = data[5];

            nombreAsignatura = data[6];
            docente1Nombre = data[7];
            docente2Nombre = data[8];
            docente3Nombre = data[9];


    
      $('#modalCRUD_acta').modal('show');
        
     
        $("#curso").show();
        $("#asicCURS").show();
        $(".ediCur").show();
        

        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Acta Editar"); 


        $('#asignatura').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
        $('#asignatura').val(asignatura).trigger('change.select2');
        
        $('#docente1').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
        $('#docente1').val(docente1).trigger('change.select2');

        $('#docente2').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
        $('#docente2').val(docente2).trigger('change.select2');

        $('#docente3').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
        $('#docente3').val(docente3).trigger('change.select2');





  
            $("#fechaActa").val(fechaActa);
            $("#fechaActaCierre").val(fechaActa);
           
             
          }
        });
   

    opcion = 2; //editar
    
      $.unblockUI();


    
});



    $(document).on("click", ".btn_Eliminar", function(){    
    fila = $(this);
    idActa = parseInt($(this).closest("tr").find('td:eq(0)').text());

           $.blockUI({ 
        message: '<h1>Espere !!</h1>',
        css: { 
        border: 'none', 
        padding: '15px', 
        backgroundColor: '#000', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: .5, 
        color: '#fff' 
    } }); 



  
    opcion = 3 ;//borrar

    eliminarActa(idActa,opcion);
  
});
    




function eliminarActa(idActa,opcion) {

  

Swal.fire({
  title: 'Esta seguro de eliminar este registro?',
  text: "Los datos eliminados no se podran recuperar!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, eliminar este registro!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Deleted!',
      'Operación éxitosa',
      'success'
    )

    eliminarActaFinal(idActa,opcion);
  }else{
       $.unblockUI();

  }
})



      
     
}


function  eliminarActaFinal(idActa,opcion){


   
        
        $.ajax({
            url: "modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_acta.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idActa:idActa},
            success: function(){
            
               
            }
        });

        tabla_acta.row(fila.parents('tr')).remove().draw();

           $.unblockUI();


}


    $('#btnActa').click(function(){
        
                  $.blockUI({ 
        message: '<h1>Espere !!</h1>',
        css: { 
        border: 'none', 
        padding: '15px', 
        backgroundColor: '#000', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: .5, 
        color: '#fff' 
    } }); 


     

        $('#asignatura').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
       
        
        $('#docente1').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
      

        $('#docente2').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
       

        $('#docente3').select2({
            dropdownParent: "#cont",
            theme: "bootstrap-5",
        });
        




        $("#curso").show();
        $("#asicCURS").show();
        $(".ediCur").show();

        
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Acta");            
        $('#modalCRUD_acta').modal('show');


        idActa=null;
        opcion=1;

         $.unblockUI();
    });







$("#formActaFinal").submit(function(e){
    e.preventDefault();    

                      $.blockUI({ 
        message: '<h1>Espere !!</h1>',
        css: { 
        border: 'none', 
        padding: '15px', 
        backgroundColor: '#000', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: .5, 
        color: '#fff' 
    } }); 


     

    buscarTipo= $.trim($("#buscarTipo").val());
   
    asignatura= $.trim($("#asignatura").val());
    
    fechaActa = $.trim($("#fechaActa").val());

    docente1 = $.trim($("#docente1").val());
    docente2 = $.trim($("#docente2").val());
    docente3 = $.trim($("#docente3").val());
    fechaActaCierre = $.trim($("#fechaActaCierre").val());

   if (buscarTipo!='Seleccione el ACTAS' && asignatura != '0' && fechaActa!='' && fechaActaCierre!='' && docente1 != '0' && docente2 != '0' && docente3 != '0') {


    $.ajax({
          type:"post",
          data:'buscarTipo=' + buscarTipo + '&asignatura=' + asignatura + '&fechaActa=' + fechaActa + '&idActa=' + idActa + '&opcion=' + opcion + '&docente1=' + docente1 + '&docente2=' + docente2 + '&docente3=' + docente3 + '&fechaActaCierre=' + fechaActaCierre,
          url:"modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_acta.php",
          beforeSend: function() {
                    $('#imagenProceso').show();
                              },
          success:function(res){

      
                 data = res.split('||');

            idActa = data[0];            
            asignatura = data[1];
            precentacion = data[2];
            fechaActaCierre = data[3];

            

            boton=' <button class="btn btn-info glyphicon glyphicon-pencil" title="PERSONAL DOCENTE ENCARGADO DE LA MESA" onclick="personalDocenteEncargo('+idActa+')"><i class="fas fa-user-tie"></i></button></td>';

            botonInscrip='<button class="btn btn-danger glyphicon glyphicon-pencil" title="INSCRIPCIONES A LA MESA" onclick="inscrpcionALUMNOS('+idActa+')"><i class="fas fa-clipboard"></i></button></td>';

             
            
            if(opcion == 1){tabla_acta.row.add([idActa,asignatura+boton,precentacion,fechaActaCierre,botonInscrip]).draw();}
            else{tabla_acta.row(fila).data([idActa,asignatura+boton,precentacion,fechaActaCierre,botonInscrip]).draw();} 

            $('#imagenProceso').hide();  

            
          }
        });
   
    $("#modalCRUD_acta").modal("hide");

    $.unblockUI();


    }else{


        Swal.fire({
                  icon: 'error',
                  title: 'LOS CAMPOS INCOMPLETOS',
                  text: 'Controle cada campo',
                  footer: '<a href>Why do I have this issue?</a>'
                })
        $.unblockUI();


    }    
    
   
  });
   
 


 
});

function personalDocenteEncargo(idActa) {

                       $.blockUI({ 
        message: '<h1>Espere !!</h1>',
        css: { 
        border: 'none', 
        padding: '15px', 
        backgroundColor: '#000', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: .5, 
        color: '#fff' 
    } }); 


    $.ajax({
          type:"post",
          data:'idActa=' + idActa,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/actaDocenteACARGO.php',
          success:function(res){

            data = res.split('||');

            docentePresidente = data[0];            
            docente1erSuplente = data[1];
            docente2doSuplente = data[2];
          
            
            Swal.fire('Presidente es '+docentePresidente+'<br>1er suplente es '+docente1erSuplente+'<br>2do suplente es '+docente2doSuplente);
                $.unblockUI();

          
          }
        });
}


function inscrpcionALUMNOS(idActa) {

                         $.blockUI({ 
        message: '<h1>Espere !!</h1>',
        css: { 
        border: 'none', 
        padding: '15px', 
        backgroundColor: '#000', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: .5, 
        color: '#fff' 
    } }); 
   
    $.ajax({
          type:"post",
          data:'idActa=' + idActa,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/session_actaInscrAlumno.php',
          success:function(res){

                   
          
          }
        });

        $('#buscarTablaInstitucional').html(''); 
        $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
       

        $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actaInsc-ALUMNO.php');
        $.unblockUI();




}



 $.unblockUI();
</script>  



<?php } ?> 

