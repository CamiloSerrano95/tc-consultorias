<?php require dirname(__FILE__).'/../home/header.php'; ?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">EXPERIENCIAS APROVADAS CON UNSPSC Y SMMLV</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">                        
                        <!-- <h5 class="card-title"></h5> -->
                        <div>
                            <div class="table-responsive text-center">
                                <table id="zero_config" class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>OBJETO</th>
                                            <th>VALOR CONTRATO EN SMMLV</th>
                                            <th>TIPO ACTIVIDAD</th>
                                            <th>CODIGOS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i=0; $i <sizeof($key) ; $i++) {  
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo $key[$i]['nombre'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $key[$i]['valor'];
                                                echo "</td>";           
                                                echo "<td>";
                                                    echo $key[$i]['tipoActividad'];
                                                echo "</td>";  
                                                echo "<td>";
                                                    echo $key[$i]['codigos'];
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