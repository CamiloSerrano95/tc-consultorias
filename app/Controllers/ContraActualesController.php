<?php 
    use \vista\Vista;

    class ContraActualesController{

        public function create($id){
            $PC = new ContractualProcessesModel();

            $response = $PC->getById($id);

            if ($response['processes']) {
                $response['processes']['prepliego_status'] = $PC->getStatus($response['processes']['prepliego_date_presentation']);
                $response['processes']['pliego_status'] = $PC->getStatus($response['processes']['pliego_date_presentation']);
                $response['processes']['offer_status'] = $PC->getStatus($response['processes']['offer_date_presentation']);

                return Vista::crear("Procesos.ContraActuales", $response);
            } else {
                return Vista::crear("Procesos.ContraActuales", $id);
            }
        }

        public function store() {
            $PC = new ContractualProcessesModel();
            $session = new SessionesModel();

            $nomenclature = $_POST['nomenclatura'];
            $entity = $_POST['entidad'];
            $contract = $_POST['id_object'];
            $value = $_POST['valor'];
            $prepliego_date_presentation = $_POST['fecha_prepliego'];
            $prepliego_status = 'a tiempo';
            $pliego_date = $_POST['fecha_apertura'];
            $pliego_date_presentation = $_POST['visita_obra'];
            $pliego_status = 'a tiempo';
            $offer_date_presentation = $_POST['fecha_presentar_propuesta'];
            $offer_status = 'a tiempo';

            $response = $PC->store($nomenclature, $entity, $contract, $value, 
            $prepliego_date_presentation, $prepliego_status, $pliego_date, $pliego_date_presentation,
            $pliego_status, $offer_date_presentation, $offer_status);

            if ($response) {
                if ($response['status'] == 1) {
                    $message = $response['msg'];
                    $notification = "toastr.success('Accion exitosa', '$message')";
                    $session->CreateNotification($notification);
                    Redirecciona::LetsGoTo('vistaresults/UnoDos');
                }
            }
        }
    }
?>