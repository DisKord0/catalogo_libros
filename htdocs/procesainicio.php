<?php
require_once "db/Bd.php";
require_once "db/recuperaTexto.php";

try {

    $correo = recuperaTexto("correo");
    $password = recuperaTexto("password");

    if ($correo === false || trim($correo) === "")
        throw new Exception("El correo es obligatorio.");

    if ($password === false || trim($password) === "")
        throw new Exception("La contraseña es obligatoria.");

    // Conexión
    $pdo = Bd::pdo();

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = :correo");
    $stmt->execute([":correo" => trim($correo)]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario === false)
        throw new Exception("Usuario no encontrado.");

    if ($usuario["password"] !== $password)
        throw new Exception("Contraseña incorrecta.");

    session_start();
    $_SESSION["usuario"] = $usuario["nombre"];

    header("location: info.php");
    exit;

} catch (Exception $e) {

    $errorHtml = htmlentities($e->getMessage());
    require "error.php";
}
