<?php 
     require dirname(__FILE__).'/../home/header.php';

    $Empresa = new EmpresaModel();
    $nit = $key;
    $Empresas = $Empresa->ObtenerEmpresa($nit);
    $codigosEmpresa = $Empresa->AllCodigos($nit);
    $ExperienciaEmpresa = $Empresa->AllExperiencias($nit);
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">INFORMACION DE LA EMPRESA</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                <?php foreach ($Empresas['empresas'] as $data) { ?>
                    <div class="card-body">
                    <h5 class="card-title"><?php echo $data['nombre_empresa'] ?></h5>
                        <div class="row mt-5">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label"><strong>NIT : </strong><?php echo $data['nit'] ?></label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label"><strong>MATRICULA MERCANTIL : </strong><?php echo $data['matricula_mercantil'] ?></label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label"><strong>REGISTRO LUCRO : </strong><?php echo $data['registro_lucro'] ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label"><strong>NÚMERO DEL PROPONENTE : </strong> <?php echo $data['numero_proponente'] ?></label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label"><strong>FECHA DE LA ÚLTIMA INSCRIPCIÓN EN EL REGISTRO DE PROPONENTES: </strong> <?php echo $data['fecha_inscripcion_registro_prop']; ?></label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label"><strong>FECHA ULTIMA RENOVACION EN EL REGISTRO DE LOS PROPONENTES : </strong> <?php echo $data['fecha_ultima_renov_prop']; ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label"><strong>TAMAÑO DE EMPRESA : </strong> <?php echo $data['tamano_empresa'] ?></label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label"><strong>ORGANIZACIÓN : </strong><?php echo $data['organizacion'] ?> </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label"><strong>INDICE DE LIQUIDEZ : </strong><?php echo $data['indice_liquidez'] ?> </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label"><strong>INDICE DE ENDEUDAMIENTO : </strong> <?php echo $data['indice_endeudamento'] ?></label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label"><strong>RAZÓN DE COBERTURA DE INTERESES: </strong><?php if ($data['razon_cobertura_interes'] == 0) {echo 'INDETERMINADO';}else{echo $data['razon_cobertura_interes'];}?> </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label"><strong>RENTABILIDAD DEL PATRIMONIO : </strong><?php echo $data['rentabilidad_patrimonio'] ?> </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label"><strong>RENTABILIDAD DEL ACTIVO : </strong> <?php echo $data['rentabilidad_del_activo'] ?></label>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                        <hr>
                        
                        <div>
                            <p><button class="btn btn-danger" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Codigos de la Empresa</button></p>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                                        <div class="card card-body">
                                            <div class="table-responsive text-center">
                                                <table id="zero_config" class="table  table-bordered">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>CODIGO</th>
                                                            <th>DESCRIPCION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($codigosEmpresa['codigos'] as $code) { ?>
                                                        <tr>
                                                            <td><?php echo $code['codigo'] ?></td>
                                                            <td><?php echo $code['nombre_servicio'] ?></td>                                                            
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

                        <div>
                            <p><button class="btn btn-info"  data-toggle="collapse" data-target=".multi-collapses" aria-expanded="false" aria-controls="multiCollapseExample3 multiCollapseExample4">Experiencias de la Empresa</button></p>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapses" id="multiCollapseExample3">
                                        <div class="card card-body">
                                            <div class="table-responsive text-center">
                                                <table id="zero_config" class="table table-bordered">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>ID EXPERIENCIA</th>
                                                            <th>EXPERIENCIA No.1</th>
                                                            <th>NÚMERO CONSECUTIVO DEL CONTRATO</th>
                                                            <th>CONTRATO CELEBRADO POR</th>
                                                            <th>NOMBRE DEL CONTRATISTA</th>
                                                            <th>NOMBRE DEL CONTRATANTE</th>
                                                            <th>VALOR CONTRATO EN SMMLV</th>
                                                            <th>FECHA INICIO OBJETO</th>
                                                            <th>FECHA FINAL OBJETO</th>
                                                            <th>OBJETO</th>
                                                            <th>TIPO ACTIVIDAD</th>
                                                            <th>CODIGOS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                        foreach ($ExperienciaEmpresa['experiencias'] as $exp) { ?>
                                                        <tr>
                                                            <td><?php echo $exp['id'] ?></td>
                                                            <td><?php echo $exp['numero_experiencia'] ?></td>
                                                            <td><?php echo $exp['numero_contrato'] ?></td>                                                            
                                                            <td><?php echo $exp['contrato_celebrado_por'] ?></td>                                                            
                                                            <td><?php echo $exp['nombre_contratista'] ?></td>                                                            
                                                            <td><?php echo $exp['nombre_contratante'] ?></td>
                                                            <td><?php echo $exp['valor_contrato_smmlv'] ?></td>
                                                            <td><?php echo $exp['fecha_obj_inicio'] ?></td>
                                                            <td><?php echo $exp['fecha_obj_final'] ?></td>
                                                            <td><?php echo $exp['descripcion'] ?></td>
                                                            <td><?php echo $exp['tipo_objeto_actividad'] ?></td>
                                                            <td>
                                                                <button type="button" class="btn btn-link mt-2" data-toggle="modal" data-target="#exampleModal-<?php echo $exp['id'] ?>" data-whatever="@fat"><span style="font-size: 2rem; color: green;"><i class="mdi mdi-barcode-scan"></i></button>
                                                                <div class="modal fade" id="exampleModal-<?php echo $exp['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Codigos de la experiencia</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="table-responsive text-center">
                                                                                    <table id="zero_config" class="table table-bordered">
                                                                                        <?php $dataService = $Empresa->CodigosExperiencia($exp['id']);?>
                                                                                        <thead class="thead-dark">
                                                                                            <tr>
                                                                                                <th>CODIGO</th>
                                                                                                <th>DESCRIPCION</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php foreach ($dataService['codigosexperiencia'] as $DataCode) { ?>
                                                                                            <tr>
                                                                                                <td><?php echo $DataCode['id_servicio']; ?></td>
                                                                                                <td><?php echo $DataCode['nombre_servicio']; ?></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                            <?php } ?>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        <?php } ?>

                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require dirname(__FILE__).'/../home/footer.php'?>