<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../bd/Bd.php";
require_once "../bd/recuperaTexto.php";
require_once "../bd/validaTexto.php";

try {
    $nombre = validaTexto(recuperaTexto("nombre"));
    $correo = validaTexto(recuperaTexto("correo"));
    $password = validaTexto(recuperaTexto("password"));

    $pdo = Bd::pdo();

    $stmt = $pdo->prepare("
        INSERT INTO usuarios (nombre, correo, password)
        VALUES (:nombre, :correo, :password)
    ");

    $stmt->execute([
        ":nombre" => $nombre,
        ":correo" => $correo,
        ":password" => password_hash($password, PASSWORD_DEFAULT)
    ]);

    header("Location: usuarios.php");
    exit;

} catch (Exception $e) {
    echo "<h2>Error al agregar usuario</h2>";
    echo "<pre>" . htmlentities($e->getMessage()) . "</pre>";
}
