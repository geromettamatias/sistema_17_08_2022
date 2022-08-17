
<!--INICIO del cont principal-->
<div class="container">
<?php
include_once '../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
session_start();


if (isset($_SESSION["idUsuario"])){
$s_usuarioProfesor=$_SESSION['idUsuario'];
 $dni=$_SESSION["dni"];


         $c3onsulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `hijos` FROM `datos_docentes` WHERE `dni`='$dni'";
        $r3esultado = $conexion->prepare($c3onsulta);
        $r3esultado->execute();
        $d3ata=$r3esultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($d3ata as $d3at) {
            $idDocente=$d3at['idDocente'];
            $nombre=$d3at['nombre'];
            $dni=$d3at['dni'];
            $domicilio=$d3at['domicilio'];
            $email=$d3at['email'];
            $telefono=$d3at['telefono'];
            $titulo=$d3at['titulo'];
            $hijos=$d3at['hijos'];
          
         }






?>

<input hidden="" value="<?php echo $idDocente; ?>" id="idDocente">












<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  AJUSTES
                </h3>
              </div>
              <div class="card-body">

                

                <button id="cambiarContraseña" type="button" class="btn btn-success" data-toggle="modal" title="CAMBIO DE CONTRASEÑA">CAMBIO DE CONTRASEÑA <i class='fas fa-edit'></i></button><br> <hr>    



                  <form id="formDatos">
					  <div class="mb-3">
					    <label for="dniDocente" class="form-label">DNI del Docente</label>
					    <input type="text" class="form-control" id="dniDocente" aria-describedby="dniHelp" value="<?php echo $dni; ?>" title='No se Puede Editar el DNI- debera hablar con el administrador' readonly>
					    <div id="dniHelp" class="form-text">El numero de DNI es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="nombreDocente" class="form-label">Apellido y Nombre del Docente</label>
					    <input type="text" class="form-control" id="nombreDocente" aria-describedby="nombreDocenteHelp" value="<?php echo $nombre; ?>" required>
					    <div id="nombreDocenteHelp" class="form-text">El nombre y apellido del docente es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="domicilioDocente" class="form-label">Domicilio del Docente</label>
					    <input type="text" class="form-control" id="domicilioDocente" aria-describedby="domicilioHelp" value="<?php echo $domicilio; ?>" required>
					    <div id="domicilioHelp" class="form-text">El domicilio del docente es obligatorio</div>
					  </div>
					 <div class="mb-3">
					    <label for="emailDocente" class="form-label">Correo Electronico del Docente</label>
					    <input type="email" class="form-control" id="emailDocente" aria-describedby="emailDocenteHelp" value="<?php echo $email; ?>" required>
					    <div id="emailDocenteHelp" class="form-text">El Email del docente es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="telefonoDocente" class="form-label">Telefono del Docente</label>
					    <input type="text" class="form-control" id="telefonoDocente" aria-describedby="telefonoDocenteHelp" value="<?php echo $telefono; ?>" required>
					    <div id="telefonoDocenteHelp" class="form-text">El Telefono del docente es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="tituloDocente" class="form-label">Titulo que possee el Docente</label>
					    <input type="text" class="form-control" id="tituloDocente" aria-describedby="tituloDocenteHelp" value="<?php echo $titulo; ?>" required>
					    <div id="tituloDocenteHelp" class="form-text">El titulo del docente es obligatorio</div>
					  </div>
					  <div class="mb-3">
					    <label for="hijos" class="form-label">Posee Hijos en escolaridad? Indique en que nivel :</label>
					    <input type="text" class="form-control" id="hijos" aria-describedby="tituloDocenteHelp" value="<?php echo $hijos; ?>" required>
					    <div id="tituloDocenteHelp" class="form-text">Este dato es obligatorio</div>
					  </div>

					  <div class="mb-3 form-check">
					    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
					    <label class="form-check-label" for="exampleCheck1">Verificación</label>
					  </div>
					  <button type="submit" class="btn btn-primary">Editar los datos personales</button>
					</form>	

               
              </div>
              <!-- /.card -->
            </div>












<div class="modal fade" id="modalCambioContraseña" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">MODIFICAR LA CONTRASEÑA DE INGRESO A LA PLATAFORMA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
                 
            <div class="modal-body">
                
                <form id="formContraseña">

			      					  <div class="form-group">
									    <label for="contraseñaVieja">Contraseña Actual</label>
									    <input type="password" class="form-control" id="contraseñaVieja" required>
									    
									  </div>
									  <hr class="sidebar-divider">
									  <div class="form-group">
									    <label for="nuevaContraseña">Nueva Contraseña</label>
									    <input type="password" class="form-control" id="nuevaContraseña" aria-describedby="nuevaContraseñaHelp" required>
									    <small id="nuevaContraseñaHelp" class="form-text text-muted">Debe tener entre 8 y 20 caracteres.</small>
									  </div>
									  <div class="form-group">
									    <label for="nuevaContraseña2">Repetir la Nueva Contraseña</label>
									    <input type="password" class="form-control" id="nuevaContraseña2" aria-describedby="nuevaContraseñaHelp2" required>
									    <small id="nuevaContraseñaHelp2" class="form-text text-muted">Debe tener entre 8 y 20 caracteres.</small>
									  </div>

									<hr class="sidebar-divider">	
									  <div class="form-check">
									    <input type="checkbox" class="form-check-input" id="nuevaContr" required>
									    <label class="form-check-label" for="nuevaContr">Verificacion</label>
									  </div>
									  <button type="submit" class="btn btn-primary">Guardar la Nueva Contraseña</button>
								
               

            </div>   
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                
            </div>
        </form> 
    </div>
  </div>
</div>

 <script type="text/javascript">
$(document).ready(function(){

$('#imagenProceso').hide();
  
		$("#cambiarContraseña").click(function(){

		    $("#formContraseña").trigger("reset");
		    $(".modal-header").css("background-color", "#1cc88a");
		    $(".modal-header").css("color", "white");
		    $(".modal-title").text("MODIFICAR LA CONTRASEÑA DE INGRESO A LA PLATAFORMA");            
		    $("#modalCambioContraseña").modal("show"); 

		    
		}); 



		$("#formDatos").submit(function(e){
		    e.preventDefault();    
		 
		    idDocente = $.trim($("#idDocente").val());
		    
		   
		    nombreDocente = $.trim($("#nombreDocente").val());
		    domicilioDocente = $.trim($("#domicilioDocente").val());
		    emailDocente = $.trim($("#emailDocente").val());
		    telefonoDocente = $.trim($("#telefonoDocente").val());
		    tituloDocente = $.trim($("#tituloDocente").val());
		    hijos = $.trim($("#hijos").val());
		    
		  
		    $.ajax({
		          type:"post",
		          data:'idDocente=' + idDocente + '&nombreDocente=' + nombreDocente + '&domicilioDocente=' + domicilioDocente + '&emailDocente=' + emailDocente + '&telefonoDocente=' + telefonoDocente + '&tituloDocente=' + tituloDocente + '&hijos=' + hijos,
		          url:'modulos/extras/ajustes/elementos/datosDocente.php',
		          success:function(r){

		          	if (r==1) {

		          		 	cargaDatoPagina_Login();
			          	toastr.success('Datos Modificados');
		          	
		          	

		          	}else{
		          		alert('Error Servidor')
		          	}
		          
		           
		          
		        }
		     });


		}); 



		$("#formContraseña").submit(function(e){
		    e.preventDefault();    
		 
		    idDocente = $.trim($("#idDocente").val());
		    contraseñaVieja = $.trim($("#contraseñaVieja").val());
		    nuevaContraseña = $.trim($("#nuevaContraseña").val());
		    nuevaContraseña2 = $.trim($("#nuevaContraseña2").val());

		   
		  
		  if (nuevaContraseña==nuevaContraseña2) {
		  
		  	   $.ajax({
		          type:"post",
		          data:'idDocente=' + idDocente + '&contraseñaVieja=' + contraseñaVieja + '&nuevaContraseña=' + nuevaContraseña,
		          url:'modulos/extras/ajustes/elementos/pass.php',
		          success:function(r){

		          	if (r==1) {

			          	cargaDatoPagina_Login();
			          	toastr.success('Datos Modificados');
		          	

		          	}else if(r==2){
		        

		          			toastr.error('LA CONTRASEÑA VIEJA ES INCORRECTA, CONSULTE CON EL ADMINISTRADOR');
		          	}else{
		          		toastr.error('Error del Servidor');
		          	}
		          
		           
		          
		        }
		     });

		  	    $("#modalCambioContraseña").modal("hide"); 

		  }else{
		  	toastr.error('La contraseña no son iguales');
		  }

		});    
    
$.unblockUI();
    
});



function cargaDatoPagina_Login() {
  

        $.ajax({
        url: "estructuras/bd/crud_datos.php",
        type: "POST",
        data: {},
        success: function(res){  
     

       if (res!=0) {
          $('#usuarioNombreDNI').html(res);   

          }else{

             window.location.href = "../login/";
          }
 
                     
              
        }        
    });

}

</script>


<?php  } ?>

