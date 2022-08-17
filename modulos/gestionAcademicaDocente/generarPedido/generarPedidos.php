
 <?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();

if ( (isset($_SESSION['idUsuario'])) && (isset($_SESSION['nombre'])) && (isset($_SESSION['cargo'])) && (isset($_SESSION['nivelCurso'])) && (isset($_SESSION['operacion'])) && (isset($_SESSION['dni']))){


                                                        
        $id_docente=$_SESSION["idUsuario"];
        $cargo=$_SESSION["cargo"];
 
$consulta = "SELECT `id_generar_pedido`, `id_docente`, `titpo`, `descripcion`, `email_envio`, `email_envio_copia`, `situacion`, `fecha` FROM `generar_pedido_docente` WHERE `id_docente`='$id_docente'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>

<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Gestión- Generar Pedidos
                </h3>
              </div>
              <div class="card-body">

                

                <div id="cargaCiclo"><img  src="../elementos/cargando.gif"  style="width: 150px;"></div>

            
                <button id="btnNuevo_pedido" type="button" class="btn btn-success" data-toggle="modal" title="Generar Un nuevo Pedido"><i class='fas fa-edit'></i>Generar un nuevo pedido</button><br> <hr>    


                <div class="table-responsive">
                  <table id="tablaGenerarPedido" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>Detalle de Pedido</th> 
                           
                                <th>Situación</th>  
                         


                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                             $colorFinal='';

                            $contadorColores=0;                          
                            foreach($data as $dat) {                                                        
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
                             
                                 <td><b>Fecha: </b><?php echo $dat['fecha'] ?><br><b>Tipo de Pedido: </b><?php echo $dat['titpo'] ?><br><b>Descripción de Pedido: </b><?php echo $dat['descripcion'] ?><br><b>Email donde se mando una copia: </b><?php echo $dat['email_envio_copia'] ?></td>
                                <td><?php echo $dat['situacion'] ?></td>
                                


                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>  

               
              </div>
              <!-- /.card -->
            </div>

                        </div>



<div class="modal fade" id="modalCRUD_GenerarPedido" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
  
                         
            <div class="modal-body">

                <?php
       
                  $cat="";

 
                  $consulta = "SELECT DISTINCT `tipo` FROM `correos` WHERE `usuario`='$cargo'";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $tipo=$da1t['tipo'];

                     $cat.="<option>".$tipo."</option>";


                  }

                ?>


                
                <div class="mb-3">
                <label for="tipo" class="col-form-label">Tipo de Pedido:</label>
                       <select class="form-control" id="tipo">
                        <option>Selecciona el tipo de Pedido</option>
                        <?php echo $cat;  ?>
                        
                        </select>

                </div>
                <hr>
                <div class="mb-3">
                <label for="descripcion" class="col-form-label">Descripción:</label>
                <textarea class="form-control" rows="5" id="descripcion"></textarea>
                </div>
                <hr>
                <div class="mb-3">
                <div id="tex"><label for="emailCopia" class="form-label">Se mandara una copia a este correo (Verificando)</label></div>
               
                <input type="email" class="form-control" id="emailCopia" aria-describedby="emailHelp">
                
                <div id="emailHelp" class="form-text">Nunca compartiremos su correo electrónico con nadie más.</div>
              
                </div>
            
                   
                <hr>
             



        <div id="container-input">
            <div class="wrap-file">


              
                <div class="content-icon-camera">
                    <input type="file" id="file" name="file[]" multiple />
                    <div class="icon-camera"></div>
                </div>
                <div id="preview-images">
                    
                </div>
            </div>
            
           
        </div>


 



            </div>   
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" id="publish" class="btn btn-dark"> <i class='fas fa-save'></i> Guardar</button>
            </div>
       
    </div>
  </div>
</div>

  


 <script type="text/javascript">

    $('#imagenProceso').hide();
      $('#cargaCiclo').hide();
  
var dataFila=[];

    


  var tablaGenerarPedido = $('#tablaGenerarPedido').DataTable({ 

          
     
        
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

// visualizar datos de la tabla extras


// 







//  validar campo Email

 var verificacionEmail ='';

document.getElementById('emailCopia').addEventListener('input', function() {
    campo = event.target;
   
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(campo.value)) {

      $('#tex').html('<label for="emailCopia" class="form-label">Se mandara una copia a este correo (<span style="color:#2471A3";>El correo es Válido</span>)</label>');
      verificacionEmail=1;
    } else {
      verificacionEmail=0; 
      $('#tex').html('<label for="emailCopia" class="form-label">Se mandara una copia a este correo (<span style="color:#FF0000";>El correo es Incorrecto</span>)</label>'); 
    
    }
});








// fin de validacion



















    var file = document.getElementById('file');
   
    var publish = document.getElementById('publish');
    var formData = new FormData();

    var cantidadArchivos=0;

   file.addEventListener('change', function (e) {

        for ( var i = 0; i < file.files.length; i++ ) {
            var thumbnail_id = Math.floor( Math.random() * 30000 ) + '_' + Date.now();

            nombreArchivo=file.files[i].name;
            createThumbnail(file, i, thumbnail_id,nombreArchivo);
            formData.append(thumbnail_id, file.files[i]);
            cantidadArchivos++;
        }

        

        e.target.value = '';

    });


  
 var createThumbnail = function (file, iterator, thumbnail_id,nombreArchivo) {
        var thumbnail = document.createElement('div');


        thumbnail.classList.add('thumbnail', thumbnail_id);
        thumbnail.dataset.id = thumbnail_id;

        // thumbnail.setAttribute('style', `background-image: url(${ URL.createObjectURL( file.files[iterator] ) })`);   imagen
        
     document.getElementById('preview-images').appendChild(thumbnail);
        createCloseButton(thumbnail_id,nombreArchivo);
    }

    var createCloseButton = function (thumbnail_id,nombreArchivo) {
        var closeButton = document.createElement('div');
        closeButton.classList.add('close-button');
        closeButton.innerText = '*) ELIMINAR: '+nombreArchivo;
        document.getElementsByClassName(thumbnail_id)[0].appendChild(closeButton);
    }

    var clearFormDataAndThumbnails = function () {
        for ( var key of formData.keys() ) {
            formData.delete(key);
        }

        cantidadArchivos=0;

        document.querySelectorAll('.thumbnail').forEach(function (thumbnail) {
            thumbnail.remove();
        });
    }

    document.body.addEventListener('click', function (e) {
        if ( e.target.classList.contains('close-button') ) {
            e.target.parentNode.remove();
            formData.delete(e.target.parentNode.dataset.id);
            cantidadArchivos--;
        }
    });

publish.addEventListener('click', function (e) {
        e.preventDefault();

 

                var f = new Date();
                fecha = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();

                tipo=$('#tipo').val();
                descripcion= $('#descripcion').val();
                emailCopia= $('#emailCopia').val();



        if ((tipo!='Selecciona el tipo de Pedido') && (descripcion!='')) {


           

                formData.append('fecha', fecha);
                formData.append('tipo', tipo);
                formData.append('descripcion', descripcion);
                formData.append('emailCopia', emailCopia);

                dataFila.push(fecha);
                dataFila.push(tipo);
                dataFila.push(descripcion);
                dataFila.push(emailCopia);

                if ((emailCopia!='') && (cantidadArchivos != 0)) {


                        if (verificacionEmail==1) {

                        Swal.fire({
                                  title: '¡Esta seguro de Generar un pedido!',
                                  text: "Una vez generado el pedido no se podra anular",
                                  icon: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '#3085d6',
                                  cancelButtonColor: '#d33',
                                  confirmButtonText: 'Si, Generar el Pedido'
                                }).then((result) => {
                                  if (result.isConfirmed) {


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

                                    

                                    finalizarTramite(formData,dataFila);
                                    $("#modalCRUD_GenerarPedido").modal("hide");


                                  }else{



                                     toastr.error('El pedido fue anulado');
                                     $("#modalCRUD_GenerarPedido").modal("hide");
                                     

                                  }
                                })


                        }else{

                                    toastr.error('Verifique que el Correo electrónico');


                        }


                    }else{

               

                            if ( (emailCopia!='') == false ) {

                                toastr.error('No se enviara ninguna copia  !!!');
                            }

                             if ( (cantidadArchivos != 0) == false ) {

                                toastr.error('No se está adjuntando ningún archivo !!!');
                            }





                                  Swal.fire({
                                  title: '¡Esta seguro de Generar un pedido!',
                                  text: "Una vez generado el pedido no se podra anular",
                                  icon: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '#3085d6',
                                  cancelButtonColor: '#d33',
                                  confirmButtonText: 'Si, Generar el Pedido'
                                }).then((result) => {
                                  if (result.isConfirmed) {


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

                                    

                                    finalizarTramite(formData,dataFila);
                                    $("#modalCRUD_GenerarPedido").modal("hide");


                                  }else{



                                     toastr.success('El pedido fue anulado');
                                     $("#modalCRUD_GenerarPedido").modal("hide");
                                 

                                  }
                                })





                    }



 }else{

    toastr.error('Uno de los campos está incompleto o no seleccionado !!!');

 }


});  





function finalizarTramite(formData,dataFila){



                $.ajax({
                
                url:'modulos/gestionAcademicaDocente/generarPedido/elementos/enviar.php',
                type:'post',
                data:formData,
                contentType:false,
                processData:false,
                
                success: function(respuesta){
                        console.log(respuesta);

                       fecha = dataFila[0];
                       tipo = dataFila[1];
                       descripcion = dataFila[2];
                       emailCopia = dataFila[3];


                       pedidoGenerado='<b>Fecha: </b>'+fecha+'<br><b>Tipo de Pedido: </b>'+tipo+'<br><b>Descripción de Pedido: </b>'+descripcion+'<br><b>Email donde se mando una copia: </b>'+emailCopia;


                    
                    tablaGenerarPedido.row.add([pedidoGenerado,'']).draw();

                    clearFormDataAndThumbnails();

                    
                        toastr.success('¡Operación exitosa!');
                        toastr.info('¡Petición exitosa!');
                        Swal.fire('Espere que el establecimiento se comunique con usted');
                  
                        


                   
                   
                    $.unblockUI();
                 },




});  


}



$("#btnNuevo_pedido").click(function(){


      $('#tipo').val('Selecciona el tipo de Pedido');
                          $('#descripcion').val('');
                        $('#emailCopia').val('');
                        $('#emailCopia').val('');
                        


                        $('#tex').html('<label for="emailCopia" class="form-label">Se mandara una copia a este correo (Verificando)</label>');

                      clearFormDataAndThumbnails();   

    $("#formPersonasUsuario").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Ingresar un nuevo Pedido");            
    $("#modalCRUD_GenerarPedido").modal("show"); 

    id_generar_pedido=null;
    opcion = 1; //alta
}); 


    






 $.unblockUI();
</script>


<?php } ?>