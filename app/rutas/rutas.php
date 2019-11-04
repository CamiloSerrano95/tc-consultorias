<?php
//todas las rutas disponibles en nuestra aplicación
$ruta = new Ruta();
$ruta->controladores(array(
    "/" => "welcomeController",
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
    "/cumplimientos1_2" => "UnoyDosController",  
    "/UnspscyExperiencia" => "UnspscyExperienciaController",
    "/FinancieroyOrganizacional" => "FinancieroyOrganizacionalController",
    "/Experiencias" => "ExperienciasController",
    "/Unspsc" => "UnspController",
    "/Allempresas" => "AllEmpresasController",

));
