<?php
// Incluimos el modelo y las utilidades para la BD
require_once "../../Model/Usuario.php";
require_once "../util/Valida.php"; 

try {
    // Recuperar datos
    $cue = validaTexto("cue");
    $matc = validaTexto("matc");

    if (empty($cue) || empty($matc)) {
        throw new Exception("Usuario y contraseña son obligatorios.", 1);
    }

    // Verificar credenciales con el Modelo (buscaPorCueYMatc)
    $usuario = Usuario::buscaPorCueYMatc($cue, $matc);

    if ($usuario) {
        // Credenciales correctas: Iniciar Sesión
        session_start();
        $_SESSION['USU_ID'] = $usuario['USU_ID'];
        $_SESSION['USU_CUE'] = $usuario['USU_CUE'];
        
        // Redirigir al área interna del catálogo
        header("location: ../../View/libros/lista.php");
        exit;
    } else {
        // Credenciales incorrectas
        throw new Exception("Usuario o contraseña incorrectos. Verifica tus datos.", 2);
    }

} catch (Exception $e) {
    $errorHtml = htmlentities($e->getMessage());
    require "../../View/layout/error.php";
}