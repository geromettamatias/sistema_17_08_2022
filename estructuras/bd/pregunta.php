<?php
include_once '../../modulos/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 

$ob = (isset($_POST['ob'])) ? $_POST['ob'] : '';
$r='NO';
if ($ob=='1') {

    $consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos` WHERE `tipo`='LIBRETA DIGITAL' AND `usuario`='DOCENTE'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
        	$r=$dat['pregunta'];
        
        }
    echo $r;

}else if ($ob=='5') {
    
    $consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos` WHERE `tipo`='INCRIPCIÓN A LAS MESAS' AND `usuario`='ALUMNO'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
            $r=$dat['pregunta'];
        
        }
    echo $r;
 

}else if ($ob=='15') {
    
    $consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos` WHERE `tipo`='AJUSTES' AND `usuario`='DOCENTE'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
            $r=$dat['pregunta'];
        
        }
    echo $r;
    




  
}else if ($ob=='9') {
    
    $consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos` WHERE `tipo`='INASISTENCIA NO ASIG' AND `usuario`='ALUMNO'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
            $r=$dat['pregunta'];
        
        }
    echo $r;
    
  
}else if ($ob=='20') {
    
    $consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos` WHERE `tipo`='GESTIÓN D.J.' AND `usuario`='DOCENTE'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
            $r=$dat['pregunta'];
        
        }
    echo $r;
    
  
}else{

	$consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos` WHERE `tipo`='INASISTENCIA' AND `usuario`='DOCENTE'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $dat) {
        	$r=$dat['pregunta'];
        
        }
    echo $r;
	
}

        
   

$conexion = NULL;