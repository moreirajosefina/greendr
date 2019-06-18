<?php
$titulo= "GREENDR - Mis plantas";

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
$planta = new Articulo ($planta);

// debug:
// var_dump($planta);
// fin debug

// variables para persistencia:
$nombreOut = "";
$n_cientificoOut = "";
$descripcionOut = "";


if($_POST){

  $erroresOut = Validador::validarModificionArticulo($_POST);
  // erroresOUT son solo errores, NO DATOS

// variables para persistencia:

// $nombreOut = trim($_POST["nombre"]);
$nombreOut = str_replace('"',"'",  trim($_POST["nombre"]));

// $n_cientificoOut = trim($_POST["n_cientifico"]);
$n_cientificoOut = str_replace('"',"'",  trim($_POST["n_cientifico"]));

$descripcionOut = trim($_POST["descripcion"]);


// debug
  // echo "erroresOUT";
  // var_dump($erroresOut);
  // echo "Post";
  // var_dump($_POST);
  // echo "Files";
  // var_dump($_FILES);
// fin debug

  if(empty($erroresOut)){
      // $articuloModificado = armarArticuloModificado($idPlanta);
      $articuloModificado = new Articulo ($dbAll-> traerUnaPlanta($idPlanta));
// var_dump($articuloModificado);
// exit;
      $dbAll->guardarArticuloModificado($articuloModificado);

      //subir imagen;
    if ($_FILES["imagen1"]["error"] == 0){
    move_uploaded_file($_FILES["imagen1"]["tmp_name"], $articuloModificado->getImagen1());
    }
    if ($_FILES["imagen2"]["error"] == 0){
      move_uploaded_file($_FILES["imagen2"]["tmp_name"], $articuloModificado->getImagen2());
    }
    if ($_FILES["imagen3"]["error"] == 0){
      move_uploaded_file($_FILES["imagen3"]["tmp_name"], $articuloModificado->getImagen3());
    }

    // header("Location:editar_mis_articulos.php");
    header("Location:articulo.php?id=$idPlanta");
    exit;
  }

}


 ?>


<!DOCTYPE html>
<html>

<?php include("partials/head.php"); ?>

  <body>

<?php include("partials/nav.php"); ?>


<!-- <div class="contenedor_articulo"> -->
  <div class="contenedor_editarArticulo">


<h3 class="h3_editarArticulo">MODIFICAR PLANTA:</h3>


<h3 class="h3_editarArticulo"><?=$planta->getNombre()?></h3>


<form class="form_editarArticulo" action="editar_articulo.php?id=<?=$planta->getId()?>" method="post" enctype="multipart/form-data">

  <div class="items_editarArticulo">
        <label class="label_editarArticulo" for="nombre">Nombre: </label>

        <input class="input_editarArticulo" type="text" id="nombre" name="nombre"
        <?php if(isset($erroresOut["nombre"])): ?>
          value= "<?=$nombreOut=""?>"
        <?php elseif(!isset($erroresOut["nombre"]) && isset($_POST["nombre"])): ?>
          value= "<?=$nombreOut?>"
        <?php else:  ?>
          value= "<?=$planta->getNombre()?>"
       <?php endif; ?>
      >
        <p class="error_editarArticulo">
        <?php if(isset($erroresOut["nombre"])){echo $erroresOut["nombre"]; } ?>
        </p>
  </div>

  <div class="items_editarArticulo">
        <label class="label_editarArticulo" for="n_cientifico">Nombre científico: </label>

        <input class="input_editarArticulo" type="text" id="n_cientifico" name="n_cientifico"
        <?php if(isset($erroresOut["n_cientifico"])): ?>
          value= "<?=$n_cientificoOut=""?>"
        <?php elseif(!isset($erroresOut["n_cientifico"]) && isset($_POST["n_cientifico"])): ?>
          value= "<?=$n_cientificoOut?>"
        <?php else:  ?>
          value= "<?=$planta->getNcientifico()?>"
       <?php endif; ?>
      >
        <p class="error_editarArticulo">
        <?php if(isset($erroresOut["n_cientifico"])){echo $erroresOut["n_cientifico"]; } ?>
        </p>
  </div>

  <div class="div_categoria items_editarArticulo">
        <label class="label_editarArticulo" for="">Categoría: </label>

<div class="radio_items_editarArticulo">
        <label class="radio_label_editarArticulo" for="planta">Planta </label>
        <?php if((isset($_POST["categoria"]) && $_POST["categoria"] == 1 )|| $planta->getId_categoria() == "PLANTA"): ?>
        <input class="radio1_input_editarArticulo" type="radio" id="planta" name="categoria" value="1" checked>
        <?php else: ?>
        <input class="radio1_input_editarArticulo" type="radio" id="planta" name="categoria" value="1">
        <?php endif ?>

        <label class="radio_label_editarArticulo" for="esqueje">Esqueje </label>
        <?php if((isset($_POST["categoria"]) && $_POST["categoria"] == 2) || $planta->getId_categoria() == "ESQUEJE"): ?>
        <input class="radio1_input_editarArticulo" type="radio" id="esqueje" name="categoria" value="2" checked>
        <?php else: ?>
        <input class="radio1_input_editarArticulo" type="radio" id="esqueje" name="categoria" value="2">
        <?php endif ?>

        <label class="radio_label_editarArticulo" for="semillas">Semillas </label>
        <?php if((isset($_POST["categoria"]) && $_POST["categoria"] == 3 )|| $planta->getId_categoria() == "SEMILLAS"): ?>
        <input class="radio1_input_editarArticulo" type="radio" id="semillas" name="categoria" value="3" checked>
        <?php else: ?>
        <input class="radio1_input_editarArticulo" type="radio" id="semillas" name="categoria" value="3">
        <?php endif ?>

        <label class="radio_label_editarArticulo" for="producto">Producto </label>
        <?php if((isset($_POST["categoria"]) && $_POST["categoria"] == 4) || $planta->getId_categoria() == "PRODUCTO"): ?>
        <input class="radio1_input_editarArticulo" type="radio" id="producto" name="categoria" value="4" checked>
        <?php else: ?>
        <input class="radio1_input_editarArticulo" type="radio" id="producto" name="categoria" value="4">
        <?php endif ?>

        <label class="radio_label_editarArticulo" for="servicio">Servicio </label>
        <?php if((isset($_POST["categoria"]) && $_POST["categoria"] == 5) || $planta->getId_categoria() == "SERVICIO"): ?>
        <input class="radio1_input_editarArticulo" type="radio" id="servicio" name="categoria" value="5" checked>
        <?php else: ?>
        <input class="radio1_input_editarArticulo" type="radio" id="servicio" name="categoria" value="5">
        <?php endif ?>
  </div>
        <p class="error_editarArticulo">
        <?php if(isset($erroresOut["categoria"])){echo $erroresOut["categoria"]; } ?>
        </p>
  </div>

  <div class="items_editarArticulo">
        <label class="label_editarArticulo" for="desc">Descripción: </label>

<textarea id="desc" name="descripcion" rows="5" cols="45" placeholder="..."><?php if(isset($erroresOut["descripcion"])):?><?=$descripcionOut=""?><?php elseif(!isset($erroresOut["descripcion"]) && isset($_POST["descripcion"])): ?><?=$descripcionOut?>
<?php else:  ?><?=$planta->getDescripcion()?><?php endif; ?></textarea>

        <p class="error_editarArticulo">
        <?php if(isset($erroresOut["descripcion"])){echo $erroresOut["descripcion"]; } ?>
        </p>
  </div>

  <div class="items_editarArticulo">

        <label class="label_editarArticulo" for="">Imágenes: </label>

<img class="img_editarArticulo" src="<?=$planta->getImagen1()?>" alt="imagen1">

        <label class="label_editarArticulo" for="ModificarImagen1">Modificar imagen 1: </label>

        <input class="input_editarArticulo_avatar" type="file" id="ModificarImagen1" name="imagen1" value= "">

        <p class="error_editarArticulo">
        <?php if(isset($erroresOut["imagen1"]["error"])){echo $erroresOut["imagen1"]["error"]; }
        if(isset($erroresOut["imagen1"]["size"])){echo $erroresOut["avatar"]["size"]; }
        if(isset($erroresOut["imagen1"]["type"])){echo $erroresOut["imagen1"]["type"]; }   ?>
        </p>

<?php if($planta->getImagen2() != "null"): ?>
<img class="img_editarArticulo" src="<?=$planta->getImagen2()?>" alt="imagen2">
<?php endif; ?>
        <label class="label_editarArticulo" for="ModificarImagen2">Modificar imagen 2: </label>

        <input class="input_editarArticulo_avatar" type="file" id="ModificarImagen2" name="imagen2" value= "">

        <p class="error_editarArticulo">
        <?php if(isset($erroresOut["imagen2"]["error"])){echo $erroresOut["imagen2"]["error"]; }
        if(isset($erroresOut["imagen2"]["size"])){echo $erroresOut["avatar"]["size"]; }
        if(isset($erroresOut["imagen2"]["type"])){echo $erroresOut["imagen2"]["type"]; }   ?>
        </p>

<?php if($planta->getImagen3() != "null"): ?>
<img class="img_editarArticulo" src="<?=$planta->getImagen3()?>" alt="imagen3">
<?php endif; ?>
        <label class="label_editarArticulo" for="ModificarImagen3">Modificar imagen 3: </label>

        <input class="input_editarArticulo_avatar" type="file" id="ModificarImagen3" name="imagen3" value= "">

        <p class="error_editarArticulo">
        <?php if(isset($erroresOut["imagen3"]["error"])){echo $erroresOut["imagen3"]["error"]; }
        if(isset($erroresOut["imagen3"]["size"])){echo $erroresOut["avatar"]["size"]; }
        if(isset($erroresOut["imagen3"]["type"])){echo $erroresOut["imagen3"]["type"]; }   ?>
        </p>

        <p>PENDIENTE: PREVIEW IMAGE</p>

  </div>

  <div class="items_editarArticulo">

      <p>PENDIENTE: SETEAR UBICACION</p>

  </div>

  <div class="items_editarArticulo">
       <button class="enviar_editarArticulo" type="submit"><p class="crear">GUARDAR CAMBIOS</p></button>
  </div>

  <div class="items_editarArticulo">
  <button class="descartar_editarArticulo" type="button">
  <a href="editar_mis_articulos.php"><p class="crear">DESCARTAR CAMBIOS</p></a>
  </button>

<!-- botón no funciona... no sé porqué
<button class="descartar_editarArticulo" type="button" name="button">
<a href="editar_mis_articulos.php">DESCARTAR CAMBIOS</a>
</button> -->

  </div>


</form>


</div>

<?php include("partials/js.php"); ?>
  </body>
</html>

<!-- pendiente
- setear ubicación
- preview y seteo image
- BORRAR FOTO
- borrar la foto de la carpeta archivos cuando alguien la borra (o si alguien la reemplaza por otra foto con otra extensión - hacer lo mismo con los avatares)-->
