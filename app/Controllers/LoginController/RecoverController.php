<?php
    require_once ('../../Models/LoginModel.php');
    
    $identidad = new LoginModel();
    $identidad->setUser($_POST['user']);
    $identidad->setEmail($_POST['email']);
    $newpass = $_POST['newpass'];
    $retrynewpass = $_POST['retrynewpass'];

    if ($newpass == $retrynewpass) {
        $identidad->setPasswd(password_hash($newpass, PASSWORD_BCRYPT));
        $data = $identidad->CambiarContrasena();

        if($data['status'] == 1) {
            echo $data['msg'];
        } else {
            header('Location: ../../Alert/usuarioIncorrecto.html');
        }
    } else {
        echo "Las contraseñas no coinciden";
    }
?>