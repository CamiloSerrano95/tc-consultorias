<?php 
    require dirname(__FILE__).'/../home/header.php';
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
                        <div>
                            <div class="table-responsive text-center">
                                <table id="zero_config" class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>NOMBRE EMPRESA</th>
                                            <th>EXPERIENCIA CUMPLIDAS</th>
                                            <th>Alianza</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i=0; $i <sizeof($key) ; $i++) {  
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo $key[$i]['nit'];
                                                    echo "</td>";
                                                    echo "<td>"; ?>
                                                        <a href="<?php echo ABS_PATH."revision/RevisionExperienciaCumple/".$key[$i]['id']."/".$value; ?>" class="btn btn-link"><span style="font-size: 3em; color: orange;"><i class="mdi mdi-certificate"></i></span></a>
                                                    <?php echo "</td>";
                                                    echo "<td>";?>
                                                        <a href="<?php echo ABS_PATH."revision/AlianzaExperiences/".$value."/".$key[$i]['id']; ?>" class="btn btn-link"><span style="font-size: 3em; color: green;"><i class="fas fa-hands-helping"></i></span></a>
                                                    <?php echo"</td>";                                                                                                                                                  
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