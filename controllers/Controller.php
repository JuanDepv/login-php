<?php

class Controller {

    public function App() {
        
        if (isset($_GET['controller'])) {
            $name_controller = $_GET['controller'].'Controller';

            // echo $name_controller . "<br>";
        
        } elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
            $name_controller = DEFAULT_CONTROLLER;
        }

        if (class_exists($name_controller)) {
            $controller = new $name_controller();

            if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){
                $action = $_GET['action'];
                $controller->$action();
                
            } elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
                $action_default = ACTION_DEFAULT;
                $controller->$action_default();
            
            } else {
                echo "error al abrir el metodo";
            }
            
        } else {
            echo "al intentar abrir el  controlador";
        }
    }
    
}