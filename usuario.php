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

// debug:
// var_dump($usuarioPlanta);
// echo "nombre de la planta: ";
// echo $usuarioPlanta["nombre"];
// fin debug
$titulo= "GREENDR - " . $usuarioPlanta["user"];
?>

<!DOCTYPE html>
<html>

<?php include("partials/head.php"); ?>

  <body>

<?php include("partials/nav.php"); ?>

<div class="contenedor_registro">

<!-- <h3 class="h3_nombre_perfil">USUARIO:</h3> -->

<div class="nombre_perfil">
<h3 class="h3_nombre_perfil"><?=$usuarioPlanta["user"]?></h3>
<img class="avatar_perfil" src="<?=$usuarioPlanta["avatar"]?>" alt="avatar">
</div>


<div class="main">
<?php $id = $usuarioPlanta["id"];
$plantas = $dbAll->traerPlantas($id);?>
<?php foreach ($plantas as $key => $value) : ?>

<article class="product">

<a class="odio" href="articulo.php?id=<?=$value["id"]?>">
<img class="photo" src="<?=$plantas[$key]["imagen1"]?>" alt="planta">

    <div class="texto">
      <h3><?=$plantas[$key]["categoria"] ?></h3>

      <h2><?=$plantas[$key]["nombre"] ?></h2>
    </div>

  </a>
</article>

<?php endforeach; ?>

</div>

</div>



<?php include("partials/js.php"); ?>
  </body>
</html>
