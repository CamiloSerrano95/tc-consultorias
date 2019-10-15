<?php require dirname(__FILE__).'/../home/header.php'?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-link">
                    <div class="auth-box bg-link ">  <!-- border-top border-secondary -->
                        <div>
                            <div class="text-center p-t-20 p-b-20">
                                <span class="db"><img src="<?php echo ASSETS_URL."images/logo1.png"?>" width="80%" alt="logo" /></span>                                
                            </div>
                            <!-- Form -->
                            <form class="form-horizontal m-t-20" action="<?php echo ABS_PATH."usuario/"?>" method="POST">
                                <div class="row p-b-30">
                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg" name="nombres" placeholder="Nombres" aria-label="Username" aria-describedby="basic-addon1" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg" name="user" placeholder="Usuario" aria-label="Username" aria-describedby="basic-addon1" required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                            </div>
                                            <input type="password" class="form-control form-control-lg" name="passwd" placeholder="Contraseña" aria-label="Password" aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row border-top border-secondary">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="p-t-20">
                                                <button class="btn btn-block btn-lg btn-info" type="submit">Registrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require dirname(__FILE__).'/../home/footer.php'?>

<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
</script>