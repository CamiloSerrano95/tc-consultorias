<?php
    require_once 'help/helps.php';
    
    define("APP_RUTA",RUTA_BASE."app/");
    define("VISTA_RUTA",RUTA_BASE."view/");
    define("ASSETS_PATH",RUTA_BASE."assets/");
    define("LIBRERIA",RUTA_BASE."libreria/");
    define("RUTA",APP_RUTA."rutas/");
    define("MODELS",APP_RUTA."model/");

    //configuraciones
    require_once RUTA_BASE."config/config.php";
    require_once  APP_RUTA."utils/Conexion.php";

    //librerias
    require_once 'vendor/Redirecciona.php';

    includeModels();
    require_once 'Vista.php';
    require_once 'Ruta.php';
    require_once RUTA.'rutas.php';
