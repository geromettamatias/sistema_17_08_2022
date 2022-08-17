<?php
                
                  
                  include_once '../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();

                  $cat="";


                  $consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` ORDER BY `ciclo`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $ciclo=$da1t['ciclo'];
                    $edicion=$da1t['edicion'];

                    if ($edicion=='SI') {
                      $cat.="<option value='".$ciclo."'>".$ciclo."</option>";
                    }

                     


                  }

?>






<br>

            <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Ciclo Lectivo
                </h3>
              </div>
              <div class="card-body">

                

                <select class="form-control" id="cicloLectivoFina">
                <option>Seleccione un año lectivo</option>
                  <?php echo $cat;  ?>
                </select>

               
              </div>
              <!-- /.card -->
            </div>


  
<script type="text/javascript">

 $('#imagenProceso').hide();

  $("#cicloLectivoFina").change(function(){
    cicloLectivoFina= $('#cicloLectivoFina').val();
  
    
    if (cicloLectivoFina!='Seleccione un año lectivo') {
$('#imagenProceso').show();


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
          data:'cicloLectivo=' + cicloLectivoFina,
          url:'modulos/gestionAcademicaDocente/dj/elementos/seccion.php',
          success:function(r){

               $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide(); 
            $('#tablaInstitucional').load('modulos/gestionAcademicaDocente/dj/dj.php');

             
    


          }
        });

     }else{

   
        $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  


     }

   });


 $.unblockUI();
</script>