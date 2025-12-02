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

        $render .= "
        <li>
            <p>
                <a href='libros-busca.php?id=$id'>$titulo</a> por $autor ($anio)
            </p>
        </li>";
    }

    require "libros-vista.php";
    
} catch (Exception $e) {
    $errorHtml = htmlentities($e->getMessage());
    require "error.php";
}