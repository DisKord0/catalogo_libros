<?php
session_start();
require_once "../../model/Libro.php";
require_once "../../controller/util/Valida.php"; 

// 1. Protección de acceso
if (!isset($_SESSION["USU_CUE"])) {
    header("location: ../../index.php");
    return;
}

try {
    // 2. Validar el ID
    $id = validaIdEntero("id");
    
    // 3. Llamar al Modelo para eliminar
    $filasAfectadas = Libro::elimina($id);
    
    // 4. Redirección al éxito
    header("location: ../../view/libros/lista.php?elimina=exito");
    
} catch (Exception $error) {

    $errorHtml = htmlentities($error->getMessage());
    require "../../view/layout/error.php";
}