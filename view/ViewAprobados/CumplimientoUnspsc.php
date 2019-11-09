<?php 
    // require_once '../../Controllers/EvaluacionController/Revision.php';
    require dirname(__FILE__).'/../home/header.php';
    $vectorcito = $key;
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">CUMPLIMIENTO UNSPSC</h4>
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
                                        <th>Empresa</th>
                                        <th>Codigos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i=0; $i <sizeof($vectorcito) ; $i++) {  
                                            echo "<tr>";
                                                if (!($i%2)){
                                                    echo "<td>";
                                                        echo $vectorcito[$i];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $vectorcito[$i+1];
                                                    echo "</td>";
                                                }
                                            echo "</tr>";
                                        } 
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