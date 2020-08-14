<?php 
class Pedido{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getUsuario_id(){
        return $this->usuario_id;
    }
    public function setUsuario_id($usuario_id){
        $this->usuario_id = $this->db->real_escape_string($usuario_id);
        return $this;
    }

    public function getProvincia(){
        return $this->provincia;
    }
    public function setProvincia($provincia){
        $this->provincia = $this->db->real_escape_string($provincia);
        return $this;
    }
 
    public function getLocalidad(){
        return $this->localidad;
    }
    public function setLocalidad($localidad){
        $this->localidad = $this->db->real_escape_string($localidad);
        return $this;
    }

    public function getDireccion(){
        return $this->direccion;
    }
    public function setDireccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);
        return $this;
    }

    public function getCoste(){
        return $this->coste;
    }
    public function setCoste($coste){
        $this->coste = $this->db->real_escape_string($coste);
        return $this;
    }

    public function getEstado(){
        return $this->estado;
    }
    public function setEstado($estado){
        $this->estado = $this->db->real_escape_string($estado);
        return $this;
    }

    public function getFecha(){
        return $this->fecha;
    }
    public function setFecha($fecha){
        $this->fecha = $this->db->real_escape_string($fecha);
        return $this;
    }

    public function getHora(){
        return $this->hora;
    }
    public function setHora($hora){
        $this->hora = $this->db->real_escape_string($hora);
        return $this;
    }
    
    public function getPedido(){
        $sql = "SELECT * FROM pedidos WHERE id={$this->getId()};";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getPedidoByUser(){
        $sql = "SELECT p.id,p.coste FROM pedidos p"
            ." WHERE p.usuario_id={$this->getUsuario_id()} ORDER BY id DESC LIMIT 1;";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }
    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p"
            ." WHERE p.usuario_id={$this->getUsuario_id()} ORDER BY id DESC;";
        $pedido = $this->db->query($sql);
        return $pedido;
    }

    public function getProductosByPedido($id){
        $sql = "SELECT p.*,lp.unidades FROM lineas_pedidos lp"
            ." INNER JOIN productos p ON lp.producto_id = p.id"
            ." WHERE lp.pedido_id={$id};";            
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getAll(){
        $sql = "SELECT * FROM pedidos ORDER BY id DESC;";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function save(){      
        $sql = "INSERT INTO pedidos VALUES (NULL,{$this->getUsuario_id()},'{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()},'confirm',CURDATE(),CURTIME());";        
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }
    public function save_linea(){ 
        $sql= "SELECT LAST_INSERT_ID() as 'pedido';"    ;
        
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach($_SESSION['carrito'] as $indice => $elemento){

            $producto= $elemento['producto'];
            $sql_insert = "INSERT INTO lineas_pedidos VALUES(NULL,{$pedido_id},{$producto->id},{$elemento['unidades']})";
            $save = $this->db->query($sql_insert);

        }

        $result = false;
        if($save){
            $result = true;
        }
        return $result;

    }
    public function updateOne(){
        $sql = "UPDATE pedidos SET estado='{$this->getEstado()}'"
        ." WHERE id = {$this->getId()};";     
         
        $save = $this->db->query($sql);
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }
}