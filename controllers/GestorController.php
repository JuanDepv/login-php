<?php


require_once 'model/UserGestor.php';

class GestorController extends SesionController {


    public function __construct() {}

    public function getName() {
        $usuarios = new UserGestor();
        $user = $usuarios->getName();
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

    public function getRol() 
    {
        $usuarios = new UserGestor();
        $user = $usuarios->getRol();
        echo json_encode($user);
    }

    public function updateUser() 
    {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = array(
                'id_usuario' => $id_usuario = trim($_POST['id_usuario']),
                'username' => $username = trim($_POST['username']),
                'email' => $email = trim($_POST['email']),
                'rol' => $rol = trim($_POST['rol'])
            );

            $gestor = new UserGestor();
            $response = $gestor->updateUser($data);

            if($response['success']) {
                echo json_encode(array(
                    'success' => true,
                    'msg' => 'correcto',
                ));
            } else {
                echo json_encode(array(
                    'success' => false,
                    'msg' => 'error',
                ));
            }

        } else {
            return array(
                'error' => "error en el metodo de envio"
            );
        }
    }

    public function updataState() 
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['id']) && isset($_POST['estado'])) {
                $id = $_POST['id'];
                $estado = $_POST['estado'];
                $user = new UserGestor();
                $data = $user->updataState($id, $estado);
                echo json_encode($data);
            } else {
                return array(
                    'error' => "en los datos de envio"
                );
            }
        } else {
            return array(
                'error' => "error en el metodo de envio"
            );
        }
    }

    public function uploadImageProfile() 
    {   
        $path = "assets/uploads/";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_FILES)) {
                $nombre_archivo = $_FILES['profile']['name'];
                $tipo = $_FILES['profile']['type'];
                $tmp_name = $_FILES['profile']['tmp_name'];
                $error =  $_FILES['profile']['error'];
                $size = $_FILES['profile']['size'];

                if ($this->validateFormatImage($tipo)) {

                    if ($error === 0) {

                        if ($this->validateSize($size)) {

                            //separar la imagen  [nombre => 0] . ['jpg' => 1]
                            $nombreext = explode('.', $nombre_archivo);
                            // estraer el jpg
                            $nombreacext = strtolower(end($nombreext));

                            // cambio de el nombre
                            $nombre_guardar = uniqid('', true) . "." . $nombreacext;

                            $nombre_imagen = BASE_URL .'/'. $path . $nombre_guardar;

                            move_uploaded_file($tmp_name, $path . $nombre_guardar);
                        } else {
                            echo json_encode(array(
                                'success' => false,
                                'msg' => 'error en el tamaño',
                            ));
                        }
                    } else {
                        echo json_encode(array(
                            'success' => false,
                            'msg' => 'error al subir el archivo',
                        ));
                    }
                } else {
                    echo json_encode(array(
                        'success' => false,
                        'msg' => 'error en tipo',
                    ));
                }
            }

            extract($_REQUEST);
            $id_user = $id_usuario;

            $upload = array(
                'id_usuario' => $id_user,
                'imagen_url' => $nombre_imagen
            );


            $user = new UserGestor();
            $data = $user->uploadNameImage($upload);
            echo json_encode($data);
        }
    } 

}