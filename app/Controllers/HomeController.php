<?php

    use \vista\Vista;
    
    class HomeController {

        public function index(){
            return Vista::crear("inicio.index");
        }
    }