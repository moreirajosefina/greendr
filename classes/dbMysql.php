<?php

class DbMysql extends Db
{

  public $connection;

  function __construct()
  {
    //Gestionar la conexión a DB
    $dsn = "mysql:host=127.0.0.1;dbname=greendr_db;port=3306";
    $user = "root";
    $pass = "root";

    try {
        //$db = new PDO($dsn, $user, $pass);
      $this->connection = new PDO($dsn, $user, $pass);
      //le dice a la db que muestre los errores en PHP.
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //echo "todo bien.";
    } catch (\Exception $e) {
      echo "Hubo un error. <br>";
      echo $e->getMessage();
      exit;
    }
  }

// GUARDA UN USUARIO NUEVO EN LA DB:
 public function guardarUsuario(Usuario $usuario)
 {
  $stmt = $this->connection->prepare("INSERT into usuarios VALUES
  (default, :nombre, :email, :usuario, :avatar, :pass, null)");

  $stmt-> bindValue(":nombre", $usuario->getNombre());
  $stmt-> bindValue(":email", $usuario->getEmail());
  $stmt-> bindValue(":usuario", $usuario->getUser());
  $stmt-> bindValue(":avatar", $usuario->getAvatar());
  $stmt-> bindValue(":pass", $usuario->getPass());

  $stmt->execute();
  }


// GUARDA UN USUARIO MODIFICADO EN LA DB:
public function guardarUsuarioModificado($usuario){

  // global $db;
  $nombre_usuario = $usuario->getUser();

  $stmt = $this->connection->prepare("UPDATE usuarios
    SET nombre = :nombre,
    email = :email,
    avatar = :avatar,
    pass = :pass
    WHERE user = '$nombre_usuario'");

  $stmt-> bindValue(":nombre", $usuario->getNombre());
  $stmt-> bindValue(":email", $usuario->getEmail());
  $stmt-> bindValue(":avatar", $usuario->getAvatar());
  $stmt-> bindValue(":pass", $usuario->getPass());

  $stmt->execute();
}

// BUSCA UN USUARIO EN LA DB, POR MAIL O POR USER. SI EXISTE, RETORNA UN OBJETO USUARIO
public function buscarUsuarioPorMailoUser($emailoUser)
{
// global $db;
$stmt = $this->connection->prepare("SELECT * FROM usuarios WHERE user=:usuario OR email=:email");

$stmt-> bindValue(":usuario", $emailoUser);
$stmt-> bindValue(":email", $emailoUser);

$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario){
  // return $usuario;
  $usuario = new Usuario($usuario);
  return $usuario;
}else{
  return null;
}
}

// BUSCA UN USUARIO EN LA DB, POR MAIL O POR USER. SI EXISTE, RETORNA UN ARRAY DEL USUARIO. ES UN PARCHE PARA EL CONSTRUCTOR DE USUARIO
public function buscarUsuarioPorMailoUserArray($emailoUser)
{
// global $db;
$stmt = $this->connection->prepare("SELECT * FROM usuarios WHERE user=:usuario OR email=:email");

$stmt-> bindValue(":usuario", $emailoUser);
$stmt-> bindValue(":email", $emailoUser);

$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario){
  // return $usuario;
  // $usuario = new Usuario($usuario);
  return $usuario;
}else{
  return null;
}
}

// BUSCA UN USUARIO EN LA DB, POR ID. RETORNA UN OBJETO USUARIO
// AGREGAR INNER JOIN ARTICULOS??
public function buscarUsuarioPorId($id){

  // global $db;

  $stmt = $this->connection->prepare("SELECT * FROM usuarios
WHERE id = $id");

  $stmt->execute();

  $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

  // return $usuario;
  $usuario = new Usuario($usuario);
  return $usuario;

}

public function existeUsuario($emailoUser){
  return $this->buscarUsuarioPorMailoUser($emailoUser) !== null;
}

public function traerUsuarioLogueado(){
  // Si está logueado trae los datos del usuario
  if(isset($_SESSION["usuario"])) {
    $usuario = $this-> buscarUsuarioPorMailoUser($_SESSION["usuario"]);
    // return $usuario;
    return $usuario;
  } else {
    // Sino: FALSE
    return false;
  }
}

public function siguienteID($tabla){

  // global $db;
  $stmt = $this->connection->prepare("SELECT id FROM $tabla
ORDER BY id DESC LIMIT 1");

  $stmt->execute();

  $id = $stmt->fetch(PDO::FETCH_ASSOC);

  return $id["id"] + 1;
}

// BUSCA TODOS LOS ARTICULOS EN LA DB. RETORNA UN ARRAY
public function traerTodasLasPlantas(){

  // global $db;

  $stmt = $this->connection->prepare("SELECT articulos.id, articulos.nombre, n_cientifico, imagen1, imagen2, imagen3, descripcion, disponible, id_usuario, id_punto, categorias.nombre AS categoria
  FROM articulos
  INNER JOIN categorias ON articulos.id_categoria = categorias.id
  WHERE disponible='si'");

  $stmt->execute();

  $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // return $articulos;
  // $articulos = new Articulo($articulos);
  // WARNINg!!
  return $articulos;

}

// BUSCA TODOS LOS ARTICULOS DE DETERMINADO USUARIO EN LA DB. RETORNA UN ARRAY
public function traerPlantas($usuarioID){

  // global $db;

  $stmt = $this->connection->prepare("SELECT articulos.id, articulos.nombre, n_cientifico, imagen1, imagen2, imagen3, descripcion, disponible, id_usuario, id_punto, categorias.nombre AS categoria
  FROM articulos
  INNER JOIN categorias ON articulos.id_categoria = categorias.id
  WHERE id_usuario=$usuarioID");

  $stmt->execute();

  $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $articulos;

}

// BUSCA UN ARTICULO POR ID EN LA DB. RETORNA UN ARRAY
public function traerUnaPlanta($articuloID){

  // global $db;

  $stmt = $this->connection->prepare("SELECT articulos.id, articulos.nombre, n_cientifico, imagen1, imagen2, imagen3, descripcion, disponible, id_usuario, usuarios.user AS user, id_punto, categorias.nombre AS categoria, avatar, email
  FROM articulos
  INNER JOIN categorias ON articulos.id_categoria = categorias.id
  INNER JOIN usuarios ON articulos.id_usuario = usuarios.id
  WHERE articulos.id=$articuloID");

  $stmt->execute();

  $articulos = $stmt->fetch(PDO::FETCH_ASSOC);

  return $articulos;

}


// GUARDA UN ARTICULO NUEVO EN LA BASE DE DATOS:
public function guardarArticulo(Articulo $articulo){

// global $db;

$stmt = $this->connection->prepare("INSERT into articulos VALUES
(default, :nombre, :n_cientifico, :imagen1, :imagen2, :imagen3, :descripcion, :disponible, :id_usuario, :id_categoria, null)");


$stmt-> bindValue(":nombre", $articulo->getNombre());
$stmt-> bindValue(":n_cientifico", $articulo->getNcientifico());
$stmt-> bindValue(":imagen1", $articulo->getImagen1());
$stmt-> bindValue(":imagen2", $articulo->getImagen2());
$stmt-> bindValue(":imagen3", $articulo->getImagen3());
$stmt-> bindValue(":descripcion", $articulo->getDescripcion());
$stmt-> bindValue(":disponible", $articulo->getDisponible());
$stmt-> bindValue(":id_usuario", $articulo->getId_usuario()->getId());
$stmt-> bindValue(":id_categoria", $articulo->getId_categoria());

// $stmt-> bindValue(":id_punto", "pendiente");

$stmt->execute();
}

// GUARDA UN ARTICULO MODIFICADO EN LA BASE DE DATOS:
public function guardarArticuloModificado($articuloModificado){
  // global $db;

  // $id = $articuloModificado["id"];
  $id = $articuloModificado->getId();

  $stmt = $this->connection->prepare("UPDATE articulos
    SET nombre = :nombre,
    n_cientifico = :n_cientifico,
    id_categoria = :id_categoria,
    descripcion = :descripcion,
    imagen1 = :imagen1,
    imagen2 = :imagen2,
    imagen3 = :imagen3
    WHERE id = $id");

  $stmt-> bindValue(":nombre", $articuloModificado-> getNombre());
  $stmt-> bindValue(":n_cientifico", $articuloModificado-> getNcientifico());
  $stmt-> bindValue(":imagen1", $articuloModificado-> getImagen1());
  $stmt-> bindValue(":imagen2", $articuloModificado->getImagen2());
  $stmt-> bindValue(":imagen3", $articuloModificado->getImagen3());
  $stmt-> bindValue(":descripcion", $articuloModificado->getDescripcion());
  $stmt-> bindValue(":id_categoria", $articuloModificado->getId_categoria());

  // $stmt-> bindValue(":id_punto", "pendiente");

  $stmt->execute();
}

}
 ?>
