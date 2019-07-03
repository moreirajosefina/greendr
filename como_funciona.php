<?php
$titulo= "Cómo funciona GREENDR";

// include "funciones_greendr.php";
include "init.php";

// if(usuarioLogueado()){
//   header("Location:index.php");
//   exit;
// }

?>

<!DOCTYPE html>
<html>

<?php include("partials/head.php"); ?>

  <body>

<?php include("partials/nav.php"); ?>

<div class="contenedor_boarding">

<h3 class="h3_boarding">CÓMO FUNCIONA GREENDR</h3>

<div class="texto_boarding">
  <p class="p_boarding">Para empezar a usar Greendr primero tenés que registrarte.</p>
  <p class="p_boarding">Una vez que tengas tu usuario podés empezar a subir las plantas* que quieras ofrecer para intercambio.</p>
  <p class="p_boarding">Navegando por Greendr vas a ver las plantas* que ofrecen otros usuarios.</p>
  <p class="p_boarding">Cuando veas una planta* que te guste, vas a poder clickear en el ítem para conocer más detalles y si te interesa, podés clickear en el botón "Quiero esta planta" para hacerle saber al otro usuario que te gustaría tener la planta* que ofrece.</p>
  <p class="p_boarding"> Si el otro usuario está interesado en alguna de las plantas* que vos ofrecés, entonces hay "COINCIDENCIA" y entre los usuarios combinan un punto de encuentro para hacer el intercambio feliz. </p>
  <p class="p_boarding"> Visitá nuestra sección de "Recomendaciones" para tener más información sobre cómo preparar las plantas, lugares recomendados para combinar el encuentro, entre otras cosas. </p>
  <p class="p_boarding"> ¡A intercambiar plantas*! </p>
  <p class="p_boarding"><i>  *Plantas, esquejes, semillas, productos o servicios de jardinería. </i></p>

</div>

<div class="links_boarding">

<!-- <a href="#"><p class="p_boarding">Cómo funciona Greendr</p></a>
<a href="#"><p class="p_boarding">Registrate acá</p></a> -->

<a href="que_es_greendr.php">
<button class="button_boarding" type="button">
Qué es Greendr
</button>
</a>

<a href="registro.php">
<button class="button_boarding" type="button">
Registrate acá
</button>
</a>

</div>

</div>





<?php include("partials/js.php"); ?>
  </body>
</html>
