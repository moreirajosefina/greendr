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

$idusuario = $_GET["id"];

$usuarioPlanta = $dbAll->buscarUsuarioPorId($idusuario);

$titulo= "GREENDR - " . $usuarioPlanta->getUser();
?>

<!DOCTYPE html>
<html>

<?php include("partials/head.php"); ?>

  <body>

<?php include("partials/nav.php"); ?>

<div class="contenedor_registro">

<!-- <h3 class="h3_nombre_perfil">USUARIO:</h3> -->

<div class="nombre_perfil">
<h3 class="h3_nombre_perfil"><?=$usuarioPlanta->getUser()?></h3>
<img class="avatar_perfil" src="<?=$usuarioPlanta->getAvatar()?>" alt="avatar">
</div>


<div class="main">
<?php $id = $usuarioPlanta->getId();
$plantas = $dbAll->traerPlantas($id);?>
<?php foreach ($plantas as $key => $value) : ?>
  <?php $planta = new Articulo($value) ?>

<article class="product">

<a class="odio" href="articulo.php?id=<?=$planta->getId()?>">
<img class="photo" src="<?=$planta->getImagen1()?>" alt="planta">

    <div class="texto">
      <h3><?=$planta->getId_categoria() ?></h3>

      <h2><?=$planta->getNombre() ?></h2>
    </div>

  </a>
</article>

<?php endforeach; ?>

</div>

</div>



<?php include("partials/js.php"); ?>
  </body>
</html>
