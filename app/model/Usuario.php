<?php
    class UsuarioModel {
        public function __construct() {
			$connection = new Conexion();
            $this->DataBase = $connection::get_conexion();
        }
    }
?>