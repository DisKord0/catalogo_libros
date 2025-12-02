<?php
require_once "bd/Bd.php";
require_once "bd/recuperaTexto.php";
require_once "bd/validaTexto.php";

try {
    $nombre = validaTexto(recuperaTexto("nombre"));
    $correo = validaTexto(recuperaTexto("correo"));
    $password = recuperaTexto("password");

    if (!$password) throw new Exception("La contraseña es obligatoria");

    // Hashear password
    $passHash = password_hash($password, PASSWORD_DEFAULT);

    $pdo = Bd::pdo();
    $stmt = $pdo->prepare("
        INSERT INTO usuarios (nombre, correo, password, rol) 
        VALUES (:nombre, :correo, :password, 'usuario')
    ");
    
    $stmt->execute([
        ":nombre" => $nombre,
        ":correo" => $correo,
        ":password" => $passHash
    ]);

    header("location: usuarios.php");

} catch (Exception $error) {
    $errorHtml = htmlentities($error->getMessage());
    require "error.php";
}