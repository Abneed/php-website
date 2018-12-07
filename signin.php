<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="basic-layout.css">
    <title>Iniciar sesión | PHP Website</title>
</head>
<body>
    <div class="navbar">
        <h2>Iniciar sesión</h2>
        <div class="button">
            <a href="index.php">Inicio</a>
        </div>
        <div class="button">
            <a href="signup.php">Registrarse</a>
        </div>
    </div>
    <div class="box-wrapper">
        <div class="alert">
            <?php
                if ($_SESSION != null) {
                    if (is_string($_SESSION["user"])) {
                        echo "<h3>" . $_SESSION["user"] . "</h3>";
                        unset($_SESSION['user']);
                    }
                }
            ?>
        </div>
        <form class="form-container" action="session.php" method="post">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario"><br>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password"><br>

            <input type="submit" value="Iniciar Sesión">
            <input type="reset" value="Limpiar">
        </form>
    </div>
</body>
</html>