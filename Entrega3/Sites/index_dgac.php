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
    
    <h2 class="title is-1"> Hola Admin<?php echo $_SESSION['username'] ?></h2>



    <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("config/conexion.php");

        $query1 = "SELECT vuelo_id, codigo_vuelo, estado FROM vuelos WHERE estado = 'pendiente';";
        $result1 = $db2 -> prepare($query1);
        $result1 -> execute();
        $estados1 = $result1 -> fetchAll();

        $query2 = "SELECT vuelo_id, codigo, estado FROM vuelos WHERE estado = 'pendiente';";
        $result2 = $db -> prepare($query2);
        $result2 -> execute();
        $estados2 = $result2 -> fetchAll();
    ?>
      <table class="table">
    <tr>
      <th>ID</th>
      <th>Código</th>
      <th>Estado</th>
      <th>Ver</th>
    </tr>

      <?php

        foreach ($estados1 as $e) {
          echo "<tr><td>$e[0]</td>
          <td>$e[1]</td>
          <td>$e[2]</td>
          <td><form action=consultas/vuelo.php method=post>
          
          <button type=submit name=id value=$e[0]>Detalles</button
          </form></td></tr>";
       }
        foreach ($estados2 as $e) {
          echo "<tr><td>$e[0]</td>
          <td>$e[1]</td>
          <td>$e[2]</td>
          <td><form action=consultas/vuelo.php method=post>
          
          <button type=submit name=id value=$e[0]>Detalles</button
          </form></td></tr>";
      }
      ?>

  </table>

    <form class="buttons" action="views/logout.php">
        <input class="button" type="submit" value="Cerrar Sesión">
    </form>
  <?php } ?>
<!--  -->

<?php include('./templates/footer.php'); ?>