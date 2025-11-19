<?php
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
    header("location: ../../View/usuarios/login.php?registro=exito");
    exit;
    
} catch (Exception $error) {
    
    // Manejo de errores
    $mensajeError = $error->getMessage();

    // Detección de error de duplicado (código 23000)
    if ($error->getCode() === '23000') {
        $mensajeError = "La cuenta **'$cue'** ya existe. Por favor, elige otro nombre de usuario.";
    }

    $errorHtml = htmlentities($mensajeError);
    require "../../View/layout/error.php";
}