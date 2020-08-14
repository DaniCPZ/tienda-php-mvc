<?php
require_once 'models/producto.php';
class carritoController{
    public function index(){
        if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){
            $carrito = $_SESSION['carrito'];            
        }
        require_once 'views/carrito/index.php'; 
    }
    public function add(){
        if(isset($_GET['id'])){
            $producto_id = $_GET['id'];
            if(isset($_SESSION['carrito'])){
                $counter = 0;
                foreach($_SESSION['carrito'] as $indice => $elemento){
                    if($elemento['id_producto'] == $producto_id){
                        $_SESSION['carrito'][$indice]['unidades']++;
                        $counter++;
                    }
                }
            }
            if(!isset($counter) || $counter == 0){
                // CONSEGUIR PRODUCTO
                $producto = new Producto();
                $producto->setid($producto_id);
                $product = $producto->getProduct();

                if(is_object($product)){
                    $_SESSION['carrito'][] = array(
                        "id_producto"=> $product->id,
                        "precio"=> $product->precio,
                        "unidades"=> 1,
                        "producto" => $product
                    );
                }
            }
            header("Location:".base_url."carrito/index");

        }else{
            header("Location:".base_url);
        }
        
    }
    public function remove(){
        if(isset($_GET['index'])){
            $indice = $_GET['index'];
            unset($_SESSION['carrito'][$indice]);
        }
        header("Location:".base_url."carrito/index");
    }
    public function up(){
        if(isset($_GET['index'])){
            $indice = $_GET['index'];
            $_SESSION['carrito'][$indice]['unidades']++;
        }
        header("Location:".base_url."carrito/index");
    }
    public function down(){
        if(isset($_GET['index'])){
            $indice = $_GET['index'];
            $_SESSION['carrito'][$indice]['unidades']--;
            if($_SESSION['carrito'][$indice]['unidades'] == 0){
                unset($_SESSION['carrito'][$indice]);
            }
        }
        header("Location:".base_url."carrito/index");
    }
    public function delete_all(){
        unset($_SESSION['carrito']);
        header("Location:".base_url."carrito/index");
    }
}