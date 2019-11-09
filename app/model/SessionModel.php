<?php

class SessionModel {
    public function ValidateSession() {
        
        if(isset($_SESSION['usuario'])){
            require dirname(__FILE__).'/../../home/header.php';
        }else{
            Redirecciona::LetsGoTo('');
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