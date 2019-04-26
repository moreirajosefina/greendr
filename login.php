<?php
$titulo= "GREENDR - Login";

 ?>


<!DOCTYPE html>
<html>

<?php include("partials/head.php"); ?>

  <body class="loginbody">

    <?php include("partials/nav.php"); ?>

    <div class="supercontainer">
      <a href="index.php"><i class="fas fa-times"></i></a>
      <div class="form-container rounded-lg rounded-sm">

        <form class="login">
          <div class="form-group rounded-lg rounded-sm">
            <label for="exampleInputEmail1">E-mail</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Contraseña</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
          </div>
          <button action="index.html" type="submit" class="btn btn-success jboton"><p>Iniciar sesión</p></button>
        </form>
        </div>
        <div class="form-container register rounded-lg rounded-sm">
            <p>¿No tenés una cuenta?</p>
            <a href="registro.php">
            <button type="button" name="submit" class="btn btn-success jboton">
              Registrate acá
            </button>
            </a>

        </div>

    </div>

<?php include("partials/js.php"); ?>

  </body>

</html>
