<?php 
    //require_once '../../Controllers/EvaluacionController/Revision.php';
    require dirname(__FILE__).'/../home/header.php';
    $instancia = new AprobadosModel();
    $variable = $instancia->obtenerLicitacionesSolas();
    echo "---------------------------------------------------->";var_dump($variable['empresas'][0]['id']);
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">CUMPLIMIENTO EXPERIENCIA</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h5 class="card-title">AlianzaEmpresas</h5> -->
                        <div class="table-responsive text-center">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Objeto Contrato</th>
                                        <th>Empresas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($variable['empresas'] as $value) {
                                            $http = ABS_PATH."revision/viewExperiences/".$value['id']; // mirar si si el metodo revisar esta en agragar en el controlador
                                            // $http = "../../Controllers/EvaluacionController/Revision.php?id=".$value['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $value['nombre']; ?></td>
                                        <td>
                                            <a href="<?php echo $http; ?>" class="btn btn-link"><span style="font-size: 2em; color: orange;"><i class="fas fa-eye"></i></span></button>                                            
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

<?php require dirname(__FILE__).'/../home/footer.php'?>