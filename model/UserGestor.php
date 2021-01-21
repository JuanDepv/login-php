<?php

require_once 'Model.php';
// require_once '../config/DataBase.php';

class UserGestor extends Model 
{
    public function __construct() {
        $this->con = new DataBase();
    }

    public function getName() {
        try {
            $sql = "SELECT u.id_usuario, u.username FROM usuario u";

            $stmt = $this->con->getConnection()->prepare($sql);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
                } else {
                    return array();
                }
            }
        } catch (PDOException $th) {
            return array(
                'error' => $th->getMessage()
            );
        }
    }

    public function getUsuarios($username = "", $estado =  "") {
        try {

            $condicion = "";

            if($username != "") 
            {
                $condicion .= " WHERE u.username = '$username'";

            } 
            
            if($estado != "") 
            {
                $condicion .= " AND u.estado = $estado";
            }


            $sql = "SELECT u.id_usuario, u.username, u.email, u.rol_id, u.estado, r.nombre as 'rol_usuario' 
                    FROM usuario u
                    INNER JOIN rol r ON r.id_rol = u.rol_id".$condicion."";

            $stmt = $this->con->getConnection()->prepare($sql);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    
                    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
                } else {
                    return array();
                }
            }
        } catch (PDOException $th) {
            return array(
                'error' => $th->getMessage()
            );
        }
    }
}