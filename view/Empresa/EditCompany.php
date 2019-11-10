<?php require dirname(__FILE__).'/../home/header.php'?>


<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <!-- <h4 class="page-title">Form Wizard</h4> -->
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <form action="<?php echo ABS_PATH."code/agregar"?>"
             <!-- /../Controllers/ServiciosController/SavedServiceController.php
                  method="POST" class="form-horizontal"> 
                <div class="card-body">
                    
                    <h4 class="card-title">Editar Empresa</h4>

                    <div class="form-group row mt-4">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">FECHA ULTIMA RENOVACION EN EL REGISTRO DE LOS PROPONENTES</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="fecha" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">INDICE DE LIQUIDEZ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="indice_liquidez" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">INDICE DE ENDEUDAMIENTO</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="indice_endeudamiento"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">RAZÒN DE COBERTURA DE INTERES</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="cobertura_interes" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">RENTABILIDAD DEL PATRIMONIO</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="rentabilidad_patrimonio" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">RENTABILIDAD DEL ACTIVO</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="rentabilidad_activo"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">PATRIMONIO</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="patrimonio"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">ACTIVO CORRIENTE</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="activo_corriente"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">PASIVO CORRIENTE</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="pasivo_corriente" required>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="row">
                        <div class="col-9"></div>
                        <div class="col-3">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">EDITAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require dirname(__FILE__).'/../home/footer.php'?>