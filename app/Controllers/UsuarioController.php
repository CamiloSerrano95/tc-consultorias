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
        
        public function Login(){
            
            $identidad->setUser($_POST['user']);
            $identidad->setPasswd($_POST['pass']);
                    
            $data = $identidad->login();
                    
            if($data['usuario']['usuario'] == $identidad->getUser()){
                if (password_verify($identidad->getPasswd(), $data['usuario']['contrasena'])) {
                    header("Location: ../../View/Inicio/index.php");
                }
            }

        }

    }
