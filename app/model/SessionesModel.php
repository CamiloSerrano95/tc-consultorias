<?php

class SessionesModel {
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

    public function ExistSession($key) {
        @session_start();

        if (isset($_SESSION[$key])) {
            $flag = true;
        } else {
            $flag = false;
        }
        
        return $flag;
    }

    public function CreateNotification($notification) {
        @session_start();
        $_SESSION['toastr'] = $notification;
    }

    public function ShowNotification() {
        @session_start();
        echo $_SESSION['toastr'];
        unset($_SESSION['toastr']);
    }
}