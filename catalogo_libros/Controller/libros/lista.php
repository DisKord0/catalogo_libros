<?php
session_start();
require_once "../../model/Libro.php";

// 1. Protección de acceso (Requisito del profesor: Usar sesiones para restringir)
if (!isset($_SESSION["USU_CUE"])) {
    header("location: ../../index.php");
    return;
}

try {
    // 2. Obtener la lista de libros del Modelo
    $libros = Libro::lista();

    // 3. Renderizar (Crear el HTML de la lista)
    $render = "";
    foreach ($libros as $libro) {
        $id = htmlentities($libro["LIB_ID"]);
        $titulo = htmlentities($libro["LIB_TITULO"]);
        $autor = htmlentities($libro["LIB_AUTOR"]);
        $anio = $libro["LIB_ANIO"] === null ? "(Desconocido)" : htmlentities((string)$libro["LIB_ANIO"]);

        // El enlace apunta al archivo que busca y muestra para modificar (lo crearemos después)
        $render .=
            "<li class='listado-libros-item'>
                <p>
                    <a href='busca.php?id=$id'>
                        <strong>$titulo</strong> 
                    </a>
                </p>
                <p>
                    Autor: $autor | Año: $anio
                </p>
             </li>";
    }

    // 4. Mostrar la Vista
    require "../../view/libros/lista.php";

} catch (Exception $error) {

    // Manejo de errores de base de datos o lógicos
    $errorHtml = htmlentities($error->getMessage());
    require "../../view/layout/error.php";
}