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

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$select_sql = "SELECT usuario, password, nombre, visitas, Tipo_Usuario FROM acceso WHERE usuario = '" . $usuario . "'";

$result = $conn->query($select_sql);

// Verificar en la base de datos si el usuario existe.
if (mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
        // Verificar que la contraseña es la correcta.
        if($row["password"] == $password)
        {
            $visitas = $row["visitas"];
            $visitas += 1;
            $update_sql = "UPDATE acceso SET visitas = ". $visitas . " WHERE usuario = '" . $usuario . "'";
            if ($conn->query($update_sql) == TRUE) 
            {
                $_SESSION["user"] = $row;
                $_SESSION["user"]["visitas"] = $visitas;
                $_SESSION["user"]["mensaje"] = "¡Inicio de sesión exitosa!";
                header( 'Location: index.php' ); 
            } 
            // Ocurrió un error durante el proceso de inserción.
            else 
            {
                $_SESSION["user"] = "error";
                $_SESSION["user"]["mensaje"] = "Ocurrió un error.";
                header( 'Location: signin.php' ); 
            }
        }
        else
        {
            $_SESSION["user"] = "¡Contraseña incorrecta!";
            header( 'Location: signin.php' ); 
        }
    }   
}
else
{
    $_SESSION["user"] = "El usuario ya existe.";
    header( 'Location: signin.php' ); 
}
?>