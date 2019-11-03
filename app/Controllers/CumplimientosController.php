<?php
    use \vista\Vista;
    class CumplimientosController{
        public function index(){
            return Vista::crear("Cumplimientos.EvalucionCumplimientos");
        }
    }
?>