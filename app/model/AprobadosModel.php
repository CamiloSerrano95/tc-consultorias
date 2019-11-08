<?php
    class AprobadosModel{
        private $DataBase;

        public function __construct(){
            $connection = new Conexion();
            $this->DataBase = $connection->get_conexion();
        }

        public function obtenerExperiencias($id){
            try {
                $sql = "SELECT * FROM cumplimiento_exp WHERE objeto_licitacion = ?";
                $query = $this->DataBase->prepare($sql);            
                $data = [$id];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
            } catch (Exception $e) {
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
        }

        public function obtenerFiltroUno($id) {
            try {
                $sql = "SELECT * FROM cumplimiento_un WHERE objeto_licitacion = ?";
                $query = $this->DataBase->prepare($sql);            
                $data = [$id];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
            } catch (Exception $e) {
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
        }

        public function obtengoExperiencia($id){
            try {
                $sql = "SELECT * FROM experiencias WHERE id = ?";
                $query = $this->DataBase->prepare($sql);            
                $data = [$id];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
            } catch (Exception $e) {
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
        }

        public function obtenerpedidosExperiencia($id){
            try {
                $sql = "SELECT * FROM cumplimiento_exp WHERE objeto_licitacion = ?";
                $query = $this->DataBase->prepare($sql);            
                $data = [$id];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
            } catch (Exception $e) {
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
        }

        public function obtenerSegundo($id){
            try {
                $sql = "SELECT * FROM cumplimiento_objeto WHERE objeto_licitacion = ?";
                $query = $this->DataBase->prepare($sql);            
                $data = [$id];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
            } catch (Exception $e) {
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
        }

        public function obtenerLicitaciones($id){
            try {
                $sql = "SELECT * FROM licitacion WHERE id =?";
                $query = $this->DataBase->prepare($sql);        
                $data = [$id];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
            } catch (Exception $e) {
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
        }

        public function obtenerfinanciero($id){
            try {
                $sql = "SELECT * FROM cumplimiento_financiero WHERE objeto_licitacion =?";
                $query = $this->DataBase->prepare($sql);        
                $data = [$id];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
            } catch (Exception $e) {
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
        }

        public function obtenerLicitacionesSolas(){
            try {
                $sql = "SELECT * FROM licitacion";
                $query = $this->DataBase->prepare($sql);        
                $query->execute();
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
            } catch (Exception $e) {
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
        }

        public function AllEmpresa() {
            try {
                $sql = "SELECT * FROM empresa ";
                $query = $this->DataBase->prepare($sql);   
                $query->execute();
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
            } catch (Exception $e) {
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
        }

        public function obtenerEmpresa($nit) {
            try {
                $sql = "SELECT * FROM empresa WHERE nit = ?";
                $query = $this->DataBase->prepare($sql);   
                $data = [$nit];         
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
            } catch (Exception $e) {
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
        }
    }
?>