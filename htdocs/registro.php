<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "bd/Bd.php";
require_once "bd/recuperaTexto.php";
require_once "bd/validaTexto.php";

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = validaTexto(recuperaTexto('nombre'));
    $correo = validaTexto(recuperaTexto('correo'));
    $password = recuperaTexto('password');

    try {
        $pdo = Bd::pdo();
        $creado_por = $_SESSION['USU_ID'] ?? NULL;

        $stmt = $pdo->prepare("
            INSERT INTO usuarios (nombre, correo, password, creado_por)
            VALUES (:nombre, :correo, :password, :creado_por)
        ");
        $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':creado_por' => $creado_por
        ]);

        $mensaje = "Usuario registrado correctamente. Ahora puedes iniciar sesión.";
    } catch (Exception $e) {
        $mensaje = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro</title>
<link rel="stylesheet" href="/estilos.css">
</head>
<body>
<?php require "header.php"; ?>
<main>
<h1>Registro de Usuario</h1>
<?php if ($mensaje) echo "<p style='color:red;'>$mensaje</p>"; ?>
<form method="post">
    <label>Nombre:
        <input type="text" name="nombre" required>
    </label><br><br>
    <label>Correo:
        <input type="email" name="correo" required>
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
