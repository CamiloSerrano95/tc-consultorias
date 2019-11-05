<?php
    use \vista\Vista;

    class controllerevaluacion {


    public function index(){
        return Vista::crear("Cumplimientos.EvalucionCumplimientos");
    }

    public function nuevo(){
        return Vista::crear("evaluacion.create");
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
    $RentabilidadPatrimonio = $_POST['patrimonio'];
    $RentabilidadActivos = $_POST['activos'];
    $Licitacion = $_POST['licitacion'];



    // Se obtiene un array llamado codigos que trae todos los nit de los servicios a buscar por el solicitante
    $codigos = $_POST['codigos'];
    /* print_r($codigos);
    echo"<br>";
    echo"<br>"; */
    $id=$empresas->AddLicitacion($Licitacion);
    $rolo = $id['id'];
    //-------------------------Primer filtro Servicio Empresas ---------------------------------------------------
    /* $bebesita = []; */
    $prrr= [];
    $uaa = [];
    for ($i=0; $i < sizeof($codigos); $i++) { 
        $codiger = ($empresas->EmpresaCodigitos($codigos[$i]));
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
    $empresas->AddCumplimientoUNSPSC(json_encode($codigos), json_encode($variableReal), $rolo);
    //-----------------Segundo Filtro Objetos-Experiencias --------------------------------------

    // Se obtiene un array llamado objetos que trae todos los nit de los objetos a buscar por el solicitante
    $objetos = $_POST['objetos'];
    $re = implode(",", $objetos);
    $mientes =[];
    for ($i=0; $i < sizeof($objetos); $i++) { 
        $data = $empresas->ObjetoEmpresa($objetos[$i]); //filtra las empresas que contengan los objetos que se pasaron por parametros.
        array_push($mientes , $data);
    }
    //data contiene las empresas que pasaron el primer filtro (objetos).
    $nit = [];// Se genera un array vacio llamado nit
    for ($i=0; $i < sizeof($mientes); $i++) { 
        array_push($nit, $mientes[$i]['empresas'][0]['nit']);
    }

    $empresas->AddCumplimientoObjeto(json_encode($objetos), json_encode($nit), $rolo);
    //------------------------ FILTRO entre 1 y 2---------------------------------------------------
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
    $empresas->AddFiltroUnoDos(json_encode($primeroysegundo), $rolo);
    //-----------------------------TERCER FILTRO-----------------------------------------
    
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
    //var_dump($parteTres);
    $empresas->AddCumplimientoExperiencia($Contratos, $CodigosRequeridos, $PorcentajeExigido , $PresupuestoOficial, $ficticia, json_encode($parteTres), $rolo);
    //------------------------------all final section--------------------------------------------
    $auxiliar = [];
    for ($i=0; $i < sizeof($parteTres); $i++) { 
        for ($h=0; $h < sizeof($mientes); $h++) { 
            if($parteTres[$i]== $mientes[$h]['empresas'][0]['nit']){
                if($Liquidez <= $mientes[$h]['empresas'][0]['indice_liquidez'] && $Endeudamiento >= $mientes[$h]['empresas'][0]['indice_endeudamento'] && $RentabilidadPatrimonio <= $mientes[$h]['empresas'][0]['rentabilidad_patrimonio'] && $RentabilidadActivos <= $mientes[$h]['empresas'][0]['rentabilidad_del_activo']){
                    if($CoberturaInteres >= 0 && $CoberturaInteres <= $mientes[$h]['empresas'][0]['razon_cobertura_interes']){
                        array_push($auxiliar, $mientes[$h]['empresas'][0]['nit']);
                    }
                }    
            }
        }
    }
    //var_dump($auxiliar);
    $empresas->AddCumplimientoFinanciero($Liquidez,$Endeudamiento,$CoberturaInteres,$RentabilidadPatrimonio,$RentabilidadActivos,json_encode($auxiliar), $rolo);
    Redirecciona::LetsGoTo('evaluacion');
    }

    public function editar($id) {
        echo $id;
    }

    public function eliminar($id) {
        echo $id;
    }

    }