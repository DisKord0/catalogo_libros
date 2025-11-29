<?php
require_once "../bd/Bd.php";
require_once "../bd/recuperaIdEntero.php";

try {
    $id = recuperaIdEntero("id");

    $pdo = Bd::pdo();

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
    $stmt->execute([":id" => $id]);
    $u = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($u === false)
        throw new Exception("Usuario no encontrado.");

    $idHtml = htmlentities($id);
    $nombreHtml = htmlentities($u["nombre"]);
    $correoHtml = htmlentities($u["correo"]);
    $passwordHtml = htmlentities($u["password"]);

    require "usuarios-modifica.php";

} catch (Exception $e) {
    $errorHtml = htmlentities($e->getMessage());
    require "../error.php";
}
