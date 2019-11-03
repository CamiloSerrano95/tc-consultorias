<?php
    require '../../Models/LoginModel.php';

    $regitro = new LoginModel();

    $regitro->setUser($_POST['user']);
    $regitro->setNombres($_POST['nombres']);
    $regitro->setEmail($_POST['email']);
    $passHash = password_hash($_POST['passwd'], PASSWORD_BCRYPT);
    $regitro->setPasswd($passHash);
    $regitro->setRol('1');

    $data = $regitro->RegistroUser();

    if ($data['status'] == 1) {
        header('Location: ../../View/Login/RegistrarUsuario.php'); 
        echo $data['msg']; 
    } else {
        echo $data['error'];
    }
    

    
?>