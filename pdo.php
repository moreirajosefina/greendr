<?php

$dsn = "mysql:host=127.0.0.1;dbname=greendr_db;port=3306";
$user = "root";
$pass = "root";

try {
  $db = new PDO ($dsn, $user, $pass);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // echo "todo bien";
} catch (\Exception $e) {
  echo "Hubo un error. <br>";
  echo $e->getMessage();
  exit;
}
