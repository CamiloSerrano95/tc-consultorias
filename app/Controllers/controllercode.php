<?php

use \vista\Vista;
    class ControllerCode {

        public function index() {
            return Vista::crear("Codigos.Codigos");
        }

        public function nuevo() {
            return Vista::crear("codigo.create"); // no tengo model para codigo
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
        
            if ($results['status']) {
                header('Location: ../../View/Empresa/AgregarCodigos.php?id='.$nit); 
                /* echo $results['msg']; */
            } else {
                echo $results['msg'];
            }
            
        }

        public function editar($id) {
            echo $id;
        }

        public function eliminar($id) {
            echo $id;
        }


    }



?>