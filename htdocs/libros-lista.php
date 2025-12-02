<?php
require_once "bd/Bd.php";

try {
    $pdo = Bd::pdo();
    $stmt = $pdo->query("SELECT id, titulo, autor, anio FROM libros ORDER BY titulo");
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $render = "";
    foreach ($libros as $l) {
        $id = htmlentities($l['id']);
        $titulo = htmlentities($l['titulo']);
        $autor = htmlentities($l['autor']);
        $anio = htmlentities($l['anio']);

        // Estructura de lista sin tablas, con enlace a la búsqueda/modificación
        $render .= "
        <li>
            <p>
                <a href='libros-busca.php?id=$id'>$titulo</a> por $autor ($anio)
            </p>
        </li>";
    }

    require "libros-vista.php"; // Llamamos a la vista separada
    
} catch (Exception $e) {
    $errorHtml = htmlentities($e->getMessage());
    require "error.php";
}