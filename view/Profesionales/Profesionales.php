<?php 
    require dirname(__FILE__).'/../home/header.php';
    // require '../../Models/ServiciosModel.php';

    $Profesional = new ProfessionalsModel();
    $Profesionales = $Profesional->EveryThings();

?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Profesionales</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="table-responsive text-center mt-5">
                <table id="zero_config" class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>NOMBRE</th>
                            <th>CEDULA</th>
                            <th>PROFESION</th>
                            <th>N° DE TARJETA</th>
                            <th>FECHA EXPEDICION</th>
                            <th>FECHA DE GRADO</th>
                            <th>ESPECIALIZACION</th>
                            <th>FECHA GRADO</th>
                            <th>MAESTRIA/MAGISTER</th>
                            <th>FECHA GRADO</th>
                            <th>DOCTORADO</th>
                            <th>FECHA GRADO</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($Profesionales['profesionales'] as $Data) { ?>
                        <tr>
                            <td><?php echo $Data['nombre'] ?></td>
                            <td><?php echo $Data['cedula'] ?></td>
                            <td><?php echo $Data['profesion'] ?></td>
                            <td><?php echo $Data['num_tarjeta'] ?></td>
                            <td><?php echo $Data['fecha_expedicion'] ?></td>
                            <td><?php echo $Data['fecha'] ?></td>
                            <td><?php echo $Data['especializacion'] ?></td>
                            <td><?php echo $Data['fecha_especializacion'] ?></td>
                            <td><?php echo $Data['maestria'] ?></td>
                            <td><?php echo $Data['fecha_maestria'] ?></td>
                            <td><?php echo $Data['doctorado'] ?></td>
                            <td><?php echo $Data['fecha_doctorado'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require dirname(__FILE__).'/../home/footer.php';?>