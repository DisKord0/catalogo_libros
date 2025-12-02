<?php
// 1. CONFIGURACIÓN
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión si no hay (necesario para $_SESSION['USU_ID'] ?? NULL;)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// DEPENDENCIAS
require_once "bd/Bd.php";
require_once "bd/recuperaTexto.php";
require_once "bd/validaTexto.php";

$mensaje = "";

// 2. LÓGICA PRINCIPAL (TRY - CATCH)
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $nombre = validaTexto(recuperaTexto('nombre'));
        $correo = validaTexto(recuperaTexto('correo'));
        $password = recuperaTexto('password');

        if (!$password) {
             // Esto garantiza que la contraseña no esté vacía
             throw new Exception("La contraseña es obligatoria.");
        }

        $pdo = Bd::pdo();
        
        // Determinar quién creó el usuario (si hay sesión activa)
        $creado_por = $_SESSION['USU_ID'] ?? NULL;

        $stmt = $pdo->prepare("
            INSERT INTO usuarios (nombre, correo, password, creado_por)
            VALUES (:nombre, :correo, :password, :creado_por)
        ");
        
        $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            // Guardar el hash de la contraseña
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':creado_por' => $creado_por
        ]);

        $mensaje = "¡Usuario registrado correctamente! Ahora puedes iniciar sesión.";
    }
} catch (Exception $e) {
    // Capturar el error para mostrarlo en el HTML
    $mensaje = "Error: " . $e->getMessage();
}
// FIN DE LA LÓGICA PHP
?><!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title>Registro</title>
<link rel="stylesheet" href="estilos.css"> </head>
<body>
<?php require "header.php"; ?>
<main>
<h1>Registro de Usuario</h1>

<?php if ($mensaje): ?>
    <?php $color = (strpos($mensaje, 'Error:') === 0) ? 'red' : 'green'; ?>
    <p style="color:<?= $color ?>; font-weight: bold;"><?= htmlentities($mensaje) ?></p>
<?php endif; ?>

<form method="post">
    <label>Nombre:
        <input type="text" name="nombre" required value="<?= isset($nombre) ? htmlentities($nombre) : '' ?>">
    </label><br><br>
    <label>Correo:
        <input type="email" name="correo" required value="<?= isset($correo) ? htmlentities($correo) : '' ?>">
    </label><br><br>
    <label>Contraseña:
        <input type="password" name="password" required>
    </label><br><br>
    <button type="submit">Registrar</button>
</form>
<p><a href="login.php">¿Ya tienes cuenta? Inicia sesión</a></p>
</main>
<?php require "footer.php"; ?>
</body>
</html>