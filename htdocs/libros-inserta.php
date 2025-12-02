<?php
require_once "bd/Bd.php";
require_once "bd/recuperaTexto.php";
require_once "bd/validaTexto.php";

try {
    $titulo = validaTexto(recuperaTexto("titulo"));
    $autor  = validaTexto(recuperaTexto("autor"));
    $anio   = recuperaTexto("anio"); // opcional

    $pdo = Bd::pdo();

    $stmt = $pdo->prepare("
        INSERT INTO libros (titulo, autor, anio)
        VALUES (:titulo, :autor, :anio)
    ");

    $stmt->execute([
        ":titulo" => $titulo,
        ":autor" => $autor,
        ":anio" => $anio
    ]);

    header("location: libros.php");
    exit;

} catch (Exception $e) {
    $errorHtml = htmlentities($e->getMessage());
    require "error.php";
}
