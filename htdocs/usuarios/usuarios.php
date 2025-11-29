<?php
// Iniciar sesión si no hay
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Validación: redirige al login si no hay sesión activa
if (!isset($_SESSION['USU_ID'])) {
    header("Location: /login.php");
    exit;
}

$titulo = "Usuarios";
require "../header.php";
?>

<main>
    <h1>Gestión de Usuarios</h1>
 <link rel="stylesheet" href="estilos.css">
    <ul>
        <li><a href="usuarios-agrega.php">Agregar usuario</a></li>
        <li><a href="usuarios-listar.php">Ver usuarios</a></li>
    </ul>
</main>

<?php require "../footer.php"; ?>
