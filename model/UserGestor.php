<?php

require_once 'Model.php';
// require_once '../config/DataBase.php';

class UserGestor extends Model
{
    public function __construct()
    {
        parent::__construct();
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
                    CASE
                        WHEN u.estado = 1 THEN 'activo'
                        ELSE 'inactivo'
                    END as estado, 
                    r.nombre as 'rol_usuario',
                    u.registro
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

    public function updateUser($data) 
    {
        try {

            if(!$this->validate('email', $data['email']) || !$this->validate('username', $data['username'])) {
                
                $sql = "UPDATE usuario
                        SET username = :username,
                            email = :email,
                            rol_id = :rol_id
                        WHERE id_usuario = :id";           
            

                // echo $sql;exit;
                $stmt = $this->con->getConnection()->prepare($sql);
                $stmt->bindParam(":username", $data['username'], PDO::PARAM_STR);
                $stmt->bindParam(":email", $data['email'], PDO::PARAM_STR);
                $stmt->bindParam(":rol_id", $data['rol'], PDO::PARAM_INT);
                $stmt->bindParam(":id", $data['id_usuario'], PDO::PARAM_INT);

                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        return array(
                            'success' => true,
                            'msg' => 'usuario editado'
                        );
                    } else {
                        return array(
                            'success' => false,
                            'msg' => 'error al editar'
                        );
                    }
                }
            }else {
                return array(
                    "success" => false,
                    "msg" => 'el correo o usuario ya existe, intenta con otro diferente!'
                );
            }
        } catch (PDOException $th) {
            return array(
                'success' => false,
                'error' => $th->getMessage()
            );
        }
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

    public function uploadNameImage($data) 
    {
        try {
            $sql = "UPDATE usuario
                    SET imagen_url = :imagen
                    WHERE id_usuario = :id";

            $stmt = $this->con->getConnection()->prepare($sql);
            $stmt->bindParam(":imagen", $data['imagen_url'], PDO::PARAM_STR);
            $stmt->bindParam(":id", $data['id_usuario'], PDO::PARAM_INT);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    return array(
                        'success' => true,
                        'message' => 'vuelve a iniciar sesion!'
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
}