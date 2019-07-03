<?php

$titulo= "GREENDR - Home";

// include "funciones_greendr.php";
include "init.php";

if (isset($_COOKIE["ultimoUsuario"])){
  $_SESSION["usuario"] = $_COOKIE["ultimoUsuario"];
}else{
$usuarioLogueado = $auth->usuarioLogueado();
// devuelve true o false
}

// $usuario = traerUsuarioLogueado();
$usuario = $dbAll->traerUsuarioLogueado();
// $usuario va a contener todo el array con los datos del usuario

// debug
// echo "$ usuario:";
// var_dump($usuario);
// echo "$ POST:";
// var_dump($_POST);
// echo "$ SESSION:";
// var_dump($_SESSION);
// echo "$ COOKIE:";
// var_dump ($_COOKIE);
// borrar cookies
// setcookie("usuario", "", -1);
// setcookie("password", "", -1);
// fin debug

 ?>


<!DOCTYPE html>
<html>

<?php include("partials/head.php"); ?>

	<body>

<?php include("partials/nav.php"); ?>

		<!-- <section class="main"> -->

<?php if(!$auth->usuarioLogueado()):?>

  <section class="section_onBoarding">

<!-- on boarding mobile -->
<div id="mobile_boarding" class="mobile_boarding">

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">

    <!-- <div class="carousel-item active">
      <img src="..." class="d-block w-100" alt="...">
    </div> -->

<div class="carousel-item active">
    <article class="product onBoarding mobile d-block w-100">
      <a class="odio onBoarding_a" href="que_es_greendr.php">
        <img class="photo onBoarding_photo" src="media/onboarding/obA.png" alt="obA">
        <div class="texto onBoarding_texto">
          <h2 class="onBoarding_h2">QUÉ ES GREENDR</h2>
        </div>
      </a>
    </article>
</div>

<div class="carousel-item">
      <article class="product onBoarding mobile d-block w-100">
        <a class="odio onBoarding_a" href="como_funciona.php">
          <img class="photo onBoarding_photo" src="media/onboarding/obB.png" alt="obB">
          <div class="texto onBoarding_texto">
            <h2 class="onBoarding_h2">CÓMO INTERCAMBIAR PLANTAS</h2>
          </div>
        </a>
      </article>
</div>

<div class="carousel-item">
      <article class="product onBoarding mobile d-block w-100">
        <a class="odio onBoarding_a" href="registro.php">
          <img class="photo onBoarding_photo" src="media/onboarding/obC.png" alt="obC">
          <div class="texto onBoarding_texto">
            <h2 class="onBoarding_h2">REGISTRATE ACÁ</h2>
          </div>
        </a>
      </article>
</div>

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

<!-- on boarding tablet -->
<article class="product onBoarding tablet">
  <a class="odio onBoarding_a" href="que_es_como_funciona.php">
    <img class="photo onBoarding_photo" src="media/onboarding/obA.png" alt="obA">
    <div class="texto onBoarding_texto">
      <h2 class="onBoarding_h2">QUÉ ES GREENDR</h2>
      <br>
      <h2 class="onBoarding_h2">CÓMO INTERCAMBIAR PLANTAS</h2>
    </div>
  </a>
</article>

<article class="product onBoarding tablet">
  <a class="odio onBoarding_a" href="registro.php">
    <img class="photo onBoarding_photo" src="media/onboarding/obC.png" alt="obC">
    <div class="texto onBoarding_texto">
      <h2 class="onBoarding_h2">REGISTRATE ACA</h2>
    </div>
  </a>
</article>


<!-- on boarding desktop   -->
      <article class="product onBoarding desktop">
        <a class="odio onBoarding_a" href="que_es_greendr.php">
          <img class="photo onBoarding_photo" src="media/onboarding/obA.png" alt="obA">
          <div class="texto onBoarding_texto">
            <h2 class="onBoarding_h2">QUÉ ES GREENDR</h2>
          </div>
        </a>
      </article>

      <article class="product onBoarding desktop">
        <a class="odio onBoarding_a" href="como_funciona.php">
          <img class="photo onBoarding_photo" src="media/onboarding/obB.png" alt="obB">
          <div class="texto onBoarding_texto">
            <h2 class="onBoarding_h2">CÓMO INTERCAMBIAR PLANTAS</h2>
          </div>
        </a>
      </article>

      <article class="product onBoarding desktop">
        <a class="odio onBoarding_a" href="registro.php">
          <img class="photo onBoarding_photo" src="media/onboarding/obC.png" alt="obC">
          <div class="texto onBoarding_texto">
            <h2 class="onBoarding_h2">REGISTRATE ACÁ</h2>
          </div>
        </a>
      </article>

</section>

<?php endif; ?>



<section class="main">

<?php $plantas = $dbAll->traerTodasLasPlantas();?>

      <?php shuffle($plantas) ?>

<?php foreach ($plantas as $key => $value) : ?>
  <?php $planta = new Articulo($value) ?>

			<article class="product">
<?php if($auth->usuarioLogueado()):?>
    <a class="odio" href="articulo.php?id=<?=$planta->getId()?>">
    <img class="photo" src="<?=$planta->getImagen1()?>" alt="planta">
<?php else: ?>
      <a class="odio" href="login.php">
      <img class="photo" src="<?=$planta->getImagen1()?>" alt="planta">
<?php endif; ?>
          <div class="texto">
            <h3><?=$planta->getId_categoria() ?></h3>
            <h2><?=$planta->getNombre() ?></h2>
          </div>
        </a>
			</article>

<?php endforeach; ?>

		</section>



<?php include("partials/js.php"); ?>

	</body>
</html>
