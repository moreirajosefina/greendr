<?php

include ("funciones_greendr.php");

echo "$ session";
echo "<br>";
var_dump($_SESSION);

$usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);

var_dump($usuario);
echo "<br>";

$traerUsuario = traerUsuarioLogueado();
echo "traer usuario";
echo "<br>";
var_dump($traerUsuario);

echo "<br>";
echo " usuario[user]";
echo $usuario["user"];

echo "json";
$json = file_get_contents("db.json");
$array = json_decode($json, true);

// $usuario = buscarUsuarioPorMailoUser($_SESSION["usuario"]);
var_dump($array);

 ?>
