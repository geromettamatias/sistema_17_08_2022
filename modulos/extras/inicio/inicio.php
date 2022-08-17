
       <section class="content">
      <div class="container-fluid">
        <div class="row">
   
   <!-- sexto -->
<hr>


          <div id="dj_imprimir_do" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-chalkboard-teacher"></i></span>

              <div class="info-box-content">
                <span  class="info-box-text">D.J. Inst.</span>
                <span class="info-box-number">Imprimir</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>








          <!-- /.col -->
          <div id="dj_do" class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas  fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">D.J.</span>
                <span class="info-box-number">Gestión</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>








          <!-- /.col -->
          <div id="generarPedido_dos"  class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pedidos</span>
                <span class="info-box-number">Email</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>





          <!-- /.col -->
                 <!-- /.col -->
          <div id="libretaDigitalDocenteEstrella"  class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-wrench"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Notas</span>
         
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->




     
          <!-- /.col -->
        </div>




         
      </div>
    </section>



<script type="text/javascript">



$("#dj_imprimir_do").click(function(){
        
       

       asignacionDocented();
   
        
    });



function asignacionDocented() {




   $.ajax({
          type:"post",
          data:{},
          url:'modulos/extras/inicio/elementos/cicloLectivo.php',
          success:function(r){ 


              ret=`<select class="form-control" id="cicloLectivoInicio">
               
                `+r+`
                </select></div>`;
     

                  Swal.fire({
                          title: 'AÑO LECTIVO',
                          html:ret, 
                          focusConfirm: false,
                          showCancelButton: true,                         
                          }).then((result) => {
                            if (result.value) {                                             
                              cicloLectivoInicio = document.getElementById('cicloLectivoInicio').value;
                          
                              asignacionDocenteFinalD(cicloLectivoInicio);
                                             
                            }
                    });

 
            
      


      }
        });

}





function asignacionDocenteFinalD(cicloLectivoInicio) {




   $.ajax({
          type:"post",
          data:'cicloLectivoInicio=' + cicloLectivoInicio,
          url:'modulos/extras/inicio/elementos/seccionDocente.php',
          success:function(r){ 


            if (r==1) {
               window.open('modulos/extras/inicio/imprimir_dj.php', '_blank');           
          
            }else{
              alert('Error de Servidor');
            }
           


      }
        });

}












$("#dj_do").click(function(){


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



      $('#imagenProceso').show();
         $.ajax({
          type:"post",
          data:'ob=' + '20',
          url:'estructuras/bd/pregunta.php',
          success:function(r){
          

            if (r=='SI') {


                  Swal.fire(
                  'IMPORTANTE !!',
                  'No se olvide de guardar los datos despues de modificarlos',
                  'warning'
                )



                  $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
       
        $('#buscarTablaInstitucional').load('modulos/gestionAcademicaDocente/dj/buscar.php');
        $('#tablaInstitucional').html('');

             

            }else{

                Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: '../elementos/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })

                $('#imagenProceso').hide();

                 $.unblockUI();

            }

          
          }
        });




        
            
   
        
    });







$("#generarPedido_dos").click(function(){
        
          $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/gestionAcademicaDocente/generarPedido/generarPedidos.php');

   
   
        
    });



     $("#libretaDigitalDocenteEstrella").click(function(){
        $('#imagenProceso').show();
         $.ajax({
          type:"post",
          data:'ob=' + '1',
          url:'estructuras/bd/pregunta.php',
          success:function(r){
          
            if (r=='SI') {

                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/notas/buscarCicloLectivo.php');
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').show();

                  Swal.fire(
                  'IMPORTANTE !!',
                  'No se olvide de guardar los datos despues de modificarlos',
                  'warning'
                )


              

            }else{

                Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: '../elementos/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })

                $('#imagenProceso').hide();
            }

          
          }
        });




        
            
   
        

    });




</script>


