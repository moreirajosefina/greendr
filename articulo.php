<?php
include "funciones_greendr.php";

if(!usuarioLogueado()){
  header("Location:index.php");
  exit;
}
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Articulo</title>
  </head>
  <body>
    <h1>PROXIMAMENTE ARTICULO</h1>
    <h2>EN CONSTRUCCION</h2>
    <img src="media/under-construction-1.gif" alt="">
    <a href="index.php">VOLVER</a>

    <?php include("partials/js.php"); ?>
  </body>
</html>
