<?php
$titulo= "GREENDR - Login";

include "funciones_greendr.php";

if(usuarioLogueado()){
  header("Location:index.php");
  exit;
}

// variables para persistencia:
$logUserOut = "";
// $logPassOut = "";

if ($_POST){
  $erroresOut = validarLogin($_POST);
  // variables para persistencia:
  $logUserOut = trim($_POST["logUser"]);

// debug
  // echo "$ POST:";
  // var_dump ($_POST);
  //
  // echo "$ SESSION:";
  // var_dump ($_SESSION);
  //
  // echo "$ COOKIE:";
  // var_dump ($_COOKIE);
  //
  // echo "erroresOUT";
  // var_dump($erroresOut);
  // echo "<br>";
  //
  // echo "probando traerUsuario";
  // echo "<br>";
  // $email_prueba = "pp@gmail.com";
  // $usuario_prueba = buscarUsuarioPorMailoUser($_POST["logUser"]);
  // var_dump($usuario_prueba);
  // echo "<br>";
  // echo $usuario_prueba["user"];
  // echo "<br>";
  // echo "probando existeCookie";
  // echo "<br>";
  // existeCookie($_POST["logUser"]);
  // echo "<br>";

// fin debug

if(empty($erroresOut)){

  loguearUsuario($_POST["logUser"]);

  recordarme();

  siguienteSession ($_POST["logUser"]);

  dejarDeRecordarme ();

  header("Location:index.php");
  exit;

  // pendiente:
  // situación: no estoy logueado - clickeo un artículo - me pide loguin
  // cuando logueo debería ir al artículo en cuestión
  // así como está, logueo y va al home
}
}

 ?>

 <!DOCTYPE html>
 <html>

 <?php include("partials/head.php"); ?>

   <body>

<?php include("partials/nav.php"); ?>

<div class="contenedor_login">

<h3 class="h3_login">INICIO DE SESIÓN</h3>

     <form class="form_login" action="login.php" method="post">

       <p class="error_login"> <?php if(isset($erroresOut["logUser"])){echo $erroresOut["logUser"]; } ?> </p>


       <div class="items_login">
             <label class="label_login" for="nombre">Nombre de usuario o e-mail: </label>

            <input class="input_login" type="text" id="nombre" list="user_reg" name="logUser" autocomplete="off" value="<?=$logUserOut?>" >

            <datalist id="user_reg" >
            <?php foreach ($_COOKIE as $key => $value) :?>
            <?php if (is_numeric($key)) : ?>
            <option value="<?=$_COOKIE[$key]["user"]?>" >
            <?php endif; ?>
            <?php endforeach; ?>
            </datalist>
       </div>

       <div class="items_login">
             <label class="label_login" for="pass"> Contraseña: </label>
             <input class="input_login" type="password" id="pass" name="logPass" value= ""  >
       </div>

<!-- <div class="radio_items_login">
<input class="radio1_input_login" type="radio" name="recordarme" value="si"> Recordarme<br>
<input class="radio2_input_login" type="radio" name="recordarme" value="no"> Dejar de recordarme<br>
</div> -->

<div class="radio_items_login">
  <label class="label_login" for="rec">Recordarme   </label>
<input class="radio1_input_login" type="radio" id="rec" name="recordarme" value="si">

  <label class="label_login_radio" for="norec">Dejar de recordarme   </label>
<input class="radio2_input_login" type="radio" id="norec" name="recordarme" value="no">
</div>

      <div class="items_login">
        <button class="enviar_login" type="submit"><p class="">LOG IN</p></button>
      </div>

<div class="items_login">
      <p class="p_login">¿No tenés una cuenta?</p>
      <a href="registro.php">
      <button class="button_registro_login" type="button" name="submit">
      Registrate acá
      </button>
      </a>
</div>

     </form>
</div>

<?php include("partials/js.php"); ?>
   </body>
 </html>
