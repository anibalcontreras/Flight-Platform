<?php
	session_start();
?>


<?php include('../templates/header.html'); ?>

<body>
	<h3> Ingrese nombre de usuario y contraseña </h3>
	<br>
    <form class="form-signin" role="form" action="login_validation.php" method="post">
        <input type="text" name="username" placeholder="nombre de usuario" required autofocus>
        <input type="password" name="password" placeholder="contraseña" required>
        <button type="submit" name="login"> Iniciar sesión </button>
    </form>

</body>