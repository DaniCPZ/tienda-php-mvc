<?php
class Utils{
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }
    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }
    public static function isIdentity(){
        if(!isset($_SESSION['identity'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }
    public static function showCategorias(){
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }
    public static function statsCarrito(){
        $stats = array(
            'count' => 0,
            'total' =>0 
        );
        if(isset($_SESSION['carrito'])){
            $stats['count'] = count($_SESSION['carrito']);
            foreach($_SESSION['carrito'] as $indice => $elemento){
                $stats['total'] += $elemento['precio'] * $elemento['unidades']; 
            }
        }
        return $stats;
    }
    public static function state(string $estado){
        $msj = 'Pendiente';
        switch ($estado) {
            case 'confirm':
                $msj = 'Pendiente';
                break;
            case 'preparation':
                $msj = 'En preparacion';
                break;
            case 'ready':
                $msj = 'Listo para enviar';
                break;
            case 'sended':
                $msj = 'Enviado';
                break;
        }
        return $msj;
    }
}