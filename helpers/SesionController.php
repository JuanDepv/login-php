<?php

class SesionController
{
    function __construct()
    {
    }

    protected function isUser() {
        if (isset($_SESSION['usuario'])) {
            return true;
        }
        return false;
    }

    protected function redirect($location) {
        return header('Location:' . BASE_URL . $location);
    }

    protected function validateFormatImage($file)
    {
        $flag = false; 
        $type = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');

        if (in_array($file, $type)) {
            $flag = true;
        }
        return $flag;
    }

    protected function validateSize($fileSize)
    {
        $flag = false;

        if ($fileSize < 10000000) { 
            $flag = true;
        }
        return $flag;
    }
}