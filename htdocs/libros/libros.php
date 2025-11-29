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

$titulo = "Libros";
require "../header.php";
?>

<main>
    <h1>Gestión de Libros</h1>

    <ul>
        <li><a href="libros-agrega.php">Agregar libro</a></li>
        <li><a href="libros-lista.php">Ver libros</a></li>
    </ul>
</main>

<?php require "../footer.php"; ?>
