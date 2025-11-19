<?php
// Inicia la sesión para verificar el estado de autenticación
session_start(); 

/* Redirecciona a la lista de libros si la sesión de usuario (USU_CUE) está activa.
 * Usaremos 'USU_CUE' en la sesión, siguiendo el ejemplo de 'x' de tu archivo sesiones.zip.
 */
if (isset($_SESSION["USU_CUE"])) {
    header("location: view/libros/lista.php");
    return;
}