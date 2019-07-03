<?php

/**
 * Iniciar sesión, loguear y controlar que el usuario esté logueado.
 */
class Auth
{

  function __construct()
  {
    session_start();
  }

  public function loguearUsuario($emailoUser){
    $_SESSION["usuario"] = $emailoUser;
  }

  public function usuarioLogueado(){
     return isset($_SESSION["usuario"]);
  }

  public function recordarme(){
    global $dbAll;
    if (isset($_POST["recordarme"]) && $_POST["recordarme"] == "si"){
      $usuario = $dbAll->traerUsuarioLogueado();
      setcookie($usuario->getId().'[user]', $_POST["logUser"]);
    }
  }

  public function dejarDeRecordarme (){
    global $dbAll;
    if (isset($_POST["recordarme"]) && $_POST["recordarme"] == "no"){
      $usuario = $dbAll->traerUsuarioLogueado();
      setcookie($usuario->getId().'[user]', "", -1);
      setcookie("ultimoUsuario", "", -1);
    }
  }

  public function siguienteSession ($emailoUser){
      setcookie("ultimoUsuario", $emailoUser);
  }


}
