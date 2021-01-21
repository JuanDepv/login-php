<?php

require_once 'model/UserGestor.php';

class GestorController extends SesionController {


    public function __construct()
    {
        
    }

    public function getName() {
        $usuarios = new UserGestor();
        $user = $usuarios->getName();
        echo json_encode($user);
    }

    public function getUsuarios() {
        $username = null;
        $estado = null;

        if(isset($_POST['username'])) {
            $username = $_POST['username'];
        }
        if(isset($_POST['estado'])) {
            $estado = $_POST['estado'];
        }

        $usuarios = new UserGestor();
        $user = $usuarios->getUsuarios($username, $estado);
        echo json_encode($user);
    }


}