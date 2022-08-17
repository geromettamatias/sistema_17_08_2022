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
<?php
    include_once '../../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    session_start();
    if (isset($_SESSION['idActa_inscriAlumno'])){
        $idActa_inscriAlumno=$_SESSION['idActa_inscriAlumno'];
    
           $consulta = "SELECT actas_examen_datos.idActa,actas_examen_datos.tipo, plan_datos_asignaturas.ciclo, plan_datos_asignaturas.nombre AS 'nombreAsignatura', plan_datos_asignaturas.idPlan, actas_examen_datos.precentacion, datos_docentes1.nombre AS 'docentePresidente', datos_docentes2.nombre AS 'docente1erSuplente', datos_docentes3.nombre AS 'docente2doSuplente' FROM actas_examen_datos INNER JOIN plan_datos_asignaturas ON plan_datos_asignaturas.idAsig = actas_examen_datos.idAsignatura INNER JOIN datos_docentes AS datos_docentes1 ON datos_docentes1.idDocente = actas_examen_datos.docente1 INNER JOIN datos_docentes AS datos_docentes2 ON datos_docentes2.idDocente = actas_examen_datos.docente2 INNER JOIN datos_docentes AS datos_docentes3 ON datos_docentes3.idDocente = actas_examen_datos.docente3 WHERE actas_examen_datos.idActa = '$idActa_inscriAlumno'";
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






            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                 <?php echo $tipo; ?>
                 <?php echo '<br>TIPO: '.$idPlan.'--CICLO: '.$ciclo.'--ASIGNATURA: '.$nombreAsignatura; ?>
                 <br>DOCENTES: <?php echo $docente1.'; '.$docente2.'; '.$docente3; ?>
                </h3>
              </div>
              <div class="card-body">

                
                <button id="btn_regresar" type="button" class="btn btn-warning" data-toggle="modal"  title="Regresar"><i class='fas fa-reply-all'></i></button>
            
                <button id="btnNuevo_InscripAl" type="button" class="btn btn-info" data-toggle="modal" title="INSCRIBIR ALUMNO"><i class='fas fa-user-plus'></i></button>
                <button  type="button" class="btn btn-secondary modalCRUD_actaGuardarNota" data-toggle="modal" title="GUARDAR NOTAS EDITADAS"><i class='fas fa-save'></i></button>
                <button id='btn_imprimir'  type="button" class="btn btn-success" data-toggle="modal" title="IMPRIMIR PLANILLA"><i class='fas fa-print'></i></button>
                
                <br> <hr>   


                <h5>Aclaración: Si utiliza el Buscador, solo se guardarán los datos que fueron buscados (se recomienda guardar los datos editados y luego utilizar el buscador)  </h5>

                 <table id="tabla_inscripFinal" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th> 
                                <th>APELLIDO Y NOMBRE</th>
                                <th>DNI</th> 
                                <th>Nota Esc</th> 
                                <th>Nota Oral</th> 
                                <th>Prom Numérico</th>
                                <th>Prom Letra</th>                         
                               
                            </tr>
                        </thead>
                        <tbody>
                       <?php  
                            $colorFinal='';

                            $contadorColores=0;
                           $consulta = "SELECT acta_examen_inscrip.idInscripcion, datosalumnos.nombreAlumnos, datosalumnos.dniAlumnos, acta_examen_inscrip.notaEsc, acta_examen_inscrip.notaOral, acta_examen_inscrip.promNumérico, acta_examen_inscrip.promLetra FROM acta_examen_inscrip INNER JOIN datosalumnos ON datosalumnos.idAlumnos = acta_examen_inscrip.idAlumno WHERE acta_examen_inscrip.idActa = '$idActa_inscriAlumno'";
                              $resultado = $conexion->prepare($consulta);
                              $resultado->execute();
                              $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                              foreach($data as $dat) { 

                              

                            $idInscripcion=$dat['idInscripcion'];
                            $nombreAlumnos=$dat['nombreAlumnos'];
                            $dniAlumnos=$dat['dniAlumnos'];

                            $notaEsc=$dat['notaEsc'];
                            $notaOral=$dat['notaOral'];
                            $promNumérico=$dat['promNumérico'];
                            $promLetra=$dat['promLetra'];

                          




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
                           
                         
                            <tr id="<?php echo $idInscripcion ?>" class="table-<?php echo $colorFinal; ?>">
                              
                              
                         
                                <td><?php echo $idInscripcion; ?></td>
                                <td><?php echo $nombreAlumnos; ?></td>
                                <td><?php echo $dniAlumnos; ?></td>
                                <td><input type="text" class="form-control bg-dark-x border-0" id="notaEsc_<?php echo $idInscripcion; ?>" value="<?php echo $notaEsc; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="notaOral_<?php echo $idInscripcion; ?>" value="<?php echo $notaOral; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="promNumérico_<?php echo $idInscripcion; ?>" value="<?php echo $promNumérico; ?>"></td>

                                <td><input type="text" class="form-control bg-dark-x border-0" id="promLetra_<?php echo $idInscripcion; ?>" value="<?php echo $promLetra; ?>"></td>

                            </tr>
                           <?php } ?>                            
                        </tbody>        
                       </table>                    

               
              </div>
              <!-- /.card -->
            </div>











 <script type="text/javascript">
$(document).ready(function(){


  


     var tablaAlumno = $('#tablaAlumnoNuevo').DataTable({ 

          
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

                    });








	$("#btn_regresar").click(function(){
        $('#imagenProceso').show();
        $('#tablaInstitucional').html(''); 
        $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actaTabla.php');
        $('#contenidoAyuda').html(''); 
        
        $('#imagenProceso').hide();


          
         $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actasBuscar.php');
     
        
    });

 
   
    var tabla_inscripFinal = $('#tabla_inscripFinal').DataTable({ 

          
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
                      
                    });





$("#btnNuevo_InscripAl").click(function(){
  
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Carga");            
    $("#inscripcionAlumnoMesaS").modal("show"); 

    
$('#idAlumnos').select2({
    dropdownParent: "#cont",
    theme: "bootstrap-5", 

});

});


$("#RegresarLibreta").click(function(){

  $('#imagenProceso').show();

      $('#libreTaOcul').show();

      $('#libretaFina').html('');
                

           
    
 $('#imagenProceso').hide(); 

}); 


$("#formInscrip").submit(function(e){
    e.preventDefault();   

    idAlumnos = $.trim($("#idAlumnos").val());

    if (idAlumnos==0) {

        Swal.fire({
                      icon: 'error',
                      title: 'Advertencia',
                      text: 'Debe seleccionar un alumno',
                      footer: '<a href>Why do I have this issue?</a>'
                    })
    }else{
    opcion=1;
    $.ajax({
          type:"post",
          data:'idAlumnos=' + idAlumnos + '&opcion=' + opcion,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_inscrp_Acta_Examen.php',
          success:function(res){
            
            data = res.split('||');

            idInscripcion = data[0];            
            nombreAlumnos = data[1];
            dniAlumnos = data[2];
            notaEsc = data[3];
            notaOral = data[4];
            promNumérico = data[5];
            promLetra = data[6];


            if (idInscripcion != '0') {

            notaEsc= '<input type="text" class="form-control bg-dark-x border-0" id="notaEsc_'+idInscripcion+'" value="'+notaEsc+'" maxlength="2">';

            notaOral= '<input type="text" class="form-control bg-dark-x border-0" id="notaOral_'+idInscripcion+'" value="'+notaOral+'" maxlength="2">';

            promNumérico= '<input type="text" class="form-control bg-dark-x border-0" id="promNumérico_'+idInscripcion+'" value="'+promNumérico+'" maxlength="2">';

            promLetra= '<input type="text" class="form-control bg-dark-x border-0" id="promLetra_'+idInscripcion+'" value="'+promLetra+'" maxlength="2">';

            boton= '<input type="checkbox" class="seleTod" value="'+idInscripcion+'"></input>';



            var tabla_inscripFinal = $('#tabla_inscripFinal').DataTable();
            tabla_inscripFinal.row.add( [idInscripcion,nombreAlumnos,dniAlumnos,notaEsc,notaOral,promNumérico,promLetra,boton]).node().id = idInscripcion;
            tabla_inscripFinal.draw( false );

            celda = document.getElementById(idInscripcion);

    
            celda.style.backgroundColor="#dddddd";

            Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Tu trabajo ha sido guardado',
                      showConfirmButton: false,
                      timer: 600
                    })

          }else{

            Swal.fire({
                      icon: 'error',
                      title: 'Advertencia',
                      text: 'El Alumno ya esta inscripto en la mesa',
                      footer: '<a href>Why do I have this issue?</a>'
                    })
          }

          
          }
        });


}
   
    
});  















$("#btn_imprimir").click(function(e){
    e.preventDefault();

  contadorAlumno=0;

  comparar=25;

  contador=0;


  tabla_inscripFinal.rows().data().each(function (value) {
    
    contadorAlumno++;

    if (contadorAlumno==comparar) {

      contador++;

    
      comparar=comparar+25;

    }
    
   
     
  });
 

          $.ajax({
                  type:"post",
                  data:'contadorAlumno=' + contadorAlumno + '&contador=' + contador,
                  url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/seccionCantidadImprimirActa.php',
                  success:function(respuesta){

 
             
              }
            });

        
        window.open('modulos/gestionAcademicaAlumno/actasExamen/imprimirActaFinal.php', '_blank'); 

});









$(document).on("click", ".modalCRUD_actaGuardarNota", function(){
  

Swal.fire({
  title: 'ESTA SEGURO DE EDITAR',
  text: "Una vez editado no se podra recuperar la nota",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
  if (result.isConfirmed) {
    

        tabla_inscripFinal.rows().data().each(function (value) {
            var idInscripcion= value[0];
        
               
            notaActaGuardar(idInscripcion);


            });
           
            
            Swal.fire(
          'MUY BIEN',
          'Los datos fueron registrados y guardados en la base de dato',
          'success'
        )

            
          

  }
})

});



});




function eliminarFinal(){


         Swal.fire({
          title: 'Esta seguro de Desmatricular estos alumno/s del curso?',
          text: "Los alumnos perderan todas las notas de la Libreta digital",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Desmatricular'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              'Operación éxitosa',
              'success'
            )

          $("#imagenProceso").show();
         
          botonMuchosEliminarFi2();
        }
      })
  

   
       
      


     
}


 function botonMuchosEliminarFi2() {

    tabla_inscripFinal=$('#tabla_inscripFinal').DataTable();
 
        $("input:checkbox:checked").each(function() {

          idInscripcion = $(this).val();
          fila=$(this);
          
     
          if (idInscripcion!=0) {

            

                tabla_inscripFinal.row(fila.parents('tr')).remove().draw();
               
                opcion=3;
                $.ajax({
                  type:"post",
                  data:'idInscripcion=' + idInscripcion + '&opcion=' + opcion,
                  url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_inscrp_Acta_Examen.php',
                  success:function(respuesta){

 
             
                  }
                });

           
            
          }

        });
        Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Se actualizo los registros',
              showConfirmButton: false,
              timer: 500
            });
        $("#imagenProceso").hide();
        
}


function ActivarCasilla(casilla){
    miscasillas=document.getElementsByClassName('seleTod'); //Rescatamos controles tipo Input
    for(i=0;i<miscasillas.length;i++) //Ejecutamos y recorremos los controles
      {
        if(miscasillas[i].type == "checkbox") // Ejecutamos si es una casilla de verificacion
        {
          miscasillas[i].checked=casilla.checked; // Si el input es CheckBox se aplica la funcion ActivarCasilla
        }
      }
    }




function notaActaGuardar(idInscripcion) {
   
    
    notaEsc = $("#notaEsc_"+idInscripcion).val();
    
    notaOral = $("#notaOral_"+idInscripcion).val();
    promNumérico = $("#promNumérico_"+idInscripcion).val();
    promLetra = $("#promLetra_"+idInscripcion).val();




        if (notaEsc === undefined) {
             console.log('NO Registrado/Analitico '+idInscripcion)
        }
        else {
           console.log('Guardado:'+notaEsc+'/Analitico '+idInscripcion)

    
    $.ajax({
        url: "modulos/gestionAcademicaAlumno/actasExamen/elementos/crud_notaActaInscrip.php",
        type: "POST",
        dataType: "json",
        data: {idInscripcion:idInscripcion, notaEsc:notaEsc, notaOral:notaOral, promNumérico:promNumérico, promLetra:promLetra},
        success: function(data){  
           
            

        }        
    });
    
    }
}    
 
</script>



<?php } ?> 


