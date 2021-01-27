<?php

require_once 'Model.php';
// require_once '../config/DataBase.php';

class UserGestor extends Model
{
    public function __construct()
    {
        $this->con = new DataBase();
    }

    public function getName()
    {
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

    public function getUser($id)
    {
        try {

            $sql = "SELECT 
                    u.id_usuario, 
                    u.username, 
                    u.email,
                    u.rol_id, 
                    u.estado, 
                    r.nombre as 'rol_usuario' 
                    FROM usuario u
                    INNER JOIN rol r ON r.id_rol = u.rol_id
                    WHERE u.id_usuario = $id";

            $stmt = $this->con->getConnection()->prepare($sql);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function getUsers($id, $estado)
    {
        try {
            $condicion = "";

            if ($id != "") {
                $condicion .= " WHERE u.id_usuario = '$id'";
            }

            if ($estado != "") {
                $condicion .= " AND u.estado = $estado";
            }

            $sql = "SELECT 
                    u.id_usuario, 
                    u.username, 
                    u.email,
                    u.rol_id, 
                    u.estado, 
                    r.nombre as 'rol_usuario' 
                    FROM usuario u
                    INNER JOIN rol r ON r.id_rol = u.rol_id" . $condicion . "";

            // echo $sql;exit;
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

    public function updateUser() 
    {

    }

    public function getRol() 
    {
        try {
            $sql = "SELECT
                    r.id_rol,
                    r.nombre as 'rol_usuario' 
                    FROM rol r";

            // echo $sql;exit;
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

    public function updataState($id, $estado)
    {
        try {
            $sql = "";
            if($estado == 0) {
                $sql .= "UPDATE usuario
                        SET estado = 1
                        WHERE id_usuario = :id";           
            }
            
            if($estado == 1) {
                $sql .= "UPDATE usuario
                        SET estado = 0
                        WHERE id_usuario = :id";
            }

            // echo $sql;exit;
            $stmt = $this->con->getConnection()->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    return array(
                        'success' => true
                    );
                } else {
                    return array(
                        'error' => 'error'
                    );
                }
            }
        } catch (PDOException $th) {
            return array(
                'error' => $th->getMessage()
            );
        }
    }

    public function uploadNameImage($image) {}
}