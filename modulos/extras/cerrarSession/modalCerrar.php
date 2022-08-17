
<div class="modal fade" id="modal_Cerrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
   <form id="forCierre">    
                         
            <div class="modal-body">
                
          <div class="mx-auto" style="width: 200px;">
          <img onclick="cerrar()" class="animation__shake" src="../elementos/csesion_btn2.png" height="200" width="200" >
            
               
</div>
              

            </div>   
                     
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class='fas fa-window-close'></i></button>
                <button type="submit"  class="btn btn-dark"> <i class='fas fa-power-off'></i></button>
            </div>
        </form> 
    </div>
  </div>
</div>

 
 <script type="text/javascript">
$(document).ready(function(){

$("#btn_Finalizar").click(function(){


    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Cerrar Sesion");            
    $("#modal_Cerrar").modal("show"); 

  
}); 

$("#forCierre").submit(function(e){
    e.preventDefault();    
 
   
    $.ajax({
        url: "modulos/extras/cerrarSession/elementos/cierre.php",
        type: "POST",
        data: {},
        success: function(data){

        if (data=='si') {  
            
           
           location.href ="../index.php"; 

        }
                     
        }        
    });
    $("#modal_Cerrar").modal("hide");    
    
});    
    

    
});


function cerrar(){

 $.ajax({
        url: "modulos/extras/cerrarSession/elementos/cierre.php",
        type: "POST",
        data: {},
        success: function(data){

        if (data=='si') {  
            
           
           location.href ="../index.php"; 

        }
                     
        }        
    });
    $("#modal_Cerrar").modal("hide");    

}

</script>

