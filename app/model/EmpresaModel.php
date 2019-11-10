<?php
    
    class EmpresaModel {
        
        private $nombre_empresa;
        private $nit;
        private $matricula_mercantil;
        private $registro_lucro;
        private $organizacion;
        private $tamano_empresa;
        private $numero_proponente;
        private $fecha_inscripcion_registro_prop;
        private $fecha_ultima_renov_prop;
        private $indice_liquidez;
        private $indice_endeudamiento;
        private $razon_cobertura_interes;
        private $rentabilidad_patrimonio;
        private $rentabilidad_del_activo;
        private $codigo_servicio;
        private $experiencia;
        private $patrimonio;
        private $activo_corriente;
        private $pasivo_corriente;
        private $capital_de_trabajo;
        private $DataBase;
        private $Table = 'empresa';


        public function __construct(){
            $this->nombre_empresa = "";
            $this->nit = "";
            $this->matricula_mercantil = "";
            $this->registro_lucro = "";
            $this->organizacion="";
            $this->tamano_empresa="";
            $this->numero_proponente="";
            $this->fecha_inscripcion_registro_prop="";
            $this->fecha_ultima_renov_prop="";
            $this->indice_liquidez="";
            $this->indice_endeudamiento="";
            $this->razon_cobertura_interes="";
            $this->rentabilidad_patrimonio="";
            $this->rentabilidad_del_activo="";
            $this->codigo_servicio ="";
            $this->experiencia = "";
            $this->nitempresa = "";
            $this->patrimonio="";
            $this->activo_corriente="";
            $this->pasivo_corriente="";
            $this->capital_de_trabajo="";
            $connection = new Conexion();
            $this->DataBase = $connection->get_conexion();
        }

        /* ---------------------------------SET----------------------------------- */

        public function setNombreEmpresa ($nombre_empresa) {
            $this->nombre_empresa = $nombre_empresa;
        }

        public function setNit ($nit) {
            $this->nit = $nit;
        }

        public function setMatriculaMercantil ($matricula_mercantil) {
            $this->matricula_mercantil = $matricula_mercantil;
        }

        public function setRegistroLucro ($registro_lucro) {
            $this->registro_lucro = $registro_lucro;
        }

        public function setOrganizacion ($organizacion) {
            $this->organizacion = $organizacion;
        }

        public function setTamañoEmpresa ($tamano_empresa) {
            $this->tamano_empresa = $tamano_empresa;
        }

        public function setNumeroProponente ($numero_proponente) {
            $this->numero_proponente = $numero_proponente;
        }

        public function setFechaInscripcionProponente ($fecha_inscripcion_registro_prop) {
            $this->fecha_inscripcion_registro_prop = $fecha_inscripcion_registro_prop;
        }

        public function setFechaUltimaRenovacionProponente ($fecha_ultima_renov_prop) {
            $this->fecha_ultima_renov_prop = $fecha_ultima_renov_prop;
        }

        public function setIndiceLiquidez ($indice_liquidez) {
            $this->indice_liquidez = $indice_liquidez;
        }

        public function setIndiceEndeudamiento ($indice_endeudamiento) {
            $this->indice_endeudamiento = $indice_endeudamiento;
        }

        public function setRazonCoberturaInteres ($razon_cobertura_interes) {
            $this->razon_cobertura_interes = $razon_cobertura_interes;
        }

        public function setRentabilidadPatrimonio ($rentabilidad_patrimonio) {
            $this->rentabilidad_patrimonio = $rentabilidad_patrimonio;
        }

        public function setRentabilidadActivo ($rentabilidad_del_activo) {
            $this->rentabilidad_del_activo = $rentabilidad_del_activo;
        }

        public function setExperiencia ($experiencia) {
            $this->experiencia = $experiencia;
        }

        public function setPatrimonio ($patrimonio) {
            $this->patrimonio = $patrimonio;
        }

        public function setActivoCorriente ($activo_corriente) {
            $this->activo_corriente = $activo_corriente;
        }

        public function setPasivoCorriente ($pasivo_corriente) {
            $this->pasivo_corriente = $pasivo_corriente;
        }

        public function setCapitaldeTrabajo ($capital_de_trabajo) {
            $this->capital_de_trabajo = $capital_de_trabajo;
        }


        /* ---------------------------------GET----------------------------------- */

        public function getNombreEmpresa () {
            return $this->nombre_empresa;
        }

        public function getNit () {
            return $this->nit;
        }

        public function getMatriculaMercantil () {
            return $this->matricula_mercantil;
        }

        public function getRegistroLucro () {
            return $this->registro_lucro;
        }

        public function getOrganizacion () {
            return $this->organizacion;
        }

        public function getTamañoEmpresa () {
            return $this->tamano_empresa;
        }

        public function getNumeroProponente () {
            return $this->numero_proponente;
        }

        public function getFechaInscripcionProponente () {
            return $this->fecha_inscripcion_registro_prop;
        }

        public function getFechaUltimaRenovacionProponente () {
            return $this->fecha_ultima_renov_prop;
        }

        public function getIndiceLiquidez () {
            return $this->indice_liquidez;
        }

        public function getIndiceEndeudamiento () {
            return $this->indice_endeudamiento;
        }

        public function getRazonCoberturaInteres () {
            return $this->razon_cobertura_interes;
        }

        public function getRentabilidadPatrimonio () {
            return $this->rentabilidad_patrimonio;
        }

        public function getRentabilidadActivo () {
            return $this->rentabilidad_del_activo;
        }

        public function getExperiencia () {
            return $this->experiencia;
        }

        public function getPatrimonio () {
            return $this->patrimonio;
        }

        public function getActivoCorriente () {
            return $this->activo_corriente;
        }

        public function getPasivoCorriente () {
            return $this->pasivo_corriente;
        }

        public function getCapitaldeTrabajo () {
            return $this->capital_de_trabajo;
        }

        public function RegistroEmpresa () {
            try {
                $sql = "INSERT INTO $this->Table (nombre_empresa, nit, matricula_mercantil, registro_lucro, organizacion, tamano_empresa, numero_proponente, fecha_inscripcion_registro_prop, fecha_ultima_renov_prop, indice_liquidez, indice_endeudamento, razon_cobertura_interes, rentabilidad_patrimonio, rentabilidad_del_activo, activo_corriente, pasivo_corriente, capital_de_trabajo, patrimonio) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $query = $this->DataBase->prepare($sql);
                $data = [$this->getNombreEmpresa(),$this->getNit(),$this->getMatriculaMercantil(),$this->getRegistroLucro(), $this->getOrganizacion(), $this->getTamañoEmpresa(), $this->getNumeroProponente(), $this->getFechaInscripcionProponente(),$this->getFechaUltimaRenovacionProponente(),$this->getIndiceLiquidez(), $this->getIndiceEndeudamiento(), $this->getRazonCoberturaInteres(), $this->getRentabilidadPatrimonio(), $this->getRentabilidadActivo(),$this->getActivoCorriente(), $this->getPasivoCorriente(), $this->getCapitaldeTrabajo(), $this->getPatrimonio()];
                $query->execute($data);
                $response = ['status' => 1, 'msg' => "Usuario guardado exitosamente"];
            } catch (Exception $e) {
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }

        public function EveryThings () {
            try {
                $sql = "SELECT * FROM $this->Table";
                $query = $this->DataBase->prepare($sql);
                $query->execute();
                $data = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $data];
            } catch (Exception $e) {
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }

        public function ObtenerEmpresa($nit) {
            try {
                $sql = "SELECT * FROM empresa WHERE nit = ?";
                $query = $this->DataBase->prepare($sql);
                $data = [$nit];
                $query->execute($data);
                $infoempresa = $query->fetchAll();
                $response = ['status' => 1, 'empresas' => $infoempresa];
            } catch (Exception $e) {
                $response = ['status' => 0, 'Error' => $e];
            }
            return $response;
        }

        public function ObtenerServicios () {
            try {
                $sql = "SELECT * FROM servicio";
                $query = $this->DataBase->prepare($sql);
                $query->execute();
                $data = $query->fetchAll();
                $response = ['status' => 1, 'servicios' => $data];
            } catch (Exception $e) {
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }

        public function RegistroCodigos ($codigos) {
                try {
                $sql = "INSERT INTO servicio_empresa (nit_empresa, codigo_servicio) VALUES (?,?)";
                $query = $this->DataBase->prepare($sql);            
                $data = [$this->getNit(), $codigos];
                $query->execute($data);
                $response = ['status' => 1, 'msg' => "codigo guardado exitosamente"];
            } catch (Exception $e) {
                $response = ['status' => 0, 'msg' => $e];
            }
            return $response;
        }

        public function AllCodigos ($nit) {
            try {
                $sql = "SELECT servicio.* FROM servicio, servicio_empresa WHERE servicio_empresa.nit_empresa = ? AND servicio_empresa.codigo_servicio = servicio.codigo";
                $query = $this->DataBase->prepare($sql);
                $data = [$nit];
                $query->execute($data);
                $infoempresa = $query->fetchAll();
                $response = ['status' => 1, 'codigos' => $infoempresa];
            } catch (Exception $e) {
                $response = ['status' => 0, 'Error' => $e];
            }
            return $response;
        }

        public function AllExperiencias ($nit) {
            
            try {
                /* $sql = "SELECT experiencias.* FROM experiencias, empresa WHERE experiencias.id_empresa_experiencia = empresa.nit AND experiencias.id_empresa_experiencia = ?"; */
                $sql = "SELECT experiencias.*  FROM experiencias, empresa WHERE experiencias.id_empresa_experiencia = empresa.nit AND experiencias.id_empresa_experiencia = ? ";
                $query = $this->DataBase->prepare($sql);
                $data = [$nit];
                $query->execute($data);
                $infoexperiencia = $query->fetchAll();
                $response = ['status' => 1, 'experiencias' => $infoexperiencia];
            } catch (Exception $e) {
                $response = ['status' => 0, 'Error' => $e];
            }
            return $response;
        }

        public function CodigosExperiencia ($id) {
            try {
                $sql = "SELECT experiencia_servicio.id_servicio, servicio.nombre_servicio FROM experiencia_servicio, servicio WHERE experiencia_servicio.idexperiencia= ? AND experiencia_servicio.id_servicio=servicio.codigo";
                $query = $this->DataBase->prepare($sql);
                $data = [$id];
                $query->execute($data);
                $infoexperiencia = $query->fetchAll();
                $response = ['status' => 1, 'codigosexperiencia' => $infoexperiencia];
            } catch (Exception $e) {
                $response = ['status' => 0, 'Error' => $e];
            }
            return $response;
        }

        public function ObjetosExperiencia () {
                try {
                $sql = "SELECT * FROM objetos";
                $query = $this->DataBase->prepare($sql);
                $query->execute();
                $data = $query->fetchAll();
                $response = ['status' => 1, 'objetos' => $data];
            } catch (Exception $e) {
                $response = ['status' => 0, 'error' => $e];
            }
            return $response;
        }

        public function info($id){
	    	try {
	    		$sql = "SELECT * FROM empresa WHERE nit=?";
	    		$query = $this->DataBase->prepare($sql);
	    		$data = [$id];
	    		$query->execute($data);
	    		$infousuario = $query->fetch();
	    		$response = ['status' => 1, 'empresa' => $infousuario];
	    	} catch (Exception $e) {
				$response = ['status' => 0, 'error' => $e];	    		
	    	}
	    	return $response;
	    }

	    public function Actualizar($id){
	    	try {
	    		$sql = "UPDATE empresa SET fecha_ultima_renov_prop=?, indice_liquidez=?, indice_endeudamento=?, razon_cobertura_interes=?, rentabilidad_patrimonio=?, rentabilidad_del_activo=?, activo_corriente=?, pasivo_corriente=?, patrimonio=?, capital_de_trabajo=? WHERE nit=?";
	    		$query = $this->DataBase->prepare($sql);
	    		$data = [$this->getNombres(), $this->getApellidos(), $this->getCedula(), $this->getCorreo(), $this->getRol(), $this->getEstado(), $id];
	    		$query->execute($data);
	    		$response = ['status' => 1, 'msg' => "empresa actulizada correctamente"];
	    	} catch (Exception $e) {
	    		$response = ['status' => 0, 'error' => $e];	   
	    	}
	    	return $response;
        }
    }
?>