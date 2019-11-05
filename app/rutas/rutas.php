<?php
//todas las rutas disponibles en nuestra aplicación
$ruta = new Ruta();
$ruta->controladores(array(
    "/" => "WelcomeController",
    "/login"    => "AuthController",
    "/usuario"  => "UsuarioController",
    "/service" => "ServiceController",
    "/producto" => "ProductoController",
    "/admin"    => "AdminController",
    "/home"     => "HomeController",
    "/busqueda" => "BusquedaPalabra",
    "/code" => "controllercode",
    "/empresa" => "controllercompany",
    "/evaluacion" => "controllerevaluacion",
    "/experiencia" => "controllerexperience",
    "/cumplimientos" => "CumplimientosController",
    "/vistaresults" => "ResultsController",  
    "/revision" => "RevisionController",
    "/Allempresas" => "AllEmpresasController",
    "/mostrarCodigos" => "CodeCompanyController",

));
