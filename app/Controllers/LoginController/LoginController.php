<?php
    require_once ('../../Models/LoginModel.php');

    $identidad = new LoginModel();
    
    $identidad->setUser($_POST['user']);
    $identidad->setPasswd($_POST['pass']);
 

     $data = $identidad->login();
     if($data['usuario']['usuario'] == $identidad->getUser()){
         if (password_verify($identidad->getPasswd(), $data['usuario']['contrasena'])) {
             header("Location: ../../View/Inicio/index.php");
         }else{
             header("Location: ../../Alert/usuarioIncorrecto.html");
         }
     }else{
         header("Location: ../../Alert/usuarioIncorrecto.html");
     }
?>