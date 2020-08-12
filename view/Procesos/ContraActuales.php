<?php require dirname(__FILE__).'/../home/header.php';
    echo "lkjsajksjskjskjskjs";
    var_dump($key);
?>


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
            <h4 class="card-title">Procesos ContraActuales</h4>
            <div class="container text-center row mt-3">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label"><strong>NOMENCLATURA : </strong></label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label"><strong>ENTIDAD : </strong></label>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label"><strong>CONTRATO : </strong></label>
                    </div>
                </div>
            </div>

            <hr>

            <div class="mt-3 text-center">
                <h5 class="text-center">PREPLIEGO</h5>
                <div class="table-responsive text-center mt-5">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Valor</th>
                                <th>Fecha presentar observaciones prepliego</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>               
                                <td></td>              
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3 text-center">
                <h5 class="text-center">PLIEGO</h5>
                <div class="table-responsive text-center mt-5">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Fecha de apertura</th>
                                <th>Visita a obra o presentación de intencion</th>
                                <th>Estado</th>
                                <th>Fecha de observaciones definitivo</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>               
                                <td></td>              
                                <td></td>               
                                <td></td>  
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3 text-center">
                <h5 class="text-center">OFERTA</h5>
                <div class="table-responsive text-center mt-5">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>fecha de presentar propuesta</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <form action="<?php echo ABS_PATH."procesos/store"?>" method="POST" class="form-horizontal">
                <div class="card-body">
                    <input type="text" name="id_object" value="<?php echo $key; ?>">
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