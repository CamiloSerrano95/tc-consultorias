<?php

use \vista\Vista;
    class controllercode {

        public function index() {
            return Vista::crear("Codigos.MostrarCodigosGenerales");
        }

        public function nuevo() {
            return Vista::crear("Codigos.Codigos"); // no tengo model para codigo, el modelo de los codigos es servicios
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