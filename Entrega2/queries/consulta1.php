<?php include('../templates/header.html');   ?>

<body>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    
    $query = "SELECT codigo_vuelo, estado FROM vuelos WHERE estado = 'pendiente';";

    $result = $db -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    ?>
    <table>
      <tr>
        <th>Código</th>
        <th>Estado</th>
      </tr>
  
      <?php
        foreach ($data as $d) {
          echo "<tr>
                  <td>$d[0]</td>
                  <td>$d[1]</td>
                  </tr>";
          }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
