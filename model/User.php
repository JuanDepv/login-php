<?php

// require_once '../config/DataBase.php';
require_once 'Model.php';

class User extends Model
{
  
  private $username;
  private $email;
  private $password;
  private $id;

  public function __construct()
  {
    parent::__construct();
  }

  function getUsername()
  {
    return $this->username;
  }

  function setUsername($username)
  {
    $this->username = $username;
  }

  function getEmail()
  {
    return $this->email;
  }

  function setEmail($email)
  {
    $this->email = $email;
  }

  function setPassword($password)
  {
    $this->password = $password;
  }

  function getPassword()
  {
    return $this->password;
  }

  function setId($id)
  {
    $this->id = $id;
  }

  function getIdUser()
  {
    return $this->id;
  }

  /**
   * @param string user
   */
  private function validateUser($user)
  {

    $sql = "SELECT * FROM usuario WHERE username LIKE BINARY :username";
    $stmt = $this->con->getConnection()->prepare($sql);

    $user = "%" . $user . "%";
    $stmt->bindParam(":username", $user, PDO::PARAM_STR);

    if ($stmt->execute()) {
      // var_dump($stmt->rowCount());
      if ($stmt->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      die("error al realizar la ejecucion");
    }
  }

  public function validateKey($key)
  {
    $sql = "SELECT id_usuario FROM usuario WHERE recover = :key";
    $stmt = $this->con->getConnection()->prepare($sql);

    $stmt->bindParam(":key", $key, PDO::PARAM_STR);

    if ($stmt->execute()) {
      // var_dump($stmt->rowCount());
      if ($stmt->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      die("error al realizar la ejecucion");
    }
  }

  public function getId($key)
  {
    $response = array();

    $sql = "SELECT id_usuario FROM usuario WHERE recover = :key";
    $stmt = $this->con->getConnection()->prepare($sql);
    $stmt->bindParam(":key", $key, PDO::PARAM_STR);

    if ($stmt->execute()) {
      error_log("ejecucion->" . $stmt->execute());

      if ($stmt->rowCount() > 0) {
        $data = $stmt->fetch();
        return $data;
      } else {
        $response['error'] = "error, internamente!";
        return $response;
      }
    }
  }

  public function getData($correo)
  {
    $response = array();

    $sql = "SELECT id_usuario FROM usuario WHERE email = :email";
    $stmt = $this->con->getConnection()->prepare($sql);
    $stmt->bindParam(":email", $correo, PDO::PARAM_STR);

    if ($stmt->execute()) {
      error_log("ejecucion->" . $stmt->execute());

      if ($stmt->rowCount() > 0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $response['data'] = $data;
        $response['status'] = true;
        return $response;
      } else {
        $response['error'] = "eror, el correo enviado no existe";
        $response['status'] = false;
        return $response;
      }
    }
  }

  public function login()
  {

    // obtenemos los valores
    $username_usuario = $this->getUsername();
    $password_usuario = $this->getPassword();
    $response = array();

    //validamos el usuario
    $sql  = "SELECT u.*, r.nombre as 'rol_usuario' FROM usuario u
             INNER JOIN rol r ON r.id_rol = u.rol_id
             WHERE u.username = ? ";

    $stmt = $this->con->getConnection()->prepare($sql);

    $stmt->bindParam(1, $username_usuario, PDO::PARAM_STR);
    // $stmt->bindValue(2, $password_usuario, PDO::PARAM_STR);

    // validar la ejecucion
    if ($stmt->execute()) {

      error_log("ejecucion->" . json_encode($sql));

      if ($stmt->rowCount() > 0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password_usuario, $data['password'])) {
          $response['data'] = $data;
          $response['status'] = true;
          return $response;
        } else {
          $response['error'] = "Contraseña incorrecta!";
          $response['status'] = false;
          return $response;
        }
      } else {
        $response['error'] = "El usuario ingresado no existe!";
        $response['status'] = false;
        return $response;
      }
    } else {
      $response['error'] = "El al hacer la ejecucion!";
      $response['status'] = false;
      return $response;
    }
  }

  public function registrar()
  {
    $response = array();
    try {
      if (!$this->validateUser($this->getusername())) {

        $password_hash = $this->hashPassword($this->getPassword());
        //realizamos la consulta el usuario
        $sql = "INSERT INTO `usuario` (username, email, password, rol_id, registro) 
                VALUES('{$this->getusername()}', '{$this->getEmail()}', '$password_hash', 2, CURDATE())";

        $stmt = $this->con->getConnection()->prepare($sql);

        // validar la ejecucion
        if ($stmt->execute()) {
          $response['success'] = "usuario registrado correctamente!";
          return $response;
        }
      } else {
        $response['error'] = "El usuaio ya existe, intenta con otro diferente!";
        return $response;
      }
    } catch (PDOException $e) {
      echo "error" . $e->getMessage();
    }
  }

  public function recover()
  {
    $email = $this->getEmail();
    $usuario = $this->getData($email);

    if ($usuario) {

      $key = $this->generateRandomString();

      $sql = "UPDATE usuario SET recover = '$key' ";
      $sql .= "WHERE id_usuario=" . $usuario['data']['id_usuario'] . "";

      error_log("recover->PASS: " . json_encode($sql));

      $stmt = $this->con->getConnection()->query($sql);

      if ($stmt->execute()) {
        return $key;
      }
    } else {
      return $usuario['error'];
    }
  }

  public function UpdatePass()
  {
    try {
      $id_user = $this->getIdUser();
      $password_new = $this->hashPassword($this->getPassword());

      $sql = "UPDATE usuario SET  password = :password WHERE (id_usuario = :id)";

      error_log("update contraseña ->" . json_encode($sql));

      $stmt = $this->con->getConnection()->prepare($sql);
      $stmt->bindParam(":password", $password_new, PDO::PARAM_STR);
      $stmt->bindParam(":id", $id_user, PDO::PARAM_INT);

      if ($stmt->execute()) {
        return [
          'response' => 'correcto',
          'status' => true
        ];
      } else {
        return [
          'response' => 'error',
          'status' => false
        ];
      }
    } catch (PDOException $e) {
      return ["error" => $e->getMessage()];
    }
  }
}


// $user = new User();
// $result = $user->getData('cuadrosc99@gmail.com');
// var_dump($result);
// $user->setEmail('j@gmail.com');
// $result = $user->recover();
// var_dump($result);