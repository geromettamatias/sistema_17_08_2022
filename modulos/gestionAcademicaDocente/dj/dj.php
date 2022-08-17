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

                            if ((isset($_SESSION["idUsuario"]))){
                            $idDocente=$_SESSION["idUsuario"];

                            
                            $cicloLectivoFINAL=$_SESSION['cicloLectivo'];
                            $profesor=$_SESSION['profesor'];


?>







<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  DECLARACIÓN JURADA DE CARGO (<?php echo $profesor ?>) <button type="button" class="btn btn-warning"  onclick="imprimirDJ()"><i class='fas fa-print'></i> Imprimir DJ</button>  
                </h3>
              </div>
              <div class="card-body">

                

                <div id="cargaCiclo"><img  src="../elementos/cargando.gif"  style="width: 150px;"></div>

                <h4>HORAS CATEDRAS</h4>
                <button id="btn_nuevo_dia_hora" type="button" class="btn btn-success" data-toggle="modal" title="Nuevo Hora Catedra"><i class='fas fa-edit'></i></button><br> <hr>    


                <div class="table-responsive">  
                   <table id="tablaDocente_Asig" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th>
                                <th>CURSOS</th> 
                                <th>ASIGNATURA</th>
                                <th>SITUACIÓN</th>
                                <th>DESDE</th>
                                <th>HASTA</th>
                                <th>Obser.</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

           
                            
                            $consulta = "SELECT `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsig`, `plan_datos_asignaturas`.`nombre`, `curso_$cicloLectivoFINAL`.`nombre` AS 'nombreCurso', `asignacion_asignatura_docente_$cicloLectivoFINAL`.`situacion`,`asignacion_asignatura_docente_$cicloLectivoFINAL`.`desde`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`hasta`, `asignacion_asignatura_docente_$cicloLectivoFINAL`.`obserbaci` FROM `asignacion_asignatura_docente_$cicloLectivoFINAL` INNER JOIN `plan_datos_asignaturas` ON `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idAsignatura` = `plan_datos_asignaturas`.`idAsig` INNER JOIN `curso_$cicloLectivoFINAL` ON `curso_$cicloLectivoFINAL`.`idCurso` = `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idCurso` WHERE `asignacion_asignatura_docente_$cicloLectivoFINAL`.`idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

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
                             
                                <td><?php echo $dat['idAsig'] ?></td>
                                <td><?php echo $dat['nombreCurso'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['situacion'] ?></td>
                                <td><?php echo $dat['desde'] ?></td>
                                <td><?php echo $dat['hasta'] ?></td>
                                <td><?php echo $dat['obserbaci'] ?></td>

                                <td></td>
                            </tr>
                            <?php
                                }}
                            ?>                                
                        </tbody>        
                       </table>  
                   </div>
                       <br><hr>

                        <h4>CARGOS</h4>
                <button id="btn_nuevo_dia_hora_Cargo" type="button" class="btn btn-success" data-toggle="modal" title="Nuevo Cargo"><i class='fas fa-edit'></i></button><br> <hr>    
             
           
                    <div class="table-responsive">  
                    <table id="tablaDocente_Asig_cargo" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th>
                                <th>CARGO</th> 
                                <th>SITUACIÓN</th>
                                <th>DESDE</th>
                                <th>HASTA</th>
                                <th>LUNES</th>
                                <th>MARTES</th>
                                <th>MIERCOLES</th>
                                <th>JUEVES</th>
                                <th>VIERNES</th> 
                                <th>BOTON</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            
                            
                            $consulta = "SELECT `id_asig_cargo`, `idDocente`, `cargo`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes` FROM `asignacion_asignatura_docente_cargo_$cicloLectivoFINAL` WHERE `idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $da1ta=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                                
                            foreach($da1ta as $d1at) {                                                        
                            ?>
                            <tr>
                             
                                <td><?php echo $d1at['id_asig_cargo'] ?></td>
                                <td><?php echo $d1at['cargo'] ?></td>
                                <td><?php echo $d1at['situacion'] ?></td>
                                <td><?php echo $d1at['desde'] ?></td>
                                <td><?php echo $d1at['hasta'] ?></td>
                                <td><?php echo $d1at['lunes'] ?></td>
                                <td><?php echo $d1at['martes'] ?></td>
                                <td><?php echo $d1at['miercoles'] ?></td>
                                <td><?php echo $d1at['jueves'] ?></td>
                                <td><?php echo $d1at['viernes'] ?></td>


                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>
                   </div>
                       <br><hr>
                              <h4>Horas Proyecto (No del plan de estudio)</h4>
                <button id="btn_nuevo_dia_hora_Proyecto" type="button" class="btn btn-success" data-toggle="modal" title="Nuevo Horas Proyecto"><i class='fas fa-edit'></i></button><br> <hr>    
             
                <div class="table-responsive">  
                      <table id="tablaDocente_Asig_Proyecto" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                         
                                <th>N°</th>
                                <th>CANTIDAD HORAS</th> 
                                <th>SITUACIÓN</th>
                                <th>DESDE</th>
                                <th>HASTA</th>
                                <th>LUNES</th>
                                <th>MARTES</th>
                                <th>MIERCOLES</th>
                                <th>JUEVES</th>
                                <th>VIERNES</th>
                                <th>LICENCIA</th>  
                                <th>BOTON</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            
                            
                            $consulta = "SELECT `id_asig_proyecto`, `idDocente`, `cHoras`, `situacion`, `desde`, `hasta`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `licencia` FROM `asignacion_asignatura_docente_proyecto_$cicloLectivoFINAL` WHERE `idDocente`='$idDocente'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $da1ta=$resultado->fetchAll(PDO::FETCH_ASSOC);

                                                
                            foreach($da1ta as $d1at) {                                                        
                            ?>
                            <tr>
                             
                                <td><?php echo $d1at['id_asig_proyecto'] ?></td>
                                <td><?php echo $d1at['cHoras'] ?></td>
                                <td><?php echo $d1at['situacion'] ?></td>
                                <td><?php echo $d1at['desde'] ?></td>
                                <td><?php echo $d1at['hasta'] ?></td>
                                <td><?php echo $d1at['lunes'] ?></td>
                                <td><?php echo $d1at['martes'] ?></td>
                                <td><?php echo $d1at['miercoles'] ?></td>
                                <td><?php echo $d1at['jueves'] ?></td>
                                <td><?php echo $d1at['viernes'] ?></td>
                                <td><?php echo $d1at['licencia'] ?></td>

                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table> 

                       </div>         
               
              </div>
              <!-- /.card -->
            </div>






















<div class="modal fade" id="modalCRUD_Docente_Asig" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="fromasignacion">    
                         
            <div class="modal-body">
                
                                  <?php

      
            $cons='';
            $c1onsulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivoFINAL`";
          $r1esultado = $conexion->prepare($c1onsulta);
          $r1esultado->execute();
          $d1ata=$r1esultado->fetchAll(PDO::FETCH_ASSOC);
          foreach($d1ata as $d1at) {

            $cons.='<option value="'.$d1at['idCurso'].'">'.$d1at['nombre'].'</option>';

          }


          ?>
        


 <div class="form-group">
            <label for="curso" class="col-form-label">CURSO:</label>
                        <select class="form-control" id="curso">
                            <option value="0">Seleccione un curso</option>
                            <?php echo $cons; ?>
                        </select>
                    </div>
          <div id="cus"></div>

          
          <div id="datos">
              <div class="col-lg-12 p-2">
                <label for="situacionRevista" class="col-form-label">SITUACIÓN DE REVISTA:</label>
                <select class="form-control" id="situacionRevista">
                <option>TITULAR</option>
                <option>INTERINO</option>
                <option>SUPLENTE</option>
                </select>
              </div>

              <div class="col-lg-12 p-2">
                <label for="obserbaci" class="col-form-label">Obserbación:</label>
            
                <input type="text" class="form-control" id="obserbaci">
                
                
              </div>

              <div class="col-lg-12 p-2">
                <label for="desde" class="col-form-label">Desde:</label>
            
                <input type="date" class="form-control" id="desde">
                
                
              </div>

              <div class="col-lg-12 p-2">
                <label for="hasta" class="col-form-label">Hasta:</label>
            
                <input type="date" class="form-control" id="hasta">
                
                
              </div>

              



          </div>

               


            </div>   
                                
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit"  class="btn btn-dark"> <i class='fas fa-save'></i> Guardar</button>
            </div>
        </form> 
    </div>
  </div>
</div>

      
                                        












<div class="modal fade" id="modalCRUD_Docente_Asig_cargo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="fromasignacionCargo">    
                         
            <div class="modal-body">

              <div class="col-lg-12 p-2">
                <label for="cargoF" class="col-form-label">CARGO:</label>
                
                  <select class="form-control" id="cargoF">
                <option>SELECCIONE UN CARGO</option>
                <option>DIRECTOR</option>
                <option>VICEDIRECTOR</option>
                <option>ASESOR PEDAGOGICO</option>
                <option>REGENTE-CULTURA</option>
                <option>REGENTE-TÉCNICO</option>
                <option>SECRET.DE 1RA</option>
                <option>AUX.DOC.PPAL 1RA</option>
                <option>MAESTRO DE TALLERES</option>
                <option>MEP-01</option>
                <option>MEP-02</option>
                <option>MEP-03</option>
                <option>MEP-04</option>
                <option>MEP-05</option>
                <option>MEP-06</option>
                <option>MEP-07</option>
                <option>MEP-08</option>
                <option>MEP-09</option>
                <option>MEP-10</option>
                <option>MEP-11</option>
                <option>MEP-12</option>
                <option>MEP-13</option>
                <option>MEP-14</option>
                <option>MEP-15</option>
                <option>MEP-16</option>
                <option>MEP-17</option>
                <option>MEP-18</option>
                <option>MEP-19</option>
                <option>MEP-20</option>
                <option>MEP-21</option>
                <option>MEP-22</option>
                <option>MEP-23</option>
                <option>MEP-24</option>
                <option>MEP-25</option>
                <option>AUX.DOCENTE-01</option>
                <option>AUX.DOCENTE-02</option>
                <option>AUX.DOCENTE-03</option>
                <option>AUX.DOCENTE-04</option>
                <option>AUX.DOCENTE-05</option>
                <option>AUX.DOCENTE-06</option>
                <option>AUX.DOCENTE-07</option>
                <option>AUX.DOCENTE-08</option>
                </select>     
              </div>

            
              <div class="col-lg-12 p-2">
                <label for="situacionRevistaF" class="col-form-label">SITUACIÓN DE REVISTA:</label>
                <select class="form-control" id="situacionRevistaF">
                <option>TITULAR</option>
                <option>INTERINO</option>
                <option>SUPLENTE</option>
                </select>
              </div>
              <div class="col-lg-12 p-2">
                <label for="desdeF" class="col-form-label">Desde:</label>
                <input type="date" class="form-control" id="desdeF">      
              </div>
              <div class="col-lg-12 p-2">
                <label for="hastaF" class="col-form-label">Hasta:</label>
                <input type="date" class="form-control" id="hastaF">
              </div>

              <div class="col-lg-12 p-2 bg-dark">
                <label for="lunesFINAL" class="col-form-label">TURNO DEL LUNES:</label>
                <select class="form-control" id="lunesFINAL">
                <option>MAÑANA</option>
                <option>TARDE</option>
                <option>VESPERTINO</option>
                </select>
                
              </div>

              <div class="col-lg-12 p-2 bg-dark">
                <label for="lunesF" class="col-form-label">HORARIO DEL LUNES:</label>
             
                <input type="text" class="form-control" id="lunesF">
              </div>


              <div class="col-lg-12 p-2">
                <label for="martesFINAL" class="col-form-label">HORARIO DEL MARTES:</label>
                <select class="form-control" id="martesFINAL">
                <option>MAÑANA</option>
                <option>TARDE</option>
                <option>VESPERTINO</option>
                </select>
                
              </div>


              <div class="col-lg-12 p-2">
                <label for="martesF" class="col-form-label">HORARIO DEL MARTES:</label>
                <input type="text" class="form-control" id="martesF">
              </div>


              <div class="col-lg-12 p-2 bg-info">
                <label for="miercolesFINAL" class="col-form-label">TURNO MIERCOLES:</label>
                <select class="form-control" id="miercolesFINAL">
                <option>MAÑANA</option>
                <option>TARDE</option>
                <option>VESPERTINO</option>
                </select>
                
              </div>

              <div class="col-lg-12 p-2 bg-info">
                <label for="miercolesF" class="col-form-label">HORARIO DEL MIERCOLES:</label>
              
                <input type="text" class="form-control" id="miercolesF">
              </div>


              <div class="col-lg-12 p-2">
                <label for="juevesFINAL" class="col-form-label">TURNO DEL JUEVES:</label>
                <select class="form-control" id="juevesFINAL">
                <option>MAÑANA</option>
                <option>TARDE</option>
                <option>VESPERTINO</option>
                </select>
                
              </div>
              <div class="col-lg-12 p-2">
                <label for="juevesF" class="col-form-label">HORARIO DEL JUEVES:</label>
                
                <input type="text" class="form-control" id="juevesF">
              </div>



              <div class="col-lg-12 p-2 bg-dark">
                <label for="viernesFINAL" class="col-form-label">TURNO DEL VIERNES:</label>
                <select class="form-control" id="viernesFINAL">
                <option>MAÑANA</option>
                <option>TARDE</option>
                <option>VESPERTINO</option>
                </select>
            
              </div>

               <div class="col-lg-12 p-2">
                <label for="viernesF" class="col-form-label">HORARIO DEL VIERNES:</label>
                
                <input type="text" class="form-control" id="viernesF">
              </div>

 
            </div>          
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit"  class="btn btn-dark"> <i class='fas fa-save'></i> Guardar</button>
            </div>
        </form> 
    </div>
  </div>
</div>



<div class="modal fade" id="modalCRUDDocenteAsigProyecto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form id="fromasignacionProyecto">    
                         
            <div class="modal-body">

                <div class="col-lg-12 p-2">
                <label for="licencia" class="col-form-label">ESTADO LICENCIA:</label>
                <select class="form-control" id="licencia">
                <option>DE LICENCIA</option>
                <option>TRABAJANDO</option>
                </select>
              </div>

              <div class="col-lg-12 p-2">
                <label for="cHoras" class="col-form-label">Cantidad Horas:</label>
                <input type="text" class="form-control" id="cHoras">
                 
              </div>

              <div id="inf"></div>
            
              <div class="col-lg-12 p-2">
                <label for="situacionRevistaFProyecto" class="col-form-label">SITUACIÓN DE REVISTA:</label>
                <select class="form-control" id="situacionRevistaFProyecto">
                <option>TITULAR</option>
                <option>INTERINO</option>
                <option>SUPLENTE</option>
                </select>
              </div>
              <div class="col-lg-12 p-2">
                <label for="desdeFProyecto" class="col-form-label">Desde:</label>
                <input type="date" class="form-control" id="desdeFProyecto">      
              </div>
              <div class="col-lg-12 p-2">
                <label for="hastaFProyecto" class="col-form-label">Hasta:</label>
                <input type="date" class="form-control" id="hastaFProyecto">
              </div>

              <div class="col-lg-12 p-2 bg-dark">
                <label for="lunesFINALProyecto" class="col-form-label">TURNO DEL LUNES:</label>
                <select class="form-control" id="lunesFINALProyecto">
                <option>MAÑANA</option>
                <option>TARDE</option>
                <option>VESPERTINO</option>
                </select>
                
              </div>

              <div class="col-lg-12 p-2 bg-dark">
                <label for="lunesFProyecto" class="col-form-label">HORARIO DEL LUNES:</label>
             
                <input type="text" class="form-control" id="lunesFProyecto">
              </div>


              <div class="col-lg-12 p-2">
                <label for="martesFINALProyecto" class="col-form-label">HORARIO DEL MARTES:</label>
                <select class="form-control" id="martesFINALProyecto">
                <option>MAÑANA</option>
                <option>TARDE</option>
                <option>VESPERTINO</option>
                </select>
                
              </div>


              <div class="col-lg-12 p-2">
                <label for="martesFProyecto" class="col-form-label">HORARIO DEL MARTES:</label>
                <input type="text" class="form-control" id="martesFProyecto">
              </div>


              <div class="col-lg-12 p-2 bg-info">
                <label for="miercolesFINALProyecto" class="col-form-label">TURNO MIERCOLES:</label>
                <select class="form-control" id="miercolesFINALProyecto">
                <option>MAÑANA</option>
                <option>TARDE</option>
                <option>VESPERTINO</option>
                </select>
                
              </div>

              <div class="col-lg-12 p-2 bg-info">
                <label for="miercolesFProyecto" class="col-form-label">HORARIO DEL MIERCOLES:</label>
              
                <input type="text" class="form-control" id="miercolesFProyecto">
              </div>


              <div class="col-lg-12 p-2">
                <label for="juevesFINALProyecto" class="col-form-label">TURNO DEL JUEVES:</label>
                <select class="form-control" id="juevesFINALProyecto">
                <option>MAÑANA</option>
                <option>TARDE</option>
                <option>VESPERTINO</option>
                </select>
                
              </div>
              <div class="col-lg-12 p-2">
                <label for="juevesFProyecto" class="col-form-label">HORARIO DEL JUEVES:</label>
                
                <input type="text" class="form-control" id="juevesFProyecto">
              </div>



              <div class="col-lg-12 p-2 bg-dark">
                <label for="viernesFINALProyecto" class="col-form-label">TURNO DEL VIERNES:</label>
                <select class="form-control" id="viernesFINALProyecto">
                <option>MAÑANA</option>
                <option>TARDE</option>
                <option>VESPERTINO</option>
                </select>
            
              </div>

              <div class="col-lg-12 p-2 bg-dark">
                <label for="viernesFProyecto" class="col-form-label">HORARIO DEL VIERNES:</label>
              
                <input type="text" class="form-control" id="viernesFProyecto">
              </div>
    
          
            </div>   
                               
             
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit"  class="btn btn-dark"> <i class='fas fa-save'></i> Guardar</button>
            </div>
        </form> 
    </div>
  </div>
</div>




 <script type="text/javascript">
    $("#imagenProceso").hide();
                                
      $('#cargaCiclo').hide();


function imprimirDJ() {
   

                window.open('modulos/gestionAcademicaDocente/dj/imprimir_dj.php', '_blank'); 


       

}



$(document).ready(function(){

$('#inf').html('');




  $(document).on("click", ".btnBorrar_Docente_asignacion_Proyecto", function(){    
    fila = $(this);
    id_asig_proyecto = parseInt($(this).closest("tr").find('td:eq(0)').text());
    
  
    opcion = 2 ;//borrar

    eliminarAntesPlanDocenteAsigProyecto(id_asig_proyecto,opcion);
  
});







function eliminarAntesPlanDocenteAsigProyecto(id_asig_proyecto,opcion) {

  

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

    eliminarAntesPlanDocenteAsigProyectoFF(id_asig_proyecto,opcion);
  }
})



      
     
}


function  eliminarAntesPlanDocenteAsigProyectoFF(id_asig_proyecto,opcion){


        
        $.ajax({
            url: "modulos/gestionAcademicaDocente/dj/elementos/crud_altaBajaAsignacion_proyecto.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id_asig_proyecto:id_asig_proyecto},
             beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_nuevo_dia_hora").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = true;
                                $(".btnGroupDrop10").attr("disabled", true);
                                $(".btnGroupDrop11").attr("disabled", true);
                                $(".btnGroupDrop12").attr("disabled", true);
                                $('#cargaCiclo').show();

                            },
            success: function(){
            
               
            }
        });
        $("#imagenProceso").hide();
                                document.getElementById("btn_nuevo_dia_hora").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = false;
                                $(".btnGroupDrop10").attr("disabled", false);
                                $(".btnGroupDrop11").attr("disabled", false);
                                $(".btnGroupDrop12").attr("disabled", false);
                                $('#cargaCiclo').hide();
        tablaDocente_Asig_Proyecto.row(fila.parents('tr')).remove().draw();
         

    
}












  $(document).on("click", ".btnBorrar_Docente_asignacion_cargo", function(){    
    fila = $(this);
    id_asig_cargo = parseInt($(this).closest("tr").find('td:eq(0)').text());
    
  
    opcion = 2 ;//borrar

    eliminarAntesPlanDocenteAsigCargo(id_asig_cargo,opcion);
  
});
    




function eliminarAntesPlanDocenteAsigCargo(id_asig_cargo,opcion) {

  

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

    eliminarAntesPlanDocenteAsigCargoFF(id_asig_cargo,opcion);
  }
})



      
     
}


function  eliminarAntesPlanDocenteAsigCargoFF(id_asig_cargo,opcion){


        
        $.ajax({
            url: "modulos/gestionAcademicaDocente/dj/elementos/crud_altaBajaAsignacion_cargo.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id_asig_cargo:id_asig_cargo},
             beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_nuevo_dia_hora").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = true;
                                $(".btnGroupDrop10").attr("disabled", true);
                                $(".btnGroupDrop11").attr("disabled", true);
                                $(".btnGroupDrop12").attr("disabled", true);
                                $('#cargaCiclo').show();

                            },
            success: function(){
            
               
            }
        });
        $("#imagenProceso").hide();
                                document.getElementById("btn_nuevo_dia_hora").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = false;
                                $(".btnGroupDrop10").attr("disabled", false);
                                $(".btnGroupDrop11").attr("disabled", false);
                                $(".btnGroupDrop12").attr("disabled", false);
                                $('#cargaCiclo').hide();
        tablaDocente_Asig_cargo.row(fila.parents('tr')).remove().draw();
         

    
}






$(document).on("click", ".btnEDITAR_Docente_asignacion", function(e){
    e.preventDefault();

    fila = $(this).closest("tr");

 
    id = parseInt(fila.find('td:eq(0)').text());
    curso = fila.find('td:eq(1)').text();
    asig = fila.find('td:eq(2)').text();
    situacion = fila.find('td:eq(3)').text();
    desde = fila.find('td:eq(4)').text();
    hasta = fila.find('td:eq(5)').text();
    obserbaci = fila.find('td:eq(6)').text();


if (situacion=='TITULAR') {
    sit=`<option>TITULAR</option>
                <option>INTERINO</option>
                <option>SUPLENTE</option>`;
}else if (situacion=='INTERINO') {
    sit=`<option>INTERINO</option>
                <option>TITULAR</option>
                <option>SUPLENTE</option>`;

}else{
    sit=`<option>SUPLENTE</option>
                <option>TITULAR</option>
                <option>INTERINO</option>`;

}
        

ret=`<div class="col-lg-12 p-2">
        <h4></h4>
                <label for="situacionRevista2" class="col-form-label">SITUACIÓN DE REVISTA:</label>
                <select class="form-control" id="situacionRevista2">
                `+sit+`
                </select>
              </div>

              <div class="col-lg-12 p-2">
                <label for="obserbaci2" class="col-form-label">Obserbación:</label>
            
                <input type="text" class="form-control" id="obserbaci2" value='`+obserbaci+`'>
                
                
              </div>

              <div class="col-lg-12 p-2">
                <label for="desde2" class="col-form-label">Desde:</label>
            
                <input type="date" class="form-control" id="desde2" value='`+desde+`'>
                
                
              </div>

              <div class="col-lg-12 p-2">
                <label for="hasta2" class="col-form-label">Hasta:</label>
            
                <input type="date" class="form-control" id="hasta2" value='`+hasta+`'>
                
                
              </div>`;
     

                  Swal.fire({
                          title: 'Curso: '+curso+'; Asignatura: '+asig,
                          html:ret, 
                          focusConfirm: false,
                          showCancelButton: true,                         
                          }).then((result) => {
                            if (result.value) {                                             
                              situacionRevista2 = document.getElementById('situacionRevista2').value;
                              obserbaci2 = document.getElementById('obserbaci2').value;
                              desde2 = document.getElementById('desde2').value;
                              hasta2 = document.getElementById('hasta2').value;
                          
                   

                              editarAsignaturaAsignada(id,situacionRevista2,obserbaci2,desde2,hasta2);
                                              
                            }
                    });

     

     




   


    
});





function editarAsignaturaAsignada(id,situacionRevista2,obserbaci2,desde2,hasta2) {




if (desde=='' || hasta=='') {

      Swal.fire({
                  icon: 'error',
                  title: 'LOS CAMPOS NO ESTAN SELECCIONADOS',
                  text: 'Compruebe los campos',
                  footer: '<a href>Why do I have this issue?</a>'
                })




    }else{

      opcion=4;
                    idAsig=id;
                    idcursoAsig=null;
                    idAsignaturaAsig=null;
                    idcursoAsig=null;
                    situacionRevista=situacionRevista2;
                    desde=desde2;
                    hasta=hasta2;
                    obserbaci=obserbaci2;

      
                  $.ajax({
                      type:"post",
                      data:'idcursoAsig=' + idcursoAsig + '&idAsignaturaAsig=' + idAsignaturaAsig + '&opcion=' + opcion + '&idAsig=' + idAsig + '&situacionRevista=' + situacionRevista + '&desde=' + desde + '&hasta=' + hasta + '&obserbaci=' + obserbaci,
                      url:'modulos/gestionAcademicaDocente/dj/elementos/crud_altaBajaAsignacion.php',
                      
                       beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_nuevo_dia_hora").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = true;
                                $(".btnGroupDrop10").attr("disabled", true);
                                $(".btnGroupDrop11").attr("disabled", true);
                                $(".btnGroupDrop12").attr("disabled", true);
                                $('#cargaCiclo').show();

                            },
                      success:function(data){

                      


                      res = data.split('||');

                               
                        idAsig = res[0];
                        nombre = res[1];
                        nombreCurso = res[2];
                        situacionRevista = res[3];
                        desde = res[4];
                        hasta = res[5];
                        obserbaci = res[6];
  
                            tablaDocente_Asig.row(fila).data([idAsig,nombreCurso,nombre,situacionRevista,desde,hasta,obserbaci]).draw();

                            $("#imagenProceso").hide();
                                document.getElementById("btn_nuevo_dia_hora").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = false;
                                $(".btnGroupDrop10").attr("disabled", false);
                                $(".btnGroupDrop11").attr("disabled", false);
                                $(".btnGroupDrop12").attr("disabled", false);
                                $('#cargaCiclo').hide();
                       


                        
                    }        
                }); 
                

                     
    }



    
}








$(document).on("click", ".btneditar_cargo", function(e){
    e.preventDefault();

    fila = $(this).closest("tr");

 
    id_asig_cargo = parseInt(fila.find('td:eq(0)').text());
    cargoF = fila.find('td:eq(1)').text();
    situacionRevistaF = fila.find('td:eq(2)').text();
    desdeF = fila.find('td:eq(3)').text();
    hastaF = fila.find('td:eq(4)').text();
    lunesF = fila.find('td:eq(5)').text();
    martesF = fila.find('td:eq(6)').text();
    miercolesF = fila.find('td:eq(7)').text();
    juevesF = fila.find('td:eq(8)').text();
    viernesF = fila.find('td:eq(9)').text();


    res = lunesF.split('//');
    lunesF1 = res[0];
    lunesF2 = res[1];

    res = martesF.split('//');
    martesF1 = res[0];
    martesF2 = res[1];

    res = miercolesF.split('//');
    miercolesF1 = res[0];
    miercolesF2 = res[1];

    res = juevesF.split('//');
    juevesF1 = res[0];
    juevesF2 = res[1];

    res = viernesF.split('//');
    viernesF1 = res[0];
    viernesF2 = res[1];



    opcion=3;

    $('#cargoF').val(cargoF);

    $('#inf').html('');

    $('#situacionRevistaF').val(situacionRevistaF);
    $('#desdeF').val(desdeF);
    $('#hastaF').val(hastaF);
    
    $('#lunesFINAL').val(lunesF1);
    $('#martesFINAL').val(martesF1);
    $('#miercolesFINAL').val(miercolesF1);
    $('#juevesFINAL').val(juevesF1);
    $('#viernesFINAL').val(viernesF1);
   
    
    $('#lunesF').val(lunesF2);
    $('#martesF').val(martesF2);
    $('#miercolesF').val(miercolesF2);
    $('#juevesF').val(juevesF2);
    $('#viernesF').val(viernesF2);
   


    $(".modal-header").css("background-color", "#D3C607");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Asignación Cargo Editar<?php echo $cicloLectivoFINAL; ?>");            
    $("#modalCRUD_Docente_Asig_cargo").modal("show"); 


    
});

  


$("#btn_nuevo_dia_hora_Cargo").click(function(){

    
    
    $(".modal-header").css("background-color", "#D3C607");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Asignación Cargo <?php echo $cicloLectivoFINAL; ?>");            
    $("#modalCRUD_Docente_Asig_cargo").modal("show"); 


    id_asig_cargo=null;
    opcion=1;
    
}); 


$("#btn_nuevo_dia_hora_Proyecto").click(function(){


      $(".modal-header").css("background-color", "#D3C607");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Asignación Horas Proyecto <?php echo $cicloLectivoFINAL; ?>");            
    $("#modalCRUDDocenteAsigProyecto").modal("show");


    id_asig_proyecto=null;
    opcion=1;
    
}); 





$(document).on("click", ".btneditar_Proyecto", function(e){
    e.preventDefault();

    fila = $(this).closest("tr");

 
    id_asig_proyecto = parseInt(fila.find('td:eq(0)').text());
    cHoras = fila.find('td:eq(1)').text();
    situacionRevistaF = fila.find('td:eq(2)').text();
    desdeF = fila.find('td:eq(3)').text();
    hastaF = fila.find('td:eq(4)').text();
    lunesF = fila.find('td:eq(5)').text();
    martesF = fila.find('td:eq(6)').text();
    miercolesF = fila.find('td:eq(7)').text();
    juevesF = fila.find('td:eq(8)').text();
    viernesF = fila.find('td:eq(9)').text();
    licencia = fila.find('td:eq(10)').text();





    res = lunesF.split('//');
    lunesF1 = res[0];
    lunesF2 = res[1];

    res = martesF.split('//');
    martesF1 = res[0];
    martesF2 = res[1];

    res = miercolesF.split('//');
    miercolesF1 = res[0];
    miercolesF2 = res[1];

    res = juevesF.split('//');
    juevesF1 = res[0];
    juevesF2 = res[1];

    res = viernesF.split('//');
    viernesF1 = res[0];
    viernesF2 = res[1];



    opcion=3;

    $('#cHoras').val(cHoras);

    $('#licencia').val(licencia);
    

    $('#inf').html('');

    $('#situacionRevistaFProyecto').val(situacionRevistaF);
    $('#desdeFProyecto').val(desdeF);
    $('#hastaFProyecto').val(hastaF);
    
    $('#lunesFINALProyecto').val(lunesF1);
    $('#martesFINALProyecto').val(martesF1);
    $('#miercolesFINALProyecto').val(miercolesF1);
    $('#juevesFINALProyecto').val(juevesF1);
    $('#viernesFINALProyecto').val(viernesF1);
   
    
    $('#lunesFProyecto').val(lunesF2);
    $('#martesFProyecto').val(martesF2);
    $('#miercolesFProyecto').val(miercolesF2);
    $('#juevesFProyecto').val(juevesF2);
    $('#viernesFProyecto').val(viernesF2);
   


    $(".modal-header").css("background-color", "#D3C607");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Asignación Horas Proyecto Editar<?php echo $cicloLectivoFINAL; ?>");            
    $("#modalCRUDDocenteAsigProyecto").modal("show"); 


    
});





//------


$("#fromasignacionProyecto").submit(function(e){
    e.preventDefault(); 


  cHoras= $('#cHoras').val();

  situacionRevistaF= $('#situacionRevistaFProyecto').val();
  desdeF= $('#desdeFProyecto').val();
  hastaF= $('#hastaFProyecto').val();
 
  luneTurno= $('#lunesFINALProyecto').val();
  marteTurno= $('#martesFINALProyecto').val();
  miercoleTurno= $('#miercolesFINALProyecto').val();
  jueveTurno= $('#juevesFINALProyecto').val();
  vierneTurno= $('#viernesFINALProyecto').val();


  lunesHorario= $('#lunesFProyecto').val();
  martesHorario= $('#martesFProyecto').val();
  miercolesHorario= $('#miercolesFProyecto').val();
  juevesHorario= $('#juevesFProyecto').val();
  viernesHorario= $('#viernesFProyecto').val();

    licencia= $('#licencia').val();
 


    if (cHoras=='' || situacionRevistaF==0 || desdeF=='' || hastaF=='' ) {

      Swal.fire({
                  icon: 'error',
                  title: 'LOS CAMPOS NO ESTAN SELECCIONADOS',
                  text: 'Compruebe los campos',
                  footer: '<a href>Why do I have this issue?</a>'
                })




    }else{


                  $.ajax({
                      type:"post",
                      data:'id_asig_proyecto=' + id_asig_proyecto + '&cHoras=' + cHoras + '&opcion=' + opcion + '&situacionRevistaF=' + situacionRevistaF + '&desdeF=' + desdeF + '&hastaF=' + hastaF + '&luneTurno=' + luneTurno+ '&marteTurno=' + marteTurno+ '&miercoleTurno=' + miercoleTurno+ '&jueveTurno=' + jueveTurno+ '&vierneTurno=' + vierneTurno+ '&lunesHorario=' + lunesHorario+ '&martesHorario=' + martesHorario+ '&miercolesHorario=' + miercolesHorario+ '&juevesHorario=' + juevesHorario+ '&viernesHorario=' + viernesHorario+ '&licencia=' + licencia,
                      url:'modulos/gestionAcademicaDocente/dj/elementos/crud_altaBajaAsignacion_proyecto.php',
            
                       beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_nuevo_dia_hora").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = true;
                                $(".btnGroupDrop10").attr("disabled", true);
                                $(".btnGroupDrop11").attr("disabled", true);
                                $(".btnGroupDrop12").attr("disabled", true);
                                $('#cargaCiclo').show();

                            },
                      success:function(data){

                      console.log(data);


                      res = data.split('||');

                               
                        id_asig_proyecto = res[0];
                        cHoras = res[1];
                        situacionRevistaF = res[2];
                        desdeF = res[3];
                        hastaF = res[4];
                        lunesF = res[5];
                        martesF = res[6];
                        miercolesF = res[7];
                        juevesF = res[8];
                        viernesF = res[9];

                        licencia = res[10];


                        if(opcion == 1){tablaDocente_Asig_Proyecto.row.add([id_asig_proyecto,cHoras,situacionRevistaF,desdeF,hastaF,lunesF,martesF,miercolesF,juevesF,viernesF,licencia]).draw();}
            else{tablaDocente_Asig_Proyecto.row(fila).data([id_asig_proyecto,cHoras,situacionRevistaF,desdeF,hastaF,lunesF,martesF,miercolesF,juevesF,viernesF,licencia]).draw();} 
  
                          

                            $("#imagenProceso").hide();
                                document.getElementById("btn_nuevo_dia_hora").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = false;
                                $(".btnGroupDrop10").attr("disabled", false);
                                $(".btnGroupDrop11").attr("disabled", false);
                                $(".btnGroupDrop12").attr("disabled", false);
                                $('#cargaCiclo').hide();
                       

                        
                    }        
                }); 
                

                  $("#modalCRUDDocenteAsigProyecto").modal("hide");   
    }
});    




//-------













$("#fromasignacionCargo").submit(function(e){
    e.preventDefault(); 


  cargoF= $('#cargoF').val();

  situacionRevistaF= $('#situacionRevistaF').val();
  desdeF= $('#desdeF').val();
  hastaF= $('#hastaF').val();
 
  luneTurno= $('#lunesFINAL').val();
  marteTurno= $('#martesFINAL').val();
  miercoleTurno= $('#miercolesFINAL').val();
  jueveTurno= $('#juevesFINAL').val();
  vierneTurno= $('#viernesFINAL').val();


  lunesHorario= $('#lunesF').val();
  martesHorario= $('#martesF').val();
  miercolesHorario= $('#miercolesF').val();
  juevesHorario= $('#juevesF').val();
  viernesHorario= $('#viernesF').val();

 

    if (cargoF=='SELECCIONE UN CARGO' || situacionRevistaF==0 || desdeF=='' || hastaF=='' ) {

      Swal.fire({
                  icon: 'error',
                  title: 'LOS CAMPOS NO ESTAN SELECCIONADOS',
                  text: 'Compruebe los campos',
                  footer: '<a href>Why do I have this issue?</a>'
                })




    }else{
                console.log('id_asig_cargo=' + id_asig_cargo + '&cargoF=' + cargoF + '&opcion=' + opcion + '&situacionRevistaF=' + situacionRevistaF + '&desdeF=' + desdeF + '&hastaF=' + hastaF + '&luneTurno=' + luneTurno+ '&marteTurno=' + marteTurno+ '&miercoleTurno=' + miercoleTurno+ '&jueveTurno=' + jueveTurno+ '&vierneTurno=' + vierneTurno+ '&lunesHorario=' + lunesHorario+ '&martesHorario=' + martesHorario+ '&miercolesHorario=' + miercolesHorario+ '&juevesHorario=' + juevesHorario+ '&viernesHorario=' + viernesHorario)

                  $.ajax({
                      type:"post",
                      data:'id_asig_cargo=' + id_asig_cargo + '&cargoF=' + cargoF + '&opcion=' + opcion + '&situacionRevistaF=' + situacionRevistaF + '&desdeF=' + desdeF + '&hastaF=' + hastaF + '&luneTurno=' + luneTurno+ '&marteTurno=' + marteTurno+ '&miercoleTurno=' + miercoleTurno+ '&jueveTurno=' + jueveTurno+ '&vierneTurno=' + vierneTurno+ '&lunesHorario=' + lunesHorario+ '&martesHorario=' + martesHorario+ '&miercolesHorario=' + miercolesHorario+ '&juevesHorario=' + juevesHorario+ '&viernesHorario=' + viernesHorario,
                      url:'modulos/gestionAcademicaDocente/dj/elementos/crud_altaBajaAsignacion_cargo.php',
            
                       beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_nuevo_dia_hora").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = true;
                                $(".btnGroupDrop10").attr("disabled", true);
                                $(".btnGroupDrop11").attr("disabled", true);
                                $(".btnGroupDrop12").attr("disabled", true);
                                $('#cargaCiclo').show();

                            },
                      success:function(data){

                      console.log(data);


                      res = data.split('||');

                               
                        id_asig_cargo = res[0];
                        cargoF = res[1];
                        situacionRevistaF = res[2];
                        desdeF = res[3];
                        hastaF = res[4];
                        lunesF = res[5];
                        martesF = res[6];
                        miercolesF = res[7];
                        juevesF = res[8];
                        viernesF = res[9];


                        if(opcion == 1){tablaDocente_Asig_cargo.row.add([id_asig_cargo,cargoF,situacionRevistaF,desdeF,hastaF,lunesF,martesF,miercolesF,juevesF,viernesF]).draw();}
            else{tablaDocente_Asig_cargo.row(fila).data([id_asig_cargo,cargoF,situacionRevistaF,desdeF,hastaF,lunesF,martesF,miercolesF,juevesF,viernesF]).draw();} 
  
                          

                            $("#imagenProceso").hide();
                                document.getElementById("btn_nuevo_dia_hora").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = false;
                                $(".btnGroupDrop10").attr("disabled", false);
                                $(".btnGroupDrop11").attr("disabled", false);
                                $(".btnGroupDrop12").attr("disabled", false);
                                $('#cargaCiclo').hide();
                       

                        
                    }        
                }); 
                

                  $("#modalCRUD_Docente_Asig_cargo").modal("hide");   
    }
});    















$("#btn_nuevo_dia_hora").click(function(){

    
  $('#asig').load('modulos/gestionAcademicaDocente/dj/elementos/cursoA.php');

    $('#informacion').html(''); 
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#D3C607");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Asignación <?php echo $cicloLectivoFINAL; ?>");            
    $("#modalCRUD_Docente_Asig").modal("show"); 
    
}); 




$("#curso").change(function(){

      curso= $('#curso').val();



      
      if (curso==0) {

        $('#cus').html('');

      }else{
      
       $.ajax({
          type:"post",
          data:'curso=' + curso,
          url:'modulos/gestionAcademicaDocente/dj/elementos/sessi2.php',
         
          success:function(r){

         
          
           $('#cus').load('modulos/gestionAcademicaDocente/dj/elementos/curso.php');
         
          }
        });

      }

      });




var tablaDocente_Asig_Proyecto = $('#tablaDocente_Asig_Proyecto').DataTable({ 

          
    "destroy":true,  
    "columnDefs":[{
       
        "targets": -1,
        "data":null,
        "defaultContent": `<div class="btn-group" role="group">
                                    <button id="btnGroupDrop10" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop10">
                                      
                                      <li><a title='Modificar tola la fila' class="dropdown-item btneditar_Proyecto" href="javascript:void(0)">Editar</a></li>
                                      <li><a title='Eliminar tola la fila' class="dropdown-item btnBorrar_Docente_asignacion_Proyecto" href="javascript:void(0)">Eliminar</a></li>
                                    </ul>
                                  </div>
                                </div>`,

   

       },

      

       ],


        
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




var tablaDocente_Asig_cargo = $('#tablaDocente_Asig_cargo').DataTable({ 

          
    "destroy":true,  
    "columnDefs":[{
       
        "targets": -1,
        "data":null,

        "defaultContent": `<div class="btn-group" role="group">
                                    <button id="btnGroupDrop11" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop11">
                                      
                                      <li><a title='Modificar tola la fila' class="dropdown-item btneditar_cargo" href="javascript:void(0)">Editar</a></li>
                                      <li><a title='Eliminar tola la fila' class="dropdown-item btnBorrar_Docente_asignacion_cargo" href="javascript:void(0)">Eliminar</a></li>
                                    </ul>
                                  </div>
                                </div>`,


       },

      

       ],


        
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




 var tablaDocente_Asig = $('#tablaDocente_Asig').DataTable({ 

          
    "destroy":true,  
    "columnDefs":[{
       
        "targets": -1,
        "data":null,
      
        "defaultContent": `<div class="btn-group" role="group">
                                    <button id="btnGroupDrop12" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="fas fa-align-center"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop12">
                                      
                                      <li><a title='Modificar tola la fila' class="dropdown-item btnEDITAR_Docente_asignacion" href="javascript:void(0)">Editar</a></li>
                                      <li><a title='Eliminar tola la fila' class="dropdown-item btnBorrar_Docente_asignacion" href="javascript:void(0)">Eliminar</a></li>
                                    </ul>
                                  </div>
                                </div>`,


       },

      

       ],


        
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








$("#fromasignacion").submit(function(e){
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



  idcursoAsig= $('#curso').val();

  idAsignaturaAsig= $('#asicCURS').val();
  situacionRevista= $('#situacionRevista').val();
  desde= $('#desde').val();
  hasta= $('#hasta').val();

  obserbaci= $('#obserbaci').val();
 
 
  


    if (idcursoAsig==0 || idAsignaturaAsig==0 || situacionRevista==0 || desde=='' || hasta=='') {

      Swal.fire({
                  icon: 'error',
                  title: 'LOS CAMPOS NO ESTAN SELECCIONADOS',
                  text: 'Compruebe los campos',
                  footer: '<a href>Why do I have this issue?</a>'
                })




    }else{

    opcion=1;
    idAsig=null;


      
                  $.ajax({
                      type:"post",
                      data:'idcursoAsig=' + idcursoAsig + '&idAsignaturaAsig=' + idAsignaturaAsig + '&opcion=' + opcion + '&idAsig=' + idAsig + '&situacionRevista=' + situacionRevista + '&desde=' + desde + '&hasta=' + hasta + '&obserbaci=' + obserbaci,
                      url:'modulos/gestionAcademicaDocente/dj/elementos/crud_altaBajaAsignacion.php',
                      
                       beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_nuevo_dia_hora").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = true;
                                $(".btnGroupDrop10").attr("disabled", true);
                                $(".btnGroupDrop11").attr("disabled", true);
                                $(".btnGroupDrop12").attr("disabled", true);
                                $('#cargaCiclo').show();

                            },
                      success:function(data){

                      


                      res = data.split('||');

                               
                        idAsig = res[0];
                        nombre = res[1];
                        nombreCurso = res[2];
                        situacionRevista = res[3];
                        desde = res[4];
                        hasta = res[5];
                        obserbaci = res[6];
  
                            tablaDocente_Asig.row.add([idAsig,nombreCurso,nombre,situacionRevista,desde,hasta,obserbaci]).draw();

                            $("#imagenProceso").hide();
                                document.getElementById("btn_nuevo_dia_hora").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = false;
                                $(".btnGroupDrop10").attr("disabled", false);
                                $(".btnGroupDrop11").attr("disabled", false);
                                $(".btnGroupDrop12").attr("disabled", false);
                                $('#cargaCiclo').hide();
                       

                        
                    }        
                }); 
                

                  $("#modalCRUD_Docente_Asig").modal("hide");  

                   $.unblockUI();  



    }
});    


$(document).on("click", ".btnBorrar_Docente_asignacion", function(){    
    fila = $(this);
    idAsig = parseInt($(this).closest("tr").find('td:eq(0)').text());
    
     cicloLectivo= $.trim($("#cicloLectivo").val());


    opcion = 2 ;//borrar

    eliminarAntesPlanDocenteAsig(idAsig,opcion,cicloLectivo);
  
});
    




function eliminarAntesPlanDocenteAsig(idAsig,opcion,cicloLectivo) {

  

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

    eliminarAntesPlanDocenteAsigFINAL(idAsig,opcion,cicloLectivo);
  }
})



      
     
}


function  eliminarAntesPlanDocenteAsigFINAL(idAsig,opcion,cicloLectivo){


        
        $.ajax({
            url: "modulos/gestionAcademicaDocente/dj/elementos/crud_altaBajaAsignacion.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idAsig:idAsig, cicloLectivo:cicloLectivo},
             beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_nuevo_dia_hora").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = true;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = true;
                                $(".btnGroupDrop10").attr("disabled", true);
                                $(".btnGroupDrop11").attr("disabled", true);
                                $(".btnGroupDrop12").attr("disabled", true);
                                $('#cargaCiclo').show();

                            },
            success: function(){
            
               
            }
        });
        $("#imagenProceso").hide();
                                document.getElementById("btn_nuevo_dia_hora").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Cargo").disabled = false;
                                document.getElementById("btn_nuevo_dia_hora_Proyecto").disabled = false;
                                $(".btnGroupDrop10").attr("disabled", false);
                                $(".btnGroupDrop11").attr("disabled", false);
                                $(".btnGroupDrop12").attr("disabled", false);
                                $('#cargaCiclo').hide();
        tablaDocente_Asig.row(fila.parents('tr')).remove().draw();
         

    
}


    


    
});

 $.unblockUI();
</script>