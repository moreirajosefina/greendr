<?php
$titulo= "GREENDR - Subir planta";

// include "funciones_greendr.php";
include "init.php";

if(!$auth->usuarioLogueado()){
  header("Location:index.php");
  exit;
}

// debug
// echo "POST";
// var_dump($_POST);
//
// echo "FILES";
// var_dump($_FILES);
//
// echo "SESSION";
// var_dump($_SESSION);
// fin debug


// variables para persistencia:
$nombreOut = "";
$n_cientificoOut = "";
$descripcionOut = "";

if($_POST){

  $erroresOut = Validador::validarSubidaArticulo($_POST);
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
// fin debug

  if(empty($erroresOut)){
      $articulo = new Articulo($_POST);
      // echo "return articulo armado";
      // var_dump($articulo);
      // exit;
      $dbAll->guardarArticulo($articulo);

      //subir imagen;
      move_uploaded_file($_FILES["imagen1"]["tmp_name"], $articulo->getImagen1());
      if ($_FILES["imagen2"]["error"] == 0){
        move_uploaded_file($_FILES["imagen2"]["tmp_name"], $articulo->getImagen2());
      }
      if ($_FILES["imagen3"]["error"] == 0){
        move_uploaded_file($_FILES["imagen3"]["tmp_name"], $articulo->getImagen3());
      }

      header("Location:editar_mis_articulos.php");
      exit;

    }

  }



 ?>

 <!DOCTYPE html>
 <html>

 <?php include("partials/head.php"); ?>

   <body>

<?php include("partials/nav.php"); ?>

<div class="contenedor_formularioSubida">

<h3 class="h3_formularioSubida">SUBIR PLANTA PARA INTERCAMBIO</h3>

<form class="form_formularioSubida" action="formulario_subida.php" method="post" enctype="multipart/form-data">

  <div class="items_formularioSubida">
        <label class="label_formularioSubida" for="nombre">Nombre: </label>

        <input class="input_formularioSubida" type="text" id="nombre" name="nombre" value="<?php if(isset($erroresOut["nombre"])){$nombreOut="";}else{echo $nombreOut;}?>">

        <p class="error_formularioSubida">
        <?php if(isset($erroresOut["nombre"])){echo $erroresOut["nombre"]; } ?>
        </p>
  </div>

  <div class="items_formularioSubida">
        <label class="label_formularioSubida" for="n_cientifico">Nombre científico: </label>

        <input class="input_formularioSubida" type="text" id="n_cientifico" name="n_cientifico" value="<?php if(isset($erroresOut["n_cientifico"])){$n_cientificoOut="";}else{echo $n_cientificoOut;}?>">

        <p class="error_formularioSubida">
        <?php if(isset($erroresOut["n_cientifico"])){echo $erroresOut["n_cientifico"]; } ?>
        </p>
  </div>

  <div class="div_categoria items_formularioSubida">
        <label class="label_formularioSubida" for="">Categoría: </label>

<div class="radio_items_formularioSubida">
        <label class="radio_label_formularioSubida" for="planta">Planta: </label>
        <?php if(isset($_POST["categoria"]) && $_POST["categoria"] == 1): ?>
        <input class="radio1_input_formularioSubida" type="radio" id="planta" name="categoria" value="1" checked>
        <?php else: ?>
        <input class="radio1_input_formularioSubida" type="radio" id="planta" name="categoria" value="1">
        <?php endif ?>

        <label class="label_formularioSubida" for="esqueje">Esqueje: </label>
        <?php if(isset($_POST["categoria"]) && $_POST["categoria"] == 2): ?>
        <input class="radio1_input_formularioSubida" type="radio" id="esqueje" name="categoria" value="2" checked>
        <?php else: ?>
        <input class="radio1_input_formularioSubida" type="radio" id="esqueje" name="categoria" value="2">
        <?php endif ?>

        <label class="label_formularioSubida" for="semillas">Semillas: </label>
        <?php if(isset($_POST["categoria"]) && $_POST["categoria"] == 3): ?>
        <input class="radio1_input_formularioSubida" type="radio" id="semillas" name="categoria" value="3" checked>
        <?php else: ?>
        <input class="radio1_input_formularioSubida" type="radio" id="semillas" name="categoria" value="3">
        <?php endif ?>

        <label class="label_formularioSubida" for="producto">Producto: </label>
        <?php if(isset($_POST["categoria"]) && $_POST["categoria"] == 4): ?>
        <input class="radio1_input_formularioSubida" type="radio" id="producto" name="categoria" value="4" checked>
        <?php else: ?>
        <input class="radio1_input_formularioSubida" type="radio" id="producto" name="categoria" value="4">
        <?php endif ?>

        <label class="label_formularioSubida" for="servicio">Servicio: </label>
        <?php if(isset($_POST["categoria"]) && $_POST["categoria"] == 5): ?>
        <input class="radio1_input_formularioSubida" type="radio" id="servicio" name="categoria" value="5" checked>
        <?php else: ?>
        <input class="radio1_input_formularioSubida" type="radio" id="servicio" name="categoria" value="5">
        <?php endif ?>
</div>
        <p class="error_formularioSubida">
        <?php if(isset($erroresOut["categoria"])){echo $erroresOut["categoria"]; } ?>
        </p>
  </div>

  <div class="items_formularioSubida">
        <label class="label_descripcion label_formularioSubida" for="desc">Descripción: </label>

        <!-- <textarea id="desc" name="descripcion" rows="5" cols="45" placeholder="Describe yourself here..."><?=$descripcionOut?> </textarea> -->

<textarea id="desc" name="descripcion" rows="5" cols="45" placeholder="Información sobre la planta..."><?=$descripcionOut?></textarea>

        <p class="error_formularioSubida">
        <?php if(isset($erroresOut["descripcion"])){echo $erroresOut["descripcion"]; } ?>
        </p>
  </div>

  <div class="items_formularioSubida">

        <label class="label_formularioSubida" for="">Imágenes: </label>

        <input class="input_formularioSubida_avatar" type="file" id="" name="imagen1" value= "">

        <p class="error_formularioSubida">
        <?php if(isset($erroresOut["imagen1"]["error"])){echo $erroresOut["imagen1"]["error"]; }
        if(isset($erroresOut["imagen1"]["size"])){echo $erroresOut["avatar"]["size"]; }
        if(isset($erroresOut["imagen1"]["type"])){echo $erroresOut["imagen1"]["type"]; }   ?>
        </p>

        <input class="input_formularioSubida_avatar" type="file" id="" name="imagen2" value= "">

        <p class="error_formularioSubida">
        <?php if(isset($erroresOut["imagen2"]["error"])){echo $erroresOut["imagen2"]["error"]; }
        if(isset($erroresOut["imagen2"]["size"])){echo $erroresOut["avatar"]["size"]; }
        if(isset($erroresOut["imagen2"]["type"])){echo $erroresOut["imagen2"]["type"]; }   ?>
        </p>

        <input class="input_formularioSubida_avatar" type="file" id="" name="imagen3" value= "">

        <p class="error_formularioSubida">
        <?php if(isset($erroresOut["imagen3"]["error"])){echo $erroresOut["imagen3"]["error"]; }
        if(isset($erroresOut["imagen3"]["size"])){echo $erroresOut["avatar"]["size"]; }
        if(isset($erroresOut["imagen3"]["type"])){echo $erroresOut["imagen3"]["type"]; }   ?>
        </p>

        <p>PENDIENTE: PREVIEW IMAGE</p>

  </div>

  <div class="items_formularioSubida">

      <p>PENDIENTE: SETEAR UBICACION</p>

  </div>


<!-- <input type="checkbox" name="recordarme" value="si"> Recordarme<br> -->

  <div class="items_formularioSubida">
       <button class="enviar_formularioSubida" type="submit"><p class="crear">SUBIR PLANTA</p></button>
  </div>

  <div class="items_formularioSubida">
       <button class="reset_formularioSubida" type="button">
<a href="formulario_subida.php"><p class="crear">RESET</p></a>
       </button>

       <!-- Type reset borra los datos cargados pero deja marcados los errores :( -->
       <!-- -Tip: Avoid reset buttons in your forms! It is frustrating for users if they click them by mistake.
       -Tip: Always specify the type attribute for the <button> element. Different browsers may use different default types for the <button> element. -->

  </div>

</form>
</div>

<?php include("partials/js.php"); ?>
   </body>
 </html>

 <!-- pendiente:
 - Preview upload imágenes (mostrar y setear imágen)
 - Setear ubicaióna
 - Elegir más de un punto de ubicación?
 - Agregar cantidad disponible de artículos? Si se agrega esto, agregarlo también a la DB
 - Ojo comillas en el nombre
 - Agregar Help para el nombre científico
 - Marcar campos obligatorios?
 - Poner link a recomendaciones de como subir un artículo
 - Poner tope de caracteres en la descripción?? wrap soft o hard??
 - Asignación de ID en el nombre del archivo: está bien el método?
 - RESOLVER: El nombre no está funcionando con acentos
 -> no funciona el strtoupper
 -> no conviene para el link del archivo
https://regexr.com/-->
