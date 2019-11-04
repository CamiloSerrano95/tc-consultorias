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
                    <h4 class="card-title">Agregar Codigos Globales</h4>
                    <div class="form-group row mt-5">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Codigo UNSPSC</label>
                        <div class="col-sm-9">
                            <input type="text" name="codigo" class="form-control" id="fname" placeholder="codigo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Descripcion</label>
                        <div class="col-sm-9">
                            <input type="text" name="descripcion" class="form-control" id="lname" placeholder="descripcion">
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