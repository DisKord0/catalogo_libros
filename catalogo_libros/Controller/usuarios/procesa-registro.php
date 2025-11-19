<?php
// Incluimos el modelo y las utilidades para la BD
require_once "../../model/Usuario.php";
require_once "../../controller/util/Valida.php"; 

try {
    // 1. Validar la entrada usando la función estricta validaTexto()
    $cue = validaTexto("cue");
    $matc = validaTexto("matc");

    // Validaciones de longitud mínima (por seguridad)
    if (strlen($cue) < 4) {
        throw new Exception("El nombre de usuario (Cue) debe tener al menos 4 caracteres.", 7);
    }

    if (strlen($matc) < 6) {
        throw new Exception("La contraseña (Matc) debe tener al menos 6 caracteres.", 8);
    }

    // 2. Llamar al Modelo para registrar el usuario (cifra la contraseña automáticamente)
    $idInsertado = Usuario::agrega($cue, $matc);

    /* 3. Redirección al éxito
     * Después de registrar, lo llevamos al index (login) con un mensaje de éxito.
     */
    header("location: ../../index.php?registro=exito");
    
} catch (Exception $error) {
    
    // 4. Manejo de errores
    $mensajeError = $error->getMessage();

    // Detección de error de duplicado (ej. "La cuenta ya existe")
    // El código 23000 es el estándar de SQLSTATE para violación de restricción de integridad (UNIQUE/PRIMARY KEY)
    if ($error->getCode() === '23000') {
         $mensajeError = "La cuenta **'$cue'** ya existe. Por favor, elige otro nombre de usuario.";
    }

    $errorHtml = htmlentities($mensajeError);
    // La ruta es relativa: salimos de 'usuarios', salimos de 'controller', entramos a 'view/layout'
    require "../../view/layout/error.php";
}