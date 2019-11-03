<?php
    
    class ExperienciaModel {
        
        private $numero_experiencia;
        private $numero_contrato;
        private $contrato_celebrado_por;
        private $nombre_contratista;
        private $nombre_contratante;
        private $valor_contrato_smmlv;
        private $fecha_obj_inicio;
        private $fecha_obj_final;
        private $codigo_objeto;
        private $nitempresa;
        private $descripcion;
        private $tipo_objeto_actividad;
        private $DataBase;
        private $Table = 'experiencias';


        public function __construct(){
            $this->numero_experiencia = "";
            $this->numero_contrato = "";
            $this->contrato_celebrado_por = "";
            $this->nombre_contratista = "";
            $this->nombre_contratante = "";
            $this->valor_contrato_smmlv = "";
            $this->fecha_obj_inicio = "";
            $this->fecha_obj_final = "";
            $this->codigo_objeto = "";
            $this->nitempresa = "";
            $this->descripcion="";
            $this->tipo_objeto_actividad="";
            $connection = new Conexion();
            $this->DataBase = $connection::get_conexion();
        }

        /* ---------------------------------SET----------------------------------- */

        public function setNumeroExperiencia ($numero_experiencia) {
            $this->numero_experiencia = $numero_experiencia;
        }

        public function setNumeroContrato ($numero_contrato) {
            $this->numero_contrato = $numero_contrato;
        }

        public function setContratoCelebradoPor ($contrato_celebrado_por) {
            $this->contrato_celebrado_por = $contrato_celebrado_por;
        }

        public function setNombreContratista ($nombre_contratista) {
            $this->nombre_contratista = $nombre_contratista;
        }

        public function setNombreContratante ($nombre_contratante) {
            $this->nombre_contratante = $nombre_contratante;
        }

        public function setValorContratoSmmlv ($valor_contrato_smmlv) {
            $this->valor_contrato_smmlv = $valor_contrato_smmlv;
        }

        public function setFechaInicioObjeto ($fecha_obj_inicio) {
            $this->fecha_obj_inicio = $fecha_obj_inicio;
        }

        public function setFechaFinalObjeto ($fecha_obj_final) {
            $this->fecha_obj_final = $fecha_obj_final;
        }

        public function setCodigoObjeto ($codigo_objeto) {
            $this->codigo_objeto = $codigo_objeto;
        }


        public function setNitEmpresa ($nitempresa) {
            $this->nitempresa = $nitempresa;
        }

        public function setObjeto ($descripcion) {
            $this->descripcion = $descripcion;
        }

        public function setTipoActividad ($tipo_objeto_actividad) {
            $this->tipo_objeto_actividad = $tipo_objeto_actividad;
        }
        

        /* ---------------------------------GET----------------------------------- */

        public function getNumeroExperiencia () {
            return $this->numero_experiencia;
        }

        public function getNumeroContrato () {
            return $this->numero_contrato;
        }

        public function getContratoCelebradoPor () {
            return $this->contrato_celebrado_por;
        }

        public function getNombreContratista () {
            return $this->nombre_contratista;
        }

        public function getNombreContratante () {
            return $this->nombre_contratante;
        }

        public function getValorContratoSmmlv () {
            return $this->valor_contrato_smmlv;
        }

        public function getFechaInicioObjeto () {
            return $this->fecha_obj_inicio;
        }

        public function getFechaFinalObjeto () {
            return $this->fecha_obj_final;
        }

        public function getCodigoObjeto () {
            return $this->codigo_objeto;
        }

        public function getNitEmpresa () {
            return $this->nitempresa;
        }

        public function getObjeto () {
            return $this->descripcion;
        }

        public function getTipoActividad () {
            return $this->tipo_objeto_actividad;
        }

        /* ---------------------------------METHOD----------------------------------- */


        public function RegistroExperiencia () {
            try {
                $sql = "INSERT INTO $this->Table (id_empresa_experiencia, numero_experiencia, numero_contrato, contrato_celebrado_por, nombre_contratista, nombre_contratante, valor_contrato_smmlv, fecha_obj_inicio, fecha_obj_final, descripcion, tipo_objeto_actividad) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                $query = $this->DataBase->prepare($sql);
                $data = [$this->getNitEmpresa(), $this->getNumeroExperiencia(), $this->getNumeroContrato(), $this->getContratoCelebradoPor(), $this->getNombreContratista(), $this->getNombreContratante(), $this->getValorContratoSmmlv(), $this->getFechaInicioObjeto(), $this->getFechaFinalObjeto(), $this->getObjeto(), $this->getTipoActividad()];
                $query->execute($data);
                $id = $this->DataBase->lastInsertId();
                $response = ['status' => 1, 'msg' => "Experiencia guardada exitosamente", "id" => $id];
            } catch (Exception $e) {
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }
        

        public function RegistroCodigos ($codigos) {
                try {
                $sql = "INSERT INTO experiencia_servicio (idexperiencia,id_servicio) VALUES (?,?)";
                $query = $this->DataBase->prepare($sql);            
                $data = [$this->getNumeroExperiencia(), $codigos];
                $query->execute($data);
                $response = ['status' => 1, 'msg' => "codigo guardado exitosamente"];
            } catch (Exception $e) {
                $response = ['status' => 0, 'msg' => $e];
            }
            return $response;
        }


    }
?>