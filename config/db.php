<?php
class DataBase{
    public static function connect(){
        $db = new mysqli('localhost','root','','tienda_master');
        $db->query("SET_NAMES 'utf8'");
        return $db;
    }
}