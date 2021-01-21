<?php


function paginaActual() {
    $archivo = basename($_SERVER['REQUEST_URI']);
    $pagina = str_replace("/", "", $archivo);
    return $pagina;
}