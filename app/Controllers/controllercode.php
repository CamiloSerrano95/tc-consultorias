<?php

use \vista\Vista;
    class ControllerCode {

        public function index() {
            return Vista::crear("Codigos.Codigos");
        }

        public function nuevo() {
            return Vista::crear("codigo.create"); // no tengo model para codigo
        }

        public function agregar() {

            $Servicio = new ServicioModel();
            $Servicio->setCodigo($_POST['codigo']);
            $Servicio->setNombreServicio($_POST['descripcion']);
            $data = $Servicio->Saved();

            if ($data['status'] == 1) {
                Redirecciona::LetsGoTo('code');
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