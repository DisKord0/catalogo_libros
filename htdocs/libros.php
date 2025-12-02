<?php
// Iniciar sesión si no hay
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Validación: redirige al login si no hay sesión activa
if (!isset($_SESSION['USU_ID'])) {
    header("Location: login.php");
    exit;
}

// Redirecciona directamente a la lista (como el index.php del profe que redirecciona a lista.php)
header("Location: libros-lista.php");
exit;