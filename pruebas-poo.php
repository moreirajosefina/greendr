<?php
include "init.php";

$planta = $dbAll->traerUnaPlanta("20");
echo "probando traer una planta:";
var_dump($planta);

$articulo = new Articulo($dbAll->traerUnaPlanta("20"));
echo "probando new articulo:";
var_dump($articulo);


$articulos = traerTodasLasPlantas();
echo "probando traer todas las plantas:";
var_dump($articulos);


// // nuevo constructor articulo:
//
// // array puede ser $_POST (si el articulo se construye desde cero)
// //
// // array puede ser $dbAll->traerUnaPlanta($idPlanta) (si estoy modificando el articulo y lo traigo de la base de datos)
//
// function __construct($array)
// {
//     global $dbAll;
//
//     $usuario = $dbAll-> buscarUsuarioPorMailoUser($_SESSION["usuario"]);
//
//     $str_replace = [' ','"'];
//
//
//     if (!isset($array["id"])) {
//     // si NO está setado $array "id", entonces el articulo se está creando desde cero:
//
//     $id = $dbAll-> siguienteID("articulos");
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
//
//       $this->id = null;
//       $this->nombre = strtoupper(trim($array["nombre"]));
//       $this->n_cientifico = trim($array["n_cientifico"]);
//       $this->id_categoria = $array["categoria"];
//       $this->descripcion = trim($array["descripcion"]);
//       $this->imagen1 = $rutaImagen1;
//       $this->imagen2 = $rutaImagen2;
//       $this->imagen3 = $rutaImagen3;
//       $this->id_usuario = $usuario["id"];
//       $this->disponible = "si";
//
//     } else {
// // arranca código para modificar un articulo existente
//
// $idPlanta = $array["id"];
//
// if ($_FILES["imagen1"]["error"] == 4){
//   $rutaImagen1 = $array["imagen1"];
// } else {
//   $ext1= pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
//   $rutaImagen1 = "archivos/". $idPlanta . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_1" . "." . $ext1;
// }
//
// if ($_FILES["imagen2"]["error"] == 4){
//   $rutaImagen2 = $array["imagen2"];
// } else {
//   $ext2= pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
//   $rutaImagen2 = "archivos/". $idPlanta . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_2" . "." . $ext2;
// }
//
// if ($_FILES["imagen3"]["error"] == 4){
//   $rutaImagen3 = $array["imagen3"];
// } else {
//   $ext3= pathinfo($_FILES["imagen3"]["name"], PATHINFO_EXTENSION);
//   $rutaImagen3 = "archivos/". $idPlanta . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_3" . "." . $ext3;
// }
//     $this->id = $array["id"];
//     $this->nombre = strtoupper(trim($_POST["nombre"]));
//     $this->n_cientifico = trim($_POST["n_cientifico"]);
//     $this->id_categoria = $_POST["categoria"];
//     $this->descripcion = trim($_POST["descripcion"]);
//     $this->imagen1 = $rutaImagen1;
//     $this->imagen2 = $rutaImagen2;
//     $this->imagen3 = $rutaImagen3;
//     $this->id_usuario = $usuario["id"];
//     $this->disponible = "si";
//
//     }
// }
// // fin función nueva constructora
//
//



 ?>
