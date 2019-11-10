<?php 
     //require_once '../../Models/EmpresaModel.php'
    require dirname(__FILE__).'/../home/header.php';

    $Empresa = new EmpresaModel();    
    $Empresas = $Empresa->ObtenerEmpresa($key);
    $servicio = $Empresa->ObtenerServicios();
?>
    
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Clasificaciones de Bienes, Obras y Servicios </h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <?php foreach ($Empresas['empresas'] as $data) { ?>
                        <h5 class="card-title"><strong><?php echo $data['nombre_empresa'] ?></strong></h5>
                    <?php } ?>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo ABS_PATH."mostrarCodigos/agregar"?>"
                            
                              method="POST" class="form-horizontal">
                            <div class="row mt-3">
                            <input type="hidden" name="nit" value="<?php  echo $key; ?>">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select class="select2 form-control custom-select mt-2" style="width: 100%; height:36px;" id="DatosSelect">
                                        <?php  foreach($servicio['servicios'] as $data) { ?>
                                            <option value="<?php echo $data['codigo']."-".$data['nombre_servicio'];  ?>"><?php echo $data['codigo']." - ".$data['nombre_servicio'];?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-2">
                                    <button type="button" id="crearInput" class="btn btn-primary">Agregar Codigo</button>
                                </div>
                            </div>
                            <div id="joker">
                                <div class="row">
                                    <div id="contenedor" class="form-group col-sm-3">
                                        <!-- input1 -->
                                    </div>
                                    <div id="charizard" class="form-group col-sm-6">
                                        <!-- input2 -->
                                    </div>
                                    <div id="erase" class="form-group col-sm-3">
                                        <!-- button -->
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Codigos</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    var crearInput = document.getElementById('crearInput');
    var obtener = document.getElementById('obtener');
    var erase = document.getElementById('erase');
    var contador = 0;
        
    crearInput.onclick = () => {
        var DatosSelect = document.getElementById('DatosSelect').value;
        var contenedor = document.getElementById('contenedor');
        var charizard = document.getElementById('charizard');
        var partes = DatosSelect.split('-');
        
        var x = document.createElement('input');
        x.setAttribute("class", "form-control mt-3");
        x.setAttribute("id" , `eraseCode-${contador}`);
        x.setAttribute("name" , "codigos[]");
        x.setAttribute("value", partes[0]);
        contenedor.appendChild(x);

        var a = document.createElement('input');
        a.setAttribute("class", "form-control mt-3 charizard");
        a.setAttribute("id" , `eraseName-${contador}`);
        a.setAttribute("value", partes[1]);
        charizard.appendChild(a);

        var b = document.createElement('button');
        b.innerHTML = "<span style='font-size: 1em; color: Tomato;'><i class='fas fa-trash'></i></span>";
        b.setAttribute("class", "mt-3 ml-2 btn btn-light col-sm-12 ");
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
<?php require dirname(__FILE__).'/../home/footer.php'?>