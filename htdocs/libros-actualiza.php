<?php    
require_once "bd/Bd.php";
require_once "bd/recuperaIdEntero.php";
require_once "bd/recuperaTexto.php";
require_once "bd/validaTexto.php";

try {
    $id     = recuperaIdEntero("id");
    $titulo = validaTexto(recuperaTexto("titulo"));
    $autor  = validaTexto(recuperaTexto("autor"));
    $anio   = recuperaTexto("anio");

    $pdo = Bd::pdo();

    $stmt = $pdo->prepare("
        UPDATE libros
        SET titulo = :titulo,
            autor  = :autor,
            anio   = :anio
        WHERE id   = :id
    ");

    $stmt->execute([
        ":titulo" => $titulo,
        ":autor"  => $autor,
        ":anio"   => $anio,
        ":id"     => $id
    ]);

    header("location: libros.php");
    exit;

} catch (Exception $e) {
    $errorHtml = htmlentities($e->getMessage());
    require "error.php";
}
