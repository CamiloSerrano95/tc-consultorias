<?php

    class ContractualProcessesModel {
        private $DataBase;

        public function __construct() {
            $connection = new Conexion();
            $this->DataBase = $connection->get_conexion();
        }

        public function store ($nomenclature, $entity, $contract, $value, 
            $prepliego_date_presentation, $prepliego_status, $pliego_date, $pliego_date_presentation,
            $pliego_status, $offer_date_presentation, $offer_status
        ){
            try {
                $sql = "INSERT INTO contractual_processes (nomenclature, entity, contract_id, value, 
                    prepliego_date_presentation, prepliego_status, pliego_date, pliego_date_presentation, 
                    pliego_status, offer_date_presentation, offer_status) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)
                ";

                $query = $this->DataBase->prepare($sql);
                $data = [
                    $nomenclature, $entity, $contract, $value, $prepliego_date_presentation, 
                    $prepliego_status, $pliego_date, $pliego_date_presentation,$pliego_status, 
                    $offer_date_presentation, $offer_status
                ];

                $query->execute($data);
                $response = ['status' => 1, 'msg' => "Proceso guardado exitosamente"];
            } catch (Exception $e) {
                $response = ['status' => 0, 'error' => $e];
            }

            return $response;
        }

        public function all() {
            try {
                $sql = "SELECT * FROM contractual_processes";
                $query = $this->DataBase->prepare($sql);
                $query->execute();
                $data = $query->fetchAll();
                $response = ['status' => 1, 'process' => $data];
            } catch (Exception $e) {
                $response = ['status' => 0, 'error' => $e];
            }

            return $response;
        }

        public function getById($id) {
          
            try {
                $sql = "SELECT licitacion.nombre, contractual_processes.* FROM licitacion, contractual_processes 
                    WHERE licitacion.id = contractual_processes.contract_id AND contractual_processes.contract_id = ?";
                $query = $this->DataBase->prepare($sql);
                $data = [$id];
                $query->execute($data);
                $infoProcesses = $query->fetch();
                $response = ['status' => 1, 'processes' => $infoProcesses];
            } catch (Exception $e) {
                $response = ['status' => 0, 'Error'=>$e];
            }
            
            return $response;
        }

        public function getStatus($date) {
            $today = strtotime(date("Y-m-d"));
            $date = strtotime($date);

            if ($today > $date) {
                $status = 'vencido';
            } else if ($today < $date) {
                $status = 'a tiempo';
            } else {
                $status = 'vence hoy';
            }

            return $status;
        }
    }
?>