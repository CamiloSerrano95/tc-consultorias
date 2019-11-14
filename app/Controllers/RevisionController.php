<?php
    use \vista\Vista;
    class RevisionController{

        public function AlianzaCodigos(){
            return Vista::crear("Alianzas.AlianzaUnspsc");
        }

        public function AlianzaExperiences($idLicitacion, $idEmpresa){
            $empresas = new AprobadosModel();
            $empresa = $empresas->obtenerEmpresa($idEmpresa);
            $codigos = $empresas->obtenerFiltroUno($idLicitacion);
            $financiero = $this->soloFinanciero($idLicitacion);
            $aux = [];
            $intersecto=[];
            for ($i=0; $i < sizeof($financiero['datos']); $i++) { 
                array_push($aux,$financiero['datos'][$i][7]);
            }
            $intenso = json_decode($codigos['empresas'][0]['result']);
            $intersecto =  array_intersect_assoc($intenso,$aux);
            var_dump($intenso);
            echo "<br>";
            var_dump($aux);
            echo "<br>";
            var_dump($intersecto);
            //return Vista::crear("Alianzas.AlianzaExperiencia", array("licitacion"=>$idLicitacion, "nombre"=>$empresa['empresas'][0]['nombre_empresa']));
        }

        public function AlianzaCodFinanciero(){
            $empre = new AprobadosModel();
            $nombreEmpresaT = $_POST['nombre'];
            $porcentajeEmpresa = $_POST['porcentajeEmpresa'];
            $empresas = $_POST['empresas'];
            $porcentaje = $_POST['porcentaje'];
            $licitacion = $_POST['licitacion'];

        }

        public function pibotExperiencias($idLicitacion,$idEmpresa,$codigos){
            $empresas = new AprobadosModel();
            $datosUns = $empresas->filtroUns($idLicitacion,$codigos);
            $datosObj = $empresas->obtenerSegundo($idLicitacion);
            $arreglo = json_decode($datosUns['empresas'][0]['objetos']);
            $Codigos = $this->filtroUnspsc($idLicitacion,$arreglo);
            $pasaronCodigos = $Codigos['pasaron'];
            $pasaronObjetos = $this->filtroObjetos($idLicitacion,json_decode($datosObj['empresas'][0]['objetos']));
            $intersecto = array_intersect_assoc($pasaronCodigos,$pasaronObjetos['pasaron']);
            $empresa = $empresas->obtenerEmpresa($idEmpresa);
            $auxiliarArray=[];
            for ($i=0; $i < sizeof($intersecto); $i++) { 
                $empr = $empresas->obtenerEmpresa($intersecto[$i]);
                if($empr['empresas'][0]['nombre_empresa'] != $empresa['empresas'][0]['nombre_empresa']){
                    array_push($auxiliarArray, $empr['empresas'][0]['nombre_empresa']);
                }
            }
            return array ("nombre"=>$empresa['empresas'][0]['nombre_empresa'], "aprobaron"=>$auxiliarArray,"licitacion"=>$idLicitacion);            
        }

        public function alianzaFinanciero($idLicitacion, $idEmpresa){
            $datos = $this->pibotCodigosExperiencias($idLicitacion,$idEmpresa);
            return Vista::crear('Alianzas.AlianzaFinancieroyOrg', $datos);
        }

        public function alianzaCodExperiencia(){
            $empre = new AprobadosModel();
            $nombreEmpresaT = $_POST['nombre'];
            $porcentajeEmpresa = $_POST['porcentajeEmpresa'];
            $empresas = $_POST['empresas'];
            $porcentaje = $_POST['porcentaje'];
            $licitacion = $_POST['licitacion'];
            $indiceL = 0;
            $indice_endeudamento =0;
            $razon_cobertura_interes =0;
            $rentabilidad_patrimonio =0;
            $rentabilidad_del_activo =0;
            $capital_de_trabajo =0;
            $patrimonio = 0;
            
            $titular = $empre->obtenerEmpresaNombre($nombreEmpresaT);
            $TindiceL = (($titular['empresas'][0]['indice_liquidez'])* ($porcentajeEmpresa/100)) + $indiceL;
            $Tindice_endeudamento = (($titular['empresas'][0]['indice_endeudamento'])* ($porcentajeEmpresa/100)) + $indice_endeudamento;
            $Trazon_cobertura_interes = (($titular['empresas'][0]['razon_cobertura_interes'])* ($porcentajeEmpresa/100)) + $razon_cobertura_interes;
            $Trentabilidad_patrimonio = (($titular['empresas'][0]['rentabilidad_patrimonio'])* ($porcentajeEmpresa/100)) + $rentabilidad_patrimonio;
            $Trentabilidad_del_activo = (($titular['empresas'][0]['rentabilidad_del_activo'])* ($porcentajeEmpresa/100)) + $rentabilidad_del_activo;
            $Tcapital_de_trabajo = (($titular['empresas'][0]['capital_de_trabajo'])* ($porcentajeEmpresa/100)) + $capital_de_trabajo;
            $Tpatrimonio = (($titular['empresas'][0]['patrimonio'])* ($porcentajeEmpresa/100)) + $patrimonio;
            for ($i=0; $i < sizeof($empresas); $i++) { 
                $info = $empre->obtenerEmpresaNombre($empresas[$i]);
                $indiceL = (($info['empresas'][0]['indice_liquidez'])* ($porcentaje[$i]/100)) + $indiceL;
                $indice_endeudamento = (($info['empresas'][0]['indice_endeudamento'])* ($porcentaje[$i]/100)) + $indice_endeudamento;
                $razon_cobertura_interes = (($info['empresas'][0]['razon_cobertura_interes'])* ($porcentaje[$i]/100)) + $razon_cobertura_interes;
                $rentabilidad_patrimonio = (($info['empresas'][0]['rentabilidad_patrimonio'])* ($porcentaje[$i]/100)) + $rentabilidad_patrimonio;
                $rentabilidad_del_activo = (($info['empresas'][0]['rentabilidad_del_activo'])* ($porcentaje[$i]/100)) + $rentabilidad_del_activo;
                $capital_de_trabajo = (($info['empresas'][0]['capital_de_trabajo'])* ($porcentaje[$i]/100)) + $capital_de_trabajo;
                $patrimonio = (($info['empresas'][0]['patrimonio'])* ($porcentaje[$i]/100)) + $patrimonio;
            }
            $totalindiceL = $indiceL + $TindiceL;
            $totalindice_endeudamento = $indice_endeudamento + $Tindice_endeudamento;
            $totalrazon_cobertura_interes = $razon_cobertura_interes + $Trazon_cobertura_interes;
            $totalrentabilidad_patrimonio = $rentabilidad_patrimonio + $Trentabilidad_patrimonio;
            $totalrentabilidad_del_activo = $rentabilidad_del_activo + $Trentabilidad_del_activo;
            $totalcapital_de_trabajo = $capital_de_trabajo + $Tcapital_de_trabajo;
            $totalpatrimonio = $patrimonio + $Tpatrimonio;
            $vectorCumple = [];
            $requeridos = $empre->obtenerfinanciero($licitacion);
            $pib = $requeridos['empresas'][0];        
            $validation = [];
            $datosFinancieros =[];
            $reingreso = $this->pibotCodigosExperiencias($licitacion,$titular['empresas'][0]['nit']);
            if($pib['ind_liquidez'] <= $totalindiceL && $pib['endeudamiento'] >= $totalindice_endeudamento && $pib['rent_patrimonio'] <= $totalrentabilidad_patrimonio && $pib['rent_activos'] <= $totalrentabilidad_del_activo && $pib['patrimonio'] <= $totalpatrimonio && $totalcapital_de_trabajo >= $pib['capital_trabajo']){
                if($pib['raz_cobertura_int'] >= 0 && $pib['raz_cobertura_int'] <= $totalrazon_cobertura_interes){
                    array_push($vectorCumple, $totalindiceL, $totalindice_endeudamento,$totalrazon_cobertura_interes, $totalrentabilidad_patrimonio,$totalrentabilidad_del_activo, $totalcapital_de_trabajo,$totalpatrimonio,$reingreso);
                    array_push($datosFinancieros,$pib['ind_liquidez'],$pib['endeudamiento'], $pib['raz_cobertura_int'],$pib['rent_patrimonio'], $pib['rent_activos'],$pib['patrimonio'], $pib['capital_trabajo']);
                    $validation =["status" => 'aprueba', "datos"=>$vectorCumple, "nombre" => $nombreEmpresaT, "financiero"=>$datosFinancieros];
                }
            }else{
                array_push($vectorCumple, $totalindiceL, $totalindice_endeudamento,$totalrazon_cobertura_interes, $totalrentabilidad_patrimonio,$totalrentabilidad_del_activo, $totalcapital_de_trabajo,$totalpatrimonio,$reingreso);
                $validation = $validation =["status" => 'reprueba', "datos"=>$vectorCumple , "nombre" => $nombreEmpresaT, "financiero"=>$datosFinancieros];
            }
            //var_dump($validation);
            return Vista::crear('Alianzas.AlianzaFinancieroyOrg',$validation);
        }

        public function pibotCodigosExperiencias($idLicitacion,$idEmpresa){
            $empresas = new AprobadosModel();
            $datosUns = $empresas->obtenerFiltroUno($idLicitacion);
            $datosObj = $empresas->obtenerSegundo($idLicitacion);
            $arreglo = json_decode($datosUns['empresas'][0]['objetos']);
            $Codigos = $this->filtroUnspsc($idLicitacion,$arreglo);
            $pasaronCodigos = $Codigos['pasaron'];
            $pasaronObjetos = $this->filtroObjetos($idLicitacion,json_decode($datosObj['empresas'][0]['objetos']));
            $intersecto = array_intersect_assoc($pasaronCodigos,$pasaronObjetos['pasaron']);
            $empresa = $empresas->obtenerEmpresa($idEmpresa);
            $auxiliarArray=[];
            for ($i=0; $i < sizeof($intersecto); $i++) { 
                $empr = $empresas->obtenerEmpresa($intersecto[$i]);
                if($empr['empresas'][0]['nombre_empresa'] != $empresa['empresas'][0]['nombre_empresa']){
                    array_push($auxiliarArray, $empr['empresas'][0]['nombre_empresa']);
                }
            }
            return array ("nombre"=>$empresa['empresas'][0]['nombre_empresa'], "aprobaron"=>$auxiliarArray,"licitacion"=>$idLicitacion);
        }
        public function alianzaUnsExperiencia(){
            $empre = new AprobadosModel();
            $nombreEmpresaT = $_POST['nombre'];
            $porcentajeEmpresa = $_POST['porcentajeEmpresa'];
            $empresas = $_POST['empresas'];
            $porcentaje = $_POST['porcentaje'];
            $licitacion = $_POST['licitacion'];
            $indiceL = 0;
            $indice_endeudamento =0;
            $razon_cobertura_interes =0;
            $rentabilidad_patrimonio =0;
            $rentabilidad_del_activo =0;
            $capital_de_trabajo =0;
            $patrimonio = 0;
            
            $titular = $empre->obtenerEmpresaNombre($nombreEmpresaT);
            $TindiceL = (($titular['empresas'][0]['indice_liquidez'])* ($porcentajeEmpresa/100)) + $indiceL;
            $Tindice_endeudamento = (($titular['empresas'][0]['indice_endeudamento'])* ($porcentajeEmpresa/100)) + $indice_endeudamento;
            $Trazon_cobertura_interes = (($titular['empresas'][0]['razon_cobertura_interes'])* ($porcentajeEmpresa/100)) + $razon_cobertura_interes;
            $Trentabilidad_patrimonio = (($titular['empresas'][0]['rentabilidad_patrimonio'])* ($porcentajeEmpresa/100)) + $rentabilidad_patrimonio;
            $Trentabilidad_del_activo = (($titular['empresas'][0]['rentabilidad_del_activo'])* ($porcentajeEmpresa/100)) + $rentabilidad_del_activo;
            $Tcapital_de_trabajo = (($titular['empresas'][0]['capital_de_trabajo'])* ($porcentajeEmpresa/100)) + $capital_de_trabajo;
            $Tpatrimonio = (($titular['empresas'][0]['patrimonio'])* ($porcentajeEmpresa/100)) + $patrimonio;
            for ($i=0; $i < sizeof($empresas); $i++) { 
                $info = $empre->obtenerEmpresaNombre($empresas[$i]);
                $indiceL = (($info['empresas'][0]['indice_liquidez'])* ($porcentaje[$i]/100)) + $indiceL;
                $indice_endeudamento = (($info['empresas'][0]['indice_endeudamento'])* ($porcentaje[$i]/100)) + $indice_endeudamento;
                $razon_cobertura_interes = (($info['empresas'][0]['razon_cobertura_interes'])* ($porcentaje[$i]/100)) + $razon_cobertura_interes;
                $rentabilidad_patrimonio = (($info['empresas'][0]['rentabilidad_patrimonio'])* ($porcentaje[$i]/100)) + $rentabilidad_patrimonio;
                $rentabilidad_del_activo = (($info['empresas'][0]['rentabilidad_del_activo'])* ($porcentaje[$i]/100)) + $rentabilidad_del_activo;
                $capital_de_trabajo = (($info['empresas'][0]['capital_de_trabajo'])* ($porcentaje[$i]/100)) + $capital_de_trabajo;
                $patrimonio = (($info['empresas'][0]['patrimonio'])* ($porcentaje[$i]/100)) + $patrimonio;
            }
            $totalindiceL = $indiceL + $TindiceL;
            $totalindice_endeudamento = $indice_endeudamento + $Tindice_endeudamento;
            $totalrazon_cobertura_interes = $razon_cobertura_interes + $Trazon_cobertura_interes;
            $totalrentabilidad_patrimonio = $rentabilidad_patrimonio + $Trentabilidad_patrimonio;
            $totalrentabilidad_del_activo = $rentabilidad_del_activo + $Trentabilidad_del_activo;
            $totalcapital_de_trabajo = $capital_de_trabajo + $Tcapital_de_trabajo;
            $totalpatrimonio = $patrimonio + $Tpatrimonio;
            $vectorCumple = [];
            $requeridos = $empre->obtenerfinanciero($licitacion);
            $pib = $requeridos['empresas'][0];        
            $validation = [];
            $datosFinancieros =[];
            $reingreso = $this->pibotFinanciero($licitacion,$titular['empresas'][0]['nit']);
            if($pib['ind_liquidez'] <= $totalindiceL && $pib['endeudamiento'] >= $totalindice_endeudamento && $pib['rent_patrimonio'] <= $totalrentabilidad_patrimonio && $pib['rent_activos'] <= $totalrentabilidad_del_activo && $pib['patrimonio'] <= $totalpatrimonio && $totalcapital_de_trabajo >= $pib['capital_trabajo']){
                if($pib['raz_cobertura_int'] >= 0 && $pib['raz_cobertura_int'] <= $totalrazon_cobertura_interes){
                    array_push($vectorCumple, $totalindiceL, $totalindice_endeudamento,$totalrazon_cobertura_interes, $totalrentabilidad_patrimonio,$totalrentabilidad_del_activo, $totalcapital_de_trabajo,$totalpatrimonio,$reingreso);
                    array_push($datosFinancieros,$pib['ind_liquidez'],$pib['endeudamiento'], $pib['raz_cobertura_int'],$pib['rent_patrimonio'], $pib['rent_activos'],$pib['patrimonio'], $pib['capital_trabajo']);
                    $validation =["status" => 'aprueba', "datos"=>$vectorCumple, "nombre" => $nombreEmpresaT, "financiero"=>$datosFinancieros];
                }
            }else{
                array_push($vectorCumple, $totalindiceL, $totalindice_endeudamento,$totalrazon_cobertura_interes, $totalrentabilidad_patrimonio,$totalrentabilidad_del_activo, $totalcapital_de_trabajo,$totalpatrimonio,$reingreso);
                $validation = $validation =["status" => 'reprueba', "datos"=>$vectorCumple , "nombre" => $nombreEmpresaT, "financiero"=>$datosFinancieros];
            }
            //var_dump($validation);
            return Vista::crear('Alianzas.AlianzaUnspscExperiencia',$validation);
        }

        public function finanmet($dato1, $dato2){
            $datos = $this->pibotFinanciero($dato1,$dato2);
            return Vista::crear('Alianzas.AlianzaUnspscExperiencia', $datos);
        }

        public function pibotFinanciero($dato1, $dato2){
            $datos = $this->soloFinanciero($dato1);
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
                return array("aprobaron" => $vect, "nombre"=>$nombre, "licitacion"=>$dato1);
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
                array_push($vect, array ("experiencia" => array ($expe['empresas'][0]['numero_experiencia'],$expe['empresas'][0]['numero_contrato'],$expe['empresas'][0]['contrato_celebrado_por'],$expe['empresas'][0]['nombre_contratista'],$expe['empresas'][0]['nombre_contratante'],$expe['empresas'][0]['valor_contrato_smmlv'],$expe['empresas'][0]['fecha_obj_inicio'],$expe['empresas'][0]['fecha_obj_final'],$expe['empresas'][0]['descripcion'], $expe['empresas'][0]['tipo_objeto_actividad']), "nameEmpresa" => $auxi, "nit" => $codEmpresa['empresas'][0]['nit'],"licitacion"=>$id));
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
            return Vista::crear('ViewAprobados.CumplimientoFyO', array ("dato" => $dato, "id"=> $id));
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
            $pib = $object['empresas'][0];
            for ($i=0; $i < sizeof($datos['empresas']); $i++) { 
                $aux = $datos['empresas'][$i];
                $porcent = ($aux['capital_de_trabajo'])*0.5;
                if($pib['ind_liquidez'] <= $aux['indice_liquidez'] && $pib['endeudamiento'] >= $aux['indice_endeudamento'] && $pib['rent_patrimonio'] <= $aux['rentabilidad_patrimonio'] && $pib['rent_activos'] <= $aux['rentabilidad_del_activo'] && $pib['patrimonio'] <= $aux['patrimonio'] && $porcent >= $pib['capital_trabajo']){
                    if($pib['raz_cobertura_int'] >= 0 && $pib['raz_cobertura_int'] <= $aux['razon_cobertura_interes']){
                        array_push($vectorCumple, array($aux['nombre_empresa'], $aux['indice_liquidez'],$aux['indice_endeudamento'], $aux['razon_cobertura_interes'] ,$aux['rentabilidad_patrimonio'], $aux['rentabilidad_del_activo'],$datos['empresas'][$i]['nit'],$aux['nit']));
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


        public function eliminar($id) {

            $Licitacion = new CumplimientosModel();
            $Licitacion->Eliminar($id);

            Vista::crear("ViewAprobados.Cumplimiento1y2");
        }
        
        public function filtroUnspsc($Licitacion,$codigos){
            $empresas = new CumplimientosModel();
            $prrr= [];
            $uaa = [];
            for ($i=0; $i < sizeof($codigos); $i++) { 
                $codiger = $empresas->EmpresaCodigitos($codigos[$i]);
                for ($j=0; $j < sizeof($codiger)-1 ; $j++) { 
                    for ($h=0; $h < sizeof($codiger['empresas']); $h++) {                 
                        $conteo = $codiger['empresas'][$h]['nit_empresa']; 
                    //    print_r($conteo);
                        array_push($prrr, $conteo);
                    }
                }
            }
            
            $uaa = array_count_values($prrr);
            $variableReal=[];
            foreach ($uaa as $key => $value) {
                if($value == sizeof($codigos)){
                    array_push($variableReal,$key);
                }
            }
            $request=["pedido"=>$codigos,"pasaron"=>$variableReal, "licitacion" => $Licitacion];
            return $request;
        }

        public function filtroObjetos($Licitacion,$objetos){
            $empresas = new CumplimientosModel();
            $mientes =[];
            for ($i=0; $i < sizeof($objetos); $i++) { 
                $data = $empresas->ObjetoEmpresa($objetos[$i]); //filtra las empresas que contengan los objetos que se pasaron por parametros.
                array_push($mientes , $data);
            }
            $nit = [];// Se genera un array vacio llamado nit
            for ($i=0; $i < sizeof($mientes); $i++) { 
                array_push($nit, $mientes[$i]['empresas'][0]['nit']);
            }
            $request=["pedido"=>$objetos,"pasaron"=>$nit, "licitacion" => $Licitacion];
            return $request;
        }
    }  
?>