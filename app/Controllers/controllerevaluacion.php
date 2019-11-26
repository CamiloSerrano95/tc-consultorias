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
                    print_r($conteo);
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

        public function codigosObjetos($variableReal, $nit, $Licitacion){
            //$primeroysegundo = [];
            $request = [];
            $intersecto = array_intersect_assoc($variableReal,$nit);
            //var_dump($intersecto);
            /* for ($i=0; $i < sizeof($variableReal); $i++) { 
                $veneno =0;
                for ($j=0; $j < sizeof($nit); $j++) { 
                    if($variableReal[$i] == $nit[$j]){
                        $veneno = $veneno +1;
                    }
                }
                if($veneno > 0 && $veneno < 2){
                    array_push($primeroysegundo, $variableReal[$i]);
                }
            } */
            $request = ["pasaron"=>$intersecto, "licitacion" => $Licitacion];
            return $request;
        }

        public function filtroExperiencia($primeroysegundo,$objetos ,$Contratos, $codigos, $CodigosRequeridos, $PresupuestoOficial,$PorcentajeExigido,$Licitacion){
            $empresas = new CumplimientosModel();
            $pibot =[];
            for ($i=0; $i < sizeof($objetos); $i++) { 
                $data = $empresas->ObjetoEmpresa($objetos[$i]); //filtra las empresas que contengan los objetos que se pasaron por parametros.
                if($data['status']==1){
                    for ($j=0; $j < sizeof($data['empresas']); $j++) { 
                        array_push($pibot, $data['empresas'][$j]['nit'], $objetos[$i]); // guardo la empresa junto a el objeto que cumple
                    }
                }
            }
            //var_dump($pibot);
            $cont =[];

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
            $pasaCantidadObjetos =[];
            foreach ($obtenerCantidad as $key => $value) {
                if ($value >= $Contratos){
                    array_push($pasaCantidadObjetos, $key);
                }
            }

            #--------------------------------------------------------------------------------------------
            $auxi =[];
            for ($i=0; $i < sizeof($objetos) ; $i++) {
                $requestExperienciaServicio = $empresas->ObtenerServicioExperiencia($objetos[$i]);
                $contador = 0;
                for ($j=0; $j < sizeof($codigos); $j++) { 
                    if($requestExperienciaServicio['empresas'][0]['id_servicio']== $codigos[$j]){
                        $contador= $contador+1;
                    }
                }
                array_push($auxi, array("objeto"=> $objetos[$i], "cantidad"=>$contador));
            }

            $cantidadCodigos = [];
            for ($i=0; $i < sizeof($auxi) ; $i++) { 
                if($auxi[$i]['cantidad'] >= $CodigosRequeridos){
                    array_push($cantidadCodigos, $auxi[$i]['objeto']);
                }
            }
            $valorComp = $PresupuestoOficial * ($PorcentajeExigido/100);
            for ($i=0; $i < sizeof($cantidadCodigos) ; $i++) { 
                $datos = $empresas->obtengoExperiencia($cantidadCodigos[$i]);
                if($datos['empresas'][0]['valor_contrato_smmlv'] <= $valorComp ){

                }
            }

            $request =["pedidos" => array ($Contratos, $CodigosRequeridos, $PorcentajeExigido , $PresupuestoOficial, $ficticia), "pasaron" =>$parteTres, "licitacion" => $Licitacion];
            //return $request;
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
            $objetos = $_POST['objetos'];
            $id=$empresas->AddLicitacion($Licitacion);
            $patrimonio = $_POST['patrimonio'];
            $capitalTrabajo = $_POST['capital'];
            //var_dump($id['id']);
            //-------------------------Primer filtro Servicio Empresas ---------------------------------------------------
            $variableReal = $this->filtroUnspsc($id['id'], $codigos, $CodigosRequeridos);
            $empresas->AddCumplimientoUNSPSC(json_encode($codigos), json_encode($variableReal['pasaron']), $id['id']);
            //-----------------Segundo Filtro Objetos-Experiencias --------------------------------------
            $nit = $this->filtroObjetos($id['id'],$objetos);
            $empresas->AddCumplimientoObjeto(json_encode($objetos), json_encode($nit['pasaron']), $id['id']);
            // Se obtiene un array llamado objetos que trae todos los nit de los objetos a buscar por el solicitante
            
            //------------------------ FILTRO entre 1 y 2---------------------------------------------------
            $primeroysegundo = $this->codigosObjetos($variableReal['pasaron'],$nit['pasaron'],$id['id']);
            $empresas->AddFiltroUnoDos(json_encode($primeroysegundo['pasaron']),$id['id']);
            //-----------------------------TERCER FILTRO-----------------------------------------
            $parteTres = $this->filtroExperiencia($primeroysegundo['pasaron'],$objetos,$Contratos,$codigos, $CodigosRequeridos,$PresupuestoOficial,$PorcentajeExigido, $id['id']);
            //$empresas->AddCumplimientoExperiencia($Contratos, $CodigosRequeridos, $PorcentajeExigido , $PresupuestoOficial, $parteTres['pedidos'][4], json_encode($parteTres['pasaron']), $id['id']);
            //------------------------------all final section--------------------------------------------
            /* $ultimo = $this->filtroFinanciero($parteTres['pasaron'],$Endeudamiento,$Liquidez,$CoberturaInteres,$RentabilidadActivos,$RentabilidadPatrimonio,$id['id'],$patrimonio,$capitalTrabajo);
            $empresas->AddCumplimientoFinanciero($Liquidez,$Endeudamiento,$CoberturaInteres,$RentabilidadPatrimonio,$RentabilidadActivos, $patrimonio,$capitalTrabajo,json_encode($ultimo['pasaron']),$id['id']); */
            //var_dump($ultimo);
            //Redirecciona::LetsGoTo('evaluacion');
        }
    }
?>