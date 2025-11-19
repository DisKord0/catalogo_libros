<?php
session_start();
require_once "../../model/Usuario.php";
require_once "../../controller/util/Valida.php"; 

try {
    // 1. Recuperar y validar las credenciales
    $cue = validaTexto("cue");
    $matc = validaTexto("matc");

    // 2. Usar el Modelo para autenticar al usuario
    $usuario = Usuario::buscaPorCueYMatc($cue, $matc);
    
    // 3. Verificar si la autenticación fue exitosa
    if ($usuario === false) {
        throw new Exception("Usuario o contraseña incorrectos.", 9);
    }
    
    // 4. Si es exitoso, iniciar la sesión (¡El requisito clave!)
    // Usamos el nombre de la cuenta (USU_CUE) como identificador en la sesión
    $_SESSION["USU_CUE"] = $usuario["USU_CUE"];
    
    /* 5. Redirección al éxito
     * Redireccionamos a la lista de libros.
     */
    header("location: ../../view/libros/lista.php");
    
} catch (Exception $error) {
    
    // 6. Manejo de errores
    $errorHtml = htmlentities($error->getMessage());
    require "../../view/layout/error.php";
}