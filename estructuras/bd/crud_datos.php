<?php
session_start();

if  (isset($_SESSION['idUsuario'])){


    $idUsuario=$_SESSION['idUsuario'];

include_once '../../modulos/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT `idDocente`, `dni`, `nombre`, `domicilio`, `email`, `telefono`, `titulo`, `passwordDocente`, `hijos` FROM `datos_docentes` WHERE  `idDocente`='$idUsuario'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
  
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach($data1 as $dat1) {  

        echo $dat1['nombre'].'<br>'.$dat1['dni'];
}



}else{
    $conexion=null;
     unset($_SESSION["idUsuario"]);

    
    session_destroy();
       echo 0;

}




}else{
    $conexion=null;
     unset($_SESSION["idUsuario"]);

    
    session_destroy();
    echo 0;

}

