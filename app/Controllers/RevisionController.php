<?php
    use \vista\Vista;
    class RevisionController{

        public function AlianzaCodigos($licitacion,$idEmpresa){
            $datos = $this->pibotCodFinanciero($licitacion,$idEmpresa);
            return Vista::crear("Alianzas.AlianzaUnspsc", $datos);
        }

        public function evaluarFinanExperiencia(){
            $empre = new AprobadosModel();
            $nombreEmpresaT = $_POST['nombre'];
            $porcentajeEmpresa = $_POST['porcentajeEmpresa'];
            $empresas = [];
            $porcentaje =[];
            if(isset($_POST['empresas'])){
                $empresas = $_POST['empresas'];
                $porcentaje = $_POST['porcentaje'];
            }
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
                $reingreso = $this->pibotAlianzaCodigos($licitacion,$titular['empresas'][0]['nit']);
        
                if($pib['ind_liquidez'] <= $totalindiceL && $pib['endeudamiento'] >= $totalindice_endeudamento && $pib['rent_patrimonio'] <= $totalrentabilidad_patrimonio && $pib['rent_activos'] <= $totalrentabilidad_del_activo && $pib['patrimonio'] <= $totalpatrimonio && $totalcapital_de_trabajo >= $pib['capital_trabajo']){
                    if($pib['raz_cobertura_int'] >= 0 && $pib['raz_cobertura_int'] <= $totalrazon_cobertura_interes || $totalrazon_cobertura_interes ==0){
                        array_push($vectorCumple, $totalindiceL, $totalindice_endeudamento,$totalrazon_cobertura_interes, $totalrentabilidad_patrimonio,$totalrentabilidad_del_activo, $totalcapital_de_trabajo,$totalpatrimonio,$reingreso);
                        array_push($datosFinancieros,$pib['ind_liquidez'],$pib['endeudamiento'], $pib['raz_cobertura_int'],$pib['rent_patrimonio'], $pib['rent_activos'],$pib['patrimonio'], $pib['capital_trabajo']);
                        $validation =["status" => 'aprueba', "datos"=>$vectorCumple, "nombre" => $nombreEmpresaT, "financiero"=>$datosFinancieros];
                    }
                }else{
                    array_push($vectorCumple, $totalindiceL, $totalindice_endeudamento,$totalrazon_cobertura_interes, $totalrentabilidad_patrimonio,$totalrentabilidad_del_activo, $totalcapital_de_trabajo,$totalpatrimonio,$reingreso);
                    $validation = $validation =["status" => 'reprueba', "datos"=>$vectorCumple , "nombre" => $nombreEmpresaT, "financiero"=>$datosFinancieros];
                }
                //var_dump($validation);
            return Vista::crear('Alianzas.AlianzaUnspsc',$validation);            
        }

        public function pibotAlianzaCodigos($dato1,$dato2){
            $empresas = new AprobadosModel();
            $datos = $this->soloFinanciero($dato1);
            $requestObjetos = $empresas->obtenerSegundo($dato1);
            $datosObjetos = $this->filtroObjetos($dato1, json_decode($requestObjetos['empresas'][0]['objetos']));
            $vect = [];
            $intersecto= [];
            $nombre ="";
            for ($i=0; $i < sizeof($datos['datos']); $i++) { 
                if($dato2 != $datos['datos'][$i][6]){
                    array_push($vect, array ($datos['datos'][$i][0],$datos['datos'][$i][1],$datos['datos'][$i][2],$datos['datos'][$i][3],$datos['datos'][$i][4],$datos['datos'][$i][5],$datos['datos'][$i][6]));
                }else{
                    $nombre = $datos['datos'][$i][0];
                }
            }
            $intersecto =array_intersect_assoc($datosObjetos, $vect);
            $result =[];
            if($intersecto != NULL){
                for ($i=0; $i < sizeof($intersecto); $i++) { 
                    $emp = $empresas->obtenerEmpresa($intersecto[$i]);
                    if($intersecto[$i] != $dato2){
                        array_push($result,$emp['empresas'][0]['nombre_empresa']);
                    }                
                }
            }
            if($nombre != ""){
                return array("aprobaron" => $result, "nombre"=>$nombre, "licitacion"=>$dato1);
            }
        }

        public function pibotCodFinanciero($idLicitacion, $idEmpresa){
            $empresas = new AprobadosModel();
            $empresa = $empresas->obtenerEmpresa($idEmpresa);
            $codigos = $empresas->obtenerFiltroUno($idLicitacion);
            $financiero = $this->soloFinanciero($idLicitacion);
            $aux = [];
            $intersecto=[];
            for ($i=0; $i < sizeof($financiero['datos']); $i++) { 
                array_push($aux,$financiero['datos'][$i][7]);
            }
            $result =[];
            $intenso = json_decode($codigos['empresas'][0]['result']);
            $intersecto =array_diff_assoc($intenso, $aux);
            for ($i=0; $i < sizeof($intersecto); $i++) { 
                $emp = $empresas->obtenerEmpresa($intersecto[$i]);
                if($intersecto[$i] != $idEmpresa){
                    array_push($result,$emp['empresas'][0]['nombre_empresa']);
                }                
            }
            return array("aprobaron"=>$result, "licitacion"=>$idLicitacion, "nombre"=>$empresa['empresas'][0]['nombre_empresa']);
        }

        public function AlianzaCodFinanciero(){
            $empre = new AprobadosModel();
            $nombreEmpresaT = $_POST['nombre'];
            $porcentajeEmpresa = $_POST['porcentajeEmpresa'];
            $empresas = [];
            $porcentaje =[];
            if(isset($_POST['empresas'])){
                $empresas = $_POST['empresas'];
                $porcentaje = $_POST['porcentaje'];
            }
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
            $reingreso = $this->pibotCodFinanciero($licitacion,$titular['empresas'][0]['nit']);
            if($pib['ind_liquidez'] <= $totalindiceL && $pib['endeudamiento'] >= $totalindice_endeudamento && $pib['rent_patrimonio'] <= $totalrentabilidad_patrimonio && $pib['rent_activos'] <= $totalrentabilidad_del_activo && $pib['patrimonio'] <= $totalpatrimonio && $totalcapital_de_trabajo >= $pib['capital_trabajo']){
                if($pib['raz_cobertura_int'] >= 0 && $pib['raz_cobertura_int'] <= $totalrazon_cobertura_interes || $totalrazon_cobertura_interes ==0){
                    array_push($vectorCumple, $totalindiceL, $totalindice_endeudamento,$totalrazon_cobertura_interes, $totalrentabilidad_patrimonio,$totalrentabilidad_del_activo, $totalcapital_de_trabajo,$totalpatrimonio,$reingreso);
                    array_push($datosFinancieros,$pib['ind_liquidez'],$pib['endeudamiento'], $pib['raz_cobertura_int'],$pib['rent_patrimonio'], $pib['rent_activos'],$pib['patrimonio'], $pib['capital_trabajo']);
                    $validation =["status" => 'aprueba', "datos"=>$vectorCumple, "nombre" => $nombreEmpresaT, "financiero"=>$datosFinancieros];
                }
            }else{
                array_push($vectorCumple, $totalindiceL, $totalindice_endeudamento,$totalrazon_cobertura_interes, $totalrentabilidad_patrimonio,$totalrentabilidad_del_activo, $totalcapital_de_trabajo,$totalpatrimonio,$reingreso);
                $validation = $validation =["status" => 'reprueba', "datos"=>$vectorCumple , "nombre" => $nombreEmpresaT, "financiero"=>$datosFinancieros];
            }
            //var_dump($validation);
            return Vista::crear('Alianzas.AlianzaExperiencia',$validation);
        }

        public function pibotExperiencias($idLicitacion,$idEmpresa,$codigos){
            $empresas = new AprobadosModel();
            $datosUns = $empresas->obtenerFiltroUno($idLicitacion,$codigos);
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

        public function AlianzaExperiences($idLicitacion, $idEmpresa){
            $datos = $this->pibotCodFinanciero($idLicitacion,$idEmpresa);
            return Vista::crear('Alianzas.AlianzaExperiencia', $datos);
        }

        public function alianzaFinanciero($idLicitacion, $idEmpresa){
            $datos = $this->pibotCodigosExperiencias($idLicitacion,$idEmpresa);
            return Vista::crear('Alianzas.AlianzaFinancieroyOrg', $datos);
        }

        public function alianzaCodExperiencia(){
            $empre = new AprobadosModel();
            $nombreEmpresaT = $_POST['nombre'];
            $porcentajeEmpresa = $_POST['porcentajeEmpresa'];
            $empresas = [];
            $porcentaje =[];
            if(isset($_POST['empresas'])){
                $empresas = $_POST['empresas'];
                $porcentaje = $_POST['porcentaje'];
            }
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
                if($pib['raz_cobertura_int'] >= 0 && $pib['raz_cobertura_int'] <= $totalrazon_cobertura_interes || $totalrazon_cobertura_interes == 0){
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
            $empresas = [];
            $porcentaje =[];
            if(isset($_POST['empresas'])){
                $empresas = $_POST['empresas'];
                $porcentaje = $_POST['porcentaje'];
            }
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
                if($pib['raz_cobertura_int'] >= 0 && $pib['raz_cobertura_int'] <= $totalrazon_cobertura_interes || $totalrazon_cobertura_interes == 0){
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
            $cumplex = $empresas->obtenerSegundo($id);
            $dataRequired = $empresas->obtenerExperiencias($id);
            $requestData = json_decode($cumplex['empresas'][0]['objetos']);
            $filtro = $this->filtroObjetos($id,$requestData);
            $pibot = $dataRequired['empresas'][0]['nro_contratos'];
            $aprobados = [];
            if($filtro['objetos_por_cantidad'] != null){
                foreach ($filtro['cantidad_objetos'] as $value) {
                    if ($value['cantidad'] >= $pibot ){
                        $infoEmpresa = $empresas->obtenerEmpresa($value['nit']);
                        array_push($aprobados,array("nombre"=>$infoEmpresa['empresas'][0]['nombre_empresa'], "id"=>$value['nit'], "licitacion"=>$id));
                    }
                }
            }
            return Vista::crear('ViewAprobados.Experiencia',$aprobados);
        }

        public function filtroUno($dat){
            $empresas = new AprobadosModel();
            $cumplimientos = new CumplimientosModel();
            $id = $dat;   
            $datos = $empresas->obtenerFiltroUno($id);
            $codigos = [];
            $data1= json_decode($datos['empresas'][0]['objetos']);
            $data = json_decode($datos['empresas'][0]['result']);
            for ($i=0; $i < sizeof($data1); $i++) { 
                array_push($codigos,$data1[$i]);
            }
            $aux = implode(",",$codigos);

            $values = [];
            for ($i=0; $i < sizeof($data); $i++) { 
                $cods = [];
                for ($j=0; $j < sizeof($data1) ; $j++) { 
                    $pibote = $cumplimientos->EmpresaCodigitos($data1[$j]);
                    for ($h=0; $h < sizeof($pibote['empresas']) ; $h++) { 
                        if($pibote['empresas'][$h]['nit_empresa']== $data[$i]){
                            array_push($cods, $data1[$j]);
                        }
                    }
                }
                $obtenerNombreEmpresa = $empresas->obtenerEmpresa($data[$i]);
                $auxi = implode(",",$cods);
                array_push($values, array("nombre"=>$obtenerNombreEmpresa['empresas'][0]['nombre_empresa'], "codigos"=>$auxi, "idEmpresa"=>$data[$i]));
            }
            return Vista::crear("ViewAprobados.CumplimientoUnspsc",array ("datos"=>$values, "id"=>$id, "otros"=>$values));
        }

        public function redirect($id){
            $dato = $this->soloFinanciero($id);
            return Vista::crear('ViewAprobados.CumplimientoFyO', array ("dato" => $dato, "id"=> $id));
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
                    if($pib['raz_cobertura_int'] >= 0 && $pib['raz_cobertura_int'] <= $aux['razon_cobertura_interes'] || $aux['razon_cobertura_interes'] == 0){
                            array_push($vectorCumple, array($aux['nombre_empresa'], $aux['indice_liquidez'],$aux['indice_endeudamento'], $aux['razon_cobertura_interes'] ,$aux['rentabilidad_patrimonio'], $aux['rentabilidad_del_activo'], $aux['capital_de_trabajo'],$aux['patrimonio'],$datos['empresas'][$i]['nit'],$aux['nit']));
                    }
                }
                
            }
            $result = [];
            $result =["requridos"=> $object['empresas'][0], "datos" => $vectorCumple];
            return $result;
            return Vista::crear('ViewAprobados.CumplimientoFyO', array("requridos"=> $object['empresas'][0], "datos" => $vectorCumple));
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
            $empr= new AprobadosModel();
            $required = $empr->obtenerpedidosExperiencia($Licitacion);
            $requeridos = $required['empresas'][0]['min_cod_req'];
            $prrr= [];
            $uaa = [];
            $paso =[];
            for ($i=0; $i < sizeof($codigos); $i++) { 
                $codiger = $empresas->EmpresaCodigitos($codigos[$i]);                
                for ($h=0; $h < sizeof($codiger['empresas']); $h++) {                 
                    $conteo = $codiger['empresas'][$h]['nit_empresa'];
                    array_push($prrr, $conteo);
                    array_push($paso,array("codigo"=>$codigos[$i],"empresa"=>$conteo));
                }
            }
            $uaa = array_count_values($prrr);
            $variableReal=[];
            foreach ($uaa as $key => $value) {
                if($value >= $requeridos){
                    array_push($variableReal,$key);
                }
            }
            $request=["pedido"=>$codigos,"pasaron"=>$variableReal, "licitacion" => $Licitacion];
            return $request;
        }

        public function filtroObjetos($Licitacion,$objetos){
            $empresas = new CumplimientosModel();
            $empr = new AprobadosModel();
            $requerido = $empr->obtenerpedidosExperiencia($Licitacion);
            $codsRequired =$empr->obtenerFiltroUno($Licitacion);
            $Contratos = $requerido['empresas'][0]['nro_contratos'];
            $slm = $requerido['empresas'][0]['result_presupuesto'];
            $CodigosRequeridos = $requerido['empresas'][0]['min_cod_req'];
            $codigos = json_decode($codsRequired['empresas'][0]['objetos']);
            $pibot =[];
            #-----------------Empresas que cumplen con los objetos--------------------------
            for ($i=0; $i < sizeof($objetos); $i++) { 
                $data = $empresas->ObjetoEmpresa($objetos[$i]); //filtra las empresas que contengan los objetos que se pasaron por parametros.
                if($data['status']==1){
                    for ($j=0; $j < sizeof($data['empresas']); $j++) { 
                        array_push($pibot, $data['empresas'][$j]['nit'], $objetos[$i]); // guardo la empresa junto a el objeto que cumple
                    }
                }
            }
            $cont =[];
            #----------------Cantidad de objetos por empresa----------------------------
            for ($i=0; $i < sizeof($pibot); $i++) { 
                if($i % 2==0 || $i==0 ){
                    $arrayObjects =[];
                    $j = 0;
                    foreach ($pibot as $key=>$value) {
                        if($key %2 ==0 || $key ==0){
                            if($pibot[$i]==$value){
                                $j= $j+1;
                                array_push($arrayObjects, $pibot[$i+1]);
                            }                        
                        }
                    }
                    array_push($cont, array("empresa"=>$pibot[$i], "cantidad"=>$j, "codigos"=>$arrayObjects));
                }
            }
            $obtenerEmpresa =((array_column($cont,'empresa')));
            $obtenerCantidad = array_count_values($obtenerEmpresa);
            #-----------Cantidad de Códigos que tiene esa experiencia------------------
            $auxi =[];
            
            for ($i=0; $i < sizeof($objetos); $i++) { 
                $carta =0;
                $obtengoServExper = $empresas->getServicioExpe($objetos[$i]);
                foreach ($obtengoServExper['empresas'] as $key => $value) {
                    for ($j=0; $j < sizeof($codigos); $j++) { 
                        if($value['id_servicio'] == $codigos[$j]){
                            $dataAux = $empresas->obtengoExperiencia($objetos[$i]);
                            if($dataAux['empresas'][0]['valor_contrato_smmlv'] >= $slm){
                                $carta = $carta+1;
                            }
                        }
                    }
                }
                array_push($auxi, array("objeto"=> $objetos[$i], "cantidad"=>$carta));
            }

            $cantidadCodigos = [];

            foreach ($auxi as $key => $value) {
                if($value['cantidad'] != 0 && $value['cantidad']>=$CodigosRequeridos){
                    array_push($cantidadCodigos, $value['objeto']);
                }
            }

            
            $pasaCantidadObjetos =[];
            $Cantidad_por_empresa =[];
            foreach ($obtenerCantidad as $key => $value) {
                if ($value >= $Contratos){
                    array_push($pasaCantidadObjetos, $key);
                    array_push($Cantidad_por_empresa, array("nit"=>$key, "cantidad"=>$value));
                }
            }
            $aprobaron =[];
            for ($i=0; $i < sizeof($pasaCantidadObjetos) ; $i++) { 
                for ($j=0; $j < sizeof($cantidadCodigos); $j++) { 
                    $ver = $empresas->ObjetoEmpresa($cantidadCodigos[$j]);
                    for ($h=0; $h < sizeof($ver); $h++) { 
                        if($ver['empresas'][0]['nit'] == $pasaCantidadObjetos[$i]){
                            array_push($aprobaron,$ver['empresas'][0]['nit']);
                        }
                    }
                }
            }
            $reductor = array_unique($aprobaron);
            $realyAprovade= array_values($reductor);
            $request=["pedido"=>$objetos, "pasaron"=>$realyAprovade, "licitacion" => $Licitacion, "objetos_por_cantidad"=>$cantidadCodigos,"cantidad_objetos"=>$Cantidad_por_empresa,"objetos"=>(array_column($cont,'codigos'))];
            return $request;
        }
        public function filtroUnoyDos($dat){
            $empresas = new AprobadosModel();
            $codRequeridos = $empresas->obtenerFiltroUno($dat);
            $objetosRequeridos = $empresas->obtenerSegundo($dat);
            $requerido = $empresas->obtenerpedidosExperiencia($dat);
            $resultFiltroUno = $this->filtroUnspsc($dat, json_decode($codRequeridos['empresas'][0]['objetos']));
            $resultFiltroDos = $this->filtroObjetos($dat, json_decode($objetosRequeridos['empresas'][0]['objetos']));
            $aprobados = array_intersect_assoc($resultFiltroUno['pasaron'],$resultFiltroDos['pasaron']);
            $codigos = implode(",", json_decode($codRequeridos['empresas'][0]['objetos']));
            $vectorDatos= [];
            for ($i=0; $i < sizeof($aprobados) ; $i++) { 
                $name = $empresas->obtenerEmpresa($aprobados[$i]);
                array_push($vectorDatos, array($name['empresas'][0]['nombre_empresa'],$codigos,$requerido['empresas'][0]['nro_contratos'],$requerido['empresas'][0]['min_cod_req'], $requerido['empresas'][0]['presupuesto_exigido'],$requerido['empresas'][0]['porcentaje_of_exigido'],$requerido['empresas'][0]['result_presupuesto'],$requerido['empresas'][0]['min_cod_req'],$dat,$aprobados[$i]));
            }
            return Vista::crear("ViewAprobados.CumplimientounspscyExperiencia", $vectorDatos);
        }

        public function SeeExperience($dat,$idEmpresa){
            $empr = new AprobadosModel();
            $empresas = new CumplimientosModel();
            $requiredCods = $empr->obtenerFiltroUno($dat);
            $requerido = $empr->obtenerpedidosExperiencia($dat);
            $CodigosRequeridos= $requerido['empresas'][0]['min_cod_req'];
            $codigos = json_decode($requiredCods['empresas'][0]['objetos']);
            $pedido = $empr->obtenerSegundo($dat);
            $requiredObjects = json_decode($pedido['empresas'][0]['objetos']);//los objetos que me piden tener
            $info = [];
            $filtrado = $this->filtroObjetos($dat,$requiredObjects);
            $rep_array = [];
            for ($l=0; $l <sizeof($filtrado['pedido']) ; $l++) { 
                array_push($rep_array,$filtrado['pedido'][$l]);
            }

            $objetos = array_values(array_unique($rep_array));
            $auxi =[];  
            
            for ($i=0; $i < sizeof($objetos); $i++) { 
                $carta =0;
                $pibo =[];
                $obtengoServExper = $empresas->getServicioExpe($objetos[$i]);
                foreach ($obtengoServExper['empresas'] as $key => $value) {
                    $aux =[];
                    for ($j=0; $j < sizeof($codigos); $j++) { 
                        if($value['id_servicio'] == $codigos[$j]){
                            $carta = $carta+1;
                            array_push($aux, $codigos[$j]);
                        }
                    }
                    if($aux != null){
                        array_push($pibo, implode(",",$aux));
                    }
                }
                array_push($auxi, array("objeto"=> $objetos[$i], "cantidad"=>$carta, "codigos"=>$pibo));
            }

            $cantidadCodigos = [];

            foreach ($auxi as $key => $value) {
                if($value['cantidad']>=$CodigosRequeridos){
                    array_push($cantidadCodigos, array("objeto"=>$value['objeto'],"codigos"=>$value['codigos']));
                }
            }      
            for ($i=0; $i < sizeof($filtrado['pasaron']) ; $i++) { 
                if($filtrado['pasaron'][$i]== $idEmpresa && $filtrado['cantidad_objetos'][$i]['nit'] == $idEmpresa && $filtrado['cantidad_objetos'][$i]['cantidad'] >= $requerido['empresas'][0]['nro_contratos']){
                    for ($p=0; $p < sizeof($objetos); $p++) { 
                        $data = $empresas->ObjetoEmpresa($objetos[$p]);
                        for ($l=0; $l < sizeof($cantidadCodigos); $l++) { 
                            if($data['empresas'][0]['nit'] == $idEmpresa && $objetos[$p] == $cantidadCodigos[$l]['objeto']){
                                $experiencia = $empr->obtengoExperiencia($cantidadCodigos[$l]['objeto']); //datos de la experiencia
                                array_push($info,array($experiencia['empresas'][0]['numero_experiencia'],$experiencia['empresas'][0]['numero_contrato'],$experiencia['empresas'][0]['contrato_celebrado_por'],$experiencia['empresas'][0]['nombre_contratista'],$experiencia['empresas'][0]['nombre_contratante'],$experiencia['empresas'][0]['valor_contrato_smmlv'],$experiencia['empresas'][0]['fecha_obj_inicio'],$experiencia['empresas'][0]['fecha_obj_final'],$experiencia['empresas'][0]['descripcion'],$experiencia['empresas'][0]['tipo_objeto_actividad'],$cantidadCodigos[$l]['codigos']));
                            }
                        }
                    }
                }
            }
            return Vista::crear("ViewAprobados.SeeExpe",$info);
        } 

        public function RevisionExperienciaCumple($id,$licitacion){
            $empr = new AprobadosModel();
            try {
                $empresas = new CumplimientosModel();
                $required = $empr->obtenerpedidosExperiencia($licitacion);
                $requiredObject = $empr->obtenerSegundo($licitacion);
                $requiredCods = $empr->obtenerFiltroUno($licitacion);
                $objetos = json_decode($requiredObject['empresas'][0]['objetos']);
                $pibot =[];
                #-----------------Empresas que cunplen con los objetos--------------------------
                $codigos = json_decode($requiredCods['empresas'][0]['objetos']);
                for ($i=0; $i < sizeof($objetos); $i++) { 
                    $data = $empresas->ObjetoEmpresa($objetos[$i]); //filtra las empresas que contengan los objetos que se pasaron por parametros.
                    if($data['status']==1){
                        if($id == $data['empresas'][0]['nit']){
                            $contar = 0;
                            $cods =[];
                            for ($h=0; $h < sizeof($codigos); $h++) { 
                                    $obtengoServExper = $empresas->ObtenerServicioExperiencia($objetos[$i],$codigos[$h]);
                                    if($obtengoServExper['status']==1 && $obtengoServExper['empresas'] != null){
                                        array_push($cods, $codigos[$h]);
                                        $contar = $contar+1;
                                    }
                            }    
                            if($contar !=0 && $contar >= $required['empresas'][0]['min_cod_req'] && $cods != 0){
                                $cod = implode(',',$cods);
                                array_push($pibot, array("nombre"=>$data['empresas'][0]['descripcion'],"valor"=>$data['empresas'][0]['valor_contrato_smmlv'],"tipoActividad"=>$data['empresas'][0]['tipo_objeto_actividad'],"codigos"=>$cod)); // guardo la empresa junto a el objeto que cumple
                            }
                        }
                    }
                }
                return Vista::crear("ViewAprobados.ViewExperience", $pibot);
            } catch (Exception $th) {
                print_r($th);
            }
        }

        public function validateObjects($licitacion){
            $empresas = new EmpresaModel();
            $required = new AprobadosModel();
            $requiredObjects = $required->obtenerSegundo($licitacion);
            $requiredExperiences = $required->obtenerExperiencias($licitacion);
            #-----------------------Filtro-----------------
            $objetos = json_decode($requiredObjects['empresas'][0]['objetos']);
            $empresas = new CumplimientosModel();
            $requerido = $required->obtenerpedidosExperiencia($licitacion);
            $codsRequired =$required->obtenerFiltroUno($licitacion);
            $CodigosRequeridos = $requerido['empresas'][0]['min_cod_req'];
            $codigos = json_decode($codsRequired['empresas'][0]['objetos']);
            $pibot =[];
            #-----------------Empresas que cumplen con los objetos--------------------------
            for ($i=0; $i < sizeof($objetos); $i++) { 
                $data = $empresas->ObjetoEmpresa($objetos[$i]); //filtra las empresas que contengan los objetos que se pasaron por parametros.
                if($data['status']==1){
                    for ($j=0; $j < sizeof($data['empresas']); $j++) { 
                        array_push($pibot, $data['empresas'][$j]['nit'], $objetos[$i]); // guardo la empresa junto a el objeto que cumple
                    }
                }
            }
            $cont =[];
            #----------------Cantidad de objetos por empresa----------------------------
            for ($i=0; $i < sizeof($pibot); $i++) { 
                if($i % 2==0 || $i==0 ){
                    $arrayObjects =[];
                    $j = 0;
                    foreach ($pibot as $key=>$value) {
                        if($key %2 ==0 || $key ==0){
                            if($pibot[$i]==$value){
                                $j= $j+1;
                                array_push($arrayObjects, $pibot[$i+1]);
                            }                        
                        }
                    }
                    array_push($cont, array("empresa"=>$pibot[$i], "cantidad"=>$j, "codigos"=>$arrayObjects));
                }
            }
            $obtenerEmpresa =((array_column($cont,'empresa')));
            $obtenerCantidad = array_count_values($obtenerEmpresa);
            #-----------Cantidad de Códigos que tiene esa experiencia------------------
            $auxi =[];
            
            for ($i=0; $i < sizeof($objetos); $i++) { 
                $carta =0;
                $obtengoServExper = $empresas->getServicioExpe($objetos[$i]);
                foreach ($obtengoServExper['empresas'] as $key => $value) {
                    for ($j=0; $j < sizeof($codigos); $j++) { 
                        if($value['id_servicio'] == $codigos[$j]){
                            $carta = $carta+1;
                        }
                    }
                }
                array_push($auxi, array("objeto"=> $objetos[$i], "cantidad"=>$carta));
            }
            
            $cantidadCodigos = [];
            
            foreach ($auxi as $key => $value) {
                if($value['cantidad']>=$CodigosRequeridos){
                    array_push($cantidadCodigos, $value['objeto']);
                }
            }
            
            
            $pasaCantidadObjetos =[];
            $Cantidad_por_empresa =[];
            foreach ($obtenerCantidad as $key => $value) {
                array_push($pasaCantidadObjetos, $key);
                $nameCompany = $required->obtenerEmpresa($key);
                array_push($Cantidad_por_empresa, array("nit"=>$nameCompany['empresas'][0]['nombre_empresa'], "cantidad"=>$value));
            }
            return array("infoAnswer"=>$Cantidad_por_empresa ,"nro_contratos"=>$requiredExperiences['empresas'][0]['nro_contratos'],"licitacion"=>$licitacion);
        }

        public function everycompany($licitacion){
            return Vista::crear("Alianzas.Cumplidos",$this->validateObjects($licitacion));
        }

        public function freeAliance(){
            $required = new AprobadosModel();
            $empresas = $_POST['empresas'];
            $porcentaje = $_POST['porcentaje'];
            $licitacion = $_POST['licitacion'];
            $object = $required->obtenerfinanciero($licitacion); //se obtiene uno a uno.
            $requiredFinancy = $required->obtenerfinanciero($licitacion);
            $pib = $requiredFinancy['empresas'][0];
            $response = $this->validateObjects($licitacion);
            $adder = 0;           
            
                if(isset($_POST['empresas'])){
                    $empresas = $_POST['empresas'];
                    $porcentaje = $_POST['porcentaje'];
                }
                $licitacion = $_POST['licitacion'];
                $indiceL = 0;
                $indice_endeudamento =0;
                $razon_cobertura_interes =0;
                $rentabilidad_patrimonio =0;
                $rentabilidad_del_activo =0;
                $capital_de_trabajo =0;
                $patrimonio = 0;
                for ($i=0; $i < sizeof($empresas); $i++) { 
                    $info = $required->obtenerEmpresaNombre($empresas[$i]);
                    $indiceL = (($info['empresas'][0]['indice_liquidez'])* ($porcentaje[$i]/100)) + $indiceL;
                    $indice_endeudamento = (($info['empresas'][0]['indice_endeudamento'])* ($porcentaje[$i]/100)) + $indice_endeudamento;
                    $razon_cobertura_interes = (($info['empresas'][0]['razon_cobertura_interes'])* ($porcentaje[$i]/100)) + $razon_cobertura_interes;
                    $rentabilidad_patrimonio = (($info['empresas'][0]['rentabilidad_patrimonio'])* ($porcentaje[$i]/100)) + $rentabilidad_patrimonio;
                    $rentabilidad_del_activo = (($info['empresas'][0]['rentabilidad_del_activo'])* ($porcentaje[$i]/100)) + $rentabilidad_del_activo;
                    $capital_de_trabajo = (($info['empresas'][0]['capital_de_trabajo'])* ($porcentaje[$i]/100)) + $capital_de_trabajo;
                    $patrimonio = (($info['empresas'][0]['patrimonio'])* ($porcentaje[$i]/100)) + $patrimonio;
                }
                $vectorCumple = [];
                $requeridos = $required->obtenerfinanciero($licitacion);
                $pib = $requeridos['empresas'][0];        
                $validation = [];
                $datosFinancieros =[];
                if($pib['ind_liquidez'] <= $indiceL && $pib['endeudamiento'] >= $indice_endeudamento && $pib['rent_patrimonio'] <= $rentabilidad_patrimonio && $pib['rent_activos'] <= $rentabilidad_del_activo && $pib['patrimonio'] <= $patrimonio && $capital_de_trabajo >= $pib['capital_trabajo']){
                    if($pib['raz_cobertura_int'] >= 0 && $pib['raz_cobertura_int'] <= $razon_cobertura_interes || $razon_cobertura_interes == 0){
                        array_push($vectorCumple, $indiceL, $indice_endeudamento,$razon_cobertura_interes, $rentabilidad_patrimonio,$rentabilidad_del_activo, $capital_de_trabajo,$patrimonio);
                        array_push($datosFinancieros,$pib['ind_liquidez'],$pib['endeudamiento'], $pib['raz_cobertura_int'],$pib['rent_patrimonio'], $pib['rent_activos'],$pib['patrimonio'], $pib['capital_trabajo']);
                        $validation =["status" => 'aprueba', "datos"=>$vectorCumple, "financiero"=>$datosFinancieros];
                    }
                }else{
                    array_push($vectorCumple, $indiceL, $indice_endeudamento,$razon_cobertura_interes, $rentabilidad_patrimonio,$rentabilidad_del_activo, $capital_de_trabajo,$patrimonio);
                    $validation = $validation =["status" => 'reprueba', "datos"=>$vectorCumple, "financiero"=>$datosFinancieros];
                }
                return Vista::crear("Alianzas.Cumplidos",$this->validateObjects($licitacion), array("resultados"=>$validation,"requeridos"=>$object['empresas'][0]));
            
        }
    }  
?>