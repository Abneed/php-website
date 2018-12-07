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

$usuario = $_SESSION['user']['usuario'];

$delete_sql = "DELETE FROM acceso WHERE usuario = '$usuario'";

if ($conn->query($delete_sql) == TRUE) 
{
    unset($_SESSION["user"]);
    $_SESSION["user"] = "¡Eliminacion del usuario exitosa!";
    header( 'Location: index.php' ); 
} 
// Ocurrió un error durante el proceso de inserción.
else 
{
    $_SESSION["user"]["mensaje"] = "Ocurrió un error.";
    header( 'Location: profile.php' ); 
}
?>