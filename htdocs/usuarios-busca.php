<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  
    
    
require_once "bd/Bd.php";
require_once "bd/recuperaIdEntero.php";

try {
    $id = recuperaIdEntero("id");

    $bd = Bd::pdo();
    $stmt = $bd->prepare("SELECT * FROM usuarios WHERE id = :id");
    $stmt->execute([":id" => $id]);
    
    $modelo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($modelo === false) {
        throw new Exception("Usuario no encontrado.");
    }

    // Preparamos datos para la vista
    $idHtml = htmlentities($id);
    $nombreHtml = htmlentities($modelo["nombre"]);
    $correoHtml = htmlentities($modelo["correo"]);

    require "usuarios-modifica.php";

} catch (Exception $error) {
    $errorHtml = htmlentities($error->getMessage());
    require "error.php";
}