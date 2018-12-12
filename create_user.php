<?php
session_start();

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "ProgramacionWebDB";

$servername = "198.71.236.19";
$username = "Web2K18";
$password = "@dm1n1str@d0r";
$dbname = "ProgramacionWeb";

$conn = new mysqli($servername, $username, $password, $dbname);

$usuario = $_POST['usuario'];
$password = $_POST['password'];
$nombre = $_POST['nombre'];
$Tipo_Usuario = $_POST['tipo_usuario'];
$Imagen = $_FILES['avatar']['tmp_name'];
$ImagenData = base64_encode(file_get_contents($Imagen));

$select_sql = "SELECT usuario, nombre, visitas, Tipo_Usuario, Imagen FROM acceso WHERE usuario = '$usuario'";

$insert_sql = "INSERT INTO acceso (usuario, password, nombre, visitas, Tipo_Usuario, Imagen) 
VALUES( '$usuario', '$password', '$nombre', 1, '$Tipo_Usuario', '$ImagenData')";

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
    $File_Size = $_FILES['avatar']['size'];
    if($File_Size > 500000 )
    {
        $_SESSION["user"] = "No puedes subir imagenes mayores de 500KB ('$File_Size ')";
        header( 'Location: signup.php' ); 
    }
    // Verificar si la inserción en la tabla de acceso fue exitoso.
    else if ($conn->query($insert_sql) == TRUE) 
    {
        // Crear la session con el nuevo usuario creado.
        $result = $conn->query($select_sql);
        while($row = mysqli_fetch_assoc($result))
        {
            $_SESSION["user"] = $row;
            $_SESSION["user"]["mensaje"] = "¡Registro de usuario exitosa!";
            
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