<?php require '../Home/Header.html'; ?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">EMPRESA QUE APROBARON LOS CUMPLIMIENTO EXIGIDOS</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h5 class="card-title">AlianzaEmpresas</h5> -->
                        <div class="table-responsive text-center">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Empresa</th>
                                        <th>Codigos</th>
                                        <th>No. Contratos</th>
                                        <th>Minimo de codigos Requeridos</th>
                                        <th>Presupuesto oficial exigido en SMMLV</th>
                                        <th>Porcentaje de presupuesto exigido</th>
                                        <th>Cumplimiento Experiencia</th>
                                        <th>Cumplimento financiero y organizacional</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>TECE PROYECTOS Y CONSULTORIAS S.A.S</td>
                                        <td>77 10 17 00 - 77 11 15 00 - 81 10 15 00</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>1.438</td>
                                        <td>50%</td>
                                        <td>
                                            <a href="VerEmpresa.php" class="btn btn-link"><span style="font-size: 3em; color: green;"><i class="mdi mdi-certificate"></i></span></button>
                                        </td>
                                        <td>
                                            <a href="Cumplimiento3y4.php" class="btn btn-link"><span style="font-size: 3em; color: purple;"><i class="fas fa-hand-holding-usd"></i></span></a>                                        
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../Home/Footer.html'; ?>