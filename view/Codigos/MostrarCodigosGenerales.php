<?php 
    require '../Home/Header.html';  
    require '../../Models/ServiciosModel.php';

    $Servicio = new ServicioModel();
    $Servicios = $Servicio->EveryThings();

    
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <!-- <h4 class="page-title">Form Wizard</h4> -->
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="table-responsive text-center mt-5">
                <table id="zero_config" class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Codigos</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($Servicios['servicios'] as $Data) { ?>
                        <tr>
                            <td><?php echo $Data['codigo'] ?></td>
                            <td><?php echo $Data['nombre_servicio'] ?></td>                             
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require '../Home/Footer.html'; ?>