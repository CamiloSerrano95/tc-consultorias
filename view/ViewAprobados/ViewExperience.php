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
                                            <th>TIPO ACTIVIDAD</th>
                                            <th>Nro EXPERIENCIA</th>
                                            <th>Nro CONSECUTIVO DEL CONTRATO</th>
                                            <th>CONTRATO CELEBRADO POR</th>
                                            <th>NOMBRE CONTRATISTA</th>
                                            <th>NOMBRE DEL CONTRATANTE</th>
                                            <th>FECHA INICIO OBJETO</th>
                                            <th>FECHA FINAL OBJETO</th>
                                            <th>VALOR CONTRATO EN SMMLV</th>
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
                                                    echo $key[$i]['valor']['tipo_objeto_actividad'];
                                                echo "</td>";  
                                                echo "<td>";
                                                    echo $key[$i]['valor']['numero_experiencia'];
                                                echo "</td>";  
                                                echo "<td>";
                                                    echo $key[$i]['valor']['numero_contrato'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $key[$i]['valor']['contrato_celebrado_por'];
                                                echo "</td>";  echo "<td>";
                                                    echo $key[$i]['valor']['nombre_contratista'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $key[$i]['valor']['nombre_contratante'];
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $key[$i]['valor']['fecha_obj_inicio'];
                                                echo "</td>";  
                                                echo "<td>";
                                                    echo $key[$i]['valor']['fecha_obj_final'];
                                                echo "</td>";  
                                                echo "<td>";
                                                    echo $key[$i]['valor']['valor_contrato_smmlv'];
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