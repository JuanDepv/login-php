<?php

if(!isset($_SESSION)){
    session_start();
}

class StoreViewController extends SesionController {

    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function inicio()
    {
        if($this->isUser()){
            $this->view->render('store/index');
        }else{
            $this->redirect('/App/acceso');
        }    
    }


}