<?php
    use \vista\Vista;

    class UsuarioController {

        public function index() {
            return Vista::crear("admin.usuario.listado");
        }

        public function nuevo() {
            return Vista::crear("admin.usuario.crear");
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
