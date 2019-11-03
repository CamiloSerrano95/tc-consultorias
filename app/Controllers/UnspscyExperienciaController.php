<?php

    use \vista\Vista;
    
    class UnspscyExperienciaController {

        public function index(){
            return Vista::crear("CumplimientosAprobados.UnspscyExperiencia");
        }
    }
    ?>