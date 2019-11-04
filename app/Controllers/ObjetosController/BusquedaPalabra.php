<?php
   
   require('../../Models/ObjetosModel.php');

   $palabrita = new ObjetoModel();

   $datos = $_POST['palabras'];
   $palabras = explode(" ", trim($datos));
   $vect=[];
   for ($i=0; $i < sizeof($palabras); $i++) { 
       $request = $palabrita->Palabrita($palabras[$i]);
       if ($request['status'] == 1) {
         foreach($request['desc'] as $desc) {
            array_push($vect, $desc['id']."-".$desc['descripcion']."*".$desc['tipo_objeto_actividad']);
         }
       }
   }

   $resultado = array_unique($vect);
    //var_dump($resultado);
   echo json_encode($vect, JSON_FORCE_OBJECT);
?>