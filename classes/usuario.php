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
function __construct($array)
{
  if (isset($_FILES["avatar"]["error"]) && $_FILES["avatar"]["error"] == 4){
  $ext = "png";
  }elseif (isset($_FILES["avatar"]["error"]) && $_FILES["avatar"]["error"] == 0){
  $ext= pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
  }
  // hace falta isset $_FILES?? sí señor

  if (isset($array["id"])){
    $this->id = $array["id"];
    $this->pass = $array["pass"];
    $this->avatar = $array["avatar"];
    $this->calificacion = $array["calificacion"];
  } else {
    $this->id = null;
    $this->pass = password_hash($array["pass"], PASSWORD_DEFAULT);
    $this->avatar = "archivos/". trim($array["user"]). "." .$ext;
    $this->calificacion = null;
  }

  $this->nombre = trim($array["nombre"]);
  // $this->nombre = trim($array["nombreCompleto"]); si queda nombreCompleto $array solo puede ser $_POST. Cambiar nombreCompleto en todos los formularios (se modificó en registro.php y perfil.php)
  $this->email = trim($array["email"]);
  $this->user = trim($array["user"]);

}


public function getId($id)
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
