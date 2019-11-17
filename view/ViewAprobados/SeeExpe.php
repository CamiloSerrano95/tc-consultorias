<?php require dirname(__FILE__).'/../home/header.php'; ?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">INFORMACION EXPERIENCIA APROBADA</h4>
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
                                            <th>NOMBRE EMPRESA</th>
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
                                        <?php for ($i=0; $i <sizeof($key) ; $i++) {  
                                            echo "<tr>";
                                                    echo "<td>";
                                                        echo $key[$i][0];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key[$i][1];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key[$i][2];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key[$i][3];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key[$i][4];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key[$i][5];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key[$i][6];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key[$i][7];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key[$i][8];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key[$i][9];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key[$i][10];
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