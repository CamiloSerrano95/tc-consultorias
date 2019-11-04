<?php
    use \vista\Vista;
    class ResultsController{

        public function Experiencias(){
            return Vista::crear("CumplimientosAprobados.Experiencias");
        }

        public function Unspsc(){
            return Vista::crear("CumplimientosAprobados.Unspsc");
        }

        public function FinancierOrganizacional(){
            return Vista::crear("CumplimientosAprobados.FinancieroyOrganizacional");
        }

        public function UnspscExperiencia(){
            return Vista::crear("CumplimientosAprobados.UnspscyExperiencia");
        }

        public function UnoDos(){
            return Vista::crear("ViewAprobados.Cumplimiento1y2");
        }
    }
?>