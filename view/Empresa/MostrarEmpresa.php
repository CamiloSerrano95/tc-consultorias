<?php 
     require dirname(__FILE__).'/../home/header.php';

    $Empresa = new EmpresaModel();
    $Empresas = $Empresa->EveryThings();
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">EMPRESAS INSCRITAS EN EL SISTEMA</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h5 class="card-title">Basic Datatable</h5> -->
                        <div class="table-responsive text-center">
                            <table id="zero_config" class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NOMBRE</th>
                                        <th>NIT</th>
                                        <th>MATRICULA MERCANTIL</th>
                                        <th>REGISTRO LUCRO</th>
                                        <th>ORGANIZACIÓN</th>
                                        <th>TAMAÑO DE EMPRESA</th>
                                        <th>NÚMERO DEL PROPONENTE</th>
                                        <th>FECHA DE LA ÚLTIMA INSCRIPCIÓN EN EL REGISTRO DE PROPONENTES</th>
                                        <th>FECHA ULTIMA RENOVACION EN EL REGISTRO DE LOS PROPONENTES</th>
                                        <th>INDICE DE LIQUIDEZ</th>
                                        <th>INDICE DE ENDEUDAMIENTO</th>
                                        <th>RAZÓN DE COBERTURA DE INTERESES</th>
                                        <th>RENTABILIDAD DEL PATRIMONIO</th>
                                        <th>RENTABILIDAD DEL ACTIVO</th>
                                        <th>AGREGAR CODIGOS</th>
                                        <th>AGREGAR EXPERIENCIAS</th>
                                        <th>VER</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($Empresas['empresas'] as $data) { 
                                    $view = "InformacionEmpresa.php?id=".$data['nit'];
                                    $ViewCodigos = "AgregarCodigos.php?id=".$data['nit'];
                                    $viewExperiencia = "AgregarExperiencias.php?id=".$data['nit'];
                                ?>
                                    
                                    
                                    <tr>
                                        <td><?php echo $data['nombre_empresa'] ?></td>
                                        <td><?php echo $data['nit'] ?></td>                                        
                                        <td><?php echo $data['matricula_mercantil'] ?></td>                                        
                                        <td><?php echo $data['registro_lucro'] ?></td>                                        
                                        <td><?php echo $data['organizacion'] ?></td>                                        
                                        <td><?php echo $data['tamano_empresa'] ?></td>
                                        <td><?php echo $data['numero_proponente'] ?></td>                                        
                                        <td><?php echo $data['fecha_inscripcion_registro_prop'] ?></td>                                        
                                        <td><?php echo $data['fecha_ultima_renov_prop'] ?></td>                                        
                                        <td><?php echo $data['indice_liquidez'] ?></td>                                        
                                        <td><?php echo $data['indice_endeudamento'] ?></td>                                        
                                        <td><?php if ($data['razon_cobertura_interes'] == 0) {
                                                echo 'INDETERMINADO';
                                            }else{
                                                echo $data['razon_cobertura_interes'];
                                            }?>
                                        </td>                                        
                                        <td><?php echo $data['rentabilidad_patrimonio'] ?></td>                                        
                                        <td><?php echo $data['rentabilidad_del_activo'] ?></td>
                                        <td>
                                            <a href="<?php echo $ViewCodigos; ?>" class="btn btn-link"><span style="font-size: 2em; color: green;"><i class="far fa-plus-square"></i></span></a>
                                        </td>
                                        <td>
                                            <a href="<?php echo $viewExperiencia; ?>" class="btn btn-link"><span style="font-size: 2em; color: purple"><i class="fas fa-folder-open"></i></span></button>
                                        </td>
                                        <td>
                                            <a href="<?php echo $view; ?>" class="btn btn-link"><span style="font-size: 2em; color: orange;"><i class="fas fa-eye"></i></span></button>
                                        </td>
                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require dirname(__FILE__).'/../home/footer.php'?>