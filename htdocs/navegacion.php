<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<?php if (isset($_SESSION['USU_ID'])): ?>
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="usuarios.php">Usuarios</a></li>
        <li><a href="libros.php">Libros</a></li>
        <li><a href="logout.php">Salir</a></li>
    </ul>
<?php else: ?>
    <p>Se mostraran las opciones cuando usted inicie sesión.</p>
<?php endif; ?>