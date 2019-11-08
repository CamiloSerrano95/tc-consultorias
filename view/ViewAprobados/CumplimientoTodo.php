<?php require dirname(__FILE__).'/../home/header.php'; ?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">EMPRESA QUE APROBARON LOS CUMPLIMIENTO EXIGIDOS</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mt-4">DATOS EXIGIDOS</h5>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"><strong>CODIGOS : </strong> <?php echo $key['unspsc']; ?> </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"><strong>No. CONTRATO : </strong> <?php echo $key['experiencia']['nro_contratos'];?> </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"><strong>MINIMO DE CODIGOS REQUERIDOS : </strong>  <?php echo $key['experiencia']['min_cod_req'];?> </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"><strong>PRESUPUESTO OFICIAL EXIGIDO : </strong>  <?php echo $key['experiencia']['presupuesto_exigido'];?> </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"><strong>PORCENTAJE DEL PRESUPUESTO EXIGIDO : </strong>  <?php echo $key['experiencia']['porcentaje_of_exigido'];?> </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"><strong>INDICE DE LIQUIDEZ : </strong> <?php echo $key['financiero']['empresas'][0]['ind_liquidez'];?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"><strong>INDICE DE ENDEUDAMIENTO : </strong> <?php echo $key['financiero']['empresas'][0]['endeudamiento'];?> </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"><strong>RAZON COBERTURA DE INTERES : </strong> <?php echo $key['financiero']['empresas'][0]['raz_cobertura_int'];?> </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"><strong>RENTABILIDAD SOBRE EL PATRIMONIO : </strong> <?php echo $key['financiero']['empresas'][0]['rent_patrimonio'];?> </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"><strong>RENTABILIDAD SOBRE LOS ACTIVOS : </strong> <?php echo $key['financiero']['empresas'][0]['rent_activos'];?> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label"><strong>OBJETOS : </strong> <?php for ($h=0; $h < sizeof($key['objetos']); $h++) { 
                                                echo $key['objetos'][$h];
                                                echo "<br>";
                                                echo "<br>";
                                        } ?></label>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive text-center">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NOMBRE EMPRESA</th>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    </tr>
                                    <?php for ($i=0; $i <sizeof($key['empresas']) ; $i++) {  
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo $key['empresas'][$i][0];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key['empresas'][$i][1];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key['empresas'][$i][2];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key['empresas'][$i][3];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key['empresas'][$i][4];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key['empresas'][$i][5];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key['empresas'][$i][6];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key['empresas'][$i][7];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key['empresas'][$i][8];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key['empresas'][$i][9];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key['empresas'][$i][10];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key['empresas'][$i][11];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key['empresas'][$i][12];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key['empresas'][$i][13];
                                                    echo "</td>";                                                                                                                                                         
                                                }
                                            echo "</tr>"
                                        ?>
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