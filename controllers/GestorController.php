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

    public function getUsers() {
        $id = "";
        $estado = "";

        if(isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        if(isset($_POST['estado'])) {
            $estado = $_POST['estado'];
        }

        $usuarios = new UserGestor();
        $user = $usuarios->getUsers($id, $estado);
        echo json_encode($user);
    }

    public function getUser()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['id'])) {
                $id = $_POST['id'];
                $user = new UserGestor();
                $data = $user->getUser($id);
                echo json_encode($data);
            } else {
                return array(
                    'error' => "error"
                );
            }
        } else {
            return array(
                'error' => "error en el metodo de envio"
            );
        }
        
    }


}