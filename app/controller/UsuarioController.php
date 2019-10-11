<?php
    use \vista\Vista;

    class UsuarioController {

        public function index() {
            return Vista::crear("usuario.listado");
        }

        public function nuevo() {
            return Vista::crear("usuario.crear");
        }

        public function agregar() {
        
        }

        public function editar($id) {
            echo $id;
        }

        public function eliminar($id) {
            echo $id;
        }

    }
