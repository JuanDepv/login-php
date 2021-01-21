<?php

function controllers_autoload($classname){
	if(file_exists('controllers/' . $classname . '.php')) {
		require_once ('controllers/' . $classname . '.php');
	} else {
		echo "error al cargar la clase";
	}
}

spl_autoload_register('controllers_autoload');
