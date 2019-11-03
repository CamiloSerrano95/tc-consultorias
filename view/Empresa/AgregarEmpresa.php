<?php require '../Home/Header.html'; ?>

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
            <form action="../../Controllers/EmpresaController/SavedEmpresaController.php" method="POST" class="form-horizontal">
                <div class="card-body">
                    <h4 class="card-title">Agregar Nueva Empresa</h4>
                    <div class="form-group row mt-5">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">NOMBRE</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nombre" id="fname" placeholder="Nombre" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">NIT</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nit" id="lname" placeholder="Nit" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">MATRICULA MERCANTIL</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="matricula" id="lname" placeholder="Matricula">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">REGISTRO DE ENTIDADES SIN ANIMO DE LUCRO</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="lucro" id="lname" placeholder="Fecha">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">FECHA DE INSCRIPCIÓN EN EL REGISTRO DE LOS PROPONENTES</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="fecha_registro" id="lname" placeholder="Fecha">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">NÙMERO DEL PROPONENTE</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="proponente" id="lname" placeholder="Numero">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">FECHA DE LA ÙLTIMA RENOVACION EN EL REGISTRO DE LOS PROPONENTES</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="fecha_renovacion" id="lname" placeholder="Fecha">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">ORGANIZACIÒN</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="organizacion" id="lname" placeholder="Organizacion">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">TAMAÑO DE EMPRESA</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="tam_empresa" id="lname" placeholder="Microempresa">
                        </div>
                    </div>
                    <hr>
                    <h4 class="card-title mt-4">Capacidad Financiera</h4>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">INDICE DE LIQUIDEZ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="indice_liquidez" id="lname" placeholder="Liquidez" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">INDICE DE ENDEUDAMIENTO</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="indice_endeudamiento" id="lname" placeholder="Endeudamiento" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">RAZÒN DE COBERTURA DE INTERES</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="cobertura_interes" id="lname" placeholder="INDETERMINADO = 0" required>
                        </div>
                    </div>
                    <hr>
                    <h4 class="card-title mt-4">Capacidad Organizacional</h4>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">RENTABILIDAD DEL PATRIMONIO</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="rentabilidad_patrimonio" id="lname" placeholder="Patrimonio" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">RENTABILIDAD DEL ACTIVO</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="rentabilidad_activo" id="lname" placeholder="Activo" required>
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

<?php require '../Home/Footer.html'; ?>