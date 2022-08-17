
<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Gestión de Actas
                </h3>
              </div>
              <div class="card-body">

                
                   <select class="form-control" id="buscarTipo">
                <option>Seleccione el tipo de ACTAS</option>
                <option>ACTAS- PARA REGULAR</option>
                <option>ACTAS- PARA LIBRE</option>
                <option>ACTAS- PARA EQUIVALENCIA</option>
                <option>ACTAS- PARA TERMINAL</option>
                
                </select>
          

               
              </div>
              <!-- /.card -->
            </div>





<script type="text/javascript">

$('#imagenProceso').hide();

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



    $("#buscarTipo").change(function(){

      buscarTipo= $('#buscarTipo').val();


      

      if (buscarTipo!='Seleccione el tipo de ACTAS') {
      
      
       $.ajax({
          type:"post",
          data:'buscarTipo=' + buscarTipo,
          url:'modulos/gestionAcademicaAlumno/actasExamen/elementos/seccionACTA.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){

           
              $('#tablaInstitucional').html(''); 
               $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actaTabla.php');
              $('#contenidoAyuda').html(''); 
            

    
              $('#imagenProceso').hide();
          }
        });

      }else{


        $('#tablaInstitucional').html('');

         $.unblockUI();


      }

      });

 $.unblockUI();


  </script>

