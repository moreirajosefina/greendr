<?php

class Usuario
{
private $id;
private $nombre;
private $email;
private $user;
private $pass;
private $avatar;
private $calificacion;

// FUNCION armarUsuario:
// FUNCION modificarUsuario:
function __construct($array)
{
// si usuario se crea desde cero: no hay id seteado y $array es $_POST:
    if ($_POST && !isset($_POST["id"]) && isset($_FILES["avatar"])){

    if (isset($_FILES["avatar"]["error"]) && $_FILES["avatar"]["error"] == 4){
    $ext = "png";
    }elseif (isset($_FILES["avatar"]["error"]) && $_FILES["avatar"]["error"] == 0){
    $ext= pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
    }

    $this->id = null;
    $this->nombre = trim($array["nombre"]);
    $this->email = trim($array["email"]);
    $this->user = trim($array["user"]);
    $this->pass = password_hash($array["pass"], PASSWORD_DEFAULT);
    $this->avatar = "archivos/". trim($array["user"]). "." .$ext;
    $this->calificacion = null;


// si usuario modifica sus datos: hay id seteado y $array es $_POST:
// no alcanza con id seteado, tiene que haber otra condición
} elseif ($_POST && isset($_POST["id"]) && isset($_FILES["avatar"])){

global $dbAll;

// $usuario = $dbAll-> buscarUsuarioPorMailoUser($_SESSION["usuario"]);
$usuario = $dbAll-> buscarUsuarioPorMailoUserArray($_SESSION["usuario"]);

if (strlen($_POST["nPass"]) > 0){
  $this->pass = password_hash($_POST["nPass"], PASSWORD_DEFAULT);
  // por qué no funciona $array["nPass"]?????
} else {
  // $this->pass = $usuario->getPass();
  $this->pass = $usuario["pass"];
}

if ($_FILES["avatar"]["error"] == 0){
  $ext= pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
  // $this->avatar = "archivos/". $usuario->getUser(). "." .$ext;
    $this->avatar = "archivos/". $usuario["user"]. "." .$ext;
} else {
  // $this->avatar = $usuario->getAvatar();
  $this->avatar = $usuario["avatar"];
}

// $this->id = $usuario->getId();
$this->id = $usuario["id"];
$this->nombre = trim($array["nombre"]);
$this->email = trim($array["email"]);
// $this->user = $usuario->getUser();
$this->user = $usuario["user"];
// $this->calificacion = $usuario->getCalificacion();
$this->calificacion = $usuario["calificacion"];


// trae los datos de la base de datos, por ejemplo
// $array = $dbAll-> buscarUsuarioPorMailoUser($_SESSION["usuario"])
} else {

  $this->id = $array["id"];
  $this->nombre = $array["nombre"];
  $this->email = $array["email"];
  $this->user = $array["user"];
  $this->pass = $array["pass"];
  $this->avatar = $array["avatar"];
  $this->calificacion = $array["calificacion"];

}

}
// fin constructor


public function getId()
{
  return $this->id;
}

public function getNombre()
{
  return $this->nombre;
}
public function setNombre($nombre)
{
  $this->nombre = $nombre;
  return $this;
}

public function getEmail()
{
  return $this->email;
}
public function setEmail($email)
{
  $this->email = $email;
  return $this;
}

public function getUser()
{
  return $this->user;
}
public function setUser($user)
{
  $this->user = $user;
  return $this;
}

public function getPass()
{
  return $this->pass;
}
public function setPass($pass)
{
  $this->pass = $pass;
  return $this;
  // cuándo hashea??
}

public function getAvatar()
{
  return $this->avatar;
}
public function setAvatar($avatar)
{
  $this->avatar = $avatar;
  return $this;
}

public function getCalificacion()
{
  return $this->calificacion;
}
public function setCalificacion($calificacion)
{
  $this->calificacion = $calificacion;
  return $this;
}


}

 ?>
