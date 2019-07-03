<?php
$titulo= "GREENDR - Prueba calesita";

include "funciones_greendr.php";

?>

<!DOCTYPE html>
<html>

<?php include("partials/head.php"); ?>

  <body>

<?php include("partials/nav.php"); ?>

<div class="contenedor_cpanel">

  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">


    <div class="carousel-inner">

      <div class="carousel-item active">
          <article class="product onBoarding mobile d-block w-100">
            <a class="odio onBoarding_a" href="editar_mis_articulos.php">
              <img class="photo onBoarding_photo" src="media/onboarding/obB.png" alt="planta">
              <div class="texto onBoarding_texto">
                <h2 class="onBoarding_h2">MIS PLANTAS</h2>
              </div>
            </a>
          </article>
      </div>

      <?php $usuario = traerUsuarioLogueado();
      $id = $usuario["id"];
      $plantas = traerPlantas($id);?>
      <?php foreach ($plantas as $key => $value) : ?>

      <div class="carousel-item">
        <article class="product d-block w-100">
        <a class="odio" href="editar_articulo.php?id=<?=$value["id"]?>">
        <img class="photo" src="<?=$plantas[$key]["imagen1"]?>" alt="planta">
        <div class="texto">
        <h3><?=$plantas[$key]["categoria"] ?></h3>
        <h2><?=$plantas[$key]["nombre"] ?></h2>
        </div>
        </a>
        </article>
      </div>

      <?php endforeach; ?>

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

</div>



<?php include("partials/js.php"); ?>
  </body>
</html>
