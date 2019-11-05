<?php
    use \vista\Vista;
    
    class controllerexperience {

        public function nuevo($dato) {
            return Vista::crear("Empresa.AgregarExperiencias",$dato); 
        }

        public function agregar() {
           
            $Experiencia = new ExperienciaModel();

            $Experiencia->setNitEmpresa($_POST['nit']);
            $Experiencia->setNumeroExperiencia($_POST['numero_experiencia']);
            $Experiencia->setNumeroContrato($_POST['numero_contrato']);
            $Experiencia->setContratoCelebradoPor(strtoupper($_POST['contrato_celebrado']));
            $Experiencia->setNombreContratista(strtoupper($_POST['nombre_contratista']));
            $Experiencia->setNombreContratante(strtoupper($_POST['nombre_contratante']));    
            $Experiencia->setValorContratoSmmlv($_POST['valor_contrato']);    
            $Experiencia->setFechaInicioObjeto($_POST['fecha_obj_inicio']);
            $Experiencia->setFechaFinalObjeto($_POST['fecha_obj_final']);
            $Experiencia->setObjeto(strtoupper($_POST['descripcion']));
            $Experiencia->setTipoActividad(strtoupper($_POST['tipo_actividad']));
            
            
            $data = $Experiencia->RegistroExperiencia();

            $experiencia = $data['id'];
            $codigos = $_POST["codigos"];  
            
            
            for ($i=0; $i < sizeof($codigos); $i++) {
                $Experiencia->setNumeroExperiencia($experiencia);
                $results = $Experiencia->RegistroCodigos($codigos[$i]);
            }
        
            $nit = $_POST['nit'];
        
            if ($data['status'] == 1) {
                header('Location: ../../View/Empresa/AgregarExperiencias.php?id='.$nit); 
                Redirecciona::LetsGoTo('experiencia/nuevo/'.$nit);
             } else {
                 echo $data['error'];
             }
            
        }

        public function editar($id) {
            echo $id;
        }

        public function eliminar($id) {
            echo $id;
        }
    }