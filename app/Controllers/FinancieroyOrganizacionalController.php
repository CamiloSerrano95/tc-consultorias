<?php
    use \vista\Vista;
    class FinancieroyOrganizacionalController{
        public function index(){
            return Vista::crear("CumplimientosAprobados.FinancieroyOrganizacional");
        }
    }