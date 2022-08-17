<?php

$numero = $_POST['numero'];


 if(is_array($_FILES) && count($_FILES)>0){



if(move_uploaded_file($_FILES["pdf"]["tmp_name"],"../pdfCirculares/".$numero."_".$_FILES["pdf"]["name"])){


$new_name_file = $numero."_".$_FILES["pdf"]["name"];
$extension="pdf";       
 




include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 




$consulta = "INSERT INTO `circular`(`id_circular`, `numero`, `url`, `type`) VALUES (null,'$numero','$new_name_file','$extension')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        
$conexion = NULL;

echo 1;
 
  }else{
         echo 0;
    }

 }else{
    echo 0;
 }








?>






