<?php
$titulo= "GREENDR - Mis plantas";

// include "funciones_greendr.php";
include "init.php";

if(!$auth->usuarioLogueado()){
  header("Location:index.php");
  exit;
}

?>

<!DOCTYPE html>
<html>

<?php include("partials/head.php"); ?>

  <body>

<?php include("partials/nav.php"); ?>

<div class="contenedor_editarMisArticulos">

<h3 class="h3_editarMisArticulos">MIS PLANTAS:</h3>


<div class="main_editarMisArticulos">
<?php $usuario = $dbAll->traerUsuarioLogueado();

$id = $usuario->getId();

$plantas = $dbAll->traerPlantas($id);?>

<?php foreach ($plantas as $key => $value) : ?>
<?php $planta = new Articulo($value) ?>

<article class="product_editarMisArticulos">

<a class="odio_editarMisArticulos" href="editar_articulo.php?id=<?=$planta->getId()?>">
<img class="photo_editarMisArticulos" src="<?=$planta->getImagen1()?>" alt="planta">

    <div class="texto_editarMisArticulos">
      <h3 class="h3_texto_editarMisArticulos"><?=$planta->getId_categoria() ?></h3>

      <h2 class="h2_texto_editarMisArticulos"><?=$planta->getNombre()?></h2>
    </div>

  </a>
</article>

<?php endforeach; ?>



</div>

</div>



<?php include("partials/js.php"); ?>
  </body>
</html>

<!-- Pendiente:
- Agregar cruz para borrar artículo con confirmación
(adentro del artículo también agregar opción para borrar ítem)
- opción para volver al control panel, o back?-->
