<?php
    use \vista\Vista;
    class ExperienciasController{
        public function index(){
            return Vista::crear("CumplimientosAprobados.Experiencias");
        }
    }