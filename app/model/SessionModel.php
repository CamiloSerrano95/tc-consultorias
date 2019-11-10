<?php

class SessionModel {
    public function ValidateSession() {
        
        if(isset($_SESSION['usuario'])){
            require dirname(__FILE__).'/../../view/home/header.php';
        }else{
            Redirecciona::LetsGoTo('');
            exit;
        }
    }

    public function CreateSession($key, $value) {
        @session_start();
        $_SESSION[$key] = $value;
    }

    public function DestroySession() {
        @session_start();
        session_destroy();
        Redirecciona::LetsGoTo('');
    }
}