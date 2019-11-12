<?php 
    require dirname(__FILE__).'/../home/header.php'; 
?> 


    <script>
        function crearInput() {
            
            var DatosSelect = document.getElementById('DatosSelect').value;
        
            var contenedor = document.getElementById('contenedor');
            var charizard = document.getElementById('charizard');
            var partes = DatosSelect.split(',');

            console.log(partes);
            
            
            var x = document.createElement('input');
            x.setAttribute("class", "form-control mt-3");
            x.setAttribute("id" , "selecsito");
            /* x.setAttribute("name", "empresas[]"); */
            x.setAttribute("value", partes[0]);
            contenedor.appendChild(x);

            var a = document.createElement('input');
            a.setAttribute("class", "form-control mt-3");
            a.setAttribute("id" , "selec1");
            /* a.setAttribute("name", "porcentaje[]"); */
            a.setAttribute("placeholder", "Asignar Porcentaje Ej: 40");
            charizard.appendChild(a);
        }

    </script>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <!-- <h4 class="page-title">Clasificaciones de Bienes, Obras y Servicios </h4> -->
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="form-group row mt-5">
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nombre" id="fname" placeholder="Nombre Empresa" required>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="porcentajeEmpresa" id="fname" placeholder="Porcentaje %" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                            <input type="hidden" name="nit" value="<?php  echo $nit; ?>">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <select class="select2 form-control custom-select mt-2" style="width: 100%; height:36px;" id="DatosSelect">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-2">
                                    <button type="button" onclick="crearInput()" class="btn btn-primary">Agregar Empresa</button>
                                </div>
                            </div>
                            
                            <div id="joker">
                                <div class="row">
                                    <div id="contenedor" class="form-group col-sm-9">
                                        <!-- input1 -->
                                    </div>
                                    <div id="charizard" class="form-group col-sm-3">
                                        <!-- input2 -->
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Comparar</button>

                            <div class="card mt-5">
                                <h5 class="card-title">DATOS REQUERIDOS</h5>
                                <div class="table-responsive text-center mt-5">
                                    <table  class="table table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Indice de liquidez</th>
                                                <th>Indice de endeudamiento</th>
                                                <th>Razon de cobertura</th>
                                                <th>Rentabilidad de patrimonio</th>
                                                <th>Rentabilidad del activo</th>
                                                <th>Capital de trabajo</th>
                                                <th>Patrimonio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                             <div class="card mt-5">
                             <h5 class="card-title">RESULTADO</h5>
                                    <div class="alert alert-success text-center mt-5" role="alert" >Alianza aprobada</div>
                                <div class="table-responsive text-center mt-5">
                                    <table  class="table table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Indice de liquidez</th>
                                                <th>Indice de endeudamiento</th>
                                                <th>Razon de cobertura</th>
                                                <th>Rentabilidad de patrimonio</th>
                                                <th>Rentabilidad del activo</th>
                                                <th>Capital de trabajo</th>
                                                <th>Patrimonio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require dirname(__FILE__).'/../home/footer.php';?>