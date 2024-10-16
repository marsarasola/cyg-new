<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Incluir el archivo config.php
if (!file_exists('config.php')) {
    die('Error: No se pudo encontrar config.php');
}
require_once 'config.php';

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, trim($_POST['username'])) : null;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, trim($_POST['password'])) : null;

    // Verificar que ambos campos estén llenos
    if ($username && $password) {
        // Preparar la consulta para seleccionar el usuario
        $stmt = $conn->prepare('SELECT id, usuario, contrasena FROM usuarios WHERE usuario = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontró el usuario
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verificar la contraseña
            if (password_verify($password, $row['contrasena'])) {
                // Iniciar sesión y redirigir al área protegida
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['usuario'];
                header('Location: admin.php');
                exit;
            } else {
                // Contraseña incorrecta
                header("Location: login.php?error=invalid_credentials");
                exit();
            }
        } else {
            // Usuario no encontrado
            header("Location: login.php?error=invalid_credentials");
            exit();
        }

        // Cerrar la consulta
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Por favor, completa todos los campos.</div>";
    }
}

// Cerrar conexión
$conn->close();
