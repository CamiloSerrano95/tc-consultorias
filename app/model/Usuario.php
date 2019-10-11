<?php
    class UsuarioModel {
        public function __construct() {
			$connection = new Conexion();
            $this->DataBase = $connection::get_conexion();
        }

        public function setNombres ($nombres) {
            $this->nombres = $nombres;
        }

        public function setUser ($user) {
            $this->user = $user;
        }

        
        public function setPasswd ($passwd) {
            $this->passwd = $passwd;
        }

        public function setRol ($rol) {
            $this->rol = $rol;
        }

        /* ---------------------------------GET----------------------------------- */

        public function getNombres () {
            return $this->nombres;
        }

        public function getUser () {
            return $this->user;
        }

        public function getPasswd () {
            return $this->passwd;
        }

        public function getRol () {
            return $this->rol;
        }

        public function login()
        {
          
            try {
                $sql = "SELECT * FROM $this->Table usuario WHERE usuario = ?";
                $query = $this->DataBase->prepare($sql);
                $data = [$this->getUser()];
                $query->execute($data);
                $infousuario = $query->fetch();
                $response = ['status' => 1, 'usuario' => $infousuario];
            } catch (Exception $e) {
                $response = ['status' => 0, 'Error'=>$e];
            }

            return $response;
        }
    }
?>