<?php

class SesionController
{
    function __construct()
    {
    }

    public static function isUser() {
        if (isset($_SESSION['usuario'])) {
            return true;
        }
        return false;
    }

    public static function redirect($location) {
        return header('Location:' . BASE_URL . $location);
    }
}