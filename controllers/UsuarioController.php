<?php
require_once 'models/usuario.php';
class usuarioController{
    public function index(){
        echo "Controlador usuarios";
    }
    public function registro(){
        require_once "views/usuario/registro.php";
    }
    public function save(){
        if(isset($_POST)){
            $usuario = new Usuario;
            $nombre = isset($_POST['nombre'])? $_POST['nombre'] : null;
            $apellidos = isset($_POST['apellido'])? $_POST['apellido'] : null;
            $email = isset($_POST['email'])? $_POST['email'] : null;
            $password = isset($_POST['password'])? $_POST['password'] : null;
            if($nombre && $apellidos && $email && $password){
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $result = $usuario->save();
                if($result){
                    $_SESSION['register'] = 'complete';
                }else{
                    $_SESSION['register'] = 'failed';
                }
            }else{
                $_SESSION['register'] = 'failed';
            }
        }else{
            $_SESSION['register'] = 'failed';
            
        }
        header("Location:".base_url.'usuario/registro');
    }

    public function login(){
        if(isset($_POST)){
            $usuario = new Usuario;
            $email = isset($_POST['email'])? $_POST['email'] : null;
            $password = isset($_POST['password'])? $_POST['password'] : null;
            if($email && $password){
                $usuario->setEmail($email);
                $usuario->setPassword($password);  
                $result = $usuario->login();
                if($result && is_object($result)){                                        
                    $_SESSION['identity'] = $result;                   
                    if($result->rol == 'admin'){
                        $_SESSION['admin'] = true;   
                    }
                }else{
                    $_SESSION['error_login']= 'Identificacion fallida';
                }
            }
        }
        header('Location:'.base_url);
    }
    
    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        header('Location:'.base_url);
    }
}