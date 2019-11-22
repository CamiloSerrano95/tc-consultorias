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
            <form action="<?php echo ABS_PATH."profesion/agregar"?>" method="POST" class="form-horizontal">
                <div class="card-body">
                    <h4 class="card-title">Agregar Profesionales</h4>
                    <div class="form-group row mt-5">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">NOMBRE</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fname" name="nombre">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">CEDULA</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lname" name="cedula">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">PROFESION</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lname" name="profesion">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">N° DE TARJETA</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lname" name="tarjeta">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">FECHA DE EXPEDICION</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="lname" name="fecha_expedicion">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">FECHA DE GRADO</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="lname" name="fecha">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">ESPECIALIZACION</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lname" name="especializacion">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">FECHA DE GRADO</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lname" name="fecha_especializacion">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">MAESTRIA/MAGISTER</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lname" name="maestria">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">FECHA DE GRADO</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lname" name="fecha_maestria">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">DOCTORADO</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="doctorado" id="lname" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">FECHA DE GRADO</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="fecha_doctorado" id="lname" >
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="row">
                        <div class="col-9"></div>
                        <div class="col-3">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require dirname(__FILE__).'/../home/footer.php'?>