<?php
setcookie("ultimoUsuario", "", -1);
setcookie("ultimoPassword", "", -1);

session_start();
session_destroy();

header("Location:index.php");
exit;
 ?>
