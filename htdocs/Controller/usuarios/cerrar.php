<?php
session_start();

// 1. Eliminar la variable de sesión específica
if (isset($_SESSION["USU_CUE"])) {
    unset($_SESSION["USU_CUE"]);
}

// 2. Destruir la sesión por completo
session_destroy();

// 3. Redirigir al inicio (Login)
header("location: ../../index.php");
