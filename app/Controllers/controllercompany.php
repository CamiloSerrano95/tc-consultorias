<?php 
use \vista\Vista;

class ControllerCompany {

    public function index(){
        return Vista::crear("inicio.index");
    }

    public function nuevo(){
        return Vista::crear("company.create");
    }

    public function agregar() {

    $Empresa = new CompanyModel();

    $Empresa->setNombreEmpresa(strtoupper($_POST['nombre']));
    $Empresa->setNit(strtoupper($_POST['nit']));
    $Empresa->setFechaInscripcionProponente($_POST['fecha_registro']);
    $Empresa->setFechaUltimaRenovacionProponente($_POST['fecha_renovacion']);
    $Empresa->setIndiceLiquidez($_POST['indice_liquidez']);
    $Empresa->setIndiceEndeudamiento($_POST['indice_endeudamiento']);
    $Empresa->setRazonCoberturaInteres($_POST['cobertura_interes']);    
    $Empresa->setRentabilidadPatrimonio($_POST['rentabilidad_patrimonio']);
    $Empresa->setRentabilidadActivo($_POST['rentabilidad_activo']);


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




        $data = $Empresa->RegistroEmpresa();

        if ($data['status'] == 1) {
            header('Location: ../../View/Empresa/AgregarEmpresa.php'); 
        } else {
            echo "Error en el Servidor";
        }
    
    }

    public function editar($id) {
        echo $id;
    }

    public function eliminar($id) {
        echo $id;
    }
}