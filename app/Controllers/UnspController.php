<?php
    use \vista\Vista;
    class UnspController{
        public function index(){
            return Vista::crear("CumplimientosAprobados.Unspsc");
        }
    }