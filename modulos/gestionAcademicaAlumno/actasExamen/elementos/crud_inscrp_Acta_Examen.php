<?php
include_once '../../../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   
session_start();
    if (isset($_SESSION['idActa_inscriAlumno'])){
        $idActa_inscriAlumno=$_SESSION['idActa_inscriAlumno'];
 
$idInscripcion = (isset($_POST['idInscripcion'])) ? $_POST['idInscripcion'] : '';

$idAlumnos = (isset($_POST['idAlumnos'])) ? $_POST['idAlumnos'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch($opcion){
    case 1: //alta

$pref=0; 
    $consulta = "SELECT acta_examen_inscrip.idInscripcion, datosalumnos.nombreAlumnos, datosalumnos.dniAlumnos FROM acta_examen_inscrip INNER JOIN datosalumnos ON datosalumnos.idAlumnos = acta_examen_inscrip.idAlumno WHERE acta_examen_inscrip.idActa='$idActa_inscriAlumno' AND acta_examen_inscrip.idAlumno='$idAlumnos'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

            foreach($data as $dat) { 

            $pref=1;                

                            
                        }




if ($pref==0) {
    # code...

        $consulta = "INSERT INTO `acta_examen_inscrip`(`idInscripcion`, `idActa`, `idAlumno`, `notaEsc`, `notaOral`, `promNumérico`, `promLetra`) VALUES (null,'$idActa_inscriAlumno','$idAlumnos','','','','') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT acta_examen_inscrip.idInscripcion, datosalumnos.nombreAlumnos, datosalumnos.dniAlumnos, acta_examen_inscrip.notaEsc, acta_examen_inscrip.notaOral, acta_examen_inscrip.promNumérico, acta_examen_inscrip.promLetra FROM acta_examen_inscrip INNER JOIN datosalumnos ON datosalumnos.idAlumnos = acta_examen_inscrip.idAlumno ORDER BY acta_examen_inscrip.idInscripcion DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


                            foreach($data as $dat) { 

                              

                            $idInscripcion=$dat['idInscripcion'];
                            $nombreAlumnos=$dat['nombreAlumnos'];
                            $dniAlumnos=$dat['dniAlumnos'];
                            $notaEsc=$dat['notaEsc'];
                            $notaOral=$dat['notaOral'];
                            $promNumérico=$dat['promNumérico'];
                            $promLetra=$dat['promLetra'];
                          

                        

                            $res= $idInscripcion.'||'.$nombreAlumnos.'||'.$dniAlumnos.'||'.$notaEsc.'||'.$notaOral.'||'.$promNumérico.'||'.$promLetra;
                        }

                        echo $res;
}else{

echo '0'.'||'.'0'.'||'.'0'.'||'.'0'.'||'.'0'.'||'.'0'.'||'.'0';

}

        break;
       
    case 3://baja
        $consulta = "DELETE FROM `acta_examen_inscrip` WHERE `idInscripcion`='$idInscripcion' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
                                
        break;        
}



}else{
    echo 'error';
}  
$conexion = NULL;