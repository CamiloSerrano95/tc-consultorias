<?php
    use \vista\Vista;

    class UsuarioController {
        
        public function index() {
            return Vista::crear("inicio.index");
        }

        public function nuevo() {
            return Vista::crear("usuario.create");
        }

        public function agregar() {
           
            $usuario = new UsuarioModel();
            $usuario->setUser($_POST['user']);
            $usuario->setNombres($_POST['nombres']);
            $passHash = password_hash($_POST['passwd'], PASSWORD_BCRYPT);
            $usuario->setPasswd($passHash);
            $usuario->setRol('1');
            $data = $usuario->RegistroUser();
        
            if ($data['status'] == 1) {
                Redirecciona::LetsGoTo('usuario/home');
                echo $data['msg']; 
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
        
        public function home(){
            return Vista::crear("inicio.index");
        }

        public function signin(){
            

            $usuario = new UsuarioModel();
            $usuario->setUser($_POST['user']);

            $res = $usuario->login();

            Redirecciona::LetsGoTo('usuario/home');
          
        }
    }
