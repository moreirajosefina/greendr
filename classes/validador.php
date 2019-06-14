<?php

class Validador {

public static function validar($datos){
// VALIDA LOS DATOS INGRESADOS EN EL FORMULARIO DE REGISTRO
// $ datos va a ser igual a $ POST
// Esta función entrega detalle errores, NO datos

global $dbAll;

$caracteresOK = [' ', 'ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü'];

$errores = [];
$datosFixed = [];

foreach ($datos as $key => $value) {
  $datosFixed[$key] = trim($value);
}

if (strlen($datosFixed["nombre"]) == 0){
  $errores["nombre"]="* El campo 'Nombre y apellido' debe estar completo.";
} elseif (ctype_alpha(str_replace($caracteresOK,'',  $datosFixed["nombre"]))  == false){
  $errores["nombre"] = "* El nombre y apellido no deben contener caracteres especiales ni números.";
}

if (strlen($datosFixed["email"]) == 0){
  $errores["email"]="* El campo E-mail debe estar completo.";
} elseif (!filter_var($datosFixed["email"], FILTER_VALIDATE_EMAIL)){
  $errores["email"]="* El e-mail debe ser válido.";
} elseif ($dbAll->existeUsuario($datosFixed["email"])){
  $errores["email"]="* Este e-mail ya se encuentra registrado.";
}

if (strlen($datosFixed["user"]) == 0){
  $errores["user"]="* El campo Usuario debe estar completo.";
} elseif (ctype_alnum($datosFixed["user"]) == false){
  $errores["user"] = "* El nombre de usuario no debe contener caracteres especiales, acentos, ñ, ni espacios.";
} elseif ($dbAll->existeUsuario($datosFixed["user"])){
  $errores["user"]="* Nombre de usuario no disponible.";
}

if (strlen($datosFixed["pass"]) == 0){
  $errores["pass"]="* El campo Contraseña debe estar completo.";
} elseif (strlen($datosFixed["pass"]) < 5) {
  $errores["pass"]="* La Contraseña debe tener como mínimo 5 caracteres.";
}

if (strlen($datosFixed["pass2"]) == 0){
  $errores["pass2"]="* Por favor repetir la contraseña.";
} elseif ($datosFixed["pass"] !== $datosFixed["pass2"]){
  $errores["pass"]="* Las contraseñas no coinciden.";
}

if($_FILES["avatar"]["error"] !== 0 && $_FILES["avatar"]["error"] !== 4){
  $errores["avatar"]["error"] ="* Imagen de perfil: error. Volver a subirla.";
}
if ($_FILES["avatar"]["size"] >= 2097152) {
  $errores["avatar"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
}
$ext = pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION);
if ($_FILES["avatar"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
  $errores["avatar"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
}

// VALIDAR USUARIOS o MAILS YA EXISTENTES:

// $json = file_get_contents("db.json");
// $array = json_decode($json, true);
// if($array !== null){
// foreach ($array as $key => $value) {
//   foreach ($value as $value2) {
//     if ($value2["email"] == $datosFixed["email"]){
//       $errores["email"]="* Este e-mail ya se encuentra registrado.";
//     }
//     if ($value2["user"] == $datosFixed["user"]){
//       $errores["user"]="* Nombre de usuario no disponible.";
//     }
//   }
// }
// }


// global $db;

// chau global $db
// si en registro.php está incluido el init.php
// y el init.php tiene adentro $dbAll = new DbMysql
// entonces está trayendo $this->connection CUALQUIERAAAAAJJAJAAJJAJAJAJAJAJJAJAJAJBUUUUUAAAAAAAAA

// FUE COMO FUNCION A dbMysql.php
// public function existeMail($email)
// global $dbAll;
//
// $stmt = $dbAll->prepare("SELECT * FROM usuarios WHERE email=:email");
//
// $email = $datosFixed["email"];
//
// $stmt-> bindValue(":email", $email);
//
// $stmt->execute();
// $resultado_email = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
// if ($resultado_email){
//   $errores["email"]="* Este e-mail ya se encuentra registrado.";
// }

// var_dump($resultado_email);
// exit;

// FUE COMO FUNCION A dbMysql.php
// public function existeUsuario($usuario)
// $stmt = $dbAll->prepare("SELECT * FROM usuarios WHERE user=:usuario");
//
// $usuario = $datosFixed["user"];
//
// $stmt-> bindValue(":usuario", $usuario);
//
// $stmt->execute();
// $resultado_user = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
// if ($resultado_user){
//   $errores["user"]="* Nombre de usuario no disponible.";
// }

// var_dump($resultado_user);
// exit;

// global $dbAll;
//
// if ($dbAll->existeMail($datosFixed["email"])){
//   $errores["email"]="* Este e-mail ya se encuentra registrado.";
// }

// if ($dbAll->existeUsuario($datosFixed["user"])){
//   $errores["user"]="* Nombre de usuario no disponible.";
// }


// debug
// echo "errores";
// var_dump ($errores);
// echo "datosFixed";
// var_dump ($datosFixed);
// fin debug

  return $errores;
}


public static function validarLogin($datos){
// VALIDA LOS DATOS INGRESADOS EN EL FORMULARIO DE LOGIN
// $datos va a ser igual a $ POST

global $dbAll;

$errores = [];

if (strlen(trim($datos["logUser"])) == 0 || strlen($datos["logPass"]) == 0){
  $errores["logUser"]="* Completar ambos campos.";
} elseif (!$dbAll->existeUsuario(trim($datos["logUser"]))){
$errores["logUser"]="* Nombre de usuario, e-mail o contraseña errónea.";
} elseif ($dbAll->existeUsuario($datos["logUser"])) {
  $usuario = $dbAll-> buscarUsuarioPorMailoUser($datos["logUser"]);
  if(!password_verify($datos["logPass"], $usuario["pass"])){
    $errores["logUser"]="* Nombre de usuario, e-mail o contraseña errónea.";
}
}
// debug
// echo "errores loginUsuario:";
// var_dump ($errores);
// fin debug

return $errores;
}

public static function validarSubidaArticulo($datos){
// VALIDA LOS DATOS INGRESADOS EN EL FORMULARIO DE SUBIDA DE ARTICULO/PLANTA
// $ datos va a ser igual a $ POST
// Esta función entrega detalle errores, NO datos

$caracteresOK = [' ', 'ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü','"', "'"];

$errores = [];
$datosFixed = [];

foreach ($datos as $key => $value) {
  $datosFixed[$key] = trim($value);
}

if (strlen($datosFixed["nombre"]) == 0){
  $errores["nombre"]="* El campo 'Nombre' debe estar completo.";
} elseif (ctype_alpha(str_replace($caracteresOK,'',  $datosFixed["nombre"]))  == false){
  $errores["nombre"] = "* El nombre no debe contener caracteres especiales ni números.";
}

if (strlen($datosFixed["n_cientifico"]) == 0){
  $errores["n_cientifico"]="* El campo 'Nombre científico' debe estar completo.";
} elseif (ctype_alpha(str_replace($caracteresOK,'',  $datosFixed["n_cientifico"]))  == false){
  $errores["n_cientifico"] = "* El nombre científico no debe contener caracteres especiales ni números.";
}

if (!isset($_POST["categoria"])){
    $errores["categoria"]="* Elegir una categoría.";
}


if($_FILES["imagen1"]["error"] == 4){
  $errores["imagen1"]["error"] ="* Subir al menos una imagen de la planta";
}
if ($_FILES["imagen1"]["size"] >= 2097152) {
  $errores["imagen1"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
}
$ext = pathinfo($_FILES["imagen1"]["name"],PATHINFO_EXTENSION);
if ($_FILES["imagen1"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
  $errores["imagen1"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
}

if($_FILES["imagen2"]["error"] !== 0 && $_FILES["imagen2"]["error"] !== 4){
  $errores["imagen2"]["error"] ="* Imagen: error. Volver a subirla.";
}
if ($_FILES["imagen2"]["size"] >= 2097152) {
  $errores["imagen2"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
}
$ext = pathinfo($_FILES["imagen2"]["name"],PATHINFO_EXTENSION);
if ($_FILES["imagen2"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
  $errores["imagen2"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
}

if($_FILES["imagen3"]["error"] !== 0 && $_FILES["imagen3"]["error"] !== 4){
  $errores["imagen3"]["error"] ="* Imagen: error. Volver a subirla.";
}
if ($_FILES["imagen3"]["size"] >= 2097152) {
  $errores["imagen3"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
}
$ext = pathinfo($_FILES["imagen3"]["name"],PATHINFO_EXTENSION);
if ($_FILES["imagen3"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
  $errores["imagen3"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
}


// FALTA VALIDACION PUNTO DE ENCUENTRO



// debug
// echo "errores";
// var_dump ($errores);
// echo "datosFixed";
// var_dump ($datosFixed);
// fin debug

  return $errores;
}

public static function validarModificionArticulo($datos){
// $ datos va a ser igual a $ POST
// Esta función entrega detalle errores, NO datos

$caracteresOK = [' ', 'ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü','"', "'"];

$errores = [];
$datosFixed = [];

foreach ($datos as $key => $value) {
  $datosFixed[$key] = trim($value);
}

if (strlen($datosFixed["nombre"]) == 0){
  $errores["nombre"]="* El campo 'Nombre' debe estar completo.";
} elseif (ctype_alpha(str_replace($caracteresOK,'',  $datosFixed["nombre"]))  == false){
  $errores["nombre"] = "* El nombre no debe contener caracteres especiales ni números.";
}

if (strlen($datosFixed["n_cientifico"]) == 0){
  $errores["n_cientifico"]="* El campo 'Nombre científico' debe estar completo.";
} elseif (ctype_alpha(str_replace($caracteresOK,'',  $datosFixed["n_cientifico"]))  == false){
  $errores["n_cientifico"] = "* El nombre científico no debe contener caracteres especiales ni números.";
}

if (!isset($_POST["categoria"])){
    $errores["categoria"]="* Elegir una categoría.";
}


if($_FILES["imagen1"]["error"] !== 0 && $_FILES["imagen1"]["error"] !== 4){
  $errores["imagen1"]["error"] ="* Imagen: error. Volver a subirla.";
}
if ($_FILES["imagen1"]["size"] >= 2097152) {
  $errores["imagen1"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
}
$ext = pathinfo($_FILES["imagen1"]["name"],PATHINFO_EXTENSION);
if ($_FILES["imagen1"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
  $errores["imagen1"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
}

if($_FILES["imagen2"]["error"] !== 0 && $_FILES["imagen2"]["error"] !== 4){
  $errores["imagen2"]["error"] ="* Imagen: error. Volver a subirla.";
}
if ($_FILES["imagen2"]["size"] >= 2097152) {
  $errores["imagen2"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
}
$ext = pathinfo($_FILES["imagen2"]["name"],PATHINFO_EXTENSION);
if ($_FILES["imagen2"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
  $errores["imagen2"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
}

if($_FILES["imagen3"]["error"] !== 0 && $_FILES["imagen3"]["error"] !== 4){
  $errores["imagen3"]["error"] ="* Imagen: error. Volver a subirla.";
}
if ($_FILES["imagen3"]["size"] >= 2097152) {
  $errores["imagen3"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
}
$ext = pathinfo($_FILES["imagen3"]["name"],PATHINFO_EXTENSION);
if ($_FILES["imagen3"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
  $errores["imagen3"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
}


// FALTA VALIDACION PUNTO DE ENCUENTRO



// debug
// echo "errores";
// var_dump ($errores);
// echo "datosFixed";
// var_dump ($datosFixed);
// fin debug

  return $errores;
}




}
 ?>
