<?php 
    use \vista\Vista;
    class AllEmpresasController{
        public function index(){
            return Vista::crear("Empresa.MostrarEmpresa");
        }

        public function viewcompany($data){
            return Vista::crear("Empresa.InformacionEmpresa",$data);
        }
    }


?>