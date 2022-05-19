<?php include('../templates/header.html');   ?>

<body>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
        $codigo_reserva = $_POST["codigo_reserva_elegido"];
        $codigo_reserva = strtoupper($codigo_reserva);
        $query = "SELECT numero_ticket, pasaporte_pasajero, costos.valor, codigo_reserva
        FROM reservas, grupo105e2.public.tickets, vuelos, grupo105e2.public.aeronaves, grupo105e2.public.rutas, costos
        WHERE tickets.reserva_id = reservas.reserva_id
        AND tickets.vuelo_id = vuelos.vuelo_id
        AND vuelos.codigo_aeronave = aeronaves.codigo_aeronave
        AND vuelos.ruta_id = rutas.ruta_id
        AND costos.ruta_id = rutas.ruta_id
        AND costos.peso = aeronaves.peso
        AND codigo_reserva LIKE '%$codigo_reserva%';";

        $result = $db -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll();
    ?>
    <table>
      <tr>
        <th>Numero Ticket</th>
        <th>Pasaporte Pasajero</th>
        <th>Valor</th>
        <th>Codigo Reserva</th>
      </tr>
  
      <?php
        foreach ($data as $d) {
          echo "<tr>
                  <td>$d[0]</td>
                  <td>$d[1]</td>
                  <td>$d[2]</td>
                  <td>$d[3]</td>
                  </tr>";
          }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
