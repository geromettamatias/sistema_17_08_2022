<?php
      include_once '../../../bd/conexion.php';
      $objeto = new Conexion();
      $conexion = $objeto->Conectar();

      session_start();
        if (isset($_SESSION['cicloLectivo'])){

          $cicloLectivoFINAL=$_SESSION['cicloLectivo'];

          $IDcurso=$_SESSION['curso'];


      $imprimir=' <div class="form-group">
                <label for="asicCURS" class="col-form-label">Asignatura:</label>
                <select class="form-control" id="asicCURS">
                  <option value="0">Seleccione una asignatura</option>';

     
      $curso='';
      $consulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivoFINAL` WHERE `idCurso`='$IDcurso'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      foreach($data as $dat) {
        $curso=$dat['ciclo'];
       } 


      

      if ($curso=='1° AÑO (1° AÑO P.C.)' || $curso=='2° AÑO (2° AÑO P.C.)') {
           

          $consulta = "SELECT `idAsig`, `nombre`, `ciclo`, `idPlan` FROM `plan_datos_asignaturas` WHERE `ciclo`='$curso' AND `idPlan`='básico'";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
          foreach($data as $dat) {
            $imprimir.='<option value="'.$dat['idAsig'].'">'.$dat['nombre'].'--'.$dat['idPlan'].'</option>';
           } 


     }else{


      $consulta = "SELECT plan_datos_asignaturas.idAsig, plan_datos_asignaturas.nombre, plan_datos_asignaturas.ciclo, plan_datos.nombre AS 'nombrePlan' FROM plan_datos_asignaturas INNER JOIN plan_datos ON plan_datos.idPlan= plan_datos_asignaturas.idPlan WHERE plan_datos_asignaturas.ciclo='$curso'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      foreach($data as $dat) {
        $imprimir.='<option value="'.$dat['idAsig'].'">'.$dat['nombre'].'--'.$dat['nombrePlan'].'</option>';
       } 


       }




       $imprimir.='</select>
        </div>';

        echo $imprimir;


      }

       ?>  
              

 

