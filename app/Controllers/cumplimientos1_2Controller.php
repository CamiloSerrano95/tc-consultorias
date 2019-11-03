<?php 
    use \vista\Vista;
    class cumplimientos1_2Controller{
        public function index(){
            return Vista::crear("Cumplimientos.Cumplimiento1y2");
        }
    }