<?php

$titulo= "GREENDR - Registro";

// include "funciones_greendr.php";
include "init.php";

if($auth->usuarioLogueado()){
  header("Location:index.php");
  exit;
}

// debug
// echo "POST";
// var_dump($_POST);
//
// echo "FILES";
// var_dump($_FILES);
//
// fin debug


// variables para persistencia:
$nombreOut = "";
$emailOut = "";
$userOut = "";

if($_POST){

  $erroresOut = Validador::validar($_POST);
  // erroresOUT son solo errores, NO DATOS

// variables para persistencia:
  $nombreOut = trim($_POST["nombre"]);
  $emailOut = trim($_POST["email"]);
  $userOut = trim($_POST["user"]);

// debug
  // echo "erroresOUT";
  // var_dump($erroresOut);
  // echo "Post";
  // var_dump($_POST);
  // echo "Files";
  // var_dump($_FILES);

// fin debug

  if(empty($erroresOut)){
      // $usuario = armarUsuario();
      $usuario = new Usuario ($_POST);
      // var_dump($usuario);
      // exit;

      // guardarUsuario($usuario);
      $dbAll->guardarUsuario($usuario);

      //subir imagen;
      if ($_FILES["avatar"]["error"] == 4){
        $avatarSinFoto = rand (1,3);
        copy("archivos/avatarGral/". $avatarSinFoto . ".png", "archivos/". $avatarSinFoto . ".png");
        rename("archivos/". $avatarSinFoto . ".png", "archivos/". trim($_POST["user"]). ".png");
      }else{
      $ext= pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["avatar"]["tmp_name"], "archivos/". trim($_POST["user"]). "." .$ext);
    }

    // loguearUsuario($_POST["user"]);
    $auth->loguearUsuario($_POST["user"]);

    // recordarme();
    // no puede recordar porque el usuario todavía no existe para traerlo en la función

    header("Location:index.php");
    exit;
  }

}

 ?>

 <!DOCTYPE html>
 <html>

 <?php include("partials/head.php"); ?>

   <body>

<?php include("partials/nav.php"); ?>

<div class="contenedor_registro">

<h3 class="h3_registro">REGISTRO DE USUARIO</h3>

<form class="form_registro" action="registro.php" method="post" enctype="multipart/form-data">

  <div class="items_registro">
        <label class="label_registro" for="nombre">Nombre y apellido: </label>

        <input class="input_registro" type="text" id="nombre" name="nombre" placeholder="Los otros usuarios no verán esta información" value="<?php if(isset($erroresOut["nombre"])){$nombreOut="";}else{echo $nombreOut;}?>">

        <p class="error_registro">
        <?php if(isset($erroresOut["nombre"])){echo $erroresOut["nombre"]; } ?>
        </p>
  </div>

  <div class="items_registro">
        <label class="label_registro" for="email">E-mail: </label>

        <input class="input_registro" type="text" id="email" name="email"  placeholder="Los otros usuarios no verán esta información" value="<?php if(isset($erroresOut["email"])){$emailOut="";}else{echo $emailOut;}?>">

        <p class="error_registro">
        <?php if(isset($erroresOut["email"])){echo $erroresOut["email"]; } ?>
        </p>
  </div>

  <div class="items_registro">
        <label class="label_registro" for="user">Elegí tu nombre de usuario: </label>

        <input class="input_registro" type="text" id="user" name="user" value="<?php if(isset($erroresOut["user"])){$userOut="";}else{echo $userOut;}?>">

        <p class="error_registro">
        <?php if(isset($erroresOut["user"])){echo $erroresOut["user"]; } ?>
        </p>
  </div>

  <div class="items_registro">
        <label class="label_registro" for="avatar">Imagen de perfil (campo no obligatorio): </label>
        <input class="input_registro_avatar" type="file" id="avatar" name="avatar" value= "">

        <p class="error_registro">
        <?php if(isset($erroresOut["avatar"]["error"])){echo $erroresOut["avatar"]["error"]; }
        if(isset($erroresOut["avatar"]["size"])){echo $erroresOut["avatar"]["size"]; }
        if(isset($erroresOut["avatar"]["type"])){echo $erroresOut["avatar"]["type"]; }   ?>
        </p>
  </div>

  <div class="items_registro">
        <label class="label_registro" for="pass">Contraseña: </label>
        <input class="input_registro" type="password" id="pass" name="pass" value= "" placeholder="Debe tener como mínimo 5 caracteres">
        <p class="error_registro">
        <?php if(isset($erroresOut["pass"])){echo $erroresOut["pass"]; } ?>
        </p>
  </div>

  <div class="items_registro">
        <label class="label_registro" for="pass2">Repetir contraseña: </label>
        <input class="input_registro" type="password" id="pass2" name="pass2" value= "">
        <p class="error_registro">
        <?php if(isset($erroresOut["pass2"])){echo $erroresOut["pass2"]; } ?>
        </p>
  </div>

<!-- <input type="checkbox" name="recordarme" value="si"> Recordarme<br> -->

  <div class="items_registro">
       <button class="enviar_registro" type="submit"><p class="crear">CREAR CUENTA</p></button>
  </div>

  <div class="items_registro">
        <p class="p_registro">¿Ya tenés una cuenta?</p>
        <a href="login.php">
        <button class="button_registro_loguear" type="button" name="submit">
        Iniciá sesión acá
        </button>
        </a>

  </div>

</form>
</div>

<?php include("partials/js.php"); ?>
   </body>
 </html>
