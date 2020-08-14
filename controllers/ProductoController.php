<?php
require_once 'models/producto.php';
class productoController{
    public function index(){
        // Conseguir productos
        $producto = new Producto();
        $productos = $producto->getAll();
        require_once 'views/producto/destacados.php';
    }
    public function ver(){       
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setid($id);

            $product = $producto->getProduct();

            require_once 'views/producto/ver.php';

        }else{
            header("Location:".base_url.'producto/gestion');
        }
    }
    public function gestion(){
        Utils::isAdmin();        
        $producto = new Producto();
        $productos = $producto->getAll();
        require_once 'views/producto/gestion.php';
    }

    public function crear(){
        Utils::isAdmin(); 
        require_once 'views/producto/crear.php';
    }
    public function save(){
        Utils::isAdmin(); 
        if(isset($_POST)){ 

            $producto = new Producto();
            
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : null;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : null;
            $imagen = null;
            // GUARDAR LA IMAGEN
            if(isset($_FILES['imagen'])){
                $file = $_FILES['imagen'];
                $file_name = $file['name'];
                $mimetype = $file['type'];
                if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){
                    if(!is_dir('uploads/images')){
                        mkdir('uploads/images', 0777, true);
                    }
                    move_uploaded_file($file['tmp_name'],'uploads/images/'.$file_name);
                    $producto->setImagen($file_name);
                    $imagen = true;
                }
            }
           
            //$oferta = isset($_POST['oferta']) ? $_POST['oferta'] : null;
            //$imagen = isset($_POST['imagen']) ? $_POST['imagen'] : null;

            if($categoria && $nombre && $descripcion && $precio && $stock){
                $producto->setCategoria_id($categoria);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                if(isset($_GET['id'])){
                    $id =$_GET['id'];
                    $producto->setId($id);
                    $result = $producto->edit();
                   
                }else{
                    $result = $producto->save();

                }
                

                if($result){
                   $_SESSION['producto'] = 'complete';
                }else{
                    $_SESSION['producto'] = 'failed';
                }
            }else{
                $_SESSION['producto'] = 'failed';
            }
        }else{
            $_SESSION['producto'] = 'failed';            
        }
        header("Location:".base_url.'producto/gestion');
    }
    public function editar(){
        Utils::isAdmin(); 
       
        if(isset($_GET['id'])){
            $edit=true;
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setid($id);

            $product = $producto->getProduct();
           
            if(isset($product)){
                /*
                if($result){
                    $_SESSION['delete'] = 'complete';
                }else{
                    $_SESSION['delete'] = 'failed';
                }*/
                require_once 'views/producto/crear.php';
            }
        }else{
            header("Location:".base_url.'producto/gestion');
        }

        
    }
    public function eliminar(){
        Utils::isAdmin(); 
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setid($id);
            $result = $producto->delete();
            if($result){
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }
        }else{
            $_SESSION['delete'] = 'failed';
        }
        header("Location:".base_url.'producto/gestion');
    }
}