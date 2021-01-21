<?php

class DataBase
{
    private $host = "localhost:3306";
    private $db_name = "test";
    private $db_user = "root";
    private $db_pass = "1234";
    private $conn;

    public function getConnection()
    {
        try {
            $this->conn = new PDO("mysql:dbname=".$this->db_name . ";host=" . $this->host, $this->db_user, $this->db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch (PDOException $e) {
            echo "Error en la conexion: " . $e->getMessage();
        }

        // print_r($this->conn);
        // var_dump($this->conn);
        return $this->conn;
    }

}