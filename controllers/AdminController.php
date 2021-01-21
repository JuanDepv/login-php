<?php

if(!isset($_SESSION)){
    session_start();
}

class AdminController extends SesionController {

    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function inicio()
    {
        if(SesionController::isUser()){
            $this->view->render('usuarios/index');
        }else{
            SesionController::redirect('/App/acceso');
        }    
    }
    
    public function gestor()
    {
        if(SesionController::isUser()){
            $this->view->render('usuarios/ver');
        }else{
            SesionController::redirect('/App/acceso');
        }
        
    }

    public function editar()
    {
        if(SesionController::isUser()){
            $this->view->render('usuarios/editar');
        }else{
            SesionController::redirect('/App/acceso');
        }
        
    }


}