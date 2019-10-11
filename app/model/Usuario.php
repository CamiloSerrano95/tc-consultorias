<?php
    class UsuarioModel {
        private $nombres;
        private $user;
        private $passwd;
        private $rol;
        private $DataBase;
        private $Table = 'usuarios';

        public function __construct() {
            $this->nombres = "";
            $this->user = "";
            $this->passwd = "";
            $this->rol = "";
            $connection = new Conexion();
            $this->DataBase = $connection::get_conexion();
        }
    }
?>