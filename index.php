<?php 
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';
function show_error(){
    $error = new ErrorController();
    $error->index();
}
if(isset($_GET['controller'])){   
    $nombre_controlador = $_GET['controller'].'Controller';     
    if(class_exists($nombre_controlador)){
        $controlador = new $nombre_controlador();

        if(isset($_GET['action']) && method_exists($controlador,$_GET['action'] )){
            $action = $_GET['action'];
            $controlador->$action();
        }else{
            show_error();
        }
    }else{
        show_error();
    }
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    $nombre_controlador = controller_default;
    $controlador = new $nombre_controlador();
    $nombre_action = action_default;
    $controlador->$nombre_action();
}else{
    show_error();
}
require_once 'views/layout/footer.php';
