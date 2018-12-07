<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ProgramacionWebDB";

// $servername = "198.71.236.19";
// $username = "Web2K18";
// $password = "@dm1n1str@d0r";
// $dbname = "ProgramacionWeb";

$conn = new mysqli($servername, $username, $password, $dbname);

$viejo_usuario = $_SESSION['user']['usuario'];

$nuevo_usuario = $_POST['usuario'];
$nuevo_nombre = $_POST['nombre'];
$nuevo_imagen = $_FILES['avatar']['tmp_name'];

$select_sql = "SELECT usuario, password, nombre, visitas, Tipo_Usuario, Imagen FROM acceso WHERE usuario = '$nuevo_usuario'";

if ($nuevo_imagen == null) {
    $update_sql = "UPDATE acceso SET usuario = '$nuevo_usuario', nombre = '$nuevo_nombre' WHERE usuario = '$viejo_usuario'";    
} else {
    $ImagenData = base64_encode(file_get_contents($nuevo_imagen));
    $update_sql = "UPDATE acceso SET usuario = '$nuevo_usuario', nombre = '$nuevo_nombre', Imagen = '$ImagenData' WHERE usuario = '$viejo_usuario'";
}


if ($conn->query($update_sql) == TRUE) 
{
    $result = $conn->query($select_sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $_SESSION["user"] = $row;
        $_SESSION["user"]["mensaje"] = "¡Actualización de los datos de usuario exitosa!";
    }
    header( 'Location: profile.php' ); 
} 
// Ocurrió un error durante el proceso de inserción.
else 
{
    $_SESSION["user"]["mensaje"] = "Ocurrió un error.";
    header( 'Location: update_profile.php' ); 
}
?>