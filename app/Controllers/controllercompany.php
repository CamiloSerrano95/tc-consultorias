<?php 
use \vista\Vista;

class controllercompany {

    public function index(){
        return Vista::crear("Empresa.MostrarEmpresa");
    }

    public function nuevo(){
        return Vista::crear("Empresa.AgregarEmpresa");
    }

    public function agregar() {

    $Empresa = new EmpresaModel();

    $Empresa->setNombreEmpresa(strtoupper($_POST['nombre']));
    $Empresa->setNit(strtoupper($_POST['nit']));
    $Empresa->setFechaInscripcionProponente($_POST['fecha_registro']);
    $Empresa->setFechaUltimaRenovacionProponente($_POST['fecha_renovacion']);
    $Empresa->setIndiceLiquidez($_POST['indice_liquidez']);
    $Empresa->setIndiceEndeudamiento($_POST['indice_endeudamiento']);
    $Empresa->setRazonCoberturaInteres($_POST['cobertura_interes']);    
    $Empresa->setRentabilidadPatrimonio($_POST['rentabilidad_patrimonio']);
    $Empresa->setRentabilidadActivo($_POST['rentabilidad_activo']);

    $Capital = (($_POST['activo_corriente']) - ($_POST['pasivo_corriente']));
    

        if ($_POST['matricula'] === "") {
            $Empresa->setMatriculaMercantil(strtoupper("no registra"));
        }else{
        $Empresa->setMatriculaMercantil(strtoupper($_POST['matricula']));    
        }

        if ($_POST['lucro'] === "") {
            $Empresa->setRegistroLucro(strtoupper("no registra"));
        }else{
            $Empresa->setRegistroLucro(strtoupper($_POST['lucro']));    
        }

        if ($_POST['proponente'] === "") {
            $Empresa->setNumeroProponente(strtoupper("no registra"));
        }else{
            $Empresa->setNumeroProponente(strtoupper($_POST['proponente']));    
        }

        if ($_POST['organizacion'] === "") {
            $Empresa->setOrganizacion(strtoupper("no registra"));
        }else{
            $Empresa->setOrganizacion(strtoupper($_POST['organizacion']));    
        }

        if ($_POST['tam_empresa'] === "") {
            $Empresa->setTamañoEmpresa(strtoupper("no registra"));
        }else{
            $Empresa->setTamañoEmpresa(strtoupper($_POST['tam_empresa']));    
        }

        if ($_POST['patrimonio'] === 0) {
            $Empresa->setPatrimonio(strtoupper("no registra"));
        }else{
            $Empresa->setPatrimonio($_POST['patrimonio']);  
        }

        if ($_POST['activo_corriente'] === 0) {
            $Empresa->setActivoCorriente(strtoupper("no registra"));
        }else{
            $Empresa->setActivoCorriente($_POST['activo_corriente']);
        }

        if ($_POST['pasivo_corriente'] === 0) {
            $Empresa->setPasivoCorriente(strtoupper("no registra"));
        }else{
            $Empresa->setPasivoCorriente($_POST['pasivo_corriente']);
        }

        if ($Capital == 0) {
            $Empresa->setCapitaldeTrabajo(strtoupper("no registra"));
        }else{
            $Empresa->setCapitaldeTrabajo($Capital);
        }

        $data = $Empresa->RegistroEmpresa();

        if ($data['status'] == 1) {
            Redirecciona::LetsGoTo('empresa');
            /* header('Location: ../../View/Empresa/AgregarEmpresa.php');  */
        } else {
            echo $data['error'];
        }
    
    }

    public function editar($id) {
        $Empresita = new EmpresaModel();
        $abajito = $Empresita->info($id);
        return Vista::crear("Empresa.EditCompany",$abajito['empresa']);
        
    }

    public function Update(){
        $Empresita = new EmpresaModel();
        $id = $_POST['id'];
        $Empresita->setFechaUltimaRenovacionProponente($_POST['fecha']);
        $Empresita->setIndiceLiquidez($_POST['indice_liquidez']);
        $Empresita->setIndiceEndeudamiento($_POST['indice_endeudamiento']);
        $Empresita->setRazonCoberturaInteres($_POST['cobertura_interes']);
        $Empresita->setRentabilidadPatrimonio($_POST['rentabilidad_patrimonio']);
        $Empresita->setRentabilidadActivo($_POST['rentabilidad_activo']);
        $Empresita->setPatrimonio($_POST['patrimonio']);
        $Empresita->setActivoCorriente($_POST['activo_corriente']);
        $Empresita->setPasivoCorriente($_POST['pasivo_corriente']);

        $Capital = (($_POST['activo_corriente']) - ($_POST['pasivo_corriente']));

        $Empresita->setCapitaldeTrabajo($Capital);

        $Empresita->Actualizar($id);
    }

    public function eliminar($id) {
        echo $id;
    }
}