<?php
    use \vista\Vista;

    class controllerevaluacion {


    public function index(){
        return Vista::crear("Cumplimientos.EvalucionCumplimientos");
    }

    public function nuevo(){
        return Vista::crear("evaluacion.create");
    }

    public function filtoUnspsc($Licitacion,$codigos){
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

    public function codigosObjetos($variableReal, $nit, $Licitacion){
        $empresas = new CumplimientosModel();
        $primeroysegundo = [];
        for ($i=0; $i < sizeof($variableReal); $i++) { 
            $veneno =0;
            for ($j=0; $j < sizeof($nit); $j++) { 
                if($variableReal[$i] == $nit[$j]){
                    $veneno = $veneno +1;
                }
            }
            if($veneno >0 && $veneno < 2){
                array_push($primeroysegundo, $variableReal[$i]);
            }
        }
        $request = ["pasaron"=>$primeroysegundo, "licitacion" => $Licitacion];
        return $request;
    }

    public function filtroExperiencia($primeroysegundo,$objetos ,$Contratos, $codigos, $CodigosRequeridos, $PresupuestoOficial,$PorcentajeExigido,$Licitacion){
        $empresas = new CumplimientosModel();
        $mientes =[];
        for ($i=0; $i < sizeof($objetos); $i++) { 
            $data = $empresas->ObjetoEmpresa($objetos[$i]); //filtra las empresas que contengan los objetos que se pasaron por parametros.
            array_push($mientes , $data);
        }
        //--------------------------parte uno----------------------------------------
        $parteUno = [];
        for ($i=0; $i <sizeof($primeroysegundo) ; $i++) { 
            $contadora = 0;
            if($primeroysegundo[$i] == $mientes[$i]['empresas'][0]['nit']){
                $contadora = $contadora + 1;
            }
            if($contadora + 1 >= $Contratos){
                array_push($parteUno, $primeroysegundo[$i]);
            }
        }
        
        //--------------------------parte dos----------------------------------------

        $llamada = [];
        for ($i=0; $i <sizeof($parteUno) ; $i++) { 
            $emergencia = $empresas->PresupuestoExigido($parteUno[$i]);    
            array_push($llamada, $emergencia);
        }
        $parteDos = [];
        for ($i=0; $i < sizeof($llamada); $i++) { 
            $contar = 0;
            for ($h=0; $h < sizeof($codigos); $h++) { 
                if($llamada[$i]['empresas'][$h][1] == $codigos[$h]){
                    $contar = $contar + 1;
                }
            }
            if($contar >= $CodigosRequeridos){
                array_push($parteDos, $llamada[$i]['empresas'][0][0]);
            }
        }

        //var_dump($parteDos); //pendiente para reconfirmar funcionamiento. Se dice que funciona, faltan mas pruebas según STIVEN
        //-----------------------parte tres------------------------------------------------------
        $ficticia = $PresupuestoOficial * ($PorcentajeExigido/100);
        $parteTres = [];
        for ($i=0; $i < sizeof($parteDos) ; $i++) { 
            $conta = 0;
            for ($j=0; $j < sizeof($mientes); $j++) { 
                if($parteDos[$i] == $mientes[$j]['empresas'][0]['nit']){
                    $conta = $conta +1;
                    if($ficticia <= $mientes[$j]['empresas'][0]['valor_contrato_smmlv'] && $conta == 1){
                        array_push($parteTres, $mientes[$j]['empresas'][0]['nit']);
                    }
                }
            }
        }   
        //var_dump($parteTres)
        $request =["pedidos" => array ($Contratos, $CodigosRequeridos, $PorcentajeExigido , $PresupuestoOficial, $ficticia), "pasaron" =>$parteTres, "licitacion" => $Licitacion];
        return $request;
    }

    public function filtroFinanciero($nitempresa,$Endeudamiento,$Liquidez,$CoberturaInteres,$RentabilidadActivos,$RentabilidadPatrimonio,$Licitacion,$patrimonio,$capitalTrabajo){
        $objeto = new EmpresaModel();
        
        $auxiliar = [];
        for ($i=0; $i < sizeof($nitempresa); $i++) { 
            $empresa = $objeto->ObtenerEmpresa($nitempresa);
            $aux = ($empresa['empresas'][0]['capital_de_trabajo'])*0.5;
            if($Liquidez <= $empresa['empresas'][0]['indice_liquidez'] && $Endeudamiento >= $empresa['empresas'][0]['indice_endeudamento'] && $RentabilidadPatrimonio <= $empresa['empresas'][0]['rentabilidad_patrimonio'] && $RentabilidadActivos <= $empresa['empresas'][0]['rentabilidad_del_activo'] && $patrimonio <= $empresa['empresas'][0]['patrimonio'] && $aux >= $capitalTrabajo){
                if($CoberturaInteres >= 0 && $CoberturaInteres <= $empresa['empresas'][0]['razon_cobertura_interes']){
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

        //-------------------------Primer filtro Servicio Empresas ---------------------------------------------------
        $variableReal = $this->filtroUnspsc($id['id'], $codigos);
        $empresas->AddCumplimientoUNSPSC(json_encode($codigos), json_encode($variableReal['pasaron']), $Licitacion);
        //-----------------Segundo Filtro Objetos-Experiencias --------------------------------------
        $nit = $this->filtroObjetos($id['id'],$objetos);
        $empresas->AddCumplimientoObjeto(json_encode($objetos), json_encode($nit['pasaron']), $Licitacion);
        // Se obtiene un array llamado objetos que trae todos los nit de los objetos a buscar por el solicitante
        
        //------------------------ FILTRO entre 1 y 2---------------------------------------------------
        $primeroysegundo = $this->codigosObjetos($variableReal,$nit,$id['id']);
        $empresas->AddFiltroUnoDos(json_encode($primeroysegundo['pasaron']), $Licitacion);
        //-----------------------------TERCER FILTRO-----------------------------------------
        $parteTres = $this->filtroExperiencia($primeroysegundo,$objetos,$Contratos,$codigos, $CodigosRequeridos,$PresupuestoOficial,$PorcentajeExigido, $Licitacion);
        $empresas->AddCumplimientoExperiencia($Contratos, $CodigosRequeridos, $PorcentajeExigido , $PresupuestoOficial, $parteTres['pedidos'][0][4], json_encode($parteTres['pasaron']), $Licitacion);
        //------------------------------all final section--------------------------------------------
        $ultimo = $this->filtroFinanciero($parteTres,$Endeudamiento,$Liquidez,$CoberturaInteres,$RentabilidadActivos,$RentabilidadPatrimonio,$Licitacion,$patrimonio,$capitalTrabajo);
        $empresas->AddCumplimientoFinanciero($Liquidez,$Endeudamiento,$CoberturaInteres,$RentabilidadPatrimonio,$RentabilidadActivos,json_encode($ultimo['pasaron']),$Licitacion);
        Redirecciona::LetsGoTo('evaluacion');
    }
}