<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Base de Datos vuelos Grupo 105 </h1>
  <p style="text-align:center;">Aquí podrás encontrar información sobre los vuelos</p>

  <br>

  <h3 align="center"> Buscar todos los vuelos pendientes de ser aprobados por la DGAC </h3>

  <form align="center" action="queries/consulta1.php" method="post">
    
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres ver los vuelos de una aerolínea a un aerodromo?</h3>
  <h3 align="center"> Escribe el código ICAO y selecciona la aerolínea </h3>

  <?php
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT nombre_compania FROM grupo105e2.public.companias;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>


  <form align="center" action="queries/consulta2.php" method="post">
    Codigo ICAO:
    <input type="text" name="codigo_icao_elegido"
    required
          minlength="4" maxlength="4">
    <br/><br/>
    Seleccionar Aerolínea:
    <select name="aerolinea">
      <?php
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres ver los tickets asociados a un código de reserva junto a pasajeros y costos?</h3>
  <h3 align="center"> Ingresa el código de reserva </h3>

  <form align="center" action="queries/consulta3.php" method="post">
    Codigo de Reserva:
    <input type="text" name="codigo_reserva_elegido"
    required
          minlength="12" maxlength="12">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> Ver clientes que han comprado mayor cantidad de tickets por cada aerolinea </h3>

  <form align="center" action="queries/consulta4.php" method="post">
    
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> ¿Quieres ver la cantidad de vuelos de una aerolínea para cada uno de los estados?</h3>
  <h3 align="center"> Escribe el nombre de la aerolínea </h3>

  <form align="center" action="queries/consulta5.php" method="post">
    Aerolínea:
    <input type="text" name="aerolinea_elegida"
    required>
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center"> Ver aerolinea que tiene mayor porcentaje de vuelos aceptados </h3>

  <form align="center" action="queries/consulta6.php" method="post">
    
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>

  <br>

</body>
</html>