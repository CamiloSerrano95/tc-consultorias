<?php
    use \vista\Vista;

    class CodigosController {

        
        public function index() {
            return Vista::crear("inicio.index");
        }

    }
