<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav>
    <ul>
        
   <li>
    <button onclick="toggleModoOscuro()" class="btn-modo">🌓 Modo oscuro</button>
</li>

        <!-- Inicio siempre visible -->
        <li><a href="/index.php">Inicio</a></li>

        <!-- Login / Info / Cerrar sesión -->
        <?php if (!isset($_SESSION['USU_ID'])): ?>
            <li><a href="/login.php">Login</a></li>
        <?php else: ?>
            <li><a href="/info.php">Info</a></li>
            <li><a href="/logout.php">Cerrar sesión</a></li>
        <?php endif; ?>

        <!-- CRUDs -->
        <li><a href="/usuarios/usuarios.php">Usuarios</a></li>
        <li><a href="/libros/libros.php">Libros</a></li>
    </ul>
</nav>
