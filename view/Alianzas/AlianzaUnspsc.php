<?php 
    require dirname(__FILE__).'/../home/header.php'; 
    // require_once '../../Models/EmpresaModel.php';

    $Empresa = new EmpresaModel();
    
    $Empresas = $Empresa->EveryThings();
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
            x.setAttribute("name" , "codigos[]");
            x.setAttribute("value", partes[0]);
            contenedor.appendChild(x);

            var a = document.createElement('input');
            a.setAttribute("class", "form-control mt-3");
            a.setAttribute("id" , "selec1");
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
                        <form action="#" method="POST" class="form-horizontal">
                            <div class="row mt-3">
                            <input type="hidden" name="nit" value="<?php  echo $nit; ?>">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <select class="select2 form-control custom-select mt-2" style="width: 100%; height:36px;" id="DatosSelect">
                                        <?php  foreach($Empresas['empresas'] as $data) { ?>
                                            <option value="<?php echo $data['nit']." ".$data['nombre_empresa'];  ?>"><?php echo $data['nombre_empresa'];?></option>
                                        <?php } ?>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require dirname(__FILE__).'/../home/header.php';?>