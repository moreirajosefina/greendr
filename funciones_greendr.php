
<?php

include "pdo.php";

session_start();

// VA A VALIDADOR
// function validar($datos){
// // $ datos va a ser igual a $ POST
// // Esta función entrega detalle errores, NO datos
//
// $caracteresOK = [' ', 'ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü'];
// // $caracteresOKuser = ['ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü']; user es el nombre de archivo, no debe tener ñ o acentos
// $errores = [];
// $datosFixed = [];
//
// foreach ($datos as $key => $value) {
//   $datosFixed[$key] = trim($value);
// }
//
// if (strlen($datosFixed["nombreCompleto"]) == 0){
//   $errores["nombreCompleto"]="* El campo 'Nombre y apellido' debe estar completo.";
// } elseif (ctype_alpha(str_replace($caracteresOK,'',  $datosFixed["nombreCompleto"]))  == false){
//   $errores["nombreCompleto"] = "* El nombre y apellido no deben contener caracteres especiales ni números.";
// }
//
// if (strlen($datosFixed["email"]) == 0){
//   $errores["email"]="* El campo E-mail debe estar completo.";
// } elseif (!filter_var($datosFixed["email"], FILTER_VALIDATE_EMAIL)){
//   $errores["email"]="* El e-mail debe ser válido.";
// }
//
// if (strlen($datosFixed["user"]) == 0){
//   $errores["user"]="* El campo Usuario debe estar completo.";
// } elseif (ctype_alnum($datosFixed["user"]) == false){
//   $errores["user"] = "* El nombre de usuario no debe contener caracteres especiales, acentos, ñ, ni espacios.";
// }
//
// if (strlen($datosFixed["pass"]) == 0){
//   $errores["pass"]="* El campo Contraseña debe estar completo.";
// } elseif (strlen($datosFixed["pass"]) < 5) {
//   $errores["pass"]="* La Contraseña debe tener como mínimo 5 caracteres.";
// }
//
// if (strlen($datosFixed["pass2"]) == 0){
//   $errores["pass2"]="* Por favor repetir la contraseña.";
// } elseif ($datosFixed["pass"] !== $datosFixed["pass2"]){
//   $errores["pass"]="* Las contraseñas no coinciden.";
// }
//
// if($_FILES["avatar"]["error"] !== 0 && $_FILES["avatar"]["error"] !== 4){
//   $errores["avatar"]["error"] ="* Imagen de perfil: error. Volver a subirla.";
// }
// if ($_FILES["avatar"]["size"] >= 2097152) {
//   $errores["avatar"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
// }
// $ext = pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION);
// if ($_FILES["avatar"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
//   $errores["avatar"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
// }
//
// // VALIDAR USUARIOS o MAILS YA EXISTENTES:
//
// // $json = file_get_contents("db.json");
// // $array = json_decode($json, true);
// // if($array !== null){
// // foreach ($array as $key => $value) {
// //   foreach ($value as $value2) {
// //     if ($value2["email"] == $datosFixed["email"]){
// //       $errores["email"]="* Este e-mail ya se encuentra registrado.";
// //     }
// //     if ($value2["user"] == $datosFixed["user"]){
// //       $errores["user"]="* Nombre de usuario no disponible.";
// //     }
// //   }
// // }
// // }
//
// global $db;
//
// $stmt = $db->prepare("SELECT * FROM usuarios WHERE email=:email");
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
//
// // var_dump($resultado_email);
// // exit;
//
// global $db;
//
// $stmt = $db->prepare("SELECT * FROM usuarios WHERE user=:usuario");
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
//
// // var_dump($resultado_user);
// // exit;
//
// // debug
// // echo "errores";
// // var_dump ($errores);
// // echo "datosFixed";
// // var_dump ($datosFixed);
// // fin debug
//
//   return $errores;
// }



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


// VA A LA CLASE USUARIO EN FORMA DE CONSTRUCTOR
// function armarUsuario(){
//   if ($_FILES["avatar"]["error"] == 4){
//   $ext = "png";
//   }else{
//   $ext= pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
// }
//   return[
//     // "id" => nextId(),
//     "nombre" => trim($_POST["nombreCompleto"]),
//     "email" => trim($_POST["email"]),
//     "user" => trim($_POST["user"]),
//     "pass" => password_hash($_POST["pass"], PASSWORD_DEFAULT),
//     "avatar" => "archivos/". trim($_POST["user"]). "." .$ext,
//   ];
// }


// VA A usuario.php COMO PARTE DEL CONSTRUCTOR
// function modificarUsuario(){
//   $usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);
//   $ext= pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
//
//   if (strlen($_POST["nPass"]) > 0 && $_FILES["avatar"]["error"] == 0 ){
//   return[
//   // "id" => $usuario["id"],
//   "nombre" => trim($_POST["nombreCompleto"]),
//   "email" => trim($_POST["email"]),
//   "user" => $usuario["user"],
//   "pass" => password_hash($_POST["nPass"], PASSWORD_DEFAULT),
//   "avatar" => "archivos/". $usuario["user"]. "." .$ext,
//   ];
// } elseif (strlen($_POST["nPass"]) == 0 && $_FILES["avatar"]["error"] !== 0 ){
// return[
//   // "id" => $usuario["id"],
//   "nombre" => trim($_POST["nombreCompleto"]),
//   "email" => trim($_POST["email"]),
//   "user" => $usuario["user"],
//   "pass" => $usuario["pass"],
//   "avatar" => $usuario["avatar"],
//   ];
// } elseif (strlen($_POST["nPass"]) > 0 && $_FILES["avatar"]["error"] !== 0 ){
// return[
//   // "id" => $usuario["id"],
//   "nombre" => trim($_POST["nombreCompleto"]),
//   "email" => trim($_POST["email"]),
//   "user" => $usuario["user"],
//   "pass" => password_hash($_POST["nPass"], PASSWORD_DEFAULT),
//   "avatar" => $usuario["avatar"],
//   ];
// } elseif (strlen($_POST["nPass"]) == 0 && $_FILES["avatar"]["error"] == 0 ){
// return[
//   // "id" => $usuario["id"],
//   "nombre" => trim($_POST["nombreCompleto"]),
//   "email" => trim($_POST["email"]),
//   "user" => $usuario["user"],
//   "pass" => $usuario["pass"],
//   "avatar" => "archivos/". $usuario["user"]. "." .$ext,
//   ];
// }
// }
//
// // VA PRIMERO A db.php COMO FUNCION ABSTRACTA
// // Y DESPUES A dbMysql.php con el código de mySql
// // ARMAR UN dbJson.php con el código de jason
// // function guardarUsuario($usuario){
// //   // $json = file_get_contents("db.json");
// //   // $array = json_decode($json, true);
// //   //
// //   // $array["usuarios"][] = $usuario;
// //   // $array = json_encode($array, JSON_PRETTY_PRINT);
// //   //
// //   // file_put_contents("db.json", $array);
// //
// // global $db;
// //
// // $stmt = $db->prepare("INSERT into usuarios VALUES
// // (default, :nombre, :email, :usuario, :avatar, :pass, null)");
// //
// // $stmt-> bindValue(":nombre", $usuario["nombre"]);
// // $stmt-> bindValue(":email", $usuario["email"]);
// // $stmt-> bindValue(":usuario", $usuario["user"]);
// // $stmt-> bindValue(":avatar", $usuario["avatar"]);
// // $stmt-> bindValue(":pass", $usuario["pass"]);
// //
// // $stmt->execute();
// // }

// VA A dbMysql.php
// function guardarUsuarioModificado($usuario){
//   // $json = file_get_contents("db.json");
//   // $array = json_decode($json, true);
//   //
//   // $array["usuarios"][$usuario["id"]-1] = $usuario;
//   // $array = json_encode($array, JSON_PRETTY_PRINT);
//   //
//   // file_put_contents("db.json", $array);
//
//   global $db;
//   $n_usuario = $usuario["user"];
//
//   $stmt = $db->prepare("UPDATE usuarios
//     SET nombre = :nombre,
//     email = :email,
//     avatar = :avatar,
//     pass = :pass
//     WHERE user = '$n_usuario'");
//
//   $stmt-> bindValue(":nombre", $usuario["nombre"]);
//   $stmt-> bindValue(":email", $usuario["email"]);
//   $stmt-> bindValue(":avatar", $usuario["avatar"]);
//   $stmt-> bindValue(":pass", $usuario["pass"]);
//
//   $stmt->execute();
// }


// VA A dbMysql.php
// function buscarUsuarioPorMailoUser($emailoUser){
// //   $json = file_get_contents("db.json");
// //   $array = json_decode($json, true);
// // if($array !== null){
// //   foreach($array["usuarios"] as $usuario){
// //     if($usuario["email"] == $emailoUser || $usuario["user"] == $emailoUser){
// //       // debug
// //       // var_dump($usuario);
// //       // fin dedug
// //       return $usuario;
// //     }
// //   }
// // }else{
// //   return null;
// // }
//
// global $db;
// $stmt = $db->prepare("SELECT * FROM usuarios WHERE user=:usuario OR email=:email");
//
// $stmt-> bindValue(":usuario", $emailoUser);
// $stmt-> bindValue(":email", $emailoUser);
//
// $stmt->execute();
//
// $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
//
// if ($usuario){
//   return $usuario;
// }else{
//   return null;
// }
// }

// VA A dbMysql.php
// function existeUsuario($emailoUser){
//   return buscarUsuarioPorMailoUser($emailoUser) !== null;
// }


function existeCookie($emailoUser){
$usuario = buscarUsuarioPorMailoUser($emailoUser);
  if ($usuario["user"] == $_COOKIE[$usuario["id"]]["user"] || $usuario["email"] == $_COOKIE[$usuario["id"]]["user"]){
    // debug
    // echo $_COOKIE[$usuario["id"]]["user"];
  return !null;
  }
}

// VA A validador.php
// function validarLogin($datos){
// // $datos va a ser igual a $ POST
//
// $errores = [];
//
// if (strlen(trim($datos["logUser"])) == 0 || strlen($datos["logPass"]) == 0){
//   $errores["logUser"]="* Completar ambos campos.";
// } elseif (!existeUsuario(trim($datos["logUser"]))){
// $errores["logUser"]="* Nombre de usuario, e-mail o contraseña errónea.";
// } elseif ((existeUsuario($datos["logUser"]))) {
//   $usuario = buscarUsuarioPorMailoUser($datos["logUser"]);
//   if(!password_verify($datos["logPass"], $usuario["pass"])){
//     $errores["logUser"]="* Nombre de usuario, e-mail o contraseña errónea.";
// }
// }
// // debug
// // echo "errores loginUsuario:";
// // var_dump ($errores);
// // fin debug
//
// return $errores;
// }

// VA A auth.php
// function loguearUsuario($emailoUser){
//   $_SESSION["usuario"] = $emailoUser;
// }


// VA A auth.php
// function siguienteSession ($emailoUser){
//     setcookie("ultimoUsuario", $emailoUser);
// }

// VA A auth.php
// function usuarioLogueado(){
//    return isset($_SESSION["usuario"]);
// }

// VA A dbMysql.php
// function traerUsuarioLogueado(){
//   // Si está logueado trae los datos del usuario
//   if(isset($_SESSION["usuario"])) {
//     $usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);
//     return $usuario;
//   } else {
//     // Sino: FALSE
//     return false;
//   }
// }

// VA A auth.php
// function recordarme(){
//   if (isset($_POST["recordarme"]) && $_POST["recordarme"] == "si"){
//     $usuario=traerUsuarioLogueado();
//     setcookie($usuario["id"].'[user]', $_POST["logUser"]);
//   }
// }

// VA A auth.php
// function dejarDeRecordarme (){
//   if (isset($_POST["recordarme"]) && $_POST["recordarme"] == "no"){
//     $usuario=traerUsuarioLogueado();
//     setcookie($usuario["id"].'[user]', "", -1);
//     setcookie("ultimoUsuario", "", -1);
//   }
// }

// VA A validador.php
// function validarPerfil($datos){
// // $ datos va a ser igual a $ POST
// // Esta función entrega detalle errores, NO datos
//
// $caracteresOK = [' ', 'ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü'];
// // $caracteresOKuser = ['ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü']; user es el nombre de archivo, no debe tener ñ o acentos
// $errores = [];
// $datosFixed = [];
//
// foreach ($datos as $key => $value) {
//   $datosFixed[$key] = trim($value);
// }
//
// if (strlen($datosFixed["nombreCompleto"]) == 0){
//   $errores["nombreCompleto"]="* El campo 'Nombre y apellido' debe estar completo.";
// } elseif (ctype_alpha(str_replace($caracteresOK,'',  $datosFixed["nombreCompleto"]))  == false){
//   $errores["nombreCompleto"] = "* El nombre y apellido no deben contener caracteres especiales ni números.";
// }
//
// if (strlen($datosFixed["email"]) == 0){
//   $errores["email"]="* El campo E-mail debe estar completo.";
// } elseif (!filter_var($datosFixed["email"], FILTER_VALIDATE_EMAIL)){
//   $errores["email"]="* El e-mail debe ser válido.";
// }
//
//
// if($_FILES["avatar"]["error"] !== 0 && $_FILES["avatar"]["error"] !== 4){
//   $errores["avatar"]["error"] ="* Imagen de perfil: error. Volver a subirla.";
// }
// if ($_FILES["avatar"]["size"] >= 2097152) {
//   $errores["avatar"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
// }
// $ext = pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION);
// if ($_FILES["avatar"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
//   $errores["avatar"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
// }
//
// if (strlen($_POST["nPass"]) > 0 && strlen($_POST["nPass"]) < 5) {
//   $errores["nPass"]="* La nueva contraseña debe tener como mínimo 5 caracteres.";
// }
//
// if (strlen($_POST["nPass"]) > 0 && strlen($_POST["nPass2"]) == 0){
//   $errores["nPass2"]="* Por favor repetir la nueva contraseña.";
// } elseif ($_POST["nPass"] !== $_POST["nPass2"]){
//   $errores["nPass"]="* Las nuevas contraseñas no coinciden.";
// }
//
// if (strlen($_POST["pass"]) == 0){
//   $errores["pass"]="* El campo Contraseña debe estar completo.";
// }
//
// elseif (existeUsuario($_SESSION["usuario"])) {
//   $usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);
//   if(!password_verify($_POST["pass"], $usuario["pass"])){
//     $errores["pass"]="Contraseña errónea.";
// }
// }
//
// // VALIDAR MAILS YA EXISTENTES:
//
// // $json = file_get_contents("db.json");
// // $array = json_decode($json, true);
// //
// // $usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);
// //
// // if($array !== null){
// // foreach ($array as $key => $value) {
// //   foreach ($value as $value2) {
// //
// //     if ($datosFixed["email"] !== $usuario["email"] && $value2["email"] == $datosFixed["email"]){
// //       $errores["email"]="* Este e-mail ya se encuentra registrado.";
// //     }
// //   }
// // }
// // }
//
// $usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);
//
// global $db;
//
// $stmt = $db->prepare("SELECT * FROM usuarios WHERE email != :email AND email = :nuevo_email");
//
// $newMail = $datosFixed["email"];
//
// $stmt-> bindValue(":email", $usuario["email"]);
// $stmt-> bindValue(":nuevo_email", $newMail);
//
// $stmt->execute();
//
// $resultado_email = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
// if ($resultado_email){
//   $errores["email"]="* Este e-mail ya se encuentra registrado.";
// }
//
//
// // debug
// // echo "errores";
// // var_dump ($errores);
// // echo "datosFixed";
// // var_dump ($datosFixed);
// // fin debug
//
//   return $errores;
// }

// VA A validador.php
// function validarSubidaArticulo($datos){
// // $ datos va a ser igual a $ POST
// // Esta función entrega detalle errores, NO datos
//
// $caracteresOK = [' ', 'ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü','"', "'"];
//
// $errores = [];
// $datosFixed = [];
//
// foreach ($datos as $key => $value) {
//   $datosFixed[$key] = trim($value);
// }
//
// if (strlen($datosFixed["nombre"]) == 0){
//   $errores["nombre"]="* El campo 'Nombre' debe estar completo.";
// } elseif (ctype_alpha(str_replace($caracteresOK,'',  $datosFixed["nombre"]))  == false){
//   $errores["nombre"] = "* El nombre no debe contener caracteres especiales ni números.";
// }
//
// if (strlen($datosFixed["n_cientifico"]) == 0){
//   $errores["n_cientifico"]="* El campo 'Nombre científico' debe estar completo.";
// } elseif (ctype_alpha(str_replace($caracteresOK,'',  $datosFixed["n_cientifico"]))  == false){
//   $errores["n_cientifico"] = "* El nombre científico no debe contener caracteres especiales ni números.";
// }
//
// if (!isset($_POST["categoria"])){
//     $errores["categoria"]="* Elegir una categoría.";
// }
//
//
// if($_FILES["imagen1"]["error"] == 4){
//   $errores["imagen1"]["error"] ="* Subir al menos una imagen de la planta";
// }
// if ($_FILES["imagen1"]["size"] >= 2097152) {
//   $errores["imagen1"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
// }
// $ext = pathinfo($_FILES["imagen1"]["name"],PATHINFO_EXTENSION);
// if ($_FILES["imagen1"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
//   $errores["imagen1"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
// }
//
// if($_FILES["imagen2"]["error"] !== 0 && $_FILES["imagen2"]["error"] !== 4){
//   $errores["imagen2"]["error"] ="* Imagen: error. Volver a subirla.";
// }
// if ($_FILES["imagen2"]["size"] >= 2097152) {
//   $errores["imagen2"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
// }
// $ext = pathinfo($_FILES["imagen2"]["name"],PATHINFO_EXTENSION);
// if ($_FILES["imagen2"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
//   $errores["imagen2"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
// }
//
// if($_FILES["imagen3"]["error"] !== 0 && $_FILES["imagen3"]["error"] !== 4){
//   $errores["imagen3"]["error"] ="* Imagen: error. Volver a subirla.";
// }
// if ($_FILES["imagen3"]["size"] >= 2097152) {
//   $errores["imagen3"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
// }
// $ext = pathinfo($_FILES["imagen3"]["name"],PATHINFO_EXTENSION);
// if ($_FILES["imagen3"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
//   $errores["imagen3"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
// }
//
//
// // FALTA VALIDACION PUNTO DE ENCUENTRO
//
//
//
// // debug
// // echo "errores";
// // var_dump ($errores);
// // echo "datosFixed";
// // var_dump ($datosFixed);
// // fin debug
//
//   return $errores;
// }

// VA A dbMysql.php
// function siguienteID($tabla){
//
//   global $db;
//   $stmt = $db->prepare("SELECT id FROM $tabla
// ORDER BY id DESC LIMIT 1");
//
//   $stmt->execute();
//
//   $id = $stmt->fetch(PDO::FETCH_ASSOC);
//
//   return $id["id"] + 1;
// }

// VA A articulo.php COMO constructor
// function armarArticulo(){
//
//   $usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);
//
//   $id = siguienteID("articulos");
//   $str_replace = [' ','"'];
//
//   if ($_FILES["imagen2"]["error"] == 4 && $_FILES["imagen3"]["error"] == 4){
//
//   $ext1= pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
//
//   return[
//     "nombre" => strtoupper(trim($_POST["nombre"])),
//     "n_cientifico" => trim($_POST["n_cientifico"]),
//     "categoria" => $_POST["categoria"],
//     "descripcion" => trim($_POST["descripcion"]),
//     "imagen1" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_1" . "." . $ext1,
//     "imagen2" => "null",
//     "imagen3" => "null",
//     "id_usuario" => $usuario["id"],
//     "disponible" => "si",
//   ];
// }elseif ($_FILES["imagen2"]["error"] == 0 && $_FILES["imagen3"]["error"] == 4){
//
//   $ext1= pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
//   $ext2= pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
//
//   return[
//     "nombre" => strtoupper(trim($_POST["nombre"])),
//     "n_cientifico" => trim($_POST["n_cientifico"]),
//     "categoria" => $_POST["categoria"],
//     "descripcion" => trim($_POST["descripcion"]),
//     "imagen1" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_1" . "." . $ext1,
//     "imagen2" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_2" . "." . $ext2,
//     "imagen3" => "null",
//     "id_usuario" => $usuario["id"],
//     "disponible" => "si",
//   ];
// }elseif($_FILES["imagen2"]["error"] == 4 && $_FILES["imagen3"]["error"] == 0){
//
//   $ext1= pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
//   $ext3= pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
//
//   return[
//     "nombre" => strtoupper(trim($_POST["nombre"])),
//     "n_cientifico" => trim($_POST["n_cientifico"]),
//     "categoria" => $_POST["categoria"],
//     "descripcion" => trim($_POST["descripcion"]),
//     "imagen1" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_1" . "." . $ext1,
//     "imagen2" => "null",
//     "imagen3" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_3" . "." . $ext3,
//     "id_usuario" => $usuario["id"],
//     "disponible" => "si",
//   ];
// }else{
//
//   $ext1= pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
//   $ext2= pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
//   $ext3= pathinfo($_FILES["imagen3"]["name"], PATHINFO_EXTENSION);
//
//   return[
//     "nombre" => strtoupper(trim($_POST["nombre"])),
//     "n_cientifico" => trim($_POST["n_cientifico"]),
//     "categoria" => $_POST["categoria"],
//     "descripcion" => trim($_POST["descripcion"]),
//     "imagen1" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_1" . "." . $ext1,
//     "imagen2" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_2" . "." . $ext2,
//     "imagen3" => "archivos/". $id . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_3" . "." . $ext3,
//     "id_usuario" => $usuario["id"],
//     "disponible" => "si",
//   ];
//
// }
// }

// VA A dbMysql.php
// function guardarArticulo($articulo){
//
// global $db;
//
// // $stmt = $db->prepare("INSERT into articulos VALUES
// // (default, ':nombre', ':n_cientifico', ':imagen1', ':imagen2', ':imagen3', ':descripcion', ':disponible:', :id_usuario, :id_categoria, null)");
//
// $stmt = $db->prepare("INSERT into articulos VALUES
// (default, :nombre, :n_cientifico, :imagen1, :imagen2, :imagen3, :descripcion, :disponible, :id_usuario, :id_categoria, null)");
//
//
// $stmt-> bindValue(":nombre", $articulo["nombre"]);
// $stmt-> bindValue(":n_cientifico", $articulo["n_cientifico"]);
// $stmt-> bindValue(":imagen1", $articulo["imagen1"]);
// $stmt-> bindValue(":imagen2", $articulo["imagen2"]);
// $stmt-> bindValue(":imagen3", $articulo["imagen3"]);
// $stmt-> bindValue(":descripcion", $articulo["descripcion"]);
// $stmt-> bindValue(":disponible", $articulo["disponible"]);
// $stmt-> bindValue(":id_usuario", $articulo["id_usuario"]);
// $stmt-> bindValue(":id_categoria", $articulo["categoria"]);
//
// // $stmt-> bindValue(":id_punto", "pendiente");
//
// $stmt->execute();
// }

// VA A dbMysql.php
// function traerPlantas($usuarioID){
//
//   global $db;
//
//   $stmt = $db->prepare("SELECT articulos.id, articulos.nombre, n_cientifico, imagen1, imagen2, imagen3, descripcion, disponible, id_usuario, id_punto, categorias.nombre AS categoria
//   FROM articulos
//   INNER JOIN categorias ON articulos.id_categoria = categorias.id
//   WHERE id_usuario=$usuarioID");
//
//   $stmt->execute();
//
//   $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//   return $articulos;
//
// }

// VA A dbMysql.php
// function traerTodasLasPlantas(){
//
//   global $db;
//
//   $stmt = $db->prepare("SELECT articulos.id, articulos.nombre, n_cientifico, imagen1, imagen2, imagen3, descripcion, disponible, id_usuario, id_punto, categorias.nombre AS categoria
//   FROM articulos
//   INNER JOIN categorias ON articulos.id_categoria = categorias.id
//   WHERE disponible='si'");
//
//   $stmt->execute();
//
//   $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//   return $articulos;
//
// }

// VA A dbMysql.php
// function traerUnaPlanta($articuloID){
//
//   global $db;
//
//   $stmt = $db->prepare("SELECT articulos.id, articulos.nombre, n_cientifico, imagen1, imagen2, imagen3, descripcion, disponible, id_usuario, usuarios.user AS user, id_punto, categorias.nombre AS categoria, avatar, email
//   FROM articulos
//   INNER JOIN categorias ON articulos.id_categoria = categorias.id
//   INNER JOIN usuarios ON articulos.id_usuario = usuarios.id
//   WHERE articulos.id=$articuloID");
//
//   $stmt->execute();
//
//   $articulos = $stmt->fetch(PDO::FETCH_ASSOC);
//
//   return $articulos;
//
// }
// // AGREGAR INNER JOIN ARTICULOS??
// function buscarUsuarioPorId($id){
//
//   global $db;
//
//   $stmt = $db->prepare("SELECT * FROM usuarios
// WHERE id = $id");
//
//   $stmt->execute();
//
//   $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
//
//   return $usuario;
//
// }

// VA A validador.php
// function validarModificionArticulo($datos){
// // $ datos va a ser igual a $ POST
// // Esta función entrega detalle errores, NO datos
//
// $caracteresOK = [' ', 'ñ', 'Ñ', 'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü','"', "'"];
//
// $errores = [];
// $datosFixed = [];
//
// foreach ($datos as $key => $value) {
//   $datosFixed[$key] = trim($value);
// }
//
// if (strlen($datosFixed["nombre"]) == 0){
//   $errores["nombre"]="* El campo 'Nombre' debe estar completo.";
// } elseif (ctype_alpha(str_replace($caracteresOK,'',  $datosFixed["nombre"]))  == false){
//   $errores["nombre"] = "* El nombre no debe contener caracteres especiales ni números.";
// }
//
// if (strlen($datosFixed["n_cientifico"]) == 0){
//   $errores["n_cientifico"]="* El campo 'Nombre científico' debe estar completo.";
// } elseif (ctype_alpha(str_replace($caracteresOK,'',  $datosFixed["n_cientifico"]))  == false){
//   $errores["n_cientifico"] = "* El nombre científico no debe contener caracteres especiales ni números.";
// }
//
// if (!isset($_POST["categoria"])){
//     $errores["categoria"]="* Elegir una categoría.";
// }
//
//
// if($_FILES["imagen1"]["error"] !== 0 && $_FILES["imagen1"]["error"] !== 4){
//   $errores["imagen1"]["error"] ="* Imagen: error. Volver a subirla.";
// }
// if ($_FILES["imagen1"]["size"] >= 2097152) {
//   $errores["imagen1"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
// }
// $ext = pathinfo($_FILES["imagen1"]["name"],PATHINFO_EXTENSION);
// if ($_FILES["imagen1"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
//   $errores["imagen1"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
// }
//
// if($_FILES["imagen2"]["error"] !== 0 && $_FILES["imagen2"]["error"] !== 4){
//   $errores["imagen2"]["error"] ="* Imagen: error. Volver a subirla.";
// }
// if ($_FILES["imagen2"]["size"] >= 2097152) {
//   $errores["imagen2"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
// }
// $ext = pathinfo($_FILES["imagen2"]["name"],PATHINFO_EXTENSION);
// if ($_FILES["imagen2"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
//   $errores["imagen2"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
// }
//
// if($_FILES["imagen3"]["error"] !== 0 && $_FILES["imagen3"]["error"] !== 4){
//   $errores["imagen3"]["error"] ="* Imagen: error. Volver a subirla.";
// }
// if ($_FILES["imagen3"]["size"] >= 2097152) {
//   $errores["imagen3"]["size"]="* El tamaño de la imagen no puede ser superior a 2 MB.";
// }
// $ext = pathinfo($_FILES["imagen3"]["name"],PATHINFO_EXTENSION);
// if ($_FILES["imagen3"]["error"] == 0 && $ext != "jpg" && $ext != "JPG" && $ext != "jpeg" && $ext != "JPEG" && $ext != "png" && $ext != "PNG") {
//   $errores["imagen3"]["type"] = "* La imagen debe ser jpg, jpeg o png.";
// }
//
//
// // FALTA VALIDACION PUNTO DE ENCUENTRO
//
//
//
// // debug
// // echo "errores";
// // var_dump ($errores);
// // echo "datosFixed";
// // var_dump ($datosFixed);
// // fin debug
//
//   return $errores;
// }

// VA A ARTICULO.PHP COMO PARTE DEL CONSTRUCTOR
// function armarArticuloModificado($idPlanta){
//
// $planta = traerUnaPlanta($idPlanta);
//
// // $id = $_GET["id"];
//   // $usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);
//
//   // $id = siguienteID("articulos");
//     $str_replace = [' ','"'];
//
// if ($_FILES["imagen1"]["error"] == 4){
//   $ruta1 = $planta["imagen1"];
// } else {
//   $ext1= pathinfo($_FILES["imagen1"]["name"], PATHINFO_EXTENSION);
//   $ruta1 = "archivos/". $idPlanta . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_1" . "." . $ext1;
// }
//
// if ($_FILES["imagen2"]["error"] == 4){
//   $ruta2 = $planta["imagen2"];
// } else {
//   $ext2= pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
//   $ruta2 = "archivos/". $idPlanta . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_2" . "." . $ext2;
// }
//
// if ($_FILES["imagen3"]["error"] == 4){
//   $ruta3 = $planta["imagen3"];
// } else {
//   $ext3= pathinfo($_FILES["imagen3"]["name"], PATHINFO_EXTENSION);
//   $ruta3 = "archivos/". $idPlanta . "_" . $_SESSION["usuario"]. "_" . str_replace($str_replace,'_',  trim($_POST["nombre"])) ."_3" . "." . $ext3;
// }
//
//
//     return[
//       "id" => $planta["id"],
//       "nombre" => strtoupper(trim($_POST["nombre"])),
//       "n_cientifico" => trim($_POST["n_cientifico"]),
//       "categoria" => $_POST["categoria"],
//       "descripcion" => trim($_POST["descripcion"]),
//       "imagen1" => $ruta1,
//       "imagen2" => $ruta2,
//       "imagen3" => $ruta3,
//       // "id_usuario" => $usuario["id"],
//       // "disponible" => "si",
//     ];
//
//   }

// VA A dbMysql.php
// function guardarArticuloModificado($articuloModificado){
//   global $db;
//
//   $id = $articuloModificado["id"];
//
// // qué es esta burrada???
// //   $stmt = $db->prepare("INSERT into articulos VALUES
// //   (default, :nombre, :n_cientifico, :imagen1, :imagen2, :imagen3, :descripcion, :disponible, :id_usuario, :id_categoria, null)");
//
//   $stmt = $db->prepare("UPDATE articulos
//     SET nombre = :nombre,
//     n_cientifico = :n_cientifico,
//     id_categoria = :id_categoria,
//     descripcion = :descripcion,
//     imagen1 = :imagen1,
//     imagen2 = :imagen2,
//     imagen3 = :imagen3
//     WHERE id = $id");
//
//
//   $stmt-> bindValue(":nombre", $articuloModificado["nombre"]);
//   $stmt-> bindValue(":n_cientifico", $articuloModificado["n_cientifico"]);
//   $stmt-> bindValue(":imagen1", $articuloModificado["imagen1"]);
//   $stmt-> bindValue(":imagen2", $articuloModificado["imagen2"]);
//   $stmt-> bindValue(":imagen3", $articuloModificado["imagen3"]);
//   $stmt-> bindValue(":descripcion", $articuloModificado["descripcion"]);
//   $stmt-> bindValue(":id_categoria", $articuloModificado["categoria"]);
//
//   // $stmt-> bindValue(":id_punto", "pendiente");
//
//   $stmt->execute();
// }


// PENDIENTE

// login en 2 pasos

// si dbjson no existe

// forgot password

// borrar cuenta

// agregar botón recordarme al registro


 ?>
