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

    public function ExistSession($key) {
        @session_start();

        if (isset($_SESSION[$key])) {
            $flag = true;
        } else {
            $flag = false;
        }
        
        return $flag;
    }

    public function CreateNotification($key, $typeToast, $message, $title) {
        @session_start();
        $_SESSION['toastr'] = $key;
        $_SESSION['toastr']['type'] = $typeToast;
        $_SESSION['toastr']['message'] = $message;
        $_SESSION['toastr']['title'] = $title;
    }

    public function ShowNotification() {
        @session_start();
        //echo $_SESSION['toastr'].$_SESSION['toastr']['type']."('". $_SESSION['toastr']['message'] ."', '". $_SESSION['toastr']['title'] ."')";
        $toast = $_SESSION['toastr'];
        $type = $_SESSION['toastr']['type'];
        $message = $_SESSION['toastr']['message'];
        $title = $_SESSION['toastr']['title'];

        echo "$toast.$type.($message, $title)";
        unset($_SESSION['toastr']);
    }
}