<?php 
    // require_once '../../Controllers/EvaluacionController/Revision.php';
    require dirname(__FILE__).'/../home/header.php';
    $vectorcito = $key['datos'];
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
                                        <th>Alianza</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i=0; $i <sizeof($vectorcito[0]) / 3 ; $i++) {  
                                            echo "<tr>";
                                                if (!($i%2)){
                                                    echo "<td>";
                                                        echo $vectorcito[$i]['nombre'];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $vectorcito[$i]['codigos'];
                                                    echo "</td>";
                                                    echo "<td>";?>
                                                        <a href="<?php echo ABS_PATH."revision/AlianzaCodigos/".$key['id']."/".$vectorcito[$i]['idEmpresa']; ?>" class="btn btn-link"><span style="font-size: 3em; color: green;"><i class="fas fa-hands-helping"></i></span></a>
                                                    <?php echo"</td>";
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