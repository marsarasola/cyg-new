<?php
// config.php
$servername = "localhost"; // Servidor de MySQL
$username = "roots"; // Usuario de MySQL
$password = "test1234"; // Contraseña de MySQL
$dbname = "experiencias"; // Base de datos

// Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
