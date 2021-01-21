<?php

class View {

    public function __construct()
    {
        
    }

    public function render($nombre, $data = []) {
        $params[] = $data;
        require 'views/' . $nombre . '.php';
    }
}