<?php 
     require dirname(__FILE__).'/../home/header.php';

    $Empresa = new EmpresaModel();
    $nit = $key;
    
    $Empresas = $Empresa->ObtenerEmpresa($nit);
    $Servicios = array($Empresa->ObtenerServicios());
    $servicio = $Empresa->ObtenerServicios();
    $Objeto = $Empresa->ObjetosExperiencia();

?> 

<script>
        var arrayConvert = <?php echo json_encode($Servicios[0]); ?>;
        var servicio = arrayConvert.servicios;
        console.log(servicio);
        var datos=[];

        for(var j=0; j< servicio.length; j++){
            datos.push(servicio[j].nombre_servicio);
        }

    </script>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">EXPERIENCIAS</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <?php foreach ($Empresas['empresas'] as $data) { ?>
                            <h5 class="card-title"><strong><?php echo $data['nombre_empresa'] ?></strong></h5>
                        <?php } ?>
                    </div>

                    <div class="card-body text-center">
                        <form action="<?php echo ABS_PATH."experiencia/agregar"?>" 
                        method="POST" class="form-horizontal">
                            <div class="row mt-5">
                            <input type="hidden" name="nit" value="<?php  echo $nit; ?>">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">EXPERIENCIA No.</label>                                                                
                                        <input type="number" class="form-control" name="numero_experiencia" placeholder="No.">                             
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">NÚMERO CONSECUTIVO DEL CONTRATO</label>    
                                        <input type="number" class="form-control" name="numero_contrato" placeholder="No.">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">CONTRATO CELEBRADO POR</label>                                                                
                                        <input type="text" class="form-control" name="contrato_celebrado" placeholder="Valor">                             
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">NOMBRE DEL CONTRATISTA</label>    
                                        <input type="text" class="form-control" name="nombre_contratista" placeholder="Nombre">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">NOMBRE DEL CONTRATANTE</label>                                                                
                                        <input type="text" class="form-control" name="nombre_contratante" placeholder="Nombre">                             
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">VALOR CONTRATADO EN SMMLV</label>    
                                        <input type="text" class="form-control" name="valor_contrato" placeholder="Valor">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">FECHA DE INICIO DEL OBJETO</label>
                                        <input type="date" class="form-control" name="fecha_obj_inicio" placeholder="No.">                             
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">FECHA DE TERMINACION DEL OBJETO</label>
                                        <input type="date" class="form-control" name="fecha_obj_final" placeholder="No.">                             
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">OBJETO</label>
                                        <input type="text" class="form-control" name="descripcion" placeholder="descripcion.">                             
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label">ACTIVIDAD DEL OBJETO</label>
                                        <input type="text" class="form-control" name="tipo_actividad" placeholder="Ej: Consultoria, Obra Civil.">                             
                                    </div>
                                </div>
                            </div>
                           

                            <hr>

                            <div class="row mt-5">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select class="select2 form-control custom-select mt-2" style="width: 100%; height:36px;" id="DatosSelect">
                                            <?php  foreach($servicio['servicios'] as $data) { ?>
                                                <option value="<?php echo $data['codigo']."-".$data['nombre_servicio'];  ?>"><?php echo $data['codigo']. " - " .$data['nombre_servicio'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-2">
                                    <button type="button" id="crearInput" class="btn btn-primary">Agregar Codigo</button>
                                </div>
                            </div>
                            <div class="row mt-3">
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
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var erase = document.getElementById('erase');
    var contador = 0;

    crearInput.onclick = () => {
        var DatosSelect = document.getElementById('DatosSelect').value;
        
        var contenedor = document.getElementById('contenedor');
        var charizard = document.getElementById('charizard');
        var partes = DatosSelect.split('-');
        
        var x = document.createElement('input');
        x.setAttribute("class", "form-control mt-3");
        x.setAttribute("id" , "selecsito");
        x.setAttribute("id" , `eraseCode-${contador}`);
        x.setAttribute("name" , "codigos[]");
        x.setAttribute("value", partes[0]);
        contenedor.appendChild(x);

        var a = document.createElement('input');
        a.setAttribute("class", "form-control mt-3");
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