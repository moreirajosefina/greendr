<?php

// include "funciones_greendr.php";
include "init.php";

if(!$auth->usuarioLogueado()){
  header("Location:index.php");
  exit;
}

// debug:
// echo "primero var dump get";
// var_dump($_GET);
// fin debug

$idPlanta = $_GET["id"];

$planta = $dbAll->traerUnaPlanta($idPlanta);
$planta = New Articulo($planta);

// debug:
// var_dump($planta);
// fin debug
$titulo= "GREENDR - " . $planta->getNombre();

 ?>

<!DOCTYPE html>
<html>

<?php include("partials/head.php"); ?>

  <body>

<?php include("partials/nav.php"); ?>

<div class="contenedor_articulo">

<h3 class="h3_articulo"><?=$planta->getNombre()?></h3>

<div class="show_plantas">

  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <?php if($planta->getImagen2() != "null"): ?>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <?php endif; ?>
      <?php if($planta->getImagen3() != "null"): ?>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      <?php endif; ?>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="img_articulo" src="<?=$planta->getImagen1()?>" class="d-block w-100" alt="imagen1">
      </div>
      <?php if($planta->getImagen2() != "null"): ?>
      <div class="carousel-item">
        <img class="img_articulo" src="<?=$planta->getImagen2()?>" class="d-block w-100" alt="imagen2">
      </div>
    <?php endif; ?>
    <?php if($planta->getImagen3() != "null"): ?>
      <div class="carousel-item">
        <img class="img_articulo" src="<?=$planta->getImagen3()?>" class="d-block w-100" alt="imagen3">
      </div>
    <?php endif; ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="items_button2_articulo">
    <?php if($_SESSION["usuario"] == $planta->getId_usuario()->getUser() || $_SESSION["usuario"] == $planta->getId_usuario()->getEmail()): ?>
      <button class="button_articulo" type="button">
      <a href="editar_articulo.php?id=<?=$planta->getId()?>"><p class="crear">EDITAR PLANTA</p></a>
      </button>
    <?php else: ?>
  <button class="button_articulo" type="button" name="button">
  <a href="#">ME INTERESA</a>
  </button>
  <?php endif; ?>
  </div>

</div>



<div class="contenedor_items_articulo">


<div class="items_articulo">
  <h4 class="h4_articulo">Nombre científico:</h4>
  <p class="p_articulo"><?=$planta->getNcientifico()?></p>
</div>

<div class="items_articulo">
  <h4 class="h4_articulo">Categoría:</h4>
  <p class="p_articulo"><?=$planta->getId_categoria()?></p>
</div>

<div class="items_articulo">
  <h4 class="h4_articulo">Descripción:</h4>
  <p class="p_articulo"><?=$planta->getDescripcion()?></p>
</div>

<div class="items_articulo">
  <h4 class="h4_articulo">Punto de intercambio:</h4>
  <p class="p_articulo"><?=$planta->getId_punto()?></p>
</div>

<div class="items_articulo">
    <h4 class="h4_articulo">Usuario:</h4>
    <?php if($_SESSION["usuario"] == $planta->getId_usuario()->getUser() || $_SESSION["usuario"] == $planta->getId_usuario()->getUser()): ?>
  <a class="a_articulo" href="editar_mis_articulos.php">
  <img class="avatar_perfil_cpanel" src="<?=$planta->getId_usuario()->getAvatar()?>" alt="avatar">
  <p class="p_usuario_articulo"><?=$planta->getId_usuario()->getUser()?></p>
  </a>
    <?php else: ?>
  <a class="a_articulo" href="usuario.php?id=<?=$planta->getId_usuario()->getId()?>">
    <img class="avatar_perfil_cpanel" src="<?=$planta->getId_usuario()->getAvatar()?>" alt="avatar">
    <p class="p_usuario_articulo"><?=$planta->getId_usuario()->getUser()?></p>
  </a>
  <?php endif; ?>
</div>

</div>

<div class="items_button1_articulo">
  <?php if($_SESSION["usuario"] == $planta->getId_usuario()->getUser() || $_SESSION["usuario"] == $planta->getId_usuario()->getEmail()): ?>
    <button class="button_articulo" type="button" name="button">
    <a href="editar_articulo.php?id=<?=$planta->getId()?>"><p class="crear">EDITAR PLANTA</p></a>
    </button>
  <?php else: ?>
<button class="button_articulo" type="button" name="button">
<a href="#">ME INTERESA</a>
</button>
<?php endif; ?>
</div>

</div>

    <!-- <a href="index.php">VOLVER</a> -->

</div>
    <?php include("partials/js.php"); ?>
  </body>
</html>

<!-- pendiente
- redondear fotos
- chequear el tamaño de todas las pantallas => que no corte la foto al medio, que no scrollee si hay justo una foto
- chequear las líneas del guardado de la descripción-->
