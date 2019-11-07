<?php 
    // require_once '../../Controllers/EvaluacionController/Revision.php';
    require dirname(__FILE__).'/../home/header.php';
    $vectorcito = $key;
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">CUMPLIMENTO UNSPSCS Y EXPERIENCIA</h4>
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
                                        <th>No. Contratos</th>
                                        <th>Minimo de codigos Requeridos</th>
                                        <th>Presupuesto oficial exigido en SMMLV</th>
                                        <th>Porcentaje de presupuesto exigido</th>
                                        <th>Total de presupuesto exigido</th>
                                        <th>Cumplimiento Experiencia</th>
                                        <th>Alianza</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php for ($i=0; $i <sizeof($vectorcito) ; $i++) {  
                                        echo "<tr>";
                                                echo "<td>";
                                                    echo $vectorcito[$i][0];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $vectorcito[$i][1];
                                                echo "</td>";                                            
                                                echo "<td>";
                                                echo $vectorcito[$i][2];
                                                echo "</td>";
                                                echo "<td>";
                                                echo $vectorcito[$i][3];
                                                echo "</td>";
                                                echo "<td>";
                                                echo $vectorcito[$i][4];
                                                echo "</td>";
                                                echo "<td>";
                                                echo $vectorcito[$i][5];
                                                echo "</td>"; 
                                                echo "<td>";
                                                echo $vectorcito[$i][6];
                                                echo "</td>";                                             
                                                echo "<td>";
                                                ?>                                            
                                                <a href="<?php echo ABS_PATH."revision/viewExperiences/".$vectorcito[$i][8];?>" class="btn btn-link"><span style="font-size: 3em; color: orange;"><i class="mdi mdi-certificate"></i></span></a>
                                                <td>
                                                    <a href="" class="btn btn-link"><span style="font-size: 3em; color: green;"><i class="fas fa-hands-helping"></i></span></a>
                                                </td>
                                                <?php echo "</td>";                                                                                            
                                            
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