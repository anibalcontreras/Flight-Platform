<?php
	ob_start();
	session_start();
?>
<?php
require("../config/conexion.php");

$msg = '';
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM usuarios WHERE username LIKE '%$username%' AND contrasena LIKE '%$password%';";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll();
}
?>
<?php if(empty($dataCollected)) { ?>
    <h2 class="subtitle has-text-centered">
    <strong> No encontramos coincidencias, reintenta iniciar sesión .</strong>
    <br>
    </h2>

<?php } if(!empty($dataCollected)) { ?>
    <?php $_SESSION['username'] = $dataCollected[0][0];
     $_SESSION['password'] = $dataCollected[0][1];
     $_SESSION['tipo'] = $dataCollected[0][2];
     $_SESSION['id'] = $dataCollected[0][3];
     $msg = "Sesión iniciada correctamente";?>
    <h3 class="subtitle has-text-centered">
    <br><br><strong> Encontramos coincidencias!!.</strong>
    <br>
    <h2 class="title is-1"> Hola <?php echo $_SESSION['tipo'] ?></h2>



    <?php if ($_SESSION['tipo'] == 0): ?>

    <form action="../index_dgac.php" method="get">
        <input type="submit" value="Volver">
    </form>

    <?php elseif ($_SESSION['tipo'] == 2): ?>

    <form action="../index_pasajero.php" method="get">
        <input type="submit" value="Volver">
    </form>

    <?php elseif ($_SESSION['tipo'] == 1): ?>

    <form action="../index_compania.php" method="get">
        <input type="submit" value="Volver">
    </form>

    <?php endif ?>

    
<?php } ?>









<?php include('./../templates/footer.php'); 
?>


