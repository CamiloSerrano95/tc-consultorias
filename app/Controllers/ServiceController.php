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


            $data = $Servicio->Saved();

            if ($data['status'] == 1) {
                header('Location: ../../View/Codigos/Codigos.php'); 
                /* echo $data['msg']; */
            } else {
                echo $data['error'];
            }
        }
        
        public function editar($id) {
            echo $id;
        }
    
        public function eliminar($id) {
            echo $id;
        }
    
        
    }
?>