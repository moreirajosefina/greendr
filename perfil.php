<?php
$titulo= "GREENDR - Perfil";

// include "funciones_greendr.php";
include "init.php";

if(!$auth->usuarioLogueado()){
  header("Location:index.php");
  exit;
}

// variables para persistencia:
$nombreOut = "";
$emailOut = "";


if($_POST){

  $erroresOut = Validador::validarPerfil($_POST);
  // erroresOUT son solo errores, NO DATOS

// variables para persistencia:
  $nombreOut = trim($_POST["nombre"]);
  $emailOut = trim($_POST["email"]);


// debug
  // echo "erroresOUT";
  // var_dump($erroresOut);
  // echo "Post";
  // var_dump($_POST);
  // echo "Files";
  // var_dump($_FILES);
  // exit;
// fin debug

  if(empty($erroresOut)){
      // $usuarioModificado = modificarUsuario();
      $usuarioModificado = new Usuario ($_POST);
      // var_dump($usuarioModificado);
      // exit;

      // guardarUsuarioModificado($usuarioModificado);
      $dbAll->guardarUsuarioModificado($usuarioModificado);

      //subir imagen;
      if ($_FILES["avatar"]["error"] == 0){
      $ext= pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
      move_uploaded_file($_FILES["avatar"]["tmp_name"], "archivos/". $usuarioModificado->getUser(). "." .$ext);
    }

    header("Location:control_panel.php");
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

<?php $usuario = $dbAll->traerUsuarioLogueado() ?>

<div class="nombre_perfil">
<h3 class="h3_nombre_perfil"><?="Nombre de usuario: ". $usuario->getUser()?></h3>
<img class="avatar_perfil" src="<?=$usuario->getAvatar()?>" alt="avatar">
</div>


<form class="form_perfil" action="perfil.php" method="post" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?=$usuario->getId()?>">

  <div class="items_perfil">
        <label class="label_perfil" for="nombre">Nombre y apellido: </label>

        <input class="input_perfil" type="text" id="nombre" name="nombre" placeholder="Los otros usuarios no verán esta información"
        <?php if(isset($erroresOut["nombre"])): ?>
          value= "<?=$nombreOut=""?>"
        <?php elseif(!isset($erroresOut["nombre"]) && isset($_POST["nombre"])): ?>
          value= "<?=$nombreOut?>"
        <?php else:  ?>
          value= "<?=$usuario->getNombre()?>"
       <?php endif; ?>
      >
        <p class="error_perfil">
        <?php if(isset($erroresOut["nombre"])){echo $erroresOut["nombre"]; } ?>
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
          value= "<?=$usuario->getEmail()?>"
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
  <button class="descartar_perfil" type="button">
  <a href="control_panel.php"><p class="crear">DESCARTAR CAMBIOS</p></a>
  </button>
  <!-- button sin elemento p adentro no funciona bien o con name="button" tampoco... no entiendo -->
  </div>

</form>

<!-- <button class="volver_perfil" type="button" name="button">
<a href="index.php">VOLVER</a>
</button> -->


</div>

<?php include("partials/js.php"); ?>
  </body>
</html>
