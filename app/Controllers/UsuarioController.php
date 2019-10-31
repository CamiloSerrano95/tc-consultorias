<?php
    use \vista\Vista;

    class UsuarioController {

        // Los controladores deben ir estructurados con los siguientes 5 metodos
        // index = es el metodo que renderiza el select from de una consulta sql
        // show = es el metodo que renderiza la informacion de una consulta en especifico recibe como parametro la llave primaria
        // create = es el metodo que renderiza la vista del formulario de guardado de la data recivida
        // store = es el metodo que recibe y valida toda la informacion enviada por el formulario
        // edit =  es el metodo que renderiza la vista de edicion de una data en particular, esta recibe la llave primaria como parametro
        // update = es el metodo que recibe y valida toda la informacion enviada por el formulario para la actualizacion
        // delete = este metodo recibe por parametro la llave primaria para eliminar un registro

        // OJO para que esto pueda funcionar, cada controlador debe ser registrado en el archivo rutas.php 
        //que se encuentra en la siguiente ruta app/rutas/rutas.php
        
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
                Redirecciona::LetsGoTo('home');
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

        public function signin(){
            $usuario = new UsuarioModel();
            $usuario->setUser($_POST['user']);
            $res = $usuario->login();
            Redirecciona::LetsGoTo('home');
        }
    }
