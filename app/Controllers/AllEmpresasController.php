<?php 
    use \vista\Vista;
    class AllEmpresasController{
        public function index(){
            return Vista::crear("Empresa.MostrarEmpresa");
        }
    }


?>