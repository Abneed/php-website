<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de usuario | PHP Website</title>
    <link rel="stylesheet" href="basic-layout.css">
</head>
<body>
    <div class="navbar">
        <h2>Registro de usuario</h2>
        <div class="button">
            <a href="index.php">Inicio</a>
        </div>
        <div class="button">
            <a href="signin.php">Iniciar sesión</a>
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
                    else {
                        echo "<h3>" . $_SESSION["user"]["mensaje"] . "</h3>";
                        $_SESSION["user"]["mensaje"] = "";
                    }
                }
            ?>
        </div>
        
        <form class="form-container" action="create_user.php" method="post" enctype="multipart/form-data">
        
        <!-- SE ESTABLECE UN TAMAÑO MAXIMO PARA EL ARCHIVO A SUBIR (500 KB = 500,000 B) -->
        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="500000">  -->
        <input type="file" name="avatar" id="avatar" required><br><br>
            
        <label for="usuario">Usuario:</label>

        <input type="text" name="usuario" id="usuario" required><br>

        <label for="nombre">Nombre completo:</label>
        <input type="text" name="nombre" id="nombre" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br>

        <!-- <label for="confirm_password">Confirmar contraseña:</label>
        <input type="password" name="conf_password" id="conf_password"><br> -->

        <label for="tipo_usuario">Tipo de usuario:</label>
        <input list="tipos_usuarios" name="tipo_usuario" id="tipo_usuario" required><br>
        
        <datalist id="tipos_usuarios">
            <option value="A">Administrador
            <option value="N">Normal
        </datalist>

        <input type="submit" value="Registrar">
        <input type="reset" value="Limpiar">
    
        </form>
    </div>
</body>
</html>