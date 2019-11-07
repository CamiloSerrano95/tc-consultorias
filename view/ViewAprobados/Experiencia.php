<?php 
    require dirname(__FILE__).'/../home/header.php';
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">INFORMACION DE LA EMPRESA</h4>
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
                                            <th>NUMERO EXPERIENCIA</th>
                                            <th>NUMERO CONTRATO</th>
                                            <th>CONTRATO CELEBRADO POR</th>
                                            <th>NOMBRE CONTRATISTA</th>
                                            <th>NOMBRE CONTRATANTE</th>
                                            <th>VALOR CONTRATO SMMLV</th>
                                            <th>FECHA OBJETO INICIO</th>
                                            <th>FECHA OBJETO FINAL</th>
                                            <th>OBJETO</th>
                                            <th>TIPO DE ACTIVIDAD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i=0; $i <sizeof($key) ; $i++) {  
                                            echo "<tr>";
                                                echo "<td>";
                                                    echo $key[$i]['nameEmpresa'];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key[$i]['experiencia'][0];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key[$i]['experiencia'][1];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key[$i]['experiencia'][2];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key[$i]['experiencia'][3];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key[$i]['experiencia'][4];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key[$i]['experiencia'][5];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key[$i]['experiencia'][6];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key[$i]['experiencia'][7];
                                                    echo "</td>";                                                                                         
                                                    echo "<td>";
                                                        echo $key[$i]['experiencia'][8];
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $key[$i]['experiencia'][9];
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