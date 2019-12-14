<?php 
    require dirname(__FILE__).'/../home/header.php'; 
?>

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
                        <div class="card mt-5">
                            <h5 class="card-title">EXPERIENCIA REQUERIDA</h5>
                            <div class="table-responsive text-center mt-5">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Numero de experiencias mínimas requeridas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo $key['nro_contratos'];?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card mt-5">
                            <h5 class="card-title">EMPRESAS</h5>
                            <div class="table-responsive text-center mt-5">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Empresa</th>
                                            <th>Cantidad experiencias</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i=0; $i < sizeof($key['infoAnswer']); $i++) { ?>

                                        <tr>
                                            <td>
                                                <?php echo $key['infoAnswer'][$i]['nit'] ?>
                                            </td>
                                            <td>
                                                <?php echo $key['infoAnswer'][$i]['cantidad'] ?>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <form action="<?php echo ABS_PATH." revision/freeAliance ";?>" method="POST" class="form-horizontal">
                            <div class="row mt-3">
                                <input type="hidden" name="nit" value="<?php  echo $nit; ?>">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <select class="select2 form-control custom-select mt-2" style="width: 100%; height:36px;" id="DatosSelect">
                                            <?php for ($i =0; $i < sizeof($key['infoAnswer']); $i++ ){ ?>
                                            <option value="<?php  echo $key['infoAnswer'][$i]['nit'] ?>"><?php echo $key['infoAnswer'][$i]['nit'];} ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-2">
                                    <input type="hidden" name="licitacion" value="<?php echo $key['licitacion'];?>">
                                    <button type="button" id="crearInput" class="btn btn-primary">Agregar Empresa</button>
                                </div>
                            </div>

                            <div id="joker">
                                <div class="row">
                                    <div id="inputA" class="form-group col-sm-9">
                                        <!-- input1 -->
                                    </div>
                                    <div id="inputB" class="form-group col-sm-3">
                                        <!-- input2 -->
                                    </div>
                                    <div id="erase" class="form-group col-sm-3">
                                        <!-- input2 -->
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Comparar</button>

                            <div class="card mt-5">
                                <h5 class="card-title">RESULTADO DE LA ALIANZA</h5>
                                <h5 class="card-title mt-5">DATOS REQUERIDOS</h5>
                                <div class="table-responsive text-center mt-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>INDICE DE LIQUIDEZ</td>
                                                <td>INDICE DE ENDEUDAMIENTO</td>
                                                <td>RAZON COBERTURA DE INTERES</td>
                                                <td>RENTABILIDAD SOBRE EL PATRIMONIO</td>
                                                <td>RENTABILIDAD DEL ACTIVO</td>
                                                <td>CAPITAL DE TRABAJO</td>
                                                <td>PATRIMONIO</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo $value['requeridos']['ind_liquidez'];?>
                                                </td>
                                                <td>
                                                    <?php echo $value['requeridos']['endeudamiento'];?>
                                                </td>
                                                <td>
                                                    <?php echo $value['requeridos']['raz_cobertura_int'];?>
                                                </td>
                                                <td>
                                                    <?php echo $value['requeridos']['rent_patrimonio'];?>
                                                </td>
                                                <td>
                                                    <?php echo $value['requeridos']['rent_activos'];?>
                                                </td>
                                                <td>
                                                    <?php echo $value['requeridos']['capital_trabajo'];?>
                                                </td>
                                                <td>
                                                    <?php echo $value['requeridos']['patrimonio'];?>
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="table-responsive text-center mt-5">
                                    <?php if(isset($value['requeridos'])){ if($value['resultados']['status'] == 'aprueba'){?>
                                    <div class="alert alert-success text-center mt-5" role="alert">Alianza aprobada</div>
                                    <?php }else {?>
                                    <div class="alert alert-danger text-center mt-5" role="alert">No aprobado</div>
                                    <?php }}?>
                                    <table class="table table-bordered">
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
                                                <td>
                                                    <?php echo $value['resultados']['datos'][0];?>
                                                </td>
                                                <td>
                                                    <?php echo $value['resultados']['datos'][1];?>
                                                </td>
                                                <td>
                                                    <?php echo $value['resultados']['datos'][2];?>
                                                </td>
                                                <td>
                                                    <?php echo $value['resultados']['datos'][3];?>
                                                </td>
                                                <td>
                                                    <?php echo $value['resultados']['datos'][4];?>
                                                </td>
                                                <td>
                                                    <?php echo $value['resultados']['datos'][5];?>
                                                </td>
                                                <td>
                                                    <?php echo $value['resultados']['datos'][6];?>
                                                </td>
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

<script>
    // Add button delete
    var erase = document.getElementById('erase');
    var contador = 0;
    crearInput.onclick = () => {
        var DatosSelect = document.getElementById('DatosSelect').value;
        
        var inputA = document.getElementById('inputA');
        var inputB = document.getElementById('inputB');
        var inputC = document.getElementById('inputC');
            
        var contenedor = document.getElementById('contenedor');
        var charizard = document.getElementById('charizard');
        var partes = DatosSelect.split(',');

        console.log(partes);

        var x = document.createElement('input');
        x.setAttribute("class", "form-control mt-3");
        x.setAttribute("id", "selecsito");
        x.setAttribute("id" , `eraseCode-${contador}`);
        x.setAttribute("name", "empresas[]");
        x.setAttribute("value", partes[0]);
        inputA.appendChild(x);

        var a = document.createElement('input');
        a.setAttribute("class", "form-control mt-3");
        a.setAttribute("id", "selec1");
        a.setAttribute("id" , `eraseName-${contador}`);
        a.setAttribute("name", "porcentaje[]");
        a.setAttribute("placeholder", "Asignar Porcentaje Ej: 40");
        inputB.appendChild(a);

        
        var b = document.createElement('button');
        b.innerHTML = "<span style='font-size: 1em; color: Tomato;'><i class='fas fa-trash'></i></span>";
        b.setAttribute("class", "mt-4 ml-2 btn btn-link col-sm-12 ");
        b.setAttribute("id" , `${contador}`);
        b.setAttribute("onclick", "obtenerId(this)");
        b.setAttribute("type" , "button");
        b.setAttribute("value", "Borrar");
        erase.appendChild(b);
       
        contador++;
    }

    function obtenerId(path) {
        var id = path.getAttribute("id")
        var eraseCode = document.getElementById(`eraseCode-${id}`);
        var eraseName = document.getElementById(`eraseName-${id}`);
        var eraseButton = document.getElementById(id);
        eraseCode.remove();
        eraseName.remove();
        eraseButton.remove();
    }
</script>

<?php require dirname(__FILE__).'/../home/footer.php';?>