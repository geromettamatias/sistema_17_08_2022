<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 

$numero = (isset($_POST['numero'])) ? $_POST['numero'] : '';


        $consulta = "SELECT `id_circular`, `numero`, `url`, `type` FROM `circular` WHERE `numero`='$numero'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;