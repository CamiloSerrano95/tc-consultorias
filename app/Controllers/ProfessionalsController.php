<?php
use \vista\Vista;
    class ProfessionalsController {

        public function index() {
            return Vista::crear("inicio.index");
        }

        public function nuevo() {
            return Vista::crear("Profesionales.AgregarProfesionales");
        }

        public function mostrarprofesionales() {
            return Vista::crear("Profesionales.Profesionales");
        }

        public function agregar() {
            $Profesional = new ProfessionalsModel;

            $Profesional->setNombre(strtoupper($_POST['nombre']));
            $Profesional->setCedula($_POST['cedula']);
            $Profesional->setProfesion(strtoupper($_POST['profesion']));
            $Profesional->setNumTarjeta($_POST['tarjeta']);

            if ($_POST['fecha_expedicion'] === "") {
                $Profesional->setFechaExpedicion("NO REGISTRA");
            }else{
                $Profesional->setFechaExpedicion($_POST['fecha_expedicion']);
            }

            if ($_POST['fecha'] === "") {
                $Profesional->setFecha("NO REGISTRA");
            }else{
                $Profesional->setFecha($_POST['fecha']);                
            }

            if ($_POST['especializacion'] === "") {
                $Profesional->setEspecializacion("NO REGISTRA");
            }else{
                $Profesional->setEspecializacion(strtoupper($_POST['especializacion']));
            }

            if ($_POST['fecha_especializacion'] === "") {
                $Profesional->setFechaEspecializacion("NO REGISTRA");
            }else{
                $Profesional->setFechaEspecializacion($_POST['fecha_especializacion']);             
            }

            if ($_POST['maestria'] === "") {
                $Profesional->setMaestria("NO REGISTRA");
            }else{
                $Profesional->setMaestria(strtoupper($_POST['maestria']));                             
            }

            if ($_POST['fecha_maestria'] === "") {
                $Profesional->setFechaMaestria("NO REGISTRA");
            }else{
                $Profesional->setFechaMaestria($_POST['fecha_maestria']);                                           
            }

            if ($_POST['doctorado'] === "") {
                $Profesional->setDoctorado("NO REGISTRA");
            }else{
                $Profesional->setDoctorado(strtoupper($_POST['doctorado']));                                                           
            }

            if ($_POST['fecha_doctorado'] === "") {
                $Profesional->setFechaDoctorado("NO REGISTRA");
            }else{
                $Profesional->setFechaDoctorado($_POST['fecha_doctorado']);                                                           
            }


            $data = $Profesional->Saved();

            if ($data['status'] == 1) {
                Redirecciona::LetsGoTo('profesion/nuevo');
             } else {
                 echo $data['error'];
             }

        }
        
        /* public function editar($id) {
            echo $id;
        }
    
        public function eliminar($id) {
            echo $id;
        } */
        
    }
?>