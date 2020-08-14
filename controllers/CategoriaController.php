<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';
class categoriaController{
    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        require_once 'views/categoria/index.php';
    }
    public function ver(){       
        if(isset($_GET['id']) && $_GET['id'] != ""){
            
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);
            $cat = $categoria->getCategoria();     
            // Conseguir productos
            $producto = new Producto(); 
            $producto->setCategoria_id($id);
            $productos = $producto->getAllByCategory();

            require_once 'views/categoria/ver.php';
        }else{
            header("Location:".base_url.'categoria/index');
        }
        
    }
    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST)){            
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
            if($nombre){
                $categoria = new Categoria();
                $categoria->setNombre($nombre);
                $result = $categoria->save();
                if($result){
                    echo "nada";
                }else{
                    echo "nada";
                }
            }else{
                echo "nada";
            }
        }else{
            echo "nada";
        }
        header("Location: ".base_url."categoria/index");
    }
}