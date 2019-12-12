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

        // Se pueden crear otros metodos, los metodos anteriores son los estandares para los CRUDs de cada
        // pero en un modelo se pueden necesitar realizar diversas consultas.
        
        public function index() {
            $this->agregar();
            return Vista::crear("inicio.index");
        }

        public function nuevo() {
            return Vista::crear("usuario.create");
        }

        public function agregar() {
           
            $usuario = new UsuarioModel();
            $usuario->setUser($_POST['user']);
            $usuario->setEmail($_POST['email']);
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
            $session = new SessionesModel();
            $usuario->setUser($_POST['user']);
            $usuario->setPasswd($_POST['pass']);
            $data = $usuario->login();

            if ($data['usuario']['usuario'] == $usuario->getUser()) {
                if (password_verify($usuario->getPasswd(), $data['usuario']['contrasena'])) {
                    @session_start();
                    $session->CreateSession('usuario', $data['usuario']['nombres']);
                    Redirecciona::LetsGoTo('home');
                } else {
                    $notification = 'toastr.error("Datos erroneos", "Contraseña incorrecta")';
                    $session->CreateNotification($notification);
                    Redirecciona::LetsGoTo('');
                }
            } else {
                    $notification = 'toastr.error("Datos erroneos", "Usuario incorrecto")';
                    $session->CreateNotification($notification);
                    Redirecciona::LetsGoTo('');
            }
        }

        public function logout() {
            $session = new SessionModel();
            $session->DestroySession();
        }

        public function recoverypass() {
            $usuario = new UsuarioModel();
            $session = new SessionesModel();

            $email = $_POST['email'];
            $newpass = $_POST['newpass'];
            $retrynewpass = $_POST['retrynewpass'];
            

            if ($newpass == $retrynewpass) {
                $usuario->setPasswd(password_hash($newpass, PASSWORD_BCRYPT));
                $data = $usuario->CambiarContrasena($email);

                if($data['status'] == 1) {
                    $notification = 'toastr.success("Accion exitosa", "'. $data['msg'] .'")';
                    $session->CreateNotification($notification);
                    Redirecciona::LetsGoTo('');
                } else {
                    //echo "Email incorrecto";
                    $notification = 'toastr.error("Datos erroneos", "Email incorrecto, no existe")';
                    $session->CreateNotification($notification);
                    Redirecciona::LetsGoTo('');    
                }
            } else {
                $notification = 'toastr.error("Datos erroneos", "Las contraseñas no coinciden")';
                $session->CreateNotification($notification);
                Redirecciona::LetsGoTo('');
            }
        }
    }
