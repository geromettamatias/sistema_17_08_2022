$(document).ready(function(){

    $('#iconosInicio').load('modulos/extras/inicio/inicio.php');

     $('#tablaInstitucional').load('modulos/extras/inicio/elementos.php');



     $('#cerrarCesionFinal').load('modulos/extras/cerrarSession/modalCerrar.php');


    $('#imagenProceso').hide();

    cargaDatoPagina();

    cargaDatoPagina_Login();


    cargarDatos();
   

    
    function sacarSelect() {
      
      $("#circularesP").removeClass("nav-link active");
      $("#circularesP").addClass("nav-link");

      $("#inasistencia").removeClass("nav-link active");
      $("#inasistencia").addClass("nav-link");

     
      $("#actaExamen").removeClass("nav-link active");
      $("#actaExamen").addClass("nav-link");


      $("#libretaDigitalDocente").removeClass("nav-link active");
      $("#libretaDigitalDocente").addClass("nav-link");


      $("#generarPedido").removeClass("nav-link active");
      $("#generarPedido").addClass("nav-link");

    }




$('#buscar').keydown(function (e){

 if(e.keyCode == 13){ 
      
               
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

    

         buscar = $("#buscar").val();
     
         
       $.ajax({
            url: "modulos/buscarDocentesAlumnos/elementos/session.php",
            type: "POST",
            dataType: "json",
            data: {buscar:buscar},
            success: function(res){

                

                if (res=="1") {
                         $('#imagenProceso').show();
                    $('#contenidoAyuda').html(''); 
                       $('#contenidoCursos').html('');
                    $('#tablaInstitucional').html('');
        
                 $('#tablaInstitucional').load('modulos/buscarDocentesAlumnos/buscar.php');
               

                }

                 
            }
        });





} 



});








    

// $("#dj").click(function(){
        
//           $('#imagenProceso').show();
//         $('#contenidoAyuda').html(''); 
       
//         $('#buscarTablaInstitucional').load('modulos/gestionAcademicaDocente/dj/buscar.php');
//         $('#tablaInstitucional').html('');
//         sacarSelect();
//                     $("#dj").removeClass("nav-link");
//                     $("#dj").addClass("nav-link active");
                    
   
        
//     });





 $("#dj").click(function(){


             
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
        sacarSelect();
                    $("#dj").removeClass("nav-link");
                    $("#dj").addClass("nav-link active");
             

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
















$("#generarPedido").click(function(){
        
          $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/gestionAcademicaDocente/generarPedido/generarPedidos.php');

        sacarSelect();
                    $("#generarPedido").removeClass("nav-link");
                    $("#generarPedido").addClass("nav-link active");
                    
   
        
    });





    $("#usuarioTexto").click(function(){

 
      toastr.success('Es el nivel de usuario que está actualmente designado, dentro del sistema');

   
    });


   $("#autoGestionTitulo").click(function(){

      toastr.success('Sistema de Gestión escolar donde administra toda la información institucional');


   
    });



    $("#cerrarSession").click(function(){
      $('#imagenProceso').show();


    $(".modal-header").css("background-color", "#DC1738");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("¿Confirma salir y cerrar Sesión?");            
    
    $('#imagenProceso').hide();


  }); 












function actualizar_final(){

                 
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
          data:'ob=' + '15',
          url:'estructuras/bd/pregunta.php',
          success:function(r){
          

            if (r=='SI') {


                  Swal.fire(
                  'IMPORTANTE !!',
                  'No se olvide de guardar los datos despues de modificarlos',
                  'warning'
                )



                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').load('modulos/extras/ajustes/ajustes.php');
                $('#tablaInstitucional').html('');
               


           
                  sacarSelect();
             

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



}




 $("#ajustesFinal").click(function(){



    actualizar_final();
        
            
   
        
    });


function cargarDatos(){

    Swal.fire({
  title: 'Actualización de los datos personales',
  text: "Los datos personales son necesarios para la comunicación, rendiciones, etc…",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Actualizar'
}).then((result) => {
  if (result.isConfirmed) {
    actualizar_final();
  }
})


}










     $("#libretaDigitalDocente").click(function(){



            
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


                  sacarSelect();
                    $("#libretaDigitalDocente").removeClass("nav-link");
                    $("#libretaDigitalDocente").addClass("nav-link active");
                    
           

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













     $("#actaExamen").click(function(){


            
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
          data:'ob=' + '5',
          url:'estructuras/bd/pregunta.php',
          success:function(r){
      
            if (r=='NO') {

                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actasBuscar.php');
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').show();

                  Swal.fire(
                  'IMPORTANTE !!',
                  'No se olvide de guardar los datos despues de modificarlos',
                  'warning'
                )


                  sacarSelect();
                    $("#actaExamen").removeClass("nav-link");
                    $("#actaExamen").addClass("nav-link active");
                    
           

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




        $("#circularProfe").click(function(){
          $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/gestionAcademicaDocente/circulares/circulares.php');

        sacarSelect();
                    $("#circularProfe").removeClass("nav-link");
                    $("#circularProfe").addClass("nav-link active");
                    
   
        
    });



























      



});





function cargaDatoPagina() {
  

        $.ajax({
        url: "estructuras/bd/datoAplicativoLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
       
            tituloS = data.titulo;
            tituloMenuS = data.tituloMenu;
            url = data.url;
            
      

            $('#logoImagenF').val('<img src="../elementos/'+url+'"   style="width: 40%;" class="mx-auto d-block">');

        

            var imagenPrevisualizacion = document.querySelector("#mostrarimagenLo");

            //  verificamos que sea PDF
           
                 imagenPrevisualizacion.src = "../elementos/"+url+"";



                  var imagenPrevisualizacionFFF = document.querySelector("#mostrarimagenLoFFF");

            //  verificamos que sea PDF
           
                 imagenPrevisualizacionFFF.src = "../elementos/"+url+"";    







         
            //  verificamos que sea PDF
           
               imagenPrevisualizacion.src = "../elementos/"+url+"";

        $('#tituloMenuURL').val(url);

          $('#titulo').html('<title>'+tituloS+'</title>');    
                      $("#tituloMenu").html(tituloMenuS);
              
        }        
    });

}




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

