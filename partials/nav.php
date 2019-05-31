<div class="contenedor_nav">
<!-- LOGOs -->
  <div class="logo">
    <a href="index.php">
    <img class="logotipo"src="media/logos/logoOK.png" alt="logotipo">
    <img class="logotipo2" src="media/logos/logo-small.png" alt="logotipo2">
 </a>
  </div>

  <nav>

  <!-- BUSCADOR -->

  <div class="buscador_container">
<form class="form_nav" action="index.php" method="post">
<input class="input_nav" type="search" name="search" value="">
<button class="button_nav" type="submit"><i class="fa fa-search"></i></button>
</form>
  </div>

<!-- ICONOS -->

  <?php if(usuarioLogueado()):?>
    <?php $usuario = traerUsuarioLogueado(); ?>
    <div class="iconos-container">

      <a class="iconos" href="index.php"><i class="fas fa-home"></i></a>

      <!-- <a class="iconos" href= "perfil.php"> <img src="<?=$usuario["avatar"]?>" class="avatar" alt="avatar"> <p class=""><?=$usuario["user"]?></p> </a> -->

      <div class="chip">
        <a href="perfil.php">
        <img src="<?=$usuario["avatar"]?>" class="avatar" alt="avatar">
        <?=$usuario["user"]?>
        </a>
      </div>


      <!-- <a class="iconos" href="#"><i class="fas fa-bars"></i></a> -->

      <div class="dropdown">

        <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <a class="iconos" href="#"></a>
          <i class="fas fa-bars"></i>
        </button>

        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
          <button class="dropdown-item" type="button"> <a href="perfil.php">Mi cuenta</a> </button>
          <button class="dropdown-item" type="button"> <a href="#">Subir ítem</a> </button>
          <button class="dropdown-item" type="button"> <a href="#">Recomendaciones</a></button>
          <button class="dropdown-item" type="button"> <a href="que_es_como_funciona.php">Preguntas frecuentes</a></button>
          <button class="dropdown-item" type="button"> <a href="#">Contacto</a></button>
          <button class="dropdown-item" type="button"> <a href="logout.php">Cerrar sesión</a></button>
        </div>

      </div>
    </div>

  <?php else: ?>
    <div class="iconos-container">

      <a class="iconos" href="index.php"><i class="fas fa-home"></i></a>

      <!-- <a class="iconos" href="login.php"><i class="fas fa-user"></i></a> -->

      <!-- <div class="chip">
      <a class="iconos" href="login.php"><i class="fas fa-user"></i></a>
      <fieldset class="chip_fieldset">
      <a class="iconos" href="login.php">LOGIN </a>
      </fieldset>
      </div> -->

<div class="chip">
  <a href="login.php">
  <i class="fas fa-user"></i>
  LOGIN
  </a>
</div>

      <!-- <a class="iconos" href="#"><i class="fas fa-bars"></i></a> -->

      <div class="dropdown">

        <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <a class="iconos" href="#"></a>
          <i class="fas fa-bars"></i>
        </button>

        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
          <button class="dropdown-item" type="submit"> <a href="login.php">Iniciar sesión</a></button>
          <button class="dropdown-item" type="button"> <a href="que_es_greendr.php">Qué es Greendr</a></button>
          <button class="dropdown-item" type="button"> <a href="#">Recomendaciones</a></button>
          <button class="dropdown-item" type="button"> <a href="como_funciona.php">Preguntas frecuentes</a> </button>
          <button class="dropdown-item" type="button"> <a href="#">Contacto</a></button>

        </div>
      </div>

    </div>
  <?php endif; ?>
</nav>

</div>
