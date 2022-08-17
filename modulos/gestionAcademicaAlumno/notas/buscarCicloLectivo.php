
<br>

            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Ciclo Lectivo
                </h3>
              </div>
              <div class="card-body">

                

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



             <select class="form-control" id="cicloLectivoFina">
              <option>Seleccione un año lectivo</option>
              <?php echo $cat;  ?>
            </select>

 




         

               
              </div>
              <!-- /.card -->
            </div>





    <div id="buscarAsignaturas"></div>
    <script type="text/javascript">
      $('#imagenProceso').hide();
    $("#cicloLectivoFina").change(function(){

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

      cicloLectivoFina= $('#cicloLectivoFina').val();

      if (cicloLectivoFina=='Seleccione un año lectivo') {
        $('#tablaInstitucional').html('');
         $('#contenidoAyuda').html(''); 
           
            $('#buscarAsignaturas').html('');    
                $('#buscarTablaInstitucional').show();

                $('#imagenProceso').hide();

                  $.unblockUI();

      }else{
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

      
      
       $.ajax({
          type:"post",
          data:'cicloLectivoFina=' + cicloLectivoFina,
          url:'modulos/gestionAcademicaAlumno/notas/elementos/seccionCiclo.php',
          success:function(r){
          
            $('#contenidoAyuda').html(''); 
           
            $('#buscarAsignaturas').load('modulos/gestionAcademicaAlumno/notas/buscarlibrebretaDigital.php');    
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').show();

                toastr.warning('Recuerde que la planilla de notas de los alumnos se ajusta al D.J. Inst. (si usted posee una suplencia y caduco, también va a caducar en el sistema y no podrá cargar notas… en ese caso deberá concurrir a la institución)');





          }
        });

      }

      });

  $.unblockUI();

  </script>

