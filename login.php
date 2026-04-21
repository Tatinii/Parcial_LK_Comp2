<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Credenciales incorrectas.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema UGB</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container login-container">
        <h2>Acceso Restringido</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <label>Usuario:</label>
            <input type="text" name="username" required>
            <label>Contraseña:</label>
            <input type="password" name="password" required>
            <button type="submit">Ingresar</button>
        </form>
        <p style="text-align:center;"><a href="index.php">Volver a la vista pública</a></p>
    </div>
</body>
</html>