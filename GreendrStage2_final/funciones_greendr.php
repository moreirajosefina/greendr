
<?php

session_start();

function validar($datos){
// $ datos va a ser igual a $ POST
// Esta función entrega detalle errores, NO datos

$caracteresOK = [' ', 'ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü'];
// $caracteresOKuser = ['ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü']; user es el nombre de archivo, no debe tener ñ o acentos
$errores = [];
$datosFixed = [];

foreach ($datos as $key => $value) {
  $datosFixed[$key] = trim($value);
}

if (strlen($datosFixed["nombreCompleto"]) == 0){
  $errores["nombreCompleto"]="* El campo 'Nombre y apellido' debe estar completo.";
} elseif (ctype_alpha(str_replace($caracteresOK,'',  $datosFixed["nombreCompleto"]))  == false){
  $errores["nombreCompleto"] = "* El nombre y apellido no deben contener caracteres especiales ni números.";
}

if (strlen($datosFixed["email"]) == 0){
  $errores["email"]="* El campo E-mail debe estar completo.";
} elseif (!filter_var($datosFixed["email"], FILTER_VALIDATE_EMAIL)){
  $errores["email"]="* El e-mail debe ser válido.";
}

if (strlen($datosFixed["user"]) == 0){
  $errores["user"]="* El campo Usuario debe estar completo.";
} elseif (ctype_alnum($datosFixed["user"]) == false){
  $errores["user"] = "* El nombre de usuario no debe contener caracteres especiales, acentos, ñ, ni espacios.";
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

$json = file_get_contents("db.json");
$array = json_decode($json, true);
if($array !== null){
foreach ($array as $key => $value) {
  foreach ($value as $value2) {
    if ($value2["email"] == $datosFixed["email"]){
      $errores["email"]="* Este e-mail ya se encuentra registrado.";
    }
    if ($value2["user"] == $datosFixed["user"]){
      $errores["user"]="* Nombre de usuario no disponible.";
    }
  }
}
}

// debug
// echo "errores";
// var_dump ($errores);
// echo "datosFixed";
// var_dump ($datosFixed);
// fin debug

  return $errores;
}

function nextId(){
  $json = file_get_contents("db.json");
  $array = json_decode($json, true);
  if (isset($array["usuarios"])){
  $ultimoUsuario = array_pop($array["usuarios"]);
  $lastId = $ultimoUsuario["id"];

  return $lastId + 1;

}else{
  return 1;
}
}

function armarUsuario(){
  if ($_FILES["avatar"]["error"] == 4){
  $ext = "png";
  }else{
  $ext= pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
}
  return[
    "id" => nextId(),
    "nombre" => trim($_POST["nombreCompleto"]),
    "email" => trim($_POST["email"]),
    "user" => trim($_POST["user"]),
    "pass" => password_hash($_POST["pass"], PASSWORD_DEFAULT),
    "avatar" => "archivos/". trim($_POST["user"]). "." .$ext,
  ];
}

function modificarUsuario(){
  $usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);
  $ext= pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);

  if (strlen($_POST["nPass"]) > 0 && $_FILES["avatar"]["error"] == 0 ){
  return[
  "id" => $usuario["id"],
  "nombre" => trim($_POST["nombreCompleto"]),
  "email" => trim($_POST["email"]),
  "user" => $usuario["user"],
  "pass" => password_hash($_POST["nPass"], PASSWORD_DEFAULT),
  "avatar" => "archivos/". $usuario["user"]. "." .$ext,
  ];
} elseif (strlen($_POST["nPass"]) == 0 && $_FILES["avatar"]["error"] !== 0 ){
return[
  "id" => $usuario["id"],
  "nombre" => trim($_POST["nombreCompleto"]),
  "email" => trim($_POST["email"]),
  "user" => $usuario["user"],
  "pass" => $usuario["pass"],
  "avatar" => $usuario["avatar"],
  ];
} elseif (strlen($_POST["nPass"]) > 0 && $_FILES["avatar"]["error"] !== 0 ){
return[
  "id" => $usuario["id"],
  "nombre" => trim($_POST["nombreCompleto"]),
  "email" => trim($_POST["email"]),
  "user" => $usuario["user"],
  "pass" => password_hash($_POST["nPass"], PASSWORD_DEFAULT),
  "avatar" => $usuario["avatar"],
  ];
} elseif (strlen($_POST["nPass"]) == 0 && $_FILES["avatar"]["error"] == 0 ){
return[
  "id" => $usuario["id"],
  "nombre" => trim($_POST["nombreCompleto"]),
  "email" => trim($_POST["email"]),
  "user" => $usuario["user"],
  "pass" => $usuario["pass"],
  "avatar" => "archivos/". $usuario["user"]. "." .$ext,
  ];
}
}


function guardarUsuario($usuario){
  $json = file_get_contents("db.json");
  $array = json_decode($json, true);

  $array["usuarios"][] = $usuario;
  $array = json_encode($array, JSON_PRETTY_PRINT);

  file_put_contents("db.json", $array);
}


function guardarUsuarioModificado($usuario){
  $json = file_get_contents("db.json");
  $array = json_decode($json, true);

  $array["usuarios"][$usuario["id"]-1] = $usuario;
  $array = json_encode($array, JSON_PRETTY_PRINT);

  file_put_contents("db.json", $array);
}


function buscarUsuarioPorMailoUser($emailoUser){
  $json = file_get_contents("db.json");
  $array = json_decode($json, true);
if($array !== null){
  foreach($array["usuarios"] as $usuario){
    if($usuario["email"] == $emailoUser || $usuario["user"] == $emailoUser){
      // debug
      // var_dump($usuario);
      // fin dedug
      return $usuario;
    }
  }
}else{
  return null;
}
}

function existeUsuario($emailoUser){
  return buscarUsuarioPorMailoUser($emailoUser) !== null;
}


function existeCookie($emailoUser){
$usuario = buscarUsuarioPorMailoUser($emailoUser);
  if ($usuario["user"] == $_COOKIE[$usuario["id"]]["user"] || $usuario["email"] == $_COOKIE[$usuario["id"]]["user"]){
    // debug
    // echo $_COOKIE[$usuario["id"]]["user"];
  return !null;
  }
}


function validarLogin($datos){
// $datos va a ser igual a $ POST

$errores = [];

if (strlen(trim($datos["logUser"])) == 0 || strlen($datos["logPass"]) == 0){
  $errores["logUser"]="* Completar ambos campos.";
} elseif (!existeUsuario(trim($datos["logUser"]))){
$errores["logUser"]="* Nombre de usuario, e-mail o contraseña errónea.";
} elseif ((existeUsuario($datos["logUser"]))) {
  $usuario = buscarUsuarioPorMailoUser($datos["logUser"]);
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


function loguearUsuario($emailoUser){
  $_SESSION["usuario"] = $emailoUser;
}

function siguienteSession ($emailoUser){
    setcookie("ultimoUsuario", $emailoUser);
}

function usuarioLogueado(){
   return isset($_SESSION["usuario"]);
}

function traerUsuarioLogueado(){
  // Si está logueado trae los datos del usuario
  if(isset($_SESSION["usuario"])) {
    $usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);
    return $usuario;
  } else {
    // Sino: FALSE
    return false;
  }
}


function recordarme(){
  if (isset($_POST["recordarme"]) && $_POST["recordarme"] == "si"){
    $usuario=traerUsuarioLogueado();
    setcookie($usuario["id"].'[user]', $_POST["logUser"]);
  }
}

function dejarDeRecordarme (){
  if (isset($_POST["recordarme"]) && $_POST["recordarme"] == "no"){
    $usuario=traerUsuarioLogueado();
    setcookie($usuario["id"].'[user]', "", -1);
    setcookie("ultimoUsuario", "", -1);
  }
}


function validarPerfil($datos){
// $ datos va a ser igual a $ POST
// Esta función entrega detalle errores, NO datos

$caracteresOK = [' ', 'ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü'];
// $caracteresOKuser = ['ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü']; user es el nombre de archivo, no debe tener ñ o acentos
$errores = [];
$datosFixed = [];

foreach ($datos as $key => $value) {
  $datosFixed[$key] = trim($value);
}

if (strlen($datosFixed["nombreCompleto"]) == 0){
  $errores["nombreCompleto"]="* El campo 'Nombre y apellido' debe estar completo.";
} elseif (ctype_alpha(str_replace($caracteresOK,'',  $datosFixed["nombreCompleto"]))  == false){
  $errores["nombreCompleto"] = "* El nombre y apellido no deben contener caracteres especiales ni números.";
}

if (strlen($datosFixed["email"]) == 0){
  $errores["email"]="* El campo E-mail debe estar completo.";
} elseif (!filter_var($datosFixed["email"], FILTER_VALIDATE_EMAIL)){
  $errores["email"]="* El e-mail debe ser válido.";
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

if (strlen($_POST["nPass"]) > 0 && strlen($_POST["nPass"]) < 5) {
  $errores["nPass"]="* La nueva contraseña debe tener como mínimo 5 caracteres.";
}

if (strlen($_POST["nPass"]) > 0 && strlen($_POST["nPass2"]) == 0){
  $errores["nPass2"]="* Por favor repetir la nueva contraseña.";
} elseif ($_POST["nPass"] !== $_POST["nPass2"]){
  $errores["nPass"]="* Las nuevas contraseñas no coinciden.";
}

if (strlen($_POST["pass"]) == 0){
  $errores["pass"]="* El campo Contraseña debe estar completo.";
}

elseif (existeUsuario($_SESSION["usuario"])) {
  $usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);
  if(!password_verify($_POST["pass"], $usuario["pass"])){
    $errores["pass"]="Contraseña errónea.";
}
}

// VALIDAR MAILS YA EXISTENTES:

$json = file_get_contents("db.json");
$array = json_decode($json, true);

$usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);

if($array !== null){
foreach ($array as $key => $value) {
  foreach ($value as $value2) {

    if ($datosFixed["email"] !== $usuario["email"] && $value2["email"] == $datosFixed["email"]){
      $errores["email"]="* Este e-mail ya se encuentra registrado.";
    }
  }
}
}

// debug
// echo "errores";
// var_dump ($errores);
// echo "datosFixed";
// var_dump ($datosFixed);
// fin debug

  return $errores;
}


// PENDIENTE

// login en 2 pasos

// si dbjson no existe

// forgot password

// borrar cuenta

// agregar botón recordarme al registro

 ?>
