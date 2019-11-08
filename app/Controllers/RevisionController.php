<?php
    use \vista\Vista;
    class RevisionController{
        public function __construct(){
        }

        public function finanmet($id){
            $empresas = new AprobadosModel();
            $object = $empresas->obtenerfinanciero($id);
            $idempresa = json_decode($object['empresas'][0]['result']);
            $arrayDeEmpresas = [];
            for ($i=0; $i < sizeof($idempresa); $i++) { 
                $pibot = $empresas->obtenerEmpresa($idempresa[$i]);
                array_push($arrayDeEmpresas, array ($pibot['empresas'][0]['nombre_empresa'], $pibot['empresas'][0]['indice_liquidez'], $pibot['empresas'][0]['indice_endeudamento'], $pibot['empresas'][0]['razon_cobertura_interes'], $pibot['empresas'][0]['rentabilidad_patrimonio'], $pibot['empresas'][0]['rentabilidad_del_activo']));
            }
            return Vista::crear('ViewAprobados.CumplimientoFyO', array("requridos"=> $object['empresas'][0], "empresas" => $arrayDeEmpresas));
        }
        
        public function viewExperiences($id){
            $empresas = new AprobadosModel();

            $Licitacion = $empresas->obtenerLicitaciones($id);    
            $cumplex = $empresas->obtenerSegundo($Licitacion['empresas'][0]['id']);
            //var_dump($cumplex['empresas']);
            $vact =[];
            foreach ($cumplex['empresas'] as $key => $value) {
                $aux =json_decode($value['objetos']);
                $aux2 = json_decode($value['result']);
                array_push($vact, $aux[$key], $aux2[$key] );
            }
            //var_dump($vact);
            $vect =[];
            $aux1 = json_decode($value['result']);
            for ($i=0; $i < sizeof($aux1); $i++) { 
                $aux =json_decode($value['objetos']);
                $aux2 = json_decode($value['result']);
                $codEmpresa = $empresas->obtenerEmpresa($aux2[$i]);
                $auxi = $codEmpresa['empresas'][0]['nombre_empresa'];
                $expe = $empresas->obtengoExperiencia($aux[$i]);
                array_push($vect, array ("experiencia" => array ($expe['empresas'][0]['numero_experiencia'],$expe['empresas'][0]['numero_contrato'],$expe['empresas'][0]['contrato_celebrado_por'],$expe['empresas'][0]['nombre_contratista'],$expe['empresas'][0]['nombre_contratante'],$expe['empresas'][0]['valor_contrato_smmlv'],$expe['empresas'][0]['fecha_obj_inicio'],$expe['empresas'][0]['fecha_obj_final'],$expe['empresas'][0]['descripcion'], $expe['empresas'][0]['tipo_objeto_actividad']), "nameEmpresa" => $auxi));
            }
            //var_dump($vect[2]['nameEmpresa']);
            return Vista::crear('ViewAprobados.Experiencia',$vect);
        }

        public function filtroUno($dat){
            $empresas = new AprobadosModel();
            $id = $dat;   
            $Licitacion = $empresas->obtenerLicitaciones($id);    
            $datos = $empresas->obtenerFiltroUno($Licitacion['empresas'][0]['id']);
            $codigos = [];
            
            $data1= json_decode($datos['empresas'][0]['objetos']);
            $data = json_decode($datos['empresas'][0]['result']);
            for ($i=0; $i < sizeof($data1); $i++) { 
                array_push($codigos,$data1[$i]);
            }
            $aux = implode(",",$codigos);
            $vectorcito = [];
            for ($i=0; $i < sizeof($data); $i++) { 
                $valorcito = $empresas->obtenerEmpresa($data[$i]);
                array_push($vectorcito, $valorcito['empresas'][0]['nombre_empresa'],$aux);
            }
            return Vista::crear("ViewAprobados.CumplimientoUnspsc",$vectorcito);

        }

        public function filtroUnoyDos($dat){

            $empresas = new AprobadosModel();
            $Licitacion = $empresas->obtenerLicitaciones($dat);  // obtengo la licitición con id que se recibió por parámetro.
            $cumplex = $empresas->obtenerpedidosExperiencia($Licitacion['empresas'][0]['id']);
            $datosFiltroUno = $empresas->obtenerFiltroUno($Licitacion['empresas'][0]['id']);
            $variableDelosObjetos = json_decode($datosFiltroUno['empresas'][0]['objetos']);
            $objetos = implode(",",$variableDelosObjetos);
            //buscar las empresas de las experiencias            
            $point = json_decode($cumplex['empresas'][0]['result']);
            // buscar las empresas de el filtro uno.
            $variableEmpresas = json_decode($datosFiltroUno['empresas'][0]['result']);
            //Cotejar empresas de ambos resultados
            $vectorDePaso=[];
            $pibote =[];
            for ($i=0; $i < sizeof($point) ; $i++) { 
                for ($j=0; $j < sizeof($variableEmpresas); $j++) { 
                    if($point[$i] == $variableEmpresas[$j]){
                        $name = $empresas->obtenerEmpresa($variableEmpresas[$j]);
                        array_push($pibote,$name['empresas'][0]['nombre_empresa']);
                        array_push($vectorDePaso, array ($pibote[$i],$objetos,$cumplex['empresas'][0]['nro_contratos'],$cumplex['empresas'][0]['min_cod_req'], $cumplex['empresas'][0]['presupuesto_exigido'],$cumplex['empresas'][0]['porcentaje_of_exigido'],$cumplex['empresas'][0]['result_presupuesto'],$cumplex['empresas'][0]['result_presupuesto'],$dat));
                    }
                }
            }
            return Vista::crear("ViewAprobados.CumplimientounspscyExperiencia", $vectorDePaso);
        }

        public function TodoCumple(){
            Vista::crear("ViewAprobados.CumplimientoTodo");
        }
    }

    
?>