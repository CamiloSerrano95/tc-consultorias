<?php
    use \vista\Vista;
    class RevisionController{
        public function __construct(){
        }

        public function finanmet($dato1, $dato2){
            $datos = $this->soloFinanciero($dato1);
            $idEmpresa =($datos['datos'][0][6]); 
            $vect = [];
            $nombre ="";
            for ($i=0; $i < sizeof($datos['datos']); $i++) { 
                if($dato2 != $datos['datos'][$i][6]){
                    array_push($vect, array ($datos['datos'][$i][0],$datos['datos'][$i][1],$datos['datos'][$i][2],$datos['datos'][$i][3],$datos['datos'][$i][4],$datos['datos'][$i][5],$datos['datos'][$i][6]));
                }else{
                    $nombre = $datos['datos'][$i][0];
                }
            }
            if($nombre != ""){
                return Vista::crear('Alianzas.AlianzaUnspscExperiencia', array("aprobaron" => $vect, "nombre"=>$nombre));
            }
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

        public function redirect($id){
            $dato = $this->soloFinanciero($id);
            return Vista::crear('ViewAprobados.CumplimientoFyO', $dato);
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
                        array_push($vectorDePaso, array ($pibote[$i],$objetos,$cumplex['empresas'][0]['nro_contratos'],$cumplex['empresas'][0]['min_cod_req'], $cumplex['empresas'][0]['presupuesto_exigido'],$cumplex['empresas'][0]['porcentaje_of_exigido'],$cumplex['empresas'][0]['result_presupuesto'],$cumplex['empresas'][0]['result_presupuesto'],$dat,$point[$i]));
                    }
                }
            }
            return Vista::crear("ViewAprobados.CumplimientounspscyExperiencia", $vectorDePaso);
        }

        public function soloFinanciero($dat){
            $empresas = new AprobadosModel();
            $datos = $empresas->AllEmpresa();
            $object = $empresas->obtenerfinanciero($dat); //se obtiene uno a uno.
            $vectorCumple = [];
            /* var_dump($datos['empresas'][0]);
            echo "<br>";
            echo "<br>";
            echo "<br>"; */
            $pib = $object['empresas'][0];
            for ($i=0; $i < sizeof($datos['empresas']); $i++) { 
                $aux = $datos['empresas'][$i];
                if($pib['ind_liquidez'] <= $aux['indice_liquidez'] && $pib['endeudamiento'] >= $aux['indice_endeudamento'] && $pib['rent_patrimonio'] <= $aux['rentabilidad_patrimonio'] && $pib['rent_activos'] <= $aux['rentabilidad_del_activo']){
                    if($pib['raz_cobertura_int'] >= 0 && $pib['raz_cobertura_int'] <= $aux['razon_cobertura_interes']){
                        array_push($vectorCumple, array($aux['nombre_empresa'], $aux['indice_liquidez'],$aux['indice_endeudamento'], $aux['razon_cobertura_interes'] ,$aux['rentabilidad_patrimonio'], $aux['rentabilidad_del_activo'],$datos['empresas'][$i]['nit']));
                    }
                }
                
            }
            $result = [];
            $result =["requridos"=> $object['empresas'][0], "datos" => $vectorCumple];
            return $result;
            //return Vista::crear('ViewAprobados.CumplimientoFyO', array("requridos"=> $object['empresas'][0], "datos" => $vectorCumple));
        }

        public function TodoCumple($dat){
            $empresas = new AprobadosModel();
            $Licitacion = $empresas->obtenerLicitaciones($dat);  // obtengo la licitición con id que se recibió por parámetro.
            $object = $empresas->obtenerfinanciero($dat); //se obtiene uno a uno.
            $cumplex = $empresas->obtenerpedidosExperiencia($Licitacion['empresas'][0]['id']);
            $segundo = $empresas->obtenerSegundo($Licitacion['empresas'][0]['id']);
            $datosFiltroUno = $empresas->obtenerFiltroUno($Licitacion['empresas'][0]['id']);
            $idempresa = json_decode($object['empresas'][0]['result']);
            $servicios = json_decode($datosFiltroUno['empresas'][0]['objetos']);
            $servicios1 = implode(",", $servicios);
            $pibotObjetos = json_decode($segundo['empresas'][0]['objetos']);
            $arrayDescrip = [];
            for ($j=0; $j < sizeof($pibotObjetos); $j++) { 
                $dato = $empresas->obtengoExperiencia($pibotObjetos[$j]);
                array_push($arrayDescrip, $dato['empresas'][0]['descripcion']);
            }

            $arrayDeEmpresas = [];
            for ($i=0; $i < sizeof($idempresa); $i++) { 
                $pibot = $empresas->obtenerEmpresa($idempresa[$i]);
                array_push($arrayDeEmpresas, array ($pibot['empresas'][0]['nombre_empresa'],$pibot['empresas'][0]['nit'], $pibot['empresas'][0]['matricula_mercantil'], $pibot['empresas'][0]['registro_lucro'], $pibot['empresas'][0]['organizacion'], $pibot['empresas'][0]['tamano_empresa'], $pibot['empresas'][0]['numero_proponente'], $pibot['empresas'][0]['fecha_inscripcion_registro_prop'], $pibot['empresas'][0]['fecha_ultima_renov_prop'], $pibot['empresas'][0]['indice_liquidez'], $pibot['empresas'][0]['indice_endeudamento'], $pibot['empresas'][0]['razon_cobertura_interes'], $pibot['empresas'][0]['rentabilidad_patrimonio'], $pibot['empresas'][0]['rentabilidad_del_activo']));
            }
            Vista::crear("ViewAprobados.CumplimientoTodo", array("financiero" => $object, "unspsc" => $servicios1, "experiencia" => $cumplex['empresas'][0], "empresas" => $arrayDeEmpresas, "objetos" => $arrayDescrip));
        }
    }

    
?>