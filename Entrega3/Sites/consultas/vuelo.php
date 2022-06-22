<?php include('../templates/header.html');   ?>

<body>

  <h2 class="title is-1"> Id del vuelo<?php echo intval( $_POST['id']) ?></h2>
<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
        
        $id = intval( $_POST['id']);
        
        
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
      </tr><?php

      foreach ($vuelos as $v) {
        echo "<tr><td>$v[0]</td><td>$v[1]</td><td>$v[2]</td><td>$v[3]</td><td>$v[4]</td><td>$v[5]</td><td>$v[6]</td><td>$v[7]</td><td>$v[8]</td><td>$v[9]</td><td>$v[10]</td>
        <td>
          <form action=aceptar_vuelo.php method=post>
            <button type=submit name=aceptar value=$v[0]>Aceptar</button>
          </form>
        </td>
        <td>
          <form action=rechazar_vuelo.php method=post>
            <button type=submit name=rechazar value=$v[0]>Rechazar</button>
          </form>
        </td>
        </tr>";
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
        echo "<tr><td>$v[0]</td><td>$v[1]</td><td>$v[2]</td><td>$v[3]</td><td>$v[4]</td><td>$v[5]</td><td>$v[6]</td><td>$v[7]</td><td>$v[8]</td></td>
        <td>
          <form action=aceptar_vuelo.php method=post>
            <button type=submit name=aceptar value=$v[0]>Aceptar</button>
          </form>
        </td>
        <td>
          <form action=rechazar_vuelo.php method=post>
            <button type=submit name=rechazar value=$v[0]>Rechazar</button>
          </form>
        </td>
        </tr>";
      }

    }

      ?>

  </table>

  <form action="../index_dgac.php" method="get">
      <input type="submit" value="Volver">
  </form>


  <?php include('./../templates/footer.php'); 
?>