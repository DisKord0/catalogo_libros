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
    // 2. Recuperar y validar el ID (requerido)
    $id = validaIdEntero("id");

    // 3. Buscar el libro en el Modelo
    $libro = Libro::buscaPorId($id);

    if ($libro === false)
        throw new Exception(
            "Libro con ID **$id** no encontrado.",
            10
        );

    // 4. Preparar variables para la Vista (Escapar HTML)
    $idHtml = htmlentities((string)$libro["LIB_ID"]);
    $tituloHtml = htmlentities($libro["LIB_TITULO"]);
    $autorHtml = htmlentities($libro["LIB_AUTOR"]);
    // El año puede ser null, lo convertimos a string vacío si es null
    $anioHtml = $libro["LIB_ANIO"] === null ? "" : htmlentities((string)$libro["LIB_ANIO"]);
    $resumenHtml = $libro["LIB_RESUMEN"] === null ? "" : htmlentities($libro["LIB_RESUMEN"]);
    
    // 5. Mostrar la Vista de Modificación
    require "../../view/libros/modifica.php";

} catch (Exception $error) {

    $errorHtml = htmlentities($error->getMessage());
    require "../../view/layout/error.php";
}