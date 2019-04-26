<?php
$titulo= "GREENDR - Registro";
 ?>


<!DOCTYPE html>
<html>

<?php include("partials/head.php"); ?>

  <body>

<?php include("partials/nav.php"); ?>

<div class="aformulario">

    <form class="aform" action="registro.php" method="post">

<div class="items">
      <label class="alabel" for="nombre">Nombre: </label>
      <input class="ainput" type="text" id="nombre" name="nombre">
      <!-- <br> -->
</div>
<div class="items">
      <label class="alabel" for="apellido">Apellido: </label>
      <input class="ainput" type="text" id="apellido" name="apellido">
      <!-- <br> -->
</div>
<div class="items">
      <label class="alabel" for="email">E-mail: </label>
      <input class="ainput" type="text" id="email" name="email">
      <!-- <br> -->
</div>
<div class="items">
      <label class="alabel" for="pass">Contraseña: </label>
      <input class="ainput" type="password" id="pass" name="pass">
      <!-- <br> -->
</div>
<div class="items">
      <label class="alabel" for="pass2">Repetir contraseña: </label>
      <input class="ainput" type="password" id="pass2" name="pass2">
      <!-- <br> -->
</div>

     <button class="aenviar" type="submit"><p class="crear">CREAR CUENTA</p></button>

  

    </form>

</div>

  </body>
</html>
