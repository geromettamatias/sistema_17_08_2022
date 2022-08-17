 <?php
include_once '../../../bd/conexion.php';
        $objeto = new Conexion();
          $conexion = $objeto->Conectar();
          session_start();
          if (isset($_SESSION['cicloLectivo'])){
            $cicloLectivoFINAL=$_SESSION['cicloLectivo'];
            $cons='';
            $c1onsulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivoFINAL`";
          $r1esultado = $conexion->prepare($c1onsulta);
          $r1esultado->execute();
          $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
          foreach($d1ata as $d1at) {

            $cons.='<option value="'.$d1at['idCurso'].'">'.$d1at['nombre'].'</option>';

          }


        }
          ?>
        

<input hidden="" id="cicloLectivo" value="<?php echo $cicloLectivoFINAL; ?>">
 <div class="form-group">
            <label for="curso" class="col-form-label">CURSO:</label>
                        <select class="form-control" id="curso">
                            <option value="0">Seleccione un curso</option>
                            <?php echo $cons; ?>
                        </select>
                    </div>
                    <div id="cusoAsunatura"></div>


   <script type="text/javascript">
$(document).ready(function(){




$("#curso").change(function(){

      curso= $('#curso').val();

   
      
      if (curso==0) {

        $('#cusoAsunatura').html('');

      }else{
      
       $.ajax({
          type:"post",
          data:'curso=' + curso,
          url:'modulosCarga/elementos/sessi2.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){
          
           $('#cusoAsunatura').load('modulosCarga/elementos/curso.php');
           $('#imagenProceso').hide();
          }
        });

      }

      });

    


    
});


</script>