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
            <form action="<?php echo ABS_PATH."empresa/agregar"?>"
            <!-- ../../Controllers/EmpresaController/SavedEmpresaController.php
                    method="POST" class="form-horizontal">
                <div class="card-body">
                    <h4 class="card-title">Procesos ContraActuales</h4>
                    <div class="form-group row mt-5">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">NOMENCLATURA</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nomenclatura" id="nomenclatura" placeholder="Nomenclaruta" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">ENTIDAD</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="entidad" id="entidad" placeholder="entidad" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">VALOR</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="valor" id="valor" placeholder="valor">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">FECHA PRESENTAR OBSERVACIONES DE PREPLIEGO</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="fecha_prepliego" id="fecha_prepliego" placeholder="Fecha">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">FECHA DE APERTURA</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="fecha_apertura" id="fecha_apertura" placeholder="Fecha">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">VISITA A OBRA O PRESENTACION DE INTENCION</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="visita_obra" id="visita_obra" placeholder="Fecha">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">FECHA DE PRESENTAR PROPUESTA</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="fecha_presentar_propuesta" id="fecha_presentar_propuesta" placeholder="Fecha">
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="row">
                        <div class="col-9"></div>
                        <div class="col-3">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">GUARDAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require dirname(__FILE__).'/../home/footer.php'?>