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
    $correo = validaTexto(recuperaTexto('correo'));
    $password = recuperaTexto('password');

    if ($correo && $password) {
        try {
            $pdo = Bd::pdo();
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo=:correo");
            $stmt->execute([':correo' => $correo]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($password, $usuario['password'])) {
                $_SESSION['USU_ID'] = $usuario['id'];
                $_SESSION['USU_NOMBRE'] = $usuario['nombre'];
                $_SESSION['USU_CORREO'] = $usuario['correo'];
                $_SESSION['USU_ROL'] = $usuario['rol'];

                header("Location: /index.php");
                exit;
            } else {
                $mensaje = "Correo o contraseña incorrectos";
            }
        } catch (Exception $e) {
            $mensaje = "Error BD: " . $e->getMessage();
        }
    } else {
        $mensaje = "Completa todos los campos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title>Login</title>
<link rel="stylesheet" href="/estilos.css">
</head>
<body>
<?php require "header.php"; ?>
<main>
<h1>Iniciar sesión</h1>
<?php if($mensaje) echo "<p style='color:red;'>$mensaje</p>"; ?>
<form method="post">
    <label>Correo:<br>
        <input type="email" name="correo" required>
    </label><br><br>
    <label>Contraseña:<br>
        <input type="password" name="password" required>
    </label><br><br>
    <button type="submit">Entrar</button>
</form>
<p><a href="registro.php">¿No tienes cuenta? Regístrate</a></p>
</main>
<?php require "footer.php"; ?>
</body>
</html>
