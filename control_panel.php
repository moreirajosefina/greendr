<?php
$titulo= "GREENDR - Panel de control";

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

<div class="contenedor_cpanel">

<h3 class="h3_cpanel">PANEL DE CONTROL</h3>


<!-- <div class="plantas_cpanel"> -->

<div class="subir_plantas_cpanel">
<a href="formulario_subida.php">
<button class="subir button_cpanel" type="button">
SUBIR PLANTA*
</button>
</a>
<p class="p_cpanel"><i>  *Planta, esqueje, semillas,<br> producto o servicio de jardinería. </i></p>
</div>

<div class="misplantas_cpanel">

<!-- <h2 class="h2_cpanel">MIS PLANTAS</h2> -->

<div class="preview_items">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">


    <div class="carousel-inner">

      <div class="carousel-item active">
          <article id="product_cpanel" class="product onBoarding mobile d-block w-100">
            <a class="odio onBoarding_a" href="editar_mis_articulos.php">
              <img class="photo onBoarding_photo" src="media/onboarding/obB.png" alt="planta">
              <div class="texto onBoarding_texto">
                <h2 class="onBoarding_h2">MIS PLANTAS</h2>
              </div>
            </a>
          </article>
      </div>


      <?php $usuario = $dbAll->traerUsuarioLogueado() ?>

      <?php
      $id = $usuario->getId();
      $plantas = $dbAll->traerPlantas($id);?>

      <?php foreach ($plantas as $key => $value) : ?>
      <?php $planta = new Articulo($value) ?>

      <div class="carousel-item">
        <article id="product_cpanel" class="product d-block w-100">
        <a class="odio" href="editar_articulo.php?id=<?=$planta->getId()?>">
        <img class="photo" src="<?=$planta->getImagen1()?>" alt="planta">
        <div class="texto">
        <h3><?=$planta->getId_categoria()?></h3>
        <h2><?=$planta->getNombre() ?></h2>
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

<a href="editar_mis_articulos.php">
<button class="button_cpanel" type="button">
    VER TODAS MIS PLANTAS*
</button>
    </a>
</div>

<!-- </div> plantas_cpanel -->

<!-- </div> -->

<div class="mensajes_cpanel">

<!-- <h2 class="h2_cpanel">MENSAJES</h2> -->

<div class="preview_mensajes_items">

  <article id="product_cpanel" class="product onBoarding mobile d-block w-100">
    <a class="odio onBoarding_a" href="#">
      <img class="photo_mensajes" src="media/inbox-fake.png" alt="inbox">
      <!-- <div class="texto onBoarding_texto">
        <h2 class="onBoarding_h2">MENSAJES - PROVISORIO</h2>
      </div> -->
    </a>
  </article>

  </div>

  <a href="#">
  <button class="button_cpanel" type="button">
      VER TODOS LOS MENSAJES
  </button>
      </a>

</div>

<div class="wishlist_cpanel">

<!-- <h2 class="h2_cpanel">LAS PLANTAS QUE QUIERO</h2> -->

  <div class="preview_items">

    <article id="product_cpanel" class="product onBoarding mobile d-block w-100">
      <a class="odio onBoarding_a" href="#">
        <img class="photo onBoarding_photo" src="media/onboarding/obC.png" alt="obC">
        <div class="texto onBoarding_texto">
          <h2 class="onBoarding_h2">LAS PLANTAS* QUE QUIERO - PROVISORIO </h2>
        </div>
      </a>
    </article>

    </div>

      <a href="editar_articulos_guardados.php">
      <button class="button_cpanel" type="button">
      VER TODAS LAS PLANTAS QUE QUIERO
      </button>
      </a>

</div>

<div class="misdatos_cpanel">

  <a href="perfil.php">
  <button class="perfil_button_cpanel" type="button">
  MIS DATOS
  </button>
  </a>

<!-- </div>

<div class="misdatos_cpanel"> -->

  <a href="borrar_cuenta.php">
  <button class="borrar button_cpanel" type="button">
  BORRAR CUENTA
  </button>
  </a>

</div>

</div>



<?php include("partials/js.php"); ?>
  </body>
</html>

<!-- pendiente:
- mejorar líneas punteadas
- primer slide del carrusel: ver el tema active
- si queda esta primer slide hay que arreglar el tamaño
- arreglar también el hover de ese ítem
- inbox
- carrusel wishlist (ojo con las clases de bootstrap)
- acción botón borrar cuenta
- el botón borrar cuenta queda ahí?
- si el usuario no tiene plantas, poner algo en que lo diga en la calesita-->
