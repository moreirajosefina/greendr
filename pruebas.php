<?php

include ("funciones_greendr.php");

echo "$ session";
echo "<br>";
var_dump($_SESSION);

$usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);

var_dump($usuario);
echo "<br>";

$traerUsuario = traerUsuarioLogueado();
echo "traer usuario";
echo "<br>";
var_dump($traerUsuario);

echo "<br>";
echo " usuario[user]";
echo $usuario["user"];
echo "<br>";

echo "<br>";
echo " usuario[id]";
echo $usuario["id"];
echo "<br>";

// echo "json";
// $json = file_get_contents("db.json");
// $array = json_decode($json, true);

// $usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);
// var_dump($array);

echo "probando funcion siguienteID: ";
$id = siguienteID("articulos");
echo $id;
echo "<br>";

echo "probando traer un articulo:";
echo "<br>";

global $db;
$stmt = $db->prepare("SELECT * FROM articulos
WHERE id=13");

$stmt->execute();

$art = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($art);

echo "probando funcion traerPlantas:";
echo "<br>";

$id = $traerUsuario["id"];
$plantas = traerPlantas($id);
var_dump($plantas);

echo $traerUsuario["id"];

// PRUEBAS armarArticuloModificado ORIGINAL
// 
// function armarArticuloModificado($idPlanta){
//
// $planta = traerUnaPlanta($idPlanta);
//
//   // $usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);
//
//     // $id = siguienteID("articulos");
//     $str_replace = [' ','"'];
//
//     if ($_FILES["imagen1"]["error"] == 4 && $_FILES["imagen2"]["error"] == 4 && $_FILES["imagen3"]["error"] == 4){
// // imagen 1 queda igual
// // imagen 2 queda igual
// // imagen 3 queda igual
//     return[
//       "id" => $planta["id"],
//       "nombre" => strtoupper(trim($_POST["nombre"])),
//       "n_cientifico" => trim($_POST["n_cientifico"]),
//       "categoria" => $_POST["categoria"],
//       "descripcion" => trim($_POST["descripcion"]),
//       "imagen1" => $planta["imagen1"],
//       "imagen2" => $planta["imagen2"],
//       "imagen3" => $planta["imagen3"],
//       // "id_usuario" => $usuario["id"],
//       // "disponible" => "si",
//     ];
//   }elseif ($_FILES["imagen2"]["error"] == 4 && $_FILES["imagen3"]["error"] == 4){
// // imagen 1 cambia
// // imagen 2 queda igual
// // imagen 3 queda igual
//     $ext1= pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
//
//     return[
//       "id" => $planta["id"],
//       "nombre" => strtoupper(trim($_POST["nombre"])),
//       "n_cientifico" => trim($_POST["n_cientifico"]),
//       "categoria" => $_POST["categoria"],
//       "descripcion" => trim($_POST["descripcion"]),
//       "imagen1" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_1" . "." . $ext1,
//       "imagen2" => $planta["imagen2"],
//       "imagen3" => $planta["imagen3"],
//       // "id_usuario" => $usuario["id"],
//       // "disponible" => "si",
//     ];
//   }elseif ($_FILES["imagen2"]["error"] == 0 && $_FILES["imagen3"]["error"] == 4){
// // imagen 1 cambia
// // imagen 2 cambia
// // imagen 3 queda igual
//     $ext1= pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
//     $ext2= pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
//
//     return[
//       "id" => $planta["id"],
//       "nombre" => strtoupper(trim($_POST["nombre"])),
//       "n_cientifico" => trim($_POST["n_cientifico"]),
//       "categoria" => $_POST["categoria"],
//       "descripcion" => trim($_POST["descripcion"]),
//       "imagen1" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_1" . "." . $ext1,
//       "imagen2" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_2" . "." . $ext2,
//       "imagen3" => $planta["imagen3"],
//       // "id_usuario" => $usuario["id"],
//       // "disponible" => "si",
//     ];
//   }elseif($_FILES["imagen2"]["error"] == 4 && $_FILES["imagen3"]["error"] == 0){
// // imagen 1 cambia
// // imagen 2 queda igual
// // imagen 3 cambia
//     $ext1= pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
//     $ext3= pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
//
//     return[
//       "id" => $planta["id"],
//       "nombre" => strtoupper(trim($_POST["nombre"])),
//       "n_cientifico" => trim($_POST["n_cientifico"]),
//       "categoria" => $_POST["categoria"],
//       "descripcion" => trim($_POST["descripcion"]),
//       "imagen1" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_1" . "." . $ext1,
//       "imagen2" => $planta["imagen2"],
//       "imagen3" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_3" . "." . $ext3,
//       // "id_usuario" => $usuario["id"],
//       // "disponible" => "si",
//     ];
//   }else{
// // imagen 1 cambia
// // imagen 2 cambia
// // imagen 3 cambia
//     $ext1= pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
//     $ext2= pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
//     $ext3= pathinfo($_FILES["imagen3"]["name"], PATHINFO_EXTENSION);
//
//     return[
//       "id" => $planta["id"],
//       "nombre" => strtoupper(trim($_POST["nombre"])),
//       "n_cientifico" => trim($_POST["n_cientifico"]),
//       "categoria" => $_POST["categoria"],
//       "descripcion" => trim($_POST["descripcion"]),
//       "imagen1" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_1" . "." . $ext1,
//       "imagen2" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_2" . "." . $ext2,
//       "imagen3" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_3" . "." . $ext3,
//       // "id_usuario" => $usuario["id"],
//       // "disponible" => "si",
//     ];
//
//   }
//   }



 ?>
