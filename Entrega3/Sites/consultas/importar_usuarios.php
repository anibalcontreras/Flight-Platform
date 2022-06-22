<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<?php include('../templates/header.html'); ?>

    <?php
        require("../config/conexion.php");
        $query = "SELECT importar_usuarios();";
        $result = $db2 -> prepare($query);
        $result -> execute();
        $data = $result -> fetchAll();
    ?>

    <h1> Se han cargado los usuarios correctamente </h1>

<?php include '../templates/footer.html' ?>