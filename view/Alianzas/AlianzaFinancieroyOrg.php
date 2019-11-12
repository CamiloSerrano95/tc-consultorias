<?php 
    require dirname(__FILE__).'/../home/header.php'; 
    $data ="";
    if(isset($key['datos'])){
        $data = $key['aprobaron'];
        $var = $key['nombre'];
        //$licit = $key['datos'][7]['licitacion'];
    }else{
        $var = $key['nombre'];
        $data = $key['aprobaron'];
        //$licit = $key['licitacion'];
    }
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
            x.setAttribute("name", "empresas[]");
            x.setAttribute("value", partes[0]);
            contenedor.appendChild(x);

            var a = document.createElement('input');
            a.setAttribute("class", "form-control mt-3");
            a.setAttribute("id" , "selec1");
            a.setAttribute("name", "porcentaje[]");
            a.setAttribute("placeholder", "Asignar Porcentaje Ej: 40");
            charizard.appendChild(a);
        }

        function EliminarInput (id,od) {
        
            var x = document.getElementById(id);
            var y = document.getElementById(od);
            if (!x){
                alert("elemento no definido");
            }else{
                x.parentNode.removeChild(x);
                y.parentNode.removeChild(y);
            }
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
                        <form action="<?php echo ABS_PATH."revision/alianzaUnsExperiencia";?>" method="POST" class="form-horizontal">
                            <div class="form-group row mt-5">
                                <div class="col-sm-10">
                                    <input type="text" value ="<?php echo $var; ?>" class="form-control" name="nombre" id="fname" placeholder="Nombre Empresa" required>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="porcentajeEmpresa" id="fname" placeholder="Porcentaje %" required>
                                    <input type="hidden" name="licitacion" value="<?php echo $licit; ?>">
                                </div>
                            </div>
                            <div class="row mt-3">
                            <input type="hidden" name="nit" value="<?php  echo $nit; ?>">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <select class="select2 form-control custom-select mt-2" style="width: 100%; height:36px;" id="DatosSelect">
                                            <?php for ($i =0; $i < sizeof($data); $i++ ){ ?>
                                            <option value="<?php  echo $data[$i][0]; ?>"><?php echo $data[$i][0];} ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-2">
                                    <button type="button" onclick="crearInput()" class="btn btn-primary">Agregar Empresa</button>
                                    <button type="button" onclick="EliminarInput ('selec1','selecsito')" class="btn btn-primary">Eliminar Empresa</button>
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
                            
                            <?php if(isset($key['status'])){ if($key['status'] == 'aprueba'){?>
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
                                            <td><?php echo $key['financiero'][0];?></td>
                                            <td><?php echo $key['financiero'][1];?></td>
                                            <td><?php echo $key['financiero'][2];?></td>
                                            <td><?php echo $key['financiero'][3];?></td>
                                            <td><?php echo $key['financiero'][4];?></td>
                                            <td><?php echo $key['financiero'][5];?></td>
                                            <td><?php echo $key['financiero'][6];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                             <div class="card mt-5">
                             <h5 class="card-title">RESULTADO</h5>                                 
                                    <div class="alert alert-success text-center mt-5" role="alert" >Alianza aprobada</div>
                                 <?php }?>
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
                                                <td><?php echo $key['datos'][0];?></td>
                                                <td><?php echo $key['datos'][1];?></td>
                                                <td><?php echo $key['datos'][2];?></td>
                                                <td><?php echo $key['datos'][3];?></td>
                                                <td><?php echo $key['datos'][4];?></td>
                                                <td><?php echo $key['datos'][5];?></td>
                                                <td><?php echo $key['datos'][6];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                 <?php }?>
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