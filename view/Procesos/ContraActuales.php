<?php require dirname(__FILE__).'/../home/header.php';?>

</style>

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
            <?php if (is_array($key)) { ?>
                <div class="container text-center row mt-3">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label"><strong>NOMENCLATURA: </strong><?php echo $key['processes']['nomenclature']; ?></label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label"><strong>ENTIDAD: </strong><?php echo $key['processes']['entity']; ?></label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label"><strong>CONTRATO: </strong><?php echo utf8_decode($key['processes']['nombre']); ?></label>
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
                                <tr id="prepliego">
                                    <td><?php echo $key['processes']['value']; ?></td>
                                    <td><?php echo $key['processes']['prepliego_date_presentation']; ?></td>               
                                    <td class="prepliego_status"><?php echo $key['processes']['prepliego_status']; ?></td>              
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- style="background-color: red; color: white;" -->
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
                                <tr id="pliego">
                                    <td><?php echo $key['processes']['pliego_date']; ?></td>
                                    <td><?php echo $key['processes']['pliego_date_presentation']; ?></td>
                                    <td class="pliego_status"><?php echo $key['processes']['pliego_status']; ?></td>   
                                    <td><?php echo $key['processes']['pliego_date_presentation']; ?></td>
                                    <td><?php echo $key['processes']['pliego_status']; ?></td>
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
                                <tr id="offer">
                                    <td><?php echo $key['processes']['offer_date_presentation']; ?></td>
                                    <td class="offer_status"><?php echo $key['processes']['offer_status']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } else if(is_numeric($key)) { ?>
            
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
            <?php } ?>
        </div>
    </div>
</div>

<script>
    function getColorStatus(status, aggClass) {
        const changeColor = document.getElementById(aggClass);

        if(status == "vencido") {
            changeColor.classList.add("alert_status");
        } else if (status == "a tiempo") {
            changeColor.classList.add("success_status");
        } else if (status == "vence hoy") {
            changeColor.classList.add("warning_status");
        }
    }

    const prepliegoStatus = document.getElementsByClassName("prepliego_status")[0].innerHTML;
    const pliegoStatus = document.getElementsByClassName("pliego_status")[0].innerHTML;
    const offerStatus = document.getElementsByClassName("offer_status")[0].innerHTML;

    getColorStatus(prepliegoStatus, 'prepliego');
    getColorStatus(pliegoStatus, 'pliego');
    getColorStatus(offerStatus, 'offer');

</script>

<?php require dirname(__FILE__).'/../home/footer.php'?>