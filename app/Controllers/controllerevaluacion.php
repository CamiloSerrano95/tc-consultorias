<?php
    use \vista\Vista;

    class controllerevaluacion {
        public function __construct()
        {
            
        }


        public function index(){
            return Vista::crear("Cumplimientos.EvalucionCumplimientos");
        }

        public function nuevo(){
            return Vista::crear("evaluacion.create");
        }

        public function filtroUnspsc($Licitacion,$codigos,$requeridos){
            $empresas = new CumplimientosModel();
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

        public function filtroObjetos($Licitacion,$objetos, $Contratos, $CodigosRequeridos, $codigos){
            $empresas = new CumplimientosModel();
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
                    $j = 0;
                    foreach ($pibot as $key=>$value) {
                        if($key %2 ==0 || $key ==0){
                            if($pibot[$i]==$value){
                                $j= $j+1;
                            }                        
                        }
                    }
                    array_push($cont, array("empresa"=>$pibot[$i], "cantidad"=>$j));
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
            foreach ($obtenerCantidad as $key => $value) {
                if ($value >= $Contratos){
                    array_push($pasaCantidadObjetos, $key);
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
            $request=["pedido"=>$objetos,"pasaron"=>array_unique($aprobaron) ,"cantidad" =>$cantidadCodigos, "licitacion" => $Licitacion];
            return $request;
        }

        public function codigosObjetos($variableReal, $nit, $Licitacion){            
            $request = [];
            $intersecto = array_intersect_assoc($variableReal,$nit);
            $request = ["pasaron"=>$intersecto, "licitacion" => $Licitacion];
            return $request;
        }

        public function filtroExperiencia($primeroysegundo ,$Contratos, $cantidadCodigos, $CodigosRequeridos, $PresupuestoOficial,$PorcentajeExigido,$Licitacion){
            $empresas = new CumplimientosModel();
            $result =[];
            $valorComp = $PresupuestoOficial * ($PorcentajeExigido/100);
            for ($i=0; $i < sizeof($cantidadCodigos) ; $i++) { 
                $datos = $empresas->obtengoExperiencia($cantidadCodigos[$i]);
                if($datos['empresas'][0]['valor_contrato_smmlv'] >= $valorComp ){
                    array_push($result, $datos['empresas'][0]['id_empresa_experiencia']);
                }
            }
            $parteTres=[];
            for ($i=0; $i < sizeof($primeroysegundo); $i++) { 
                for ($j=0; $j < sizeof($result); $j++) { 
                    if($primeroysegundo[$i] == $result[$j]){
                        array_push($parteTres, $primeroysegundo[$i]);
                    }
                }
            }
            $resultado = (array_unique($parteTres)); 
            $request =["pedidos" => array ($Contratos, $CodigosRequeridos, $PorcentajeExigido , $PresupuestoOficial, $valorComp), "pasaron" =>$resultado, "licitacion" => $Licitacion];
            return $request;
        }

        public function filtroFinanciero($nitempresa,$Endeudamiento,$Liquidez,$CoberturaInteres,$RentabilidadActivos,$RentabilidadPatrimonio,$Licitacion,$patrimonio,$capitalTrabajo){
            $objeto = new EmpresaModel();
            
            $auxiliar = [];
            for ($i=0; $i < sizeof($nitempresa); $i++) { 
                $empresa = $objeto->ObtenerEmpresa($nitempresa[$i]);
                $aux = ($empresa['empresas'][0]['capital_de_trabajo'])*0.5;
                if($Liquidez <= $empresa['empresas'][0]['indice_liquidez'] && $Endeudamiento >= $empresa['empresas'][0]['indice_endeudamento'] && $RentabilidadPatrimonio <= $empresa['empresas'][0]['rentabilidad_patrimonio'] && $RentabilidadActivos <= $empresa['empresas'][0]['rentabilidad_del_activo'] && $patrimonio <= $empresa['empresas'][0]['patrimonio'] && $aux >= $capitalTrabajo){
                    if($CoberturaInteres >= 0 && $CoberturaInteres <= $empresa['empresas'][0]['razon_cobertura_interes'] || $empresa['empresas'][0]['razon_cobertura_interes'] == 0){
                        array_push($auxiliar, $empresa['empresas'][0]['nit']);
                    }
                }
            }        
            $request = ["pedidos" => array ($Liquidez,$Endeudamiento,$CoberturaInteres,$RentabilidadPatrimonio,$RentabilidadActivos), "pasaron" => $auxiliar, "licitacion" => $Licitacion];
            return $request;
        }

        public function agregar(){
            $empresas = new CumplimientosModel();
            /* ----------------------------DATOS POR POST ------------------------ */
            $Contratos = $_POST['num_contrato'];
            $CodigosRequeridos = $_POST['codigos_requeridos'];
            $PresupuestoOficial = $_POST['presupuesto_oficial'];
            $PorcentajeExigido = $_POST['porcentaje_exigido'];
            $Liquidez = $_POST['liquidez'];
            $Endeudamiento = $_POST['endeudamiento'];
            $CoberturaInteres = $_POST['cobertura'];
            $RentabilidadPatrimonio = $_POST['rentabilidad_patrimonio'];
            $RentabilidadActivos = $_POST['activos'];
            $Licitacion = $_POST['licitacion'];
            $codigos = $_POST['codigos'];
            $objets = $_POST['objetos'];
            $objetos= array_values(array_unique($objets));
            $id=$empresas->AddLicitacion($Licitacion);
            $patrimonio = $_POST['patrimonio'];
            $capitalTrabajo = $_POST['capital'];
            try {
                //-------------------------Primer filtro Servicio Empresas ---------------------------------------------------
                $variableReal = $this->filtroUnspsc($id['id'], $codigos, $CodigosRequeridos);
                $empresas->AddCumplimientoUNSPSC(json_encode($codigos), json_encode($variableReal['pasaron']), $id['id']);
                //-----------------Segundo Filtro Objetos-Experiencias --------------------------------------
                $nit = $this->filtroObjetos($id['id'],$objetos,$Contratos,$CodigosRequeridos,$codigos);
                $empresas->AddCumplimientoObjeto(json_encode($objetos), json_encode($nit['pasaron']), $id['id']);
                // Se obtiene un array llamado objetos que trae todos los nit de los objetos a buscar por el solicitante
                
                //------------------------ FILTRO entre 1 y 2---------------------------------------------------
                $primeroysegundo = $this->codigosObjetos($variableReal['pasaron'],$nit['pasaron'],$id['id']);
                $empresas->AddFiltroUnoDos(json_encode($primeroysegundo['pasaron']),$id['id']);
                //-----------------------------TERCER FILTRO-----------------------------------------
                $parteTres = $this->filtroExperiencia($primeroysegundo['pasaron'],$Contratos,$nit['cantidad'], $CodigosRequeridos,$PresupuestoOficial,$PorcentajeExigido, $id['id']);
                $empresas->AddCumplimientoExperiencia($Contratos, $CodigosRequeridos, $PorcentajeExigido , $PresupuestoOficial, $parteTres['pedidos'][4], json_encode($parteTres['pasaron']), $id['id']);
                //------------------------------all final section--------------------------------------------
                $ultimo = $this->filtroFinanciero($parteTres['pasaron'],$Endeudamiento,$Liquidez,$CoberturaInteres,$RentabilidadActivos,$RentabilidadPatrimonio,$id['id'],$patrimonio,$capitalTrabajo);
                $empresas->AddCumplimientoFinanciero($Liquidez,$Endeudamiento,$CoberturaInteres,$RentabilidadPatrimonio,$RentabilidadActivos, $patrimonio,$capitalTrabajo,json_encode($ultimo['pasaron']),$id['id']);
                Redirecciona::LetsGoTo('evaluacion');
            } catch (Exception $e) {
                print_r($e);
            }
        }
    }
?>