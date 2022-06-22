<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<?php include('../templates/header.html'); ?>

    <?php
        require("../config/conexion.php");

        $id = intval( $_POST['rechazar']);

        $exists = "SELECT * FROM vuelos WHERE vuelo_id = $id ;";
        $result = $db2 -> prepare($exists);
        $result -> execute();
        $data = $result -> fetchAll();
        # Si el id esta en la bdd del grupo 106 (en el 105 no existe)
        if(empty($data)){
          $query = "SELECT rechazar_vuelo($id);";
          $result = $db -> prepare($query);
          $result -> execute();
          $data = $result -> fetchAll();
          # Si el id si existe en el grupo 105
        } else {
            $query = "SELECT rechazar_vuelo($id);";
            $result = $db2 -> prepare($query);
            $result -> execute();
            $data = $result -> fetchAll();

        }

    ?>

    <h1> Se rechaza el vuelo </h1>

    <?php
        $database = 0;
        $query = "SELECT * FROM vuelos WHERE vuelo_id = $id ;";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $vuelos = $result -> fetchAll();
        if(empty($vuelos)){
            $query = "SELECT * FROM vuelos WHERE vuelo_id = $id ;";
            $result = $db -> prepare($query);
            $result -> execute();
            $vuelos = $result -> fetchAll();
            $database = 1;
          }

    ?>

    <?php
    if($database == 0){ ?>
      <table>
      <tr>
        <th>ID</th>
        <th>Código</th>
        <th>Id aerodromo llegada</th>
        <th>Fecha de llegada</th>
        <th>Id aerodromo salida</th>
        <th>Estado</th>
        <th>Velocidad</th>
        <th>Altitud</th>
        <th>Codigo aeronave</th>
        <th>Codigo compania</th>
        <th>Ruta Id</th>
      </tr>

      <?php

        foreach ($vuelos as $v) {
          echo "<tr><td>$v[0]</td><td>$v[1]</td><td>$v[2]</td><td>$v[3]</td><td>$v[4]</td><td>$v[5]</td><td>$v[6]</td><td>$v[7]</td><td>$v[8]</td><td>$v[9]</td><td>$v[10]</td</tr>";
      }
    }
    else { ?>
      <table>
      <tr>
      <th>ID</th>
      <th>Código</th>
      <th>Codigo aeronave</th>
      <th>Fpl id</th>
      <th>Código Compañia</th>
      <th>Estado</th>
      <th>Id operación</th>
      <th>Id aeródromo despegue</th>
      <th>Id aeródromo arribo</th>
      </tr><?php

      foreach ($vuelos as $v) {
        echo "<tr><td>$v[0]</td><td>$v[1]</td><td>$v[2]</td><td>$v[3]</td><td>$v[4]</td><td>$v[5]</td><td>$v[6]</td><td>$v[7]</td><td>$v[8]</td></td></tr>";
      }
    }
      ?>

  </table>

<?php include '../templates/footer.html' ?>