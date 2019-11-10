<?php 
    // require_once '../../Models/ObjetosModel.php';
    // require_once '../../Models/EmpresaModel.php';

    $busqueda = new ObjetosModel();
    if (isset($_GET['buscar'])) {
        $data = $busqueda->search($_GET['buscar']);
    }

    $Empresa = new EmpresaModel();
    
    $Servicios = array($Empresa->ObtenerServicios());
    $servicio = $Empresa->ObtenerServicios();

?> 
<script>
        var arrayConvert = <?php echo json_encode($Servicios[0]); ?>;
        var servicio = arrayConvert.servicios;
        var datos=[];

            for(var j=0; j< servicio.length; j++){
                datos.push(servicio[j].nombre_servicio);
            }
               
        function crearInput() {
            
            var DatosSelect = document.getElementById('DatosSelect').value;
        
            var contenedor = document.getElementById('contenedor');
            var charizard = document.getElementById('charizard');
            var partes = DatosSelect.split('-');
            
            var x = document.createElement('input');
            x.setAttribute("class", "form-control mt-3");
            x.setAttribute("id" , "selecsito");
            x.setAttribute("name" , "codigos[]");
            x.setAttribute("value", partes[0]);
            contenedor.appendChild(x);

            var a = document.createElement('input');
            a.setAttribute("class", "form-control mt-3");
            a.setAttribute("value", partes[1]);
            charizard.appendChild(a);
        }

        function rar() {
            var palabra = document.getElementById("PalabrasClaves").value;
            var param = {
                "palabras": palabra
            };

            $.ajax({
                data: param,
                url: "<?php echo ABS_PATH."busqueda/agregar";?>",
                method: "post",
                success: function(data) {
                    
                    var s = document.getElementById('daticos');
                    s.innerHTML = "";
                    var res =  JSON.parse(data);
                    Object.keys(res).map(function(e) { 
                        //console.log(res[e]);
                        var partes = res[e].split('-');
                        s.innerHTML += "<option value='"+partes[0]+"'>"+partes[1]+"</option>";
                    })
                }
            }); 
        }

        function obtenerObjeto(){
            var Datos = document.getElementById('daticos').value;
            var combo = document.getElementById("daticos");
            var selected = combo.options[combo.selectedIndex].text;  

            var porciones = selected.split('*');
            console.log(porciones[0]);
            console.log(porciones[1]);          
        
            var inputA = document.getElementById('inputA');
            var inputB = document.getElementById('inputB');
            var inputC = document.getElementById('inputC');
            
            var a = document.createElement('input');
            a.setAttribute("class", "form-control mt-3");
            a.setAttribute("value", Datos);
            a.setAttribute("type", "hidden");
            a.setAttribute("name" , "objetos[]");
            inputA.appendChild(a);

            var b = document.createElement('input');
            b.setAttribute("class", "form-control mt-3");
            b.setAttribute("value", porciones[0]);
            inputB.appendChild(b);

            var c = document.createElement('input');
            c.setAttribute("class", "form-control mt-3");
            c.setAttribute("value", porciones[1]);
            inputC.appendChild(c);
        }

    </script>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- "libs/flot/css/float-chart.css"?>" -->
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo ASSETS_URL."images/favicon.png"?>">
    <title>Cumplimiento</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL."extra-libs/multicheck/multicheck.css"?>">
    <link href="<?php echo ASSETS_URL."libs/jquery-steps/jquery.steps.css"?>" rel="stylesheet">
    <link href="<?php echo ASSETS_URL."libs/jquery-steps/steps.css"?>" rel="stylesheet">
    <link href="<?php echo ASSETS_URL."dist/css/style.min.css"?>" rel="stylesheet">
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">        
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <a class="navbar-brand" href="../Inicio/index.php">
                        <b class="logo-icon p-l-10">
                            <img src="<?php echo ASSETS_URL."images/logo1.png"?>" width="90%" alt="homepage" class="light-logo" />
                        </b>
                    </a>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                    </ul>
                    <ul class="navbar-nav float-right ">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo ASSETS_URL."images/users/1.jpg"?>" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo ABS_PATH.""?>"><i class="fa fa-power-off m-r-5 m-l-5"></i>Cerrar Sesion</a>
                                <a class="dropdown-item" href="<?php echo ABS_PATH."usuario/nuevo"?>"><i class="mdi mdi-account-key m-r-5 m-l-5"></i>Registrar Usuario</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo ABS_PATH."cumplimientos"?>" aria-expanded="false"><i class="fas fa-tasks"></i><span class="hide-menu">Evaluacion de Cumplimientos</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-check-circle"></i><span class="hide-menu">Tabla de Cumplimiento </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."vistaresults/UnoDos"?>" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu">Cumplientos</span></a></li>
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."vistaresults/UnspscExperiencia"?>" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu">Unspsc-Experiencias</span></a></li>
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."vistaresults/Unspsc"?>" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu">Unspsc</span></a></li>
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."vistaresults/Experiencias"?>" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu">Experiencia</span></a></li>
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."vistaresults/FinancierOrganizacional"?>" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu">Financiero y Organizacional</span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-building"></i><span class="hide-menu"> Gestionar Empresas </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."empresa"?>" class="sidebar-link"><i class="mdi mdi-book-plus"></i><span class="hide-menu"> Agregar Empresa </span></a></li>
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."koto"?>" class="sidebar-link"><i class="mdi mdi-book-plus"></i><span class="hide-menu"> Mostrar Empresas </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-barcode"></i><span class="hide-menu"> Codigos Globales </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."code"?>" class="sidebar-link"><i class="mdi mdi-barcode-scan"></i><span class="hide-menu"> Agregar Codigos </span></a></li>
                                <li class="sidebar-item"><a href="../Codigos/MostrarCodigosGenerales.php" class="sidebar-link"><i class="mdi mdi-barcode-scan"></i><span class="hide-menu"> Mostrar Codigos </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-settings-variant"></i><span class="hide-menu"> Gestionar Profesionales </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../Profesionales/Profesionales.php" aria-expanded="false"><i class="mdi mdi-account-search"></i><span class="hide-menu">Buscar Profesionales</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../Profesionales/AgregarProfesionales.php" aria-expanded="false"><i class="mdi mdi-plus"></i><span class="hide-menu">Agregar Profesionales</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

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
                    <div class="card-body wizard-content">
                        <form id="example-form" action="<?php echo ABS_PATH."evaluacion/agregar"?>"
                        <!-- ../../Controllers/EvaluacionController/Evaluacion.php   
                        method="POST" class="m-t-40">
                            <div>

                                <h3>Cumplimiento UNSPSC</h3>
                                <section>
                                    <div class="form-group text-center">
                                        <label>Objeto del Contrato</label>
                                        <textarea name="licitacion" class="form-control"></textarea>
                                        <!-- <input type="text" class="form-control" name="licitacion"> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <select class="select2 form-control custom-select mt-2" style="width: 100%; height:36px;" id="DatosSelect">
                                                    <?php  foreach($servicio['servicios'] as $data) { ?>
                                                        <option value="<?php echo $data['codigo']."-".$data['nombre_servicio'];  ?>"><?php echo $data['codigo']. " - " .  $data['nombre_servicio'];?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mt-2">
                                            <button type="button" onclick="crearInput()" class="btn btn-primary">Agregar Codigo</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="contenedor" class="form-group col-sm-6">
                                            <!-- input1 -->
                                        </div>
                                        <div id="charizard" class="form-group col-sm-6">
                                            <!-- input2 -->
                                        </div>
                                    </div>
                                </section>

                                <h3>Cumplimiento Objeto</h3>
                                <section>
                                    <div class="form-group">
                                        <label class="mt-3">Palabra Clave Objeto</label>
                                        <input type="text" id ="PalabrasClaves" onkeyup="rar()" class="form-control" placeholder="Digite palabra Ej: revision" name="buscar" autofocus>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <select class="select2 form-control custom-select mt-2" style="width: 100%; height:36px;" id="daticos">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 mt-2">
                                            <button type="button" onclick="obtenerObjeto()" class="btn btn-primary">Agregar Objetos</button>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div id="inputB" class="form-group col-sm-10">
                                            <!-- input2 -->
                                        </div>
                                        <div id="inputC" class="form-group col-sm-2">
                                            <!-- input3 -->
                                        </div>
                                        <div id="inputA" class="form-group col-sm-1">
                                            <!-- input1 -->
                                        </div>
                                    </div>
                                    
                                </section>

                                <h3>Cumplimiento de Experiencia</h3>
                                <section>
                                    <div class="form-group">
                                        <label>No. Contratos</label>
                                        <input type="text" class="form-control" name="num_contrato" placeholder="Ej: 1">

                                        <label class="mt-3">Minimo de codigo Requeridos</label>
                                        <input type="text" class="form-control" name="codigos_requeridos" placeholder="Ej: 2">

                                        <label class="mt-3">Presupuesto Oficial Exigido</label>
                                        <input type="text" class="form-control" name="presupuesto_oficial" placeholder="valor en smmlv Ej: 20">

                                        <label class="mt-3">Porcentaje de Presupuesto Exigido</label>
                                        <input type="text" class="form-control" name="porcentaje_exigido" placeholder="%">
                                        
                                    </div>
                                </section>


                                <h3>Cumplimiento Financiero y Organizacional</h3>
                                <section>
                                    <div class="form-group">
                                        <label>Indice de Liquidez</label>
                                        <input type="text" class="form-control" name="liquidez" placeholder="Ej: 1.9">

                                        <label class="mt-3">Endeudamiento</label>
                                        <input type="text" class="form-control" name="endeudamiento" placeholder="Ej: 0.05">

                                        <label class="mt-3">Razon cobertura de intereses</label>
                                        <input type="text" class="form-control" name="cobertura" placeholder="INDETERMINADO = 0">

                                        <label class="mt-3">Rentabilidad sobre el Patrimonio</label>
                                        <input type="text" class="form-control" name="rentabilidad_patrimonio" placeholder="Ej: 0.06">

                                        <label class="mt-3">Rentabilidad sobre Activos</label>
                                        <input type="text" class="form-control" name="activos" placeholder="Ej: 0.03">

                                        <label class="mt-3">Capital de Trabajo</label>
                                        <input type="text" class="form-control" name="capital" placeholder="Ej: digite el valor en smmlv">

                                        <label class="mt-3">Patrimonio</label>
                                        <input type="text" class="form-control" name="patrimonio" placeholder="Ej: digite el valor en smmlv">
                                    </div>
                                </section>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo ASSETS_URL."libs/jquery/dist/jquery.min.js"?>"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo ASSETS_URL."libs/popper.js/dist/umd/popper.min.js"?>"></script>
    <script src="<?php echo ASSETS_URL."libs/bootstrap/dist/js/bootstrap.min.js"?>"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo ASSETS_URL."libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"?>"></script>
    <script src="<?php echo ASSETS_URL."extra-libs/sparkline/sparkline.js"?>"></script>
    <!--Wave Effects -->
    <script src="<?php echo ASSETS_URL."dist/js/waves.js"?>"></script>
    <!--Menu sidebar -->
    <script src="<?php echo ASSETS_URL."dist/js/sidebarmenu.js"?>"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo ASSETS_URL."dist/js/custom.min.js"?>"></script>
    <script src="<?php echo ASSETS_URL."extra-libs/multicheck/datatable-checkbox-init.js"?>"></script>
    <script src="<?php echo ASSETS_URL."extra-libs/multicheck/jquery.multicheck.js"?>"></script>
    <!-- this page js -->
    <script src="<?php echo ASSETS_URL."libs/jquery-steps/build/jquery.steps.min.js"?>"></script>
    <script src="<?php echo ASSETS_URL."libs/jquery-validation/dist/jquery.validate.min.js"?>"></script>
    <script>
        // Basic Example with form
        var form = $("#example-form");
        form.validate({
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
            },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function(event, currentIndex, newIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                //alert("Submitted!");
                form.submit();
            }
        });
    </script>
</body>

</html>