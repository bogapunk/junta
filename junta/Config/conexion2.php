<?php
require "Config2.php";
class Conexion{
    public $cnx;
    public function conectar2(){
        try {
            $opciones = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
            );
            $this->cnx = new PDO(
                "mysql:host=db;
                dbname=".BD,
                DB_USER, 
                PASS,
                $opciones
               
            );
            return $this->cnx;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function desconectar(){
        $this->cnx = null;
    }

public function buscar(){
        
        $this->_db->conectar2();

        $consulta = $this->_db->cnx->prepare("SELECT * FROM usuarios");

        $consulta->execute();
        
        while($row = $consulta->fetch(PDO::FETCH_OBJ)){
            $this->lista_usuarios[] =$row;
        }

        $this->_db->desconectar2();
        return $this->lista_usuarios;

    }

}