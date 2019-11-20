<?php
use \vista\Vista;
    class ControllerService {

        public function index() {
            return Vista::crear("inicio.index");
        }

        public function nuevo() {
            return Vista::crear("servicio.create");
        }

        public function agregar() {
            $Servicio = new ServicioModel();

            $Servicio->setCodigo($_POST['codigo']);
            $Servicio->setNombreServicio($_POST['descripcion']);


            $Servicio->Saved();

        }
        
        public function editar($id) {
            echo $id;
        }
    
        public function eliminar($id) {
            echo $id;
        }
    
        
    }
?>