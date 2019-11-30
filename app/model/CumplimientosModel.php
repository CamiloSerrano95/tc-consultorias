<?php
    class CumplimientosModel {
        private $DataBase;

        public function __construct(){
            $connection = new Conexion();
            $this->DataBase = $connection->get_conexion();
        }
        
        public function EmpresaServicios($codigos) {
            try {
                $sql = "SELECT nit_empresa FROM servicio_empresa WHERE codigo_servicio IN (?) GROUP BY nit_empresa";
                $query = $this->DataBase->prepare($sql);
                $data = [$codigos];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
            } catch (Exception $e) {
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
        }

        public function ObtenerServicioExperiencia($experience, $service){
            try{
                $sql = "SELECT * FROM experiencia_servicio where idexperiencia = ? AND experiencia_servicio.id_servicio = ?";
                $query = $this->DataBase->prepare($sql);
                $data = [$experience, $service];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
           }catch (Exception $e){
            $response = ['status' => 0, 'empresas' => $e];
           }
           return $response; 
        }

        public function obtengoExperiencia($dato){
            try{
                $sql = "SELECT * FROM experiencias where id =?";
                $query = $this->DataBase->prepare($sql);
                $data = [$dato];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
           }catch (Exception $e){
            $response = ['status' => 0, 'empresas' => $e];
           }
           return $response; 
        }

        public function ObjetoEmpresa($idObjeto){
           //Obtener empresas mediante el id del objeto.
           try{
                $sql = "SELECT * FROM empresa, experiencias WHERE empresa.nit = experiencias.id_empresa_experiencia AND experiencias.id = ?";
                $query = $this->DataBase->prepare($sql);
                $data = [$idObjeto];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
           }catch (Exception $e){
            $response = ['status' => 0, 'empresas' => $e];
           }
           return $response;
        }

        public function ServicioEmpresa($idEmpresa){
            //obtener empresas con el servicio recibido por parametro.
            try{
                /* $sql = "SELECT COUNT(experiencia_servicio.idexperiencia) as numero_experiencias, experiencias.id_empresa_experiencia FROM experiencia_servicio, experiencias, servicio WHERE experiencia_servicio.id_servicio = servicio.codigo AND experiencia_servicio.idexperiencia = experiencias.id AND experiencias.id_empresa_experiencia IN (?) GROUP BY experiencias.id_empresa_experiencia"; */
                $sql = "SELECT COUNT(experiencia_servicio.idexperiencia) as numero_experiencias, experiencias.id_empresa_experiencia FROM experiencia_servicio, experiencias, servicio WHERE experiencia_servicio.id_servicio = servicio.codigo AND experiencia_servicio.idexperiencia = experiencias.id AND experiencias.id_empresa_experiencia = ?";
                $query = $this->DataBase->prepare($sql);
                $data = [$idEmpresa];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'CodigosExistentes' => $empresas];
            }catch (Exception $e){
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
        }

        public function PresupuestoExigido($idEmpresa){
           // obtener de las empresas filtradas 
           //SELECT experiencias.valor_contrato_smmlv FROM `experiencias`, `servicio`, `experiencia_servicio`WHERE experiencia_servicio.id_servicio = servicio.codigo AND experiencia_servicio.idexperiencia = experiencias.id AND experiencias.id_empresa_experiencia IN ('900262944-6') GROUP BY experiencias.id_empresa_experiencia
            try{
                $sql = "SELECT empresa.nit, experiencia_servicio.id_servicio FROM experiencia_servicio,experiencias, empresa WHERE experiencia_servicio.idexperiencia = experiencias.id AND empresa.nit = experiencias.id_empresa_experiencia AND experiencias.id_empresa_experiencia = ?";
                $query = $this->DataBase->prepare($sql);
                $data = [$idEmpresa];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
            }catch (Exception $e){
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
       }

        public function AddCumplimientoObjeto($objeto, $resultado, $licitacion){
            try{
                $sql = "INSERT INTO cumplimiento_objeto (objetos, result, objeto_licitacion) VALUES (?,?,?)";
                $query = $this->DataBase->prepare($sql);
                $data = [$objeto, $resultado, $licitacion];
                $query->execute($data);
                $response = ['status' => 1, 'msg' => "Datos guardados"];
            }catch (Exception $e){
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }

        public function AddCumplimientoUNSPSC($objeto, $resultado, $licitacion){
            try{
                $sql = "INSERT INTO cumplimiento_un (objetos, result, objeto_licitacion) VALUES (?,?,?)";
                $query = $this->DataBase->prepare($sql);
                $data = [$objeto, $resultado, $licitacion];
                $query->execute($data);
                $response = ['status' => 1, 'msg' => "Datos guardados"];
            }catch (Exception $e){
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }

        public function AddCumplimientoExperiencia($nrc, $minc, $pre,$por, $pres, $resultado, $licitacion){
            try{
                $sql = "INSERT INTO cumplimiento_exp (nro_contratos, min_cod_req, porcentaje_of_exigido, presupuesto_exigido, result_presupuesto, result, objeto_licitacion) VALUES (?,?,?,?,?,?,?)";
                $query = $this->DataBase->prepare($sql);
                $data = [$nrc, $minc, $pre, $por, $pres, $resultado, $licitacion];
                $query->execute($data);
                $response = ['status' => 1, 'msg' => "Datos guardados"];
            }catch (Exception $e){
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }

        public function AddCumplimientoFinanciero($ind, $endeu, $raz, $rent, $rentact, $patr, $capi, $resultado, $licitacion){
            try{
                $sql = "INSERT INTO cumplimiento_financiero (ind_liquidez,endeudamiento,raz_cobertura_int,rent_patrimonio,rent_activos,patrimonio, capital_trabajo,result, objeto_licitacion) VALUES (?,?,?,?,?,?,?,?,?)";
                $query = $this->DataBase->prepare($sql);
                $data = [$ind, $endeu, $raz, $rent, $rentact, $patr,$capi,$resultado, $licitacion];
                $query->execute($data);
                $response = ['status' => 1, 'msg' => "Datos guardados"];
            }catch (Exception $e){
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }

        public function EmpresaCodigitos($codigos) {
            try {
                $sql = "SELECT nit_empresa FROM servicio_empresa WHERE codigo_servicio = ?";
                $query = $this->DataBase->prepare($sql);
                $data = [$codigos];
                $query->execute($data);
                $empresas = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $empresas];
            } catch (Exception $e) {
                $response = ['status' => 0, 'empresas' => $e];
            }
            return $response;
        }

        public function AddFiltroUnoDos($result , $licitacion){
            try{
                $sql = "INSERT INTO uno_dos (results, objeto_licitacion) VALUES (?,?)";
                $query = $this->DataBase->prepare($sql);
                $data = [$result, $licitacion];
                $query->execute($data);
                $response = ['status' => 1, 'msg' => "empresass"];
            }catch (Exception $e){
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }
        public function AddLicitacion($objeto){
            try{
                $sql = "INSERT INTO licitacion (nombre) VALUES (?)";
                $query = $this->DataBase->prepare($sql);
                $data = [$objeto];
                $query->execute($data);
                $id = $this->DataBase->lastInsertId();
                $response = ['status' => 1, 'msg' => "Datos guardados", "id" => $id];
            }catch(Exception $e){
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }

        public function Eliminar($id){
	    	try { 
	    		$sql = "DELETE FROM licitacion WHERE id=?";
	    		$query = $this->DataBase->prepare($sql);
	    		$data = [$id];
	    		$query->execute($data);
	    		$response = ['status' => 1, 'msg' => "Dato eliminado exitosamente"];	
	    	} catch (Exception $e) {
	    		$response = ['status' => 0, 'error' => $e];
	    	}
	    	return $response;
        }

    }
?>

