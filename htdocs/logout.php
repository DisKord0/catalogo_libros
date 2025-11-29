<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Destruye todas las variables de sesión
session_unset();
session_destroy();

// Redirige al login
header("Location: /login.php");
exit;
