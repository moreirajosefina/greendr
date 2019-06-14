<?php

class Articulo
{
private $id;
private $nombre;
private $n_cientifico;
private $imagen1;
private $imagen2;
private $imagen3;
private $descripcion;
private $disponible;
private $id_usuario; //Objeto Usuario
private $id_categoria; //Objeto Categoria
private $id_punto;

// FUNCION armarArticulo:
// function __construct($array)
// {
//     global $dbAll;
//     $usuario = $dbAll-> buscarUsuarioPorMailoUser($_SESSION["usuario"]);
//
//     $id = $dbAll-> siguienteID("articulos");
//
//     $str_replace = [' ','"'];
//
//     $ext1= pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
//     $rutaImagen1 = "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_1" . "." . $ext1;
//
//     if ($_FILES["imagen2"]["error"] == 4){
//       $rutaImagen2 = "null";
//     } else {
//         $ext2= pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
//         $rutaImagen2 = "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_2" . "." . $ext2;
//     }
//
//     if ($_FILES["imagen3"]["error"] == 4){
//       $rutaImagen3 = "null";
//     } else {
//       $rutaImagen3 = "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_3" . "." . $ext3;
//     }
//
//     if (isset($array["id"])){
//       $this->id = $array["id"];
//     } else {
//       $this->id = null;
//     }
//
//       $this->nombre = strtoupper(trim($array["nombre"]));
//       $this->n_cientifico = trim($array["n_cientifico"]);
//       $this->id_categoria = $array["categoria"];
//       $this->descripcion = trim($array["descripcion"]);
//       $this->imagen1 = $rutaImagen1;
//       $this->imagen2 = $rutaImagen2;
//       $this->imagen3 = $rutaImagen3;
//       $this->id_usuario = $usuario["id"];
//       $this->disponible = "si";
// }


// nuevo constructor articulo:

// array puede ser $_POST (si el articulo se construye desde cero)
//
// array puede ser $dbAll->traerUnaPlanta($idPlanta) (si estoy modificando el articulo y lo traigo de la base de datos)

function __construct($array)
{
    global $dbAll;


    $str_replace = [' ','"'];


    if (!isset($array["id"])) {
    // si NO está setado $array "id", entonces el articulo se está creando desde cero:

    $id = $dbAll-> siguienteID("articulos");

    $ext1= pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
    $rutaImagen1 = "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_1" . "." . $ext1;

    if ($_FILES["imagen2"]["error"] == 4){
      $rutaImagen2 = "null";
    } else {
        $ext2= pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
        $rutaImagen2 = "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_2" . "." . $ext2;
    }

    if ($_FILES["imagen3"]["error"] == 4){
      $rutaImagen3 = "null";
    } else {
      $rutaImagen3 = "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_3" . "." . $ext3;
    }

      $usuario = $dbAll-> buscarUsuarioPorMailoUser($_SESSION["usuario"]); //tiene que retornar un Objeto Usuario.

      $this->id = null;
      $this->nombre = strtoupper(trim($array["nombre"]));
      $this->n_cientifico = trim($array["n_cientifico"]);
      $this->id_categoria = $array["categoria"];
      $this->descripcion = trim($array["descripcion"]);
      $this->imagen1 = $rutaImagen1;
      $this->imagen2 = $rutaImagen2;
      $this->imagen3 = $rutaImagen3;
      $this->id_usuario = $usuario; //Un objeto usuario;
      $this->disponible = "si";

    } else {
// arranca código para modificar un articulo existente

$idPlanta = $array["id"];

if (isset($_FILES["imagen1"]["error"]) && $_FILES["imagen1"]["error"] == 4){
  $rutaImagen1 = $array["imagen1"];
} elseif (isset($_FILES["imagen1"]["error"]) && $_FILES["imagen1"]["error"] == 0) {
  $ext1= pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
  $rutaImagen1 = "archivos/". $idPlanta . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_1" . "." . $ext1;
}

if (isset($_FILES["imagen2"]["error"]) && $_FILES["imagen2"]["error"] == 4){
  $rutaImagen2 = $array["imagen2"];
} elseif (isset($_FILES["imagen2"]["error"]) && $_FILES["imagen1"]["error"] == 0) {
  $ext2= pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
  $rutaImagen2 = "archivos/". $idPlanta . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_2" . "." . $ext2;
}

if (isset($_FILES["imagen1"]["error"]) && $_FILES["imagen3"]["error"] == 4){
  $rutaImagen3 = $array["imagen3"];
} elseif (isset($_FILES["imagen3"]["error"]) && $_FILES["imagen1"]["error"] == 0){
  $ext3= pathinfo($_FILES["imagen3"]["name"], PATHINFO_EXTENSION);
  $rutaImagen3 = "archivos/". $idPlanta . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_3" . "." . $ext3;
}
    $this->id = $array["id"];
    $this->nombre = strtoupper(trim($_POST["nombre"]));
    $this->n_cientifico = trim($_POST["n_cientifico"]);
    $this->id_categoria = $_POST["categoria"];
    $this->descripcion = trim($_POST["descripcion"]);
    $this->imagen1 = $rutaImagen1;
    $this->imagen2 = $rutaImagen2;
    $this->imagen3 = $rutaImagen3;
    $this->id_usuario = $usuario["id"];
    $this->disponible = "si";

    }
}
// fin función nueva constructora





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

public function getNcientifico()
{
  return $this->n_cientifico;
}
public function setNcientifico($n_cientifico)
{
  $this->n_cientifico = $n_cientifico;
  return $this;
}

public function getImagen1()
{
  return $this->imagen1;
}
public function setImagen1($imagen1)
{
  $this->imagen1 = $imagen1;
  return $this;
}

public function getImagen2()
{
  return $this->imagen2;
}
public function setImagen2($imagen2)
{
  $this->imagen2 = $imagen2;
  return $this;
}

public function getImagen3()
{
  return $this->imagen3;
}
public function setImagen3($imagen3)
{
  $this->imagen3 = $imagen3;
  return $this;
}

public function getDescripcion()
{
  return $this->descripcion;
}
public function setDescripcion($descripcion)
{
  $this->descripcion = $descripcion;
  return $this;
}

public function getDisponible()
{
  return $this->disponible;
}
public function setDisponible($disponible)
{
  $this->disponible = $disponible;
  return $this;
}

public function getId_usuario()
{
  return $this->id_usuario;
}
public function setId_usuario($id_usuario)
{
  $this->id_usuario = $id_usuario;
  return $this;
}

public function getId_categoria()
{
  return $this->id_categoria;
}
public function setId_categoria($id_categoria)
{
  $this->id_categoria = $id_categoria;
  return $this;
}

public function getId_punto()
{
  return $this->id_punto;
}
public function setId_punto($id_punto)
{
  $this->id_punto = $id_punto;
  return $this;
}





}
 ?>
