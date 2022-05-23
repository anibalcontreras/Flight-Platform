<?php include('../templates/header.html');   ?>

<body>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    
    $query = "SELECT maximosCompradores.nombre_compania, nombre_comprador, cantidadTickets
    FROM (SELECT DISTINCT nombre_compania, compradores.nombre_comprador, count(numero_ticket) as cantidadTickets
    FROM grupo105e2.public.companias, grupo105e2.public.vuelos, grupo105e2.public.tickets, reservas, compradores
    WHERE companias.codigo_compania = vuelos.codigo_compania
    AND vuelos.vuelo_id = tickets.vuelo_id
    AND tickets.reserva_id = reservas.reserva_id
    AND reservas.pasaporte_comprador = compradores.pasaporte_comprador
    GROUP BY nombre_compania, compradores.nombre_comprador
    ORDER BY  nombre_compania) as TicketsCompradores, (SELECT DISTINCT nombre_compania, max(cantidadTickets)
    FROM (SELECT DISTINCT nombre_compania, compradores.nombre_comprador, count(numero_ticket) as cantidadTickets
    FROM grupo105e2.public.companias, grupo105e2.public.vuelos, grupo105e2.public.tickets, reservas, compradores
    WHERE companias.codigo_compania = vuelos.codigo_compania
    AND vuelos.vuelo_id = tickets.vuelo_id
    AND tickets.reserva_id = reservas.reserva_id
    AND reservas.pasaporte_comprador = compradores.pasaporte_comprador
    GROUP BY nombre_compania, compradores.nombre_comprador
    ORDER BY  nombre_compania) as compradoresTickets
    GROUP BY nombre_compania) as maximosCompradores
    WHERE maximosCompradores.nombre_compania = TicketsCompradores.nombre_compania
    AND TicketsCompradores.cantidadTickets = maximosCompradores.max;";

    $result = $db -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    ?>
    <table class="table table-striped table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th>Aerolínea</th>
          <th>Maximos Compradores</th>
          <th>Cantidad de Tickets</th>
        </tr>
      </thead>
  
      <?php
        foreach ($data as $d) {
          echo "<tr>
                  <td>$d[0]</td>
                  <td>$d[1]</td>
                  <td>$d[2]</td>
                  </tr>";
          }
      ?>
      
  </table>

<center><?php include('../templates/footer.html'); ?></center>
