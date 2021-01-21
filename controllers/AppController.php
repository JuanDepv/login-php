<?php
require_once 'model/User.php';

class AppController extends SesionController
{

    public $view;
    public $mail;

    public function __construct()
    {
        $this->view = new View();
        $this->mail = new MailController();
    }

    public function acceso()
    {
        $this->view->render("app/login");
        error_log("abriendo la vista de acceso -> entrando en el controlador login");
        // require_once 'views/app/login.php';
    }

    public function registro()
    {
        $this->view->render("app/register");
        error_log("Abriendo la vista de registro -> entrando en el controlador registro");
        //require_once 'views/app/register.php';
    }

    public function recover()
    {
        $this->view->render('app/recover');
        error_log("Abriendo la vista de recover -> entrando en el controlador recover");
    }


    public function signIn()
    {
        $response_login = array();

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST') {

            try {
                $nombre = trim($_POST["name"]);
                $password = trim($_POST['pass']);

                if (empty($nombre) || empty($password)) {
                    $response_login['errorinputs'] = "Todos los campos son obligatorios!";
                    echo json_encode($response_login);
                    exit;
                }

                $userLogin = new User();
                $userLogin->setUsername($nombre);
                $userLogin->setPassword($password);

                $response_login = $userLogin->login();

                if ($response_login['status']) {
                    session_start();
                    $_SESSION['email'] = $response_login["data"]["email"];
                    $_SESSION['usuario'] = $response_login["data"]["username"];
                    $_SESSION['rol'] = $response_login["data"]["rol_usuario"];
                }

            } catch(Exception $e) {
                echo "error" . $e->getMessage();
            }

        } else {
            echo "error en el metodo de envio";
        }

        echo json_encode($response_login);
    }

    public function signUp()
    {

        $response_register = array();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {

            $nombre = trim($_POST['name']);
            $correo = trim($_POST['correo']);
            $password = trim($_POST['password']);

            if (empty($nombre) || empty($correo) || empty($password)) 
            {
                $response_register['error'] = "Todos los campos son obligatorios!";
                echo json_encode($response_register);
                exit;
            }

            $userRegister = new User();
            $userRegister->setUsername($nombre);
            $userRegister->setEmail($correo);
            $userRegister->setPassword($password);

            $response_register = $userRegister->registrar();
            echo json_encode($response_register);
        }
    }

    public function logout() {
        if(isset($_SESSION['usuario']) && isset($_SESSION['email']))
        {
            unset($_SESSION['usuario']);
            unset($_SESSION['email']);
            unset($_SESSION['rol']);
            SesionController::redirect('/App/acceso');
        }
    }

    public function enviarCambioPassword()
    {
        if (isset($_POST)) 
        {
            $email = trim($_POST['email']);

            try {
                $usuario = new User();
                $usuario->setEmail($email);

                $key = $usuario->recover();
                $html = "
                <p>
                    <span>
                        abrir el siguiente link
                    </span>
                    <a href='http://localhost/proyectos-juan/proyecto-uno/App/cambioPass&key=$key'>
                        Igresar al Link
                    </a>
                </p>
                ";
                $this->mail->sendEmail($email, 'Recuperacion password', $html);
            
            } catch (Exception $th) {
                echo $th->getMessage();
            }


            echo json_encode([
                'message' => 'correo enviado'
            ]);
        }
    }

    public function cambioPass() 
    {
        $user = new User();
        if (isset($_GET['key'])) {
            $key = $_GET['key'];
            if ($user->validateKey($key)) {
                $user_id = $user->getId($key);
                include_once 'views/app/cambiopassoword.php';
            } else {
                SesionController::redirect('/App/acceso');
            }
        } else {
            SesionController::redirect('/App/acceso');
        }

    }

    public function UpdatePass() 
    {
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] === 'POST' ) {

            $id_user = (int) trim($_POST['id_user']);
            $password_cambio = trim($_POST['pass']);

            $user = new User();
            $user->setId($id_user);
            $user->setPassword($password_cambio);
            $update = $user->UpdatePass();

            if ($update['status']) {
                echo json_encode([
                    'response' => 'correcto',
                    'status' => true
                ]);
            } else {
                echo json_encode([
                    'response' => 'error',
                    'status' => false
                ]);
            }
        }
    }

}