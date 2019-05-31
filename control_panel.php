<?php
$titulo= "GREENDR - Panel de control";

include "funciones_greendr.php";

if(!usuarioLogueado()){
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

<?php $usuario = traerUsuarioLogueado() ?>

<div class="nombre_perfil">
<h3 class="h3_nombre_perfil"><?="Nombre de usuario: ". $usuario["user"]?></h3>
<img class="avatar_perfil" src="<?=$usuario["avatar"]?>" alt="avatar">
</div>

<div class="plantas_cpanel">

<a href="formulario_subida.php">
<button class="button_cpanel" type="button">
SUBIR PLANTA*
</button>
</a>
<p class="p_cpanel"><i>  *Planta, esqueje, semillas, producto o servicio de jardinería. </i></p>

<a href="editar_items.php">
<button class="button_cpanel" type="button">
MIS ÍTEMS
</button>
</a>

<section class="preview_items">

reemplazar foreach por select limit 3
      ?php shuffle($articulos) ?>

			?php foreach ($articulos as $key => $value) : ?>

			<article class="product_preview_items">
    <a class="odio" href="articulo.php">
    <img class="photo" src="media/imagenes/< ?=$articulos[$key]["imagen"] ?>" alt="planta">
    </a>
			</article>

		?php endforeach; ?>

		</section>

    <a href="editar_items.php">
    <button class="button_cpanel" type="button">
    VER TODOS
    </button>
    </a>

</div>

<div class="misdatos_cpanel">

  <a href="perfil.php">
  <button class="button_cpanel" type="button">
  MIS DATOS
  </button>
  </a>

</div>

<div class="mensajes_cpanel">

  <p>ACA VA UNA CAJA CON MENSAJES</p>

</div>

<div class="wishlist_cpanel">

  <section class="preview_items">

  reemplazar foreach por select limit 3
        ?php shuffle($articulos) ?>

  			?php foreach ($articulos as $key => $value) : ?>

  			<article class="product_preview_items">
      <a class="odio" href="articulo.php">
      <img class="photo" src="media/imagenes/< ?=$articulos[$key]["imagen"] ?>" alt="planta">
      </a>
  			</article>

  		?php endforeach; ?>

  		</section>

      <a href="editar_items_guardados.php">
      <button class="button_cpanel" type="button">
      VER TODOS
      </button>
      </a>

</div>

</div>



<?php include("partials/js.php"); ?>
  </body>
</html>
