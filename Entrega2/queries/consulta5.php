<?php include('../templates/header.html');   ?>

<body>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
        $aerolinea = $_POST["aerolinea_elegida"];
        $aerolinea = strtoupper($aerolinea);
        $query = "SELECT DISTINCT estado, COUNT(estado) as cantidadVuelos
        FROM grupo105e2.public.vuelos, grupo105e2.public.companias
        WHERE vuelos.codigo_compania = companias.codigo_compania
        AND nombre_compania LIKE '%$aerolinea%'
        GROUP BY estado;";
        $result = $db -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll();
    ?>
    <table class="table table-striped table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th>Estado</th>
          <th>Cantidad Vuelos</th>
        </tr>
      </thead>
  
      <?php
        foreach ($data as $d) {
          echo "<tr>
                  <td>$d[0]</td>
                  <td>$d[1]</td>
                  </tr>";
          }
      ?>
      
  </table>

<center><?php include('../templates/footer.html'); ?></center>
