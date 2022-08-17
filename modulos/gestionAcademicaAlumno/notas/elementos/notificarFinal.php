<?php
                  
                  include_once '../../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();
               
                  $columSele = (isset($_POST['columSele'])) ? $_POST['columSele'] : '';
                  $id_asignatura = (isset($_POST['id_asignatura'])) ? $_POST['id_asignatura'] : '';
                  $id_curso = (isset($_POST['id_curso'])) ? $_POST['id_curso'] : '';
                  $id_usuario = (isset($_POST['id_usuario'])) ? $_POST['id_usuario'] : '';
                  $id_cicloLectivo = (isset($_POST['id_cicloLectivo'])) ? $_POST['id_cicloLectivo'] : '';

                  $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';


              

                   $consulta = "INSERT INTO `notificacion`(`id_notificacion`, `id_docente`, `id_curso`, `id_asignatura`, `ciclo`, `columna`, `fecha`) VALUES (null,'$id_usuario','$id_curso','$id_asignatura','$id_cicloLectivo','$columSele','$fecha')";      
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute(); 
               

                  echo 1;

?>