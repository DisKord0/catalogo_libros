<?php
require_once "bd/Bd.php";
require_once "bd/recuperaIdEntero.php";
require_once "bd/recuperaTexto.php";
require_once "bd/validaTexto.php";

try {
    $id = recuperaIdEntero("id");
    $nombre = validaTexto(recuperaTexto("nombre"));
    $correo = validaTexto(recuperaTexto("correo"));
    $password = recuperaTexto("password");

    $bd = Bd::pdo();

    // Si escribieron password, la actualizamos, si no, solo nombre y correo
    if ($password !== "") {
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $bd->prepare("UPDATE usuarios SET nombre=:nombre, correo=:correo, password=:pass WHERE id=:id");
        $stmt->execute([
            ":nombre" => $nombre,
            ":correo" => $correo,
            ":pass"   => $passHash,
            ":id"     => $id
        ]);
    } else {
        $stmt = $bd->prepare("UPDATE usuarios SET nombre=:nombre, correo=:correo WHERE id=:id");
        $stmt->execute([
            ":nombre" => $nombre,
            ":correo" => $correo,
            ":id"     => $id
        ]);
    }

    header("location: usuarios.php");

} catch (Exception $error) {
    $errorHtml = htmlentities($error->getMessage());
    require "error.php";
}