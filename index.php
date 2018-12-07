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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio | PHP Website</title>
    <link rel="stylesheet" href="basic-layout.css">
</head>
<body>
    <div class="navbar">
        <?php
            echo "<h2>Bienvenido ha PHP Website" . $TipoUsuario . "</h2>";
        ?>
        <div class="nav-wrapper">
        <?php
            if($TipoUsuario == "")
            {
                echo '
                <div class="button">
                    <a href="signup.php">Registrarse</a>
                </div>
                <div class="button">
                    <a href="signin.php">Iniciar sesión</a>
                </div>';
            }
            else
            {
                echo '
                <div class="profile-image">
                    <a href="profile.php">
                        <img src="data:image/jpeg;base64,'. $Imagen .'" alt="Foto de perfil" srcset="">
                    </a>
                </div>
                <div class="button">
                    <a href="profile.php">Mi perfil</a>
                </div>
                <div class="button">
                    <a href="close_session.php">Cerrar sesión</a>
                </div>
                ';
            }
        ?>
        </div>
    </div>
        <?php
            if ($_SESSION != null) {
                if (is_string($_SESSION["user"])) {
                    echo "<h3>" . $_SESSION["user"] . "</h3>";
                    unset($_SESSION['user']);
                }
                else if($_SESSION["user"]["mensaje"] != "") {
                    echo "<h3>" . $_SESSION["user"]["mensaje"] . "</h3>";
                    $_SESSION["user"]["mensaje"] = "";
                }
            }
        ?>
    <p>
        Proyecto final para la asignatura "Programacion Web".  
    </p>
    <?php
        if ($_SESSION != null) {
            if (is_string($_SESSION["user"])) {
                
            }
            else if($_SESSION["user"]["usuario"] != "") {
                echo "<h3>Usuario: " . $_SESSION["user"]["usuario"] . "</h3>";
                echo "<h3>Visitas: " . $_SESSION["user"]["visitas"] . "</h3>";
            }
        }
    ?>
</body>
</html>