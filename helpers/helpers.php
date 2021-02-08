<?php


function paginaActual() {
    $archivo = basename($_SERVER['REDIRECT_URL']);
    $pagina = str_replace("/", "", $archivo);
    return $pagina;
}

