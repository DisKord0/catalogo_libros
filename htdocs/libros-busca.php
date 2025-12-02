<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "bd/Bd.php";
require_once "bd/recuperaIdEntero.php";

try {
    $id = recuperaIdEntero("id");

    $pdo = Bd::pdo();
    $stmt = $pdo->prepare("SELECT * FROM libros WHERE id = :id");
    $stmt->execute([":id" => $id]);
    $libro = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($libro === false)
        throw new Exception("Libro no encontrado.");

    $idHtml = htmlentities($id);
    $tituloHtml = htmlentities($libro["titulo"]);
    $autorHtml = htmlentities($libro["autor"]);
    $anioHtml = htmlentities($libro["anio"]);

    require "libros-modifica.php";

} catch (Exception $e) {
    $errorHtml = htmlentities($e->getMessage());
    require "error.php";
}
