
<div class="scontainer">
  <div class="logo">
    <a href="index.php">
    <img class="logotipo"src="media/logos/logoOK.png" alt="logotipo">
    <img class="logotipo2" src="media/logos/logo-small.png" alt="logotipo2">
 </a>
  </div>
  <nav class="barra">
    <form class="sform" action="index.php" method="post">
      <fieldset class="sfieldset">
        <input class="sinput" type="search" name="search" value="">
        <button class="sbutton" type="submit" >
          <i class="fas fa-search"></i>

        </button>
     </fieldset>
   </form>
</nav>

   <?php if(usuarioLogueado()):?>
     <?php $usuario = traerUsuarioLogueado(); ?>
     <div class="iconos-container">

       <a class="iconos" href="index.php"><i class="fas fa-home"></i></a>
       <a class="iconos" href= "perfil.php"> <img src="<?=$usuario["avatar"]?>" class="avatar" alt="avatar"> <p class=""><?=$usuario["user"]?></p> </a>
       <div class="dropdown">
         <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <a class="iconos" href="#"></a>
           <i class="fas fa-bars"></i>
         </button>
         <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
           <button class="dropdown-item" type="button"> <a href="#">Mi cuenta</a> </button>
           <button class="dropdown-item" type="button"> <a href="#">Recomendaciones</a></button>
           <button class="dropdown-item" type="button"> <a href="#">Preguntas frecuentes</a></button>
           <button class="dropdown-item" type="button"> <a href="logout.php">Cerrar sesión</a></button>
         </div>
       </div>
     </div>

   <?php else: ?>
     <div class="iconos-container">
              <a class="iconos" href="index.php"><i class="fas fa-home"></i></a>
       <a class="iconos" href="login.php"><i class="fas fa-user"></i></a>
       <div class="dropdown">
         <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <a class="iconos" href="#"></a>
           <i class="fas fa-bars"></i>
         </button>
         <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
           <button class="dropdown-item" type="submit"> <a href="login.php">Iniciar sesión</a>
             <button class="dropdown-item" type="button"> <a href="#">Preguntas frecuentes</a> </button>
             <button class="dropdown-item" type="button"> <a href="#">Quienes somos</a></button>
             <button class="dropdown-item" type="button"> <a href="#">Contacto</a></button>

           </a></button>
         </div>
       </div>
     </div>


   <?php endif; ?>

<!-- por qué no funciona poner $usuarioLogueado si la variable está declarada en index? -->

</div>
