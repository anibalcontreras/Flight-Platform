<?php include('../templates/header.html');   ?>

<body>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    $icao = $_POST["codigo_icao_elegido"];
    $var = $_POST["aerolinea"];
    $query = "SELECT vuelos.vuelo_id, aerodromo_salida_id, aerodromo_llegada_id, estado, nombre_compania
    FROM aerodromos, grupo105e2.public.companias, grupo105e2.public.vuelos
    WHERE aerodromos.aerodromo_id = vuelos.aerodromo_llegada_id
    AND vuelos.codigo_compania = companias.codigo_compania
    AND codigo_ICAO LIKE '%$icao%'
    AND nombre_compania LIKE '%$var%'
    AND vuelos.estado LIKE 'aceptado';";
    $result = $db -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll();
    ?>

<table>
    <tr>
      <th>ID vuelo</th>
      <th>Id aeródromo salida</th>
      <th>Id aeródromo llegada</th>
      <th>Estado</th>
      <th>Nombre compania</th>
    </tr>
  <?php
  foreach ($dataCollected as $d) {
    echo "<tr>
            <td>$d[0]</td>
            <td>$d[1]</td>
            <td>$d[2]</td>
            <td>$d[3]</td>
            <td>$d[4]</td>
            </tr>";
    }
  ?>
  </table>

    
<?php include('../templates/footer.html'); ?>
