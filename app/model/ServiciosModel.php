<?php
    
    class ServicioModel {
        
        private $codigo;
        private $nombre_servicio;
        private $DataBase;
        private $Table = 'servicio';


        public function __construct(){
            $this->codigo = "";
            $this->nombre_servicio = "";
            $connection = new Conexion();
            $this->DataBase = $connection->get_conexion();
        }

        /* ---------------------------------SET----------------------------------- */

        public function setCodigo ($codigo) {
            $this->codigo = $codigo;
        }

        public function setNombreServicio ($nombre_servicio) {
            $this->nombre_servicio = $nombre_servicio;
        }

      
        /* ---------------------------------GET----------------------------------- */

        public function getCodigo () {
            return $this->codigo;
        }

        public function getNombreServicio () {
            return $this->nombre_servicio;
        }


        /* ---------------------------------METHOD----------------------------------- */

        public function Saved () {
            try {
                $sql = "INSERT INTO $this->Table (codigo, nombre_servicio) VALUES (?,?)";
                $query = $this->DataBase->prepare($sql);
                $data = [$this->getCodigo(),$this->getNombreServicio()];
                $query->execute($data);
                $response = ['status' => 1, 'msg' => "Codigos guardados exitosamente"];
            } catch (Exception $e) {
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }

        public function EveryThings () {
            try {
                $sql = "SELECT * FROM $this->Table";
                $query = $this->DataBase->prepare($sql);
                $query->execute();
                $data = $query->fetchAll();
                $response = ['status' => 1, 'servicios' => $data];
            } catch (Exception $e) {
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }

        

    }
?>