<?php
class FrontController {

    //Constructor
    function __construct($route) {
        
        if($route){ //Si la ruta no es vacia
            list($class,$method) = explode('/',$route);         
        } else {  //Si la ruta es vacia
            $class="MenuController"; //Nos lleva al controller del Menu
            $method="validateMenu"; //Nos lleva a validar un menu
        }

        require_once "controllers/$class.php"; //Requiere automaticamente el archivo

        $instance=new $class(); //Crea la clase

        $instance->$method(); //Llama el metodo
    }
}
