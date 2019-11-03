<?php
    require '../../Models/ServiciosModel.php';

    $Servicio = new ServicioModel();

    $Servicio->setCodigo($_POST['codigo']);
    $Servicio->setNombreServicio($_POST['descripcion']);
    

    $data = $Servicio->Saved();

    if ($data['status'] == 1) {
        header('Location: ../../View/Codigos/Codigos.php'); 
        /* echo $data['msg']; */
    } else {
        echo $data['error'];
    }
    
?>