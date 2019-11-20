<?php
    
    class ProfessionalsModel {
        
        private $nombre;
        private $cedula;
        private $profesion;
        private $num_tarjeta;
        private $fecha_expedicion;
        private $fecha;
        private $especializacion;
        private $fecha_especializacion;
        private $maestria;
        private $fecha_maestria;
        private $doctorado;
        private $fecha_doctorado;
        private $DataBase;
        private $Table = 'profesionales';


        public function __construct(){
            $this->nombre = "";
            $this->cedula = "";
            $this->profesion="";
            $this->num_tarjeta="";
            $this->fecha_expedicion="";
            $this->fecha="";
            $this->especializacion="";
            $this->fecha_especializacion="";
            $this->maestria="";
            $this->fecha_maestria="";
            $this->doctorado="";
            $this->fecha_doctorado="";
            $connection = new Conexion();
            $this->DataBase = $connection->get_conexion();
        }

        /* ---------------------------------SET----------------------------------- */

        public function setNombre ($nombre) {
            $this->nombre = $nombre;
        }

        public function setCedula ($cedula) {
            $this->cedula = $cedula;
        }

        public function setProfesion ($profesion) {
            $this->profesion = $profesion;
        }

        public function setNumTarjeta ($num_tarjeta) {
            $this->num_tarjeta = $num_tarjeta;
        }

        public function setFechaExpedicion ($fecha_expedicion) {
            $this->fecha_expedicion = $fecha_expedicion;
        }

        public function setFecha ($fecha) {
            $this->fecha = $fecha;
        }

        public function setEspecializacion ($especializacion) {
            $this->especializacion = $especializacion;
        }

        public function setFechaEspecializacion ($fecha_especializacion) {
            $this->fecha_especializacion = $fecha_especializacion;
        }

        public function setMaestria ($maestria) {
            $this->maestria = $maestria;
        }

        public function setFechaMaestria ($fecha_maestria) {
            $this->fecha_maestria = $fecha_maestria;
        }

        public function setDoctorado ($doctorado) {
            $this->doctorado = $doctorado;
        }

        public function setFechaDoctorado ($fecha_doctorado) {
            $this->fecha_doctorado = $fecha_doctorado;
        }

      
        /* ---------------------------------GET----------------------------------- */

        public function getNombre () {
            return $this->nombre;
        }

        public function getCedula () {
            return $this->cedula;
        }

        public function getProfesion () {
            return $this->profesion;
        }

        public function getNumTarjeta () {
            return $this->num_tarjeta;
        }

        public function getFechaExpedicion () {
            return $this->fecha_expedicion;
        }

        public function getFecha () {
            return $this->fecha;
        }

        public function getEspecializacion () {
            return $this->especializacion;
        }

        public function getFechaEspecializacion () {
            return $this->fecha_especializacion;
        }

        public function getMaestria () {
            return $this->maestria;
        }

        public function getFechaMaestria () {
            return $this->fecha_maestria;
        }

        public function getDoctorado () {
            return $this->doctorado;
        }

        public function getFechaDoctorado () {
            return $this->fecha_doctorado;
        }

        /* ---------------------------------METHOD----------------------------------- */

        public function Saved () {
            try {
                $sql = "INSERT INTO $this->Table (nombre, cedula, profesion, num_tarjeta, fecha_expedicion, fecha, especializacion, fecha_especializacion, maestria	, fecha_maestria, doctorado, fecha_doctorado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                $query = $this->DataBase->prepare($sql);
                $data = [$this->getNombre(), $this->getCedula(), $this->getProfesion() , $this->getNumTarjeta() , $this->getFechaExpedicion() , $this->getFecha() , $this->getEspecializacion() , $this->getFechaEspecializacion() , $this->getMaestria() , $this->getFechaMaestria(), $this->getDoctorado(), $this->getFechaDoctorado()];
                $query->execute($data);
                $response = ['status' => 1, 'msg' => "Profesionales guardados exitosamente"];
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
                $response = ['status' => 1, 'profesionales' => $data];
            } catch (Exception $e) {
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }

        

    }
?>