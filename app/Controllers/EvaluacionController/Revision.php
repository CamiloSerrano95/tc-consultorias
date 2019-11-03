<?php
    require_once '../../Models/AprobadosModel.php';
    $empresas = new AprobadosModel();
    $id = $_GET['id'];


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
    return($vectorcito);

    
?>