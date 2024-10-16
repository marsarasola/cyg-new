<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/styles/contacto.css?v=1.0">
    <link rel="stylesheet" href="../public/styles/index.css">
    <link rel="shortcut icon" href="../public/assets/C&G COLOR-01.png" type="image/x-icon">
    <title>Contacto</title>
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <a href="../index.php" class="navbar-brand">
                <img src="/CYG/public/assets/C&G COLOR-01.png" alt="logo" class="logo" width="100%" height="180px">
            </a>
            <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="../index.php" class="nav-link">INICIO </a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="contact-section">
        <!-- Mapa de Google -->
        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2924.789611374766!2d-4.421398284523073!3d40.41690197936619!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd41699f3fa388d7%3A0x8086451dfaccd5bb!2sMadrid!5e0!3m2!1ses!2ses!4v1602934627365!5m2!1ses!2ses"
                allowfullscreen=""
                aria-hidden="false"
                tabindex="0">
            </iframe>
        </div>

        <!-- Formulario de Contacto -->
        <div class="form-container">
            <form action="contacto.php" method="POST">
                <h2 class="tit">Contacta con Nosotros</h2>
                <div class="form-group">
                    <label for="nombre" class="form-label">Nombre </label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email </label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="asunto" class="form-label">Asunto </label>
                    <input type="text" class="form-control" id="asunto" name="asunto" required>
                </div>
                <div class="form-group">
                    <label for="mensaje" class="form-label">Mensaje </label>
                    <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn">Enviar</button>
            </form>
        </div>
    </div>

    <?php
    // Incluir PHPMailer
    require 'phpMailer/Exception.php';
    require 'phpMailer/PHPMailer.php';
    require 'phpMailer/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Procesar el formulario si se ha enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitizar las entradas del formulario
        $nombre = htmlspecialchars(trim($_POST['nombre']));
        $email = htmlspecialchars(trim($_POST['email']));
        $mensaje = htmlspecialchars(trim($_POST['mensaje']));

        // Validar el correo electrónico
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='alert alert-danger' role='alert'>Correo electrónico no válido.</div>";
            exit;
        }

        // Instanciar PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuraciones del servidor
            $mail->isSMTP();
            $mail->Host = 'smtp.tuhosting.com';  // Servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'tuemail@tudominio.com';  // Tu email
            $mail->Password = 'tucontraseña';  // Tu contraseña de email
            $mail->SMTPSecure = 'tls';  // Encriptación, puede ser 'ssl' o 'tls'
            $mail->Port = 587;  // Puerto del servidor SMTP

            // Remitente y destinatario
            $mail->setFrom($email, $nombre);  // Remitente (quien envía el correo)
            $mail->addAddress('martinasarasola21@gmail.com');  // Destinatario

            // Contenido del correo
            $mail->isHTML(true);  // Activar el formato HTML
            $mail->Subject = 'Consulta desde la página de contacto';
            $mail->Body    = "<p>Nombre: $nombre</p><p>Email: $email</p><p>Mensaje: $mensaje</p>";
            $mail->AltBody = "Nombre: $nombre\nEmail: $email\nMensaje: $mensaje";  // Versión de texto plano

            // Enviar el correo
            if ($mail->send()) {
                echo "<div class='alert alert-success' role='alert'>¡Mensaje enviado con éxito!</div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>Hubo un error al enviar el mensaje. Inténtalo de nuevo más tarde.</div>";
            }
        } catch (Exception $e) {
            echo "<div class='alert alert-danger' role='alert'>Error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}</div>";
        }
    }
    ?>

    <?php include 'footer.php'; ?>

    <script src="../public/js/contacto.js"></script>
</body>

</html>