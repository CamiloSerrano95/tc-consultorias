<?php

class Ruta
{
    private $_controladores = array();
    public function controladores($controlador)
    {
        $this->_controladores = $controlador;
        self::submit();
    }
    
    public function submit()
    {
        $uri   = isset($_GET["uri"]) ? $_GET["uri"] : "/"; 
        $paths = explode("/", $uri);
        if ($uri == "/") {
            $res = array_key_exists("/", $this->_controladores);
            if ($res != "" && $res == 1) {
                foreach ($this->_controladores as $ruta => $controller) {
                    if ($ruta == "/") { 
                        $controlador = $controller; 
                    }
                }
                $this->getController("index", $controlador);
            }
        } else {
            $estado = false;
            foreach ($this->_controladores as $ruta => $cont) {
                if (trim($ruta, "/") != "") {
                    $pos = strpos($uri, trim($ruta, "/"));

                    if ($pos === false) {
                        //echo "<small style='color:red;'>no se encontro</small><br>";
                    } else {
                        $arrayParams  = array();
                        $estado       = true;
                        $controlador  = $cont;
                        $metodo       = "";
                        $cantidadRuta = count(explode("/", trim($ruta, "/")));
                        $cantidad     = count($paths);
                        if ($cantidad > $cantidadRuta) {
                            $metodo = $paths[$cantidadRuta];
                            for ($i = 0; $i < count($paths); $i++) {
                                if ($i > $cantidadRuta) {
                                    $arrayParams[] = $paths[$i];
                                }
                            }
                        }

                        /*if(count($paths) > 1){
                        $metodo = $paths[1];
                        }*/
                        $this->getController($metodo, $controlador, $arrayParams);

                    }
                }
            }

            if ($estado == false) {
                die("error en la ruta");
            }

        }
    }
    public function getController($metodo, $controlador, $params = null)
    {
        $metodoController = "";

        if ($metodo == "index" || $metodo == "" || is_null($metodo)) {
            $metodoController = "index";
        } else {
            $metodoController = $metodo;
        }
        
        $this->incluirControlador($controlador);
        
        if (class_exists($controlador)) {
            $ClaseTemp = new $controlador();
            
            if (is_callable(array($ClaseTemp, $metodoController))) {
                if ($metodoController == "index") {
                    if (count($params) == 0) {
                        $ClaseTemp->$metodoController();
                    } else {
                        die("error en parametros");
                    }
                } else {
                    call_user_func_array(array($ClaseTemp, $metodoController), $params);
                }
            } else {
                die(" no existe el metodo");
            }
        } else {
            die("no existe la clase");
        }

    }
    public function incluirControlador($controlador) {

        if (file_exists(APP_RUTA . "controller/" . $controlador . ".php")) {
            include APP_RUTA . "controller/" . $controlador . ".php";
        } else {
            die("error al encontrar el archivo de controlador");
        }
    }

}
