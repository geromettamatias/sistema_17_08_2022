<?php
session_start();
unset($_SESSION["idUsuario"]);
    unset($_SESSION["dni"]);
    unset($_SESSION["nombre"]);
    unset($_SESSION["cargo"]);
    unset($_SESSION["nivelCurso"]);
    unset($_SESSION["operacion"]);
    unset($_SESSION["password"]);
    session_destroy();


echo 'si';

;
?>