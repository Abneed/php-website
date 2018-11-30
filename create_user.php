<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ProgramacionWebDB";

$conn = new mysqli($servername, $username, $password, $dbname);

$usuario = $_POST['usuario'];
$password = $_POST['password'];
$nombre = $_POST['nombre'];
$Tipo_Usuario = $_POST['tipo_usuario'];

$select_sql = "SELECT usuario, nombre, visitas, Tipo_Usuario FROM acceso WHERE usuario = '" . $usuario . "'";

$insert_sql = "INSERT INTO acceso (usuario, password, nombre, visitas, Tipo_Usuario) 
VALUES('" . $usuario . "','" . $password . "','" . $nombre . "'," . 1 . ",'" . $Tipo_Usuario ."')";

$result = $conn->query($select_sql);
// Verificar en la base de datos si el usuario existe.
if (mysqli_num_rows($result) > 0)
{
    // El usuario ya existe, generar mensaje de error, y regresar al sitio de registro de usuario.
    $_SESSION["user"] = "El usuario ya existe.";
    header( 'Location: signup.php' ); 
}
else 
{
    // Verificar si la inserción en la tabla de acceso fue exitoso.
    if ($conn->query($insert_sql) == TRUE) 
    {
        // Crear la session con el nuevo usuario creado.
        $result = $conn->query($select_sql);
        while($row = mysqli_fetch_assoc($result))
        {
            $_SESSION["user"] = $row;
            $_SESSION["user"]["mensaje"] = "¡Registro completado!";
            header( 'Location: index.php' ); 
        }
    } 
    // Ocurrió un error durante el proceso de inserción.
    else 
    {
        $_SESSION["user"] = "error";
        $_SESSION["user"]["mensaje"] = "Ocurrió un error.";
        header( 'Location: signup.php' ); 
    }
}
?>