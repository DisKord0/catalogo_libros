<?php
// ¡SOLUCIÓN CRÍTICA PARA ERRORES DE REDIRECCIÓN!
// Inicia el buffer de salida para asegurar que header() funcione correctamente
ob_start();

// Incluimos el modelo y las utilidades para la BD
require_once "../../Model/Usuario.php";
require_once "../util/Valida.php"; 

try {
    // Recuperar y validar la entrada
    $cue = validaTexto("cue");
    $matc = validaTexto("matc");
    $matc2 = validaTexto("matc2"); 

    // Validaciones
    if (strlen($cue) < 4) {
        throw new Exception("El nombre de usuario (Cue) debe tener al menos 4 caracteres.", 7);
    }

    if (strlen($matc) < 6) {
        throw new Exception("La contraseña (Matc) debe tener al menos 6 caracteres.", 8);
    }
    
    // Las contraseñas deben coincidir
    if ($matc !== $matc2) {
        throw new Exception("Las contraseñas no coinciden. Por favor, revísalas.", 9);
    }

    // Llamar al Modelo para registrar el usuario (agrega)
    $idInsertado = Usuario::agrega($cue, $matc);

    // Redirección al éxito (a la página de login)
    // SOLUCIÓN 1: Usar una ruta absoluta para forzar la correcta redirección.
    $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $urlRedireccion = $protocolo . "://" . $host . "/View/usuarios/login.php?registro=exito";

    header("Location: " . $urlRedireccion);
    
    // La redirección está completa, limpiamos el buffer y terminamos el script.
    ob_end_flush();
    exit;
    
} catch (Exception $error) {
    
    // Manejo de errores
    $mensajeError = $error->getMessage();

    // Detección de error de base de datos (Ej: Usuario ya existe)
    if ($error->getCode() === '23000' && str_contains($error->getMessage(), 'USU_CUE_UNQ')) {
        $cue = isset($cue) ? $cue : "desconocida";
        $mensajeError = "La cuenta **$cue** ya está registrada. Por favor, elige otra.";
    }

    // Redirección al error
    // Usamos 'View' (mayúscula) para mantener la consistencia con tus otros archivos.
    $errorHtml = htmlentities($mensajeError);
    require "../../View/layout/error.php";
}