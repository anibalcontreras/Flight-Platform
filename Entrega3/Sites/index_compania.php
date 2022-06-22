<?php 
require_once "./__init__.php";
include('./templates/header.php'); ?>
<nav class="navbar">
  <div class="container">
    <div id="navMenu" class="navbar-menu">
      <div class="navbar-start">
        <a class="navbar-item">
          Home
        </a>
      </div>

      <div class="navbar-end">
        <div class="navbar-item">
        </div>
      </div>
    </div>
  </div>
</nav>

<section class="hero is-link is-fullheight-with-navbar">
  <div class="hero-body">
    <p class="title">
      Entrega 3 Grupo 105 - 106
    </p>
  </div>

  <!--  -->
  <?php 
    if (isset($_SESSION['username'])) { 
  ?>
    <!-- Cuando el usuario ya ingresó a su sesión -->
    
    <h2 class="title is-1"> Hola Compañia <?php echo $_SESSION['username'] ?></h2>

  


    <form class="buttons" action="views/logout.php">
        <input class="button" type="submit" value="Cerrar Sesión">
    </form>
  <?php } ?>
<!--  -->

<?php include('./templates/footer.php'); ?>