<?php 
class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $image;
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

    public function getNombre(){
        return $this->nombre;       
    }
    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
        return $this;
    }

    public function getApellidos(){
        return  $this->apellidos;
    }
    public function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
        return $this;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
        return $this;
    }

    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password = $this->db->real_escape_string($password);
        return $this;
    }

    public function getRol(){
        return $this->rol;
    }
    public function setRol($rol){
        $this->rol = $rol;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image){
        $this->image = $image;
        return $this;
    }

    public function save(){
        $hash = password_hash($this->getPassword(), PASSWORD_BCRYPT, ['cost' => 4]);
        $sql = "INSERT INTO usuarios VALUES (NULL,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','$hash','user',null);";        
        $save = $this->db->query($sql);
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function login(){
        $sql = "SELECT * FROM usuarios WHERE email='{$this->getEmail()}'";
        $login = $this->db->query($sql);
        $result = false;
        
        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();
            // Verificar la contraseña            
            $verify = password_verify($this->getPassword(), $usuario->password);  
            if($verify){
                $result = $usuario;
            }            
        }
        return $result;        
    }
}