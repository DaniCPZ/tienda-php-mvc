<?php
require_once 'models/pedido.php';
class pedidoController{
    public function hacer(){
        require_once 'views/pedido/hacer.php';
    }
    public function add(){
        
        if(isset($_SESSION['identity'])){            
            if(isset($_POST)){
                $pedido = new Pedido();
                $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
                $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
                $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
                
                if($provincia && $localidad && $direccion){
                    $usuario_id = $_SESSION['identity']->id;
                    $stats = Utils::statsCarrito();
                    $coste = $stats['total'];

                    $pedido->setProvincia($provincia);
                    $pedido->setLocalidad($localidad);
                    $pedido->setDireccion($direccion);
                    $pedido->setUsuario_id($usuario_id);
                    $pedido->setCoste($coste);
                    $result = $pedido->save();
                    
                    $save_linea = $pedido->save_linea();
                    if($result && $save_linea){
                        $_SESSION['pedido'] = 'complete';
                    }else{
                        $_SESSION['pedido'] = 'failed';
                    }
                }else{
                    $_SESSION['pedido'] = 'failed';
                }
                header("Location:".base_url.'pedido/confirmado');  
            }else{
                header("Location:".base_url.'pedido/hacer');            
            }
        }else{
            header("Location:".base_url);  
        }
    }
    public function confirmado(){
        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();

            $pedido->setUsuario_id($identity->id);
            $last_pedido = $pedido->getPedidoByUser();
            
            $productos = $pedido->getProductosByPedido($last_pedido->id);
            require_once 'views/pedido/confirmado.php';
        }
        
    }
    public function mis_pedidos(){
        Utils::isIdentity();
        $pedido = new Pedido();
        $usuario_id = $_SESSION['identity']->id;

        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();

        require_once 'views/pedido/mis_pedidos.php';
    }
    public function detalle(){
        Utils::isIdentity();
        if(isset($_GET['id'])){
            $pedido = new Pedido();
            $pedido_id = $_GET['id'];
            $pedido->setId($pedido_id);
            $detalle_pedido = $pedido->getPedido();
            $productos = $pedido->getProductosByPedido($detalle_pedido->id);
            require_once 'views/pedido/detalle.php';
        }else{
            header("Location:".base_url."pedido/mis_pedidos"); 
        }
    }
    public function gestion(){
        Utils::isAdmin();
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        $gestion =true;

        require_once 'views/pedido/mis_pedidos.php';
    }
    public function estado(){
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            $estado = $_POST['estado'] ;
            $id = $_POST['pedido_id'];

            $pedido = new Pedido();
            
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedidos = $pedido->updateOne();
            header("Location:".base_url."pedido/detalle&id=".$id); 
        }else{
            header("Location:".base_url); 
        }
        
    }
}