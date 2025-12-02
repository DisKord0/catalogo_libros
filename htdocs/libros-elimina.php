<?php
require_once "bd/Bd.php";
require_once "bd/recuperaIdEntero.php"; // Usamos la función de ayuda

try {
    // Recuperamos el ID y validamos que sea entero y exista
    $id = recuperaIdEntero("id");

    $bd = Bd::pdo();
    $stmt = $bd->prepare("DELETE FROM libros WHERE id = :id");
    $stmt->execute([
        ":id" => $id,
    ]);

    header("location: libros-lista.php");

} catch (Exception $error) {
    $errorHtml = htmlentities($error->getMessage());
    require "error.php";
}