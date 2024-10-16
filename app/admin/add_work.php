<?php
session_start();
include('config.php');

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

// Inicializar variables
$titulo = '';
$exp = '';
$images = [];
$action = 'add'; // Acción por defecto
$errors = []; // Array para errores

// Tipos de archivo permitidos
$allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
$max_file_size = 5 * 1024 * 1024; // 5MB

// Verifica si es edición
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = 'edit';

    // Obtener el trabajo de la base de datos
    $sql = "SELECT * FROM trabajos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $trabajo = $result->fetch_assoc();
        $titulo = $trabajo['titulo'];
        $exp = $trabajo['exp'];
        $images = explode(',', $trabajo['img']); // Cambiar a un array de imágenes
    } else {
        echo "Trabajo no encontrado.";
        exit;
    }
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $exp = $_POST['exp'];
    $images = []; // Reiniciar las imágenes

    // Manejo de subida de imágenes
    if (isset($_FILES['img'])) {
        foreach ($_FILES['img']['name'] as $key => $file_name) {
            if ($_FILES['img']['error'][$key] !== UPLOAD_ERR_NO_FILE) {
                $file_type = $_FILES['img']['type'][$key];
                $file_size = $_FILES['img']['size'][$key];
                $tmp_name = $_FILES['img']['tmp_name'][$key];
                $target_file = "../../public/assets/" . basename($file_name);

                if (!in_array($file_type, $allowed_types)) {
                    $errors[] = "$file_name no es un tipo de archivo válido. Solo se permiten JPG, PNG y GIF.";
                }

                if ($file_size > $max_file_size) {
                    $errors[] = "$file_name supera el tamaño máximo de 5MB.";
                }

                if (empty($errors) && !move_uploaded_file($tmp_name, $target_file)) {
                    $errors[] = "Error al subir $file_name.";
                }

                if (empty($errors)) {
                    $images[] = $file_name; // Agregar la imagen al array
                }
            }
        }
    }

    // Si no se subió una nueva imagen, mantenemos la imagen existente (en caso de edición)
    if ($action == 'edit' && empty($images)) {
        $images = explode(',', $trabajo['img']); // Asigna las imágenes existentes
    }

    // Verifica si hay errores antes de continuar con las operaciones de la base de datos
    if (empty($errors)) {
        $img_string = implode(',', $images); // Convertir a string para la base de datos

        if ($action == 'add') {
            // Insertar el nuevo trabajo
            $sql = "INSERT INTO trabajos (titulo, exp, img) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $titulo, $exp, $img_string);
        } else if ($action == 'edit') {
            // Actualizar el trabajo existente
            $sql = "UPDATE trabajos SET titulo = ?, exp = ?, img = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $titulo, $exp, $img_string, $id);
        }

        if ($stmt->execute()) {
            header("Location: admin.php"); // Redirigir al panel de administración
            exit;
        } else {
            echo "Error al procesar el trabajo: " . $stmt->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/styles/admin.css">
    <link rel="shortcut icon" href="../../public/assets/C&G COLOR-01.png" type="image/x-icon">
    <title><?php echo $action == 'edit' ? 'Editar Trabajo' : 'Añadir Trabajo'; ?></title>
</head>

<body>
    <div class="add-review-container">
        <h2><?php echo $action == 'edit' ? 'Editar Trabajo' : 'Añadir Nuevo Trabajo'; ?></h2>
        <form action="<?php echo $action == 'edit' ? "add_work.php?id=$id" : "add_work.php"; ?>" method="POST" enctype="multipart/form-data">
            <label for="titulo">Título del Trabajo:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>" required>

            <label for="exp">Descripción de la Experiencia:</label>
            <textarea id="exp" name="exp" rows="4" required><?php echo htmlspecialchars($exp); ?></textarea>

            <label for="img">Subir Imágenes:</label>
            <input type="file" id="img" name="img[]" accept="image/*" multiple>

            <button type="submit" class="button"><?php echo $action == 'edit' ? 'Actualizar Trabajo' : 'Añadir Trabajo'; ?></button>
        </form>

        <!-- Mostrar errores si los hay -->
        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <h3>Se produjeron errores:</h3>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($images)): ?>
            <h3>Imágenes Actuales:</h3>
            <?php foreach ($images as $img): ?>
                <img src="../../public/assets/<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($titulo); ?>" style="max-width: 100px; margin: 5px;">
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>
