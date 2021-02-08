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
        if($this->isUser()){
            $this->view->render('usuarios/index');
        }else{
            $this->redirect('/App/acceso');
        }    
    }
    
    public function gestor()
    {
        if($this->isUser()){
            $this->view->render('usuarios/gestor');
        }else{
            $this->redirect('/App/acceso');
        }
        
    }

    public function perfil()
    {
        if($this->isUser()){
            $this->view->render('usuarios/perfil');
        }else{
            $this->redirect('/App/acceso'); 
        }
        
    }

    public function creacionproductos()
    {
        if($this->isUser()){
            $this->view->render('productos/creacion');
        }else{
            $this->redirect('/App/acceso'); 
        }
        
    }

    public function productos()
    {
        if($this->isUser()){
            $this->view->render('productos/gestor');
        }else{
            $this->redirect('/App/acceso'); 
        }
        
    }


}