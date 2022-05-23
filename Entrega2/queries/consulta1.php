<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    <table class="table table-striped table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th>Código</th>
          <th>Estado</th>
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
