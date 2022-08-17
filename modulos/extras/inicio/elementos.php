

<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Datos del Profesor
                </h3>
              </div>
              <div class="card-body">

                  <div id="infoPersonal"></div>

	          

               
              </div>
              <!-- /.card -->
            </div>






            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Anuncios
                </h3>
              </div>
              <div class="card-body">

                

              
                <div id="anunciosLeer" ></div>

               
              </div>
              <!-- /.card -->
            </div>





<script type="text/javascript">
  anuncioDocente();


  datosPersonal();


function anuncioDocente() {


  
        $.ajax({
        url: "modulos/extras/inicio/elementos/anuncioLeerDocente.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            info = data.anuncio.informe;
           

            
            $("#anunciosLeer").html(info);
            

                  
        }        
    });
}




function datosPersonal() {


  
        $.ajax({
        url: "estructuras/bd/datosDocente.php",
        type: "POST",
        dataType: "json",
        data: {},
         success: function(data){  
            

            idDocente = data[0].idDocente;            
            nombre = data[0].nombre;
            dni = data[0].dni;
            domicilio = data[0].domicilio;
            email = data[0].email;
            telefono = data[0].telefono;
            titulo = data[0].titulo;


            $("#infoPersonal").html('<b>USUARIO: </b>'+nombre+'<br><b>DNI: </b>'+dni+'<br><b>Correo: </b>'+email+'<br><b>Telefono: </b>'+telefono+'<br><b>Titulo: </b>'+titulo+'<br><b>Domicilio: </b>'+domicilio);
            

                  
        }        
    });
}




</script>


