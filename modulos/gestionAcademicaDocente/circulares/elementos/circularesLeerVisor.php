<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
 

$id_circular = (isset($_POST['id_circular'])) ? $_POST['id_circular'] : '';



        $consulta = "SELECT `id_circular`, `numero`, `url`, `type` FROM `circular` WHERE `id_circular`='$id_circular'";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;