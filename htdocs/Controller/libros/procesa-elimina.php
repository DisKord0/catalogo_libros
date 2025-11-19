<?php
session_start();

require_once "../../Model/Libro.php";

require_once "../../Controller/util/Valida.php"; 

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
    header("location: ../../View/libros/lista.php?elimina=exito");
    
} catch (Exception $error) {

    $errorHtml = htmlentities($error->getMessage());
    require "../../View/layout/error.php";
}
