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
            <form class="form-horizontal">
                <div class="card-body">
                    <h4 class="card-title">Agregar Profesionales</h4>
                    <div class="form-group row mt-5">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">PROFESION</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fname" placeholder="profesion">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">ESPECIALIZACION</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lname" placeholder="especialización">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">AÑOS DE EXPERIENCIA PROFESIONAL</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lname" placeholder="años">
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="row">
                        <div class="col-9"></div>
                        <div class="col-3">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require dirname(__FILE__).'/../home/footer.php'?>