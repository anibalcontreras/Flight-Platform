<?php include('../templates/header.html');   ?>

<body>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    
    $query = "SELECT codigo_compania, nombre_compania, porcentaje
    FROM (SELECT max(porcentaje) as maximo_porcentaje
    FROM (SELECT tablaEstadosTotales.codigo_compania, tablaEstadosTotales.nombre_compania, (estado_aceptado/estadosTotales) as porcentaje
    FROM (SELECT estadosAceptados.codigo_compania, estadosAceptados.nombre_compania, sum(estadosAceptados.estado_acpetado + estadosNoAceptados.estado_no_aceptado) as estadosTotales
    FROM (SELECT vuelos.codigo_compania,companias.nombre_compania, count(nombre_compania) as estado_acpetado
    FROM grupo105e2.public.vuelos, grupo105e2.public.companias
    WHERE vuelos.codigo_compania = companias.codigo_compania
    AND estado = 'aceptado'
    GROUP BY vuelos.codigo_compania, companias.nombre_compania) as estadosAceptados, (
    SELECT vuelos.codigo_compania,companias.nombre_compania, count(nombre_compania) as estado_no_aceptado
    FROM grupo105e2.public.vuelos, grupo105e2.public.companias
    WHERE vuelos.codigo_compania = companias.codigo_compania
    AND estado <> 'aceptado'
    GROUP BY vuelos.codigo_compania, companias.nombre_compania) as estadosNoAceptados
    WHERE estadosAceptados.codigo_compania = estadosNoAceptados.codigo_compania
    GROUP BY estadosAceptados.codigo_compania, estadosAceptados.nombre_compania) as tablaEstadosTotales,
    (SELECT vuelos.codigo_compania, companias.nombre_compania, count(nombre_compania) as estado_aceptado
    FROM grupo105e2.public.vuelos, grupo105e2.public.companias
    WHERE vuelos.codigo_compania = companias.codigo_compania
    AND estado = 'aceptado'
    GROUP BY vuelos.codigo_compania, companias.nombre_compania) as tablaEstadosAceptados
    WHERE tablaEstadosTotales.codigo_compania = tablaEstadosAceptados.codigo_compania
    AND tablaEstadosAceptados.nombre_compania = tablaEstadosTotales.nombre_compania) as tabla_porcentajes) as maximoValor, (
    SELECT tablaEstadosTotales.codigo_compania, tablaEstadosTotales.nombre_compania, (estado_aceptado/estadosTotales) as porcentaje
    FROM (SELECT estadosAceptados.codigo_compania, estadosAceptados.nombre_compania, sum(estadosAceptados.estado_acpetado + estadosNoAceptados.estado_no_aceptado) as estadosTotales
    FROM (SELECT vuelos.codigo_compania,companias.nombre_compania, count(nombre_compania) as estado_acpetado
    FROM grupo105e2.public.vuelos, grupo105e2.public.companias
    WHERE vuelos.codigo_compania = companias.codigo_compania
    AND estado = 'aceptado'
    GROUP BY vuelos.codigo_compania, companias.nombre_compania) as estadosAceptados, (
    SELECT vuelos.codigo_compania,companias.nombre_compania, count(nombre_compania) as estado_no_aceptado
    FROM grupo105e2.public.vuelos, grupo105e2.public.companias
    WHERE vuelos.codigo_compania = companias.codigo_compania
    AND estado <> 'aceptado'
    GROUP BY vuelos.codigo_compania, companias.nombre_compania) as estadosNoAceptados
    WHERE estadosAceptados.codigo_compania = estadosNoAceptados.codigo_compania
    GROUP BY estadosAceptados.codigo_compania, estadosAceptados.nombre_compania) as tablaEstadosTotales,
    (SELECT vuelos.codigo_compania, companias.nombre_compania, count(nombre_compania) as estado_aceptado
    FROM grupo105e2.public.vuelos, grupo105e2.public.companias
    WHERE vuelos.codigo_compania = companias.codigo_compania
    AND estado = 'aceptado'
    GROUP BY vuelos.codigo_compania, companias.nombre_compania) as tablaEstadosAceptados
    WHERE tablaEstadosTotales.codigo_compania = tablaEstadosAceptados.codigo_compania
    AND tablaEstadosAceptados.nombre_compania = tablaEstadosTotales.nombre_compania
    ) as maximosValores
    WHERE maximosValores.porcentaje = maximo_porcentaje;";

    $result = $db -> prepare($query);
    $result -> execute();
    $data = $result -> fetchAll();
    ?>
    <table>
      <tr>
        <th>Código Aerolínea</th>
        <th>Nombre Aerolínea</th>
        <th>Porcentaje (en Decimales)</th>
      </tr>
  
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

<?php include('../templates/footer.html'); ?>