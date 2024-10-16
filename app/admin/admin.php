<?php
session_start();
include('config.php');

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

// Obtener todos los trabajos de la base de datos
$sql = "SELECT * FROM trabajos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../public/assets/C&G COLOR-01.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/styles/admin.css">
</head>

<body>
    <div class="container">
        <h2>Bienvenido al Panel de Administración</h2>

        <!-- Botón para añadir nuevos trabajos -->
        <a href="add_work.php" class="button">Añadir nuevo trabajo</a>

        <!-- Mostrar todos los trabajos -->
        <h3>Trabajos:</h3>
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($row['titulo']); ?></strong>

                        <?php echo htmlspecialchars($row['exp']); ?>

                        <!-- Mostrar las imágenes asociadas al trabajo -->
                        <?php 
                        $images = explode(',', $row['img']); // Supone que las imágenes están separadas por comas
                        foreach ($images as $image): ?>
                            <img src="../../public/assets/<?php echo htmlspecialchars(trim($image)); ?>" alt="Imagen para <?php echo htmlspecialchars($row['titulo']); ?>" class="review-image">
                        <?php endforeach; ?>

                        <a href="add_work.php?id=<?php echo $row['id']; ?>">Editar</a> |
                        <a href="delete_work.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este trabajo?');">Eliminar</a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No hay trabajos aún.</p>
        <?php endif; ?>
    </div>
</body>

</html>