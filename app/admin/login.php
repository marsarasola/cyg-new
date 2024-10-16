<?php
//login.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/cyg/public/assets/C&G COLOR-01.png" type="image/x-icon">
    <link rel="stylesheet" href="/cyg/public/styles/login.css">
    <title>LOGIN</title>
</head>

<body>
    <div class="login-box">
        <h2><img src="/cyg/public/assets/C&G COLOR-01.png" alt="cyg" width="35%" ></h2>
        <form action="/cyg/app/admin/login_process.php" method="post">
            <div class="user-box">
                <input type="text" id="username" name="username" autocomplete="username" required="">
                <label for="username">Usuario</label>
            </div>
            <div class="user-box">
                <input type="password" id="password" name="password" autocomplete="current-password" required="">
                <label for="password">Contrasena</label>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <p class="error-message">Invalid username or password. Please try again.</p>
            <?php endif; ?>

            <button type="submit">ACEPTAR</button>

        </form>
    </div>
</body>

</html>

