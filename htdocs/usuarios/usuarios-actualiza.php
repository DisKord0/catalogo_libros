<?php
require_once "../bd/Bd.php";
require_once "../bd/recuperaIdEntero.php";
require_once "../bd/recuperaTexto.php";
require_once "../bd/validaTexto.php";

try {
    $id = recuperaIdEntero("id");
    $nombre = validaTexto(recuperaTexto("nombre"));
    $correo = validaTexto(recuperaTexto("correo"));
    $password = validaTexto(recuperaTexto("password"));

    $pdo = Bd::pdo();

    $stmt = $pdo->prepare("
        UPDATE usuarios
        SET nombre = :nombre,
            correo = :correo,
            password = :password
        WHERE id = :id
    ");

    $stmt->execute([
        ":nombre" => $nombre,
        ":correo" => $correo,
        ":password" => $password,
        ":id" => $id,
    ]);

    header("location: usuarios.php");
    exit;

} catch (Exception $e) {
    $errorHtml = htmlentities($e->getMessage());
    require "../error.php";
}
