<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<?php if (isset($_SESSION['USU_ID'])): ?>
    <ul>
      <li>
  <button type="button" onclick="toggleModoOscuro()" style="cursor:pointer; font-size: 1.5em;" aria-label="Cambiar modo de color">
    <span id="theme-icon">🌓</span>
  </button>
</li>

        
        <li><a href="index.php">Inicio</a></li>
        <li><a href="info.php">Info</a></li>
        <li><a href="usuarios.php">Usuarios</a></li>
        <li><a href="libros.php">Libros</a></li>
        <li><a href="logout.php">Salir</a></li>
    </ul>
<?php else: ?>
    <p>Se mostraran las opciones cuando usted inicie sesión.</p>
  <button type="button" onclick="toggleModoOscuro()" style="cursor:pointer; font-size: 1.5em;" aria-label="Cambiar modo de color">
    <span id="theme-icon">🌓</span>
  </button>
<?php endif; ?>