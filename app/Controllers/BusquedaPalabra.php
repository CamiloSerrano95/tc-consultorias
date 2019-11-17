<?php
use \vista\Vista;
    class BusquedaPalabra {

        public function index() {
            return Vista::crear("inicio.index");
        }

        public function nuevo() {
            return Vista::crear("objetivo.create"); 
        }
   
        public function agregar() {
         $palabrita = new ObjetosModel();

         $datos = $_POST['palabras'];
         $palabras = explode(" ", trim($datos));
         $vect=[];
         for ($i=0; $i < sizeof($palabras); $i++) { 
             $request = $palabrita->Palabrita($palabras[$i]);
             if ($request['status'] == 1) {
               foreach($request['desc'] as $desc) {
                  array_push($vect, $desc['id']."_".$desc['descripcion']."*".$desc['tipo_objeto_actividad']);
               }
             }
         }

         $resultado = array_unique($vect);
          //var_dump($resultado);
         echo json_encode($vect, JSON_FORCE_OBJECT);

      }
      public function editar($id) {
         echo $id;
     }
 
     public function eliminar($id) {
         echo $id;
     }
   }

?>