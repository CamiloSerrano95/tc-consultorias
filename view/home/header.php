<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo ASSETS_URL."images/favicon.png"?>">
    <title>TC - CONSULTORIAS</title>
    <!-- Custom CSS -->
    <link href="<?php echo ASSETS_URL."libs/flot/css/float-chart.css"?>" rel="stylesheet">
    <!-- Custom CSS -->
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
                    <ul class="navbar-nav float-right">
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
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."cumplimientos1_2"?>" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu">Cumplientos</span></a></li>
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."UnspscyExperiencia"?>" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu">Unspsc-Experiencias</span></a></li>
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."Unspsc"?>" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu">Unspsc</span></a></li>
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."Experiencias"?>" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu">Experiencia</span></a></li>
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."FinancieroyOrganizacional"?>" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu">Financiero y Organizacional</span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-building"></i><span class="hide-menu"> Gestionar Empresas </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."empresa"?>" class="sidebar-link"><i class="mdi mdi-book-plus"></i><span class="hide-menu"> Agregar Empresa </span></a></li>
                                <li class="sidebar-item"><a href="<?php echo ABS_PATH."Allempresas"?>" class="sidebar-link"><i class="mdi mdi-book-plus"></i><span class="hide-menu"> Mostrar Empresas </span></a></li>
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