<?php
    use \vista\Vista;

    class CodeCompanyController {

        public function __construct()
        {
            
        } 
        public function ViewCodigos($id) {
            return Vista::crear("Empresa.AgregarCodigos", $id);
        }
        public function agregar() {

            $Servicio = new ServicioModel();
            $Empresa = new EmpresaModel();

            $nit = $_POST['nit'];
            $codigos = $_POST["codigos"];  

            for ($i=0; $i < sizeof($codigos); $i++) {
                $Empresa->setNit($nit);
                $results = $Empresa->RegistroCodigos($codigos[$i]);
            }

            if ($results['status'] == 1) {
                Redirecciona::LetsGoTo('code');
            } else {
                echo $results['error'];
            }   
        }

    }



?>