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

<body>
  <?php 
    if (!isset($_SESSION['username'])) { 
  ?>
    <!-- Se muestra cuando el usuario no ha iniciado sesión -->
    <form align="center" action="consultas/importar_usuarios.php" method="post">
      <input type="submit" onclick="Click();" value="Cargar usuarios">
    </form>
    <label class="lblname" >Antes de ingresar por favor presionar el botón para cargar los usuarios</label>
    </section>
    <br></br>
    <form align="center" action="views/login.php" method="get">
        <input type="submit" value="Iniciar sesión">
    </form>


  <?php } else { ?>
    <!-- Cuando el usuario ya ingresó a su sesión -->
    
    <h2 class="title is-1"> Hola <?php echo $_SESSION['username'] ?></h2>
    <form class="buttons" action="views/logout.php">
      <input class="button" type="submit" value="Cerrar Sesión">
    </form>
  <?php } ?>
</body>
<!--  -->

<?php include('./templates/footer.php'); ?>
