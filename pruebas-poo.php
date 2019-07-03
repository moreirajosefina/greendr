<?php
include "init.php";

$planta = $dbAll->traerUnaPlanta("20");
echo "probando traer una planta:";
var_dump($planta);

$articulo = new Articulo($dbAll->traerUnaPlanta("20"));
echo "probando new articulo:";
var_dump($articulo);


// $articulos = traerTodasLasPlantas();
// echo "probando traer todas las plantas:";
// var_dump($articulos);


echo "probando traer las plantas por id usuario:";
$plantas = $dbAll->traerPlantas("7");?>
<?php foreach ($plantas as $key => $value) : ?>
<?php $planta = new Articulo($value) ?>
<?php var_dump($planta) ?>

  <?php endforeach; ?>


<?php

$usuario = $dbAll->buscarUsuarioPorMailoUser("fanita");
echo "buscarUsuarioPorMailoUser:";
var_dump($usuario);

 ?>




 ?>
