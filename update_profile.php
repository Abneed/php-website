<?php
session_start();
    if ($_SESSION != null) 
    {
        if (!is_string($_SESSION["user"])) 
        {
            $usuario = $_SESSION['user']['usuario'];
            $nombre = $_SESSION['user']['nombre'];
            $visitas = $_SESSION['user']['visitas'];
            $Tipo_Usuario = $_SESSION['user']['Tipo_Usuario'];
            $Imagen = $_SESSION['user']['Imagen'];
        }
    }
    $TipoUsuario = "";
    
    if ($_SESSION != null) {
        if (is_string($_SESSION["user"])) {
            
        }
        else if($_SESSION["user"]["Tipo_Usuario"] == "A") {
            $TipoUsuario = " - Administrador";
        }
        else{
            $TipoUsuario = " - Usuario Normal";
        }
    }       
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar perfil | PHP Website</title>
    <link rel="stylesheet" href="basic-layout.css">
</head>
<body>
    <div class="navbar">
        <h2>Actualizar perfil</h2>
        <div class="button">
            <a href="index.php">Inicio</a>
        </div>
        <div class="button">
            <a href="close_session.php">Cerrar sesión</a>
        </div>
    </div>
    <p>
        Proyecto final para la asignatura "Programacion Web".  
    </p>
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
        <form class="form-container" action="update_user.php" method="post" enctype="multipart/form-data">
        
        <?php
            echo "<img src='data:image/jpeg;base64," . $Imagen . "' alt='Foto de perfil'>";
        ?>
        <br>

        <!-- SE ESTABLECE UN TAMAÑO MAXIMO PARA EL ARCHIVO A SUBIR (500 KB = 500,000 B) -->
        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="500000"> -->
        <input type="file" name="avatar" id="avatar"><br><br>
            
        <label for="usuario">Usuario:</label>

        <input type="text" name="usuario" id="usuario" value='<?php echo $usuario ?>' required><br>

        <label for="nombre">Nombre completo:</label>
        <input type="text" name="nombre" id="nombre" value='<?php echo $nombre ?>' required><br>

        <input type="submit" value="Actualizar">
        <input type="reset" value="Limpiar">
    
        </form>
    </div>
</body>
</html>