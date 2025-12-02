<?php
require_once "bd/Bd.php"; 
require_once "bd/recuperaTexto.php";
require_once "bd/validaTexto.php";

// Iniciar sesión si no existe
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mensaje = "";

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $correo = validaTexto(recuperaTexto('correo'));
        $password = recuperaTexto('password');

        if ($correo && $password) {
            $pdo = Bd::pdo();
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo=:correo");
            $stmt->execute([':correo' => $correo]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Validar contraseña
            if ($usuario && password_verify($password, $usuario['password'])) {
                $_SESSION['USU_ID'] = $usuario['id'];
                $_SESSION['USU_NOMBRE'] = $usuario['nombre'];
                
                // Redirección
                header("Location: index.php");
                exit;
            } else {
                throw new Exception("Correo o contraseña incorrectos.");
            }
        } else {
            throw new Exception("Por favor completa todos los campos.");
        }
    }
} catch (Exception $e) {
   
    $mensaje = $e->getMessage();
}

?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Login - Biblioteca</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <?php require "header.php"; ?>

    <main>
        <h1>Iniciar sesión</h1>

        <?php if ($mensaje): ?>
            <p style="color: red; font-weight: bold;"><?= htmlentities($mensaje) ?></p>
        <?php endif; ?>

        <form method="post">
            <p>
                <label>Correo electrónico
                    <input type="email" name="correo" required value="<?= isset($_POST['correo']) ? htmlentities($_POST['correo']) : '' ?>">
                </label>
            </p>
            <p>
                <label>Contraseña
                    <input type="password" name="password" required>
                </label>
            </p>
            <p>
                <button type="submit">Entrar</button>
            </p>
        </form>

        <p><a href="registro.php">¿No tienes cuenta? Regístrate</a></p>
    </main>

    <?php require "footer.php"; ?>
</body>
</html>