<?php

error_reporting(E_ALL); // Error/Exception engine, always use E_ALL

ini_set('ignore_repeated_errors', TRUE); // always use TRUE

ini_set('date.timezone', 'America/Bogota'); // 

ini_set('display_errors', TRUE); // Error/Exception display, use FALSE only in production environment or real server. Use TRUE in development environment

ini_set('log_errors', TRUE); // Error/Exception file logging engine.

ini_set("error_log", "/xampp/htdocs/proyectos-juan/proyecto-uno/php-error.log");


require_once __DIR__.'/autoload.php';
require_once __DIR__.'/config/DataBase.php';
require_once __DIR__.'/config/Constants.php';
require_once __DIR__.'./helpers/SesionController.php';
// require_once 'helpers/SesionController.php';
require_once __DIR__.'./helpers/helpers.php';
// require_once '/helpers/helpers.php';
require_once 'libs/view.php';
require_once 'controllers/MailController.php';
require_once 'controllers/Controller.php';

require_once 'libs/PHPMailer-master/src/Exception.php';
require_once 'libs/PHPMailer-master/src/OAuth.php';
require_once 'libs/PHPMailer-master/src/PHPMailer.php';
require_once 'libs/PHPMailer-master/src/POP3.php';
require_once 'libs/PHPMailer-master/src/SMTP.php';

$inicio = new Controller();
$inicio->App();




