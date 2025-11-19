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
    // 2. Validar campos
    // Usamos validaTexto() para Título y Autor (obligatorios)
    $titulo = validaTexto("titulo");
    $autor = validaTexto("autor");

    // Usamos recuperaEntero() para Año (opcional)
    $anio = recuperaEntero("anio");
    
    // Resumen es opcional, puede ser null o una cadena (usamos recuperaTexto y luego trim)
    $resumenRaw = recuperaTexto("resumen");
    $resumen = ($resumenRaw === false || trim($resumenRaw) === "") ? null : trim($resumenRaw);


    // 3. Llamar al Modelo para registrar el libro
    $idInsertado = Libro::agrega($titulo, $autor, $anio, $resumen);

    /* 4. Redirección al éxito
     * Después de registrar, lo llevamos de vuelta a la lista.
     */
    header("location: ../../view/libros/lista.php?agrega=exito&id=" . $idInsertado);
    
} catch (Exception $error) {
    
    // 5. Manejo de errores (ej. El libro ya existe)
    $mensajeError = $error->getMessage();
    
    // Detección de error de duplicado (UNIQUE KEY en Título y Autor)
    if ($error->getCode() === '23000') {
         $mensajeError = "Ya existe un libro con el título **'$titulo'** y autor **'$autor'**. No se permiten duplicados.";
    }

    $errorHtml = htmlentities($mensajeError);
    require "../../view/layout/error.php";
}