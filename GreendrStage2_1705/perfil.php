<?php
$titulo= "GREENDR - Perfil";

include "funciones_greendr.php";

if(!usuarioLogueado()){
  header("Location:index.php");
  exit;
}

// variables para persistencia:
$nombreCompletoOut = "";
$emailOut = "";


if($_POST){

  $erroresOut = validarPerfil($_POST);
  // erroresOUT son solo errores, NO DATOS

// variables para persistencia:
  $nombreCompletoOut = trim($_POST["nombreCompleto"]);
  $emailOut = trim($_POST["email"]);


// debug
  // echo "erroresOUT";
  // var_dump($erroresOut);
  // echo "Post";
  // var_dump($_POST);
  // echo "Files";
  // var_dump($_FILES);
// fin debug

  if(empty($erroresOut)){
      $usuarioModificado = modificarUsuario();
      guardarUsuarioModificado($usuarioModificado);
      //subir imagen;
      if ($_FILES["avatar"]["error"] == 0){
      $ext= pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["avatar"]["tmp_name"], "archivos/". $usuarioModificado["user"]. "." .$ext);
    }

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


<div class="contenedor_perfil">


<h3 class="h3_perfil">MIS DATOS</h3>

<?php $usuario = traerUsuarioLogueado() ?>

<div class="nombre_perfil">
<h3 class="h3_nombre_perfil"><?="Nombre de usuario: ". $usuario["user"]?></h3>
<img class="avatar_perfil" src="<?=$usuario["avatar"]?>" alt="avatar">
</div>


<form class="form_perfil" action="perfil.php" method="post" enctype="multipart/form-data">

  <div class="items_perfil">
        <label class="label_perfil" for="nombre">Nombre y apellido: </label>

        <input class="input_perfil" type="text" id="nombre" name="nombreCompleto" placeholder="Los otros usuarios no verán esta información"
        <?php if(isset($erroresOut["nombreCompleto"])): ?>
          value= "<?=$nombreCompletoOut=""?>"
        <?php elseif(!isset($erroresOut["nombreCompleto"]) && isset($_POST["nombreCompleto"])): ?>
          value= "<?=$nombreCompletoOut?>"
        <?php else:  ?>
          value= "<?=$usuario["nombre"]?>"
       <?php endif; ?>
      >
        <p class="error_perfil">
        <?php if(isset($erroresOut["nombreCompleto"])){echo $erroresOut["nombreCompleto"]; } ?>
        </p>
  </div>

  <div class="items_perfil">
        <label class="label_perfil" for="email">E-mail: </label>

        <input class="input_perfil" type="text" id="email" name="email"  placeholder="Los otros usuarios no verán esta información"
        <?php if(isset($erroresOut["email"])): ?>
          value= "<?=$emailOut=""?>"
        <?php elseif(!isset($erroresOut["email"]) && isset($_POST["email"])): ?>
          value= "<?=$emailOut?>"
        <?php else:  ?>
          value= "<?=$usuario["email"]?>"
       <?php endif; ?>
      >
        <p class="error_perfil">
        <?php if(isset($erroresOut["email"])){echo $erroresOut["email"]; } ?>
        </p>
  </div>

  <div class="items_perfil">
        <label class="label_perfil_avatar" for="avatar">Elegí una imagen de perfil: </label>
        <input class="input_perfil_avatar" type="file" id="avatar" name="avatar" value= "">

        <p class="error_perfil">
        <?php if(isset($erroresOut["avatar"]["error"])){echo $erroresOut["avatar"]["error"]; }
        if(isset($erroresOut["avatar"]["size"])){echo $erroresOut["avatar"]["size"]; }
        if(isset($erroresOut["avatar"]["type"])){echo $erroresOut["avatar"]["type"]; }   ?>
        </p>
  </div>

  <div class="items_perfil">
        <label class="label_perfil" for="nPass">Nueva contraseña: </label>
        <input class="input_perfil" type="password" id="nPass" name="nPass" value= "" placeholder="Debe tener como mínimo 5 caracteres">
        <p class="error_registro">
        <?php if(isset($erroresOut["nPass"])){echo $erroresOut["nPass"]; } ?>
        </p>
  </div>

  <div class="items_perfil">
        <label class="label_perfil" for="nPass2">Repetir nueva contraseña: </label>
        <input class="input_perfil" type="password" id="nPass2" name="nPass2" value= "" >
        <p class="error_perfil">
        <?php if(isset($erroresOut["nPass2"])){echo $erroresOut["nPass2"]; } ?>
        </p>
  </div>

  <div class="items_perfil">
    <p class="p_perfil">Necesitás ingresar tu contraseña original para modificar los datos</p>
        <label class="label_perfil" for="pass">Contraseña: </label>
        <input class="input_perfil" type="password" id="pass" name="pass" value= "" >
        <p class="error_perfil">
        <?php if(isset($erroresOut["pass"])){echo $erroresOut["pass"]; } ?>
        </p>
  </div>

  <div class="items_perfil">
       <button class="enviar_perfil" type="submit"><p class="crear">GUARDAR CAMBIOS</p></button>
  </div>

  <div class="items_perfil">
  <button class="descartar_perfil" type="button" name="button">
  <a href="index.php">DESCARTAR CAMBIOS</a>
  </button>
  </div>

</form>

<!-- <button class="volver_perfil" type="button" name="button">
<a href="index.php">VOLVER</a>
</button> -->


</div>

<?php include("partials/js.php"); ?>
  </body>
</html>
