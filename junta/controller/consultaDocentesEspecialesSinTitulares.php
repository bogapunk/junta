<?php
require "../Config/conexionSqlServer.php";

class Consulta3{
    private $_db;
    private  $lista_DocentesEspecialesSinTitulares;

    public function __construct(){
        $this->_db = new Conexion();
        
    }

    public function buscarDocentesEspecialesSinTitulares(){
         
        $this->_db->conectar();


        $consulta = $this->_db->cnx->prepare("SELECT * FROM DocentesEspecialesSINTITULARES ORDER by Total DESC ");

        $consulta->execute();

        while($row = $consulta->fetch(PDO::FETCH_OBJ)){
            $this->lista_DocentesEspecialesSinTitulares[] =$row;
        }

        $this->_db->desconectar();
        return $this->lista_DocentesEspecialesSinTitulares;

    }

}