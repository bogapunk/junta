<?php
require "Config2.php";

class Conexion {
    public $cnx;

    public function conectar() {
        try {
            $opciones = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::SQLSRV_ATTR_ENCODING => PDO::SQLSRV_ENCODING_UTF8
            );

            $this->cnx = new PDO(
                "sqlsrv:Server=db;Database=" . BD . ";TrustServerCertificate=true",
                DB_USER,
                PASS,
                $opciones
            );


            return $this->cnx;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function desconectar() {
        $this->cnx = null;
    }

    public function buscar() {
        $this->conectar();

        try {
            $consulta = $this->cnx->prepare("SELECT * FROM usuarios");
            $consulta->execute();

            $this->lista_usuarios = array();
            while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
                $this->lista_usuarios[] = $row;
            }

            $this->desconectar();
            return $this->lista_usuarios;
        } catch (PDOException $e) {
            // Registrar el error de la consulta
            error_log("Error en la consulta: " . $e->getMessage(), 0);
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
}
?>