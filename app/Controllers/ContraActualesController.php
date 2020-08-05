<?php 
    use \vista\Vista;
    class ContraActualesController{
        public function index(){
            return Vista::crear("Procesos.ContraActuales");
        }
    }


?>