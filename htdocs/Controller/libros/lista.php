<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../../Model/Libro.php";

// PROTEGER ACCESO
if (!isset($_SESSION["USU_CUE"])) {
    header("location: ../../index.php");
    exit;
}

// Mensaje de éxito al agregar libro
$alerta = "";
if (!empty($_GET['agrega']) && $_GET['agrega'] === 'exito' && !empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    $alerta = "<script>alert('Libro ID $id agregado con éxito');</script>";
}

// Buscar libros si hay query string 'q'
$busqueda = $_GET['q'] ?? "";

try {
    $libros = $busqueda === "" ? Libro::lista() : Libro::buscar($busqueda);
} catch (Exception $e) {
    $errorHtml = "Error al obtener la lista de libros: " . htmlentities($e->getMessage());
    require __DIR__ . "/../../View/layout/error.php";
    exit;
}

// Renderizar vista
require __DIR__ . "/../../View/libros/lista.php";

// Imprimir alerta después de cargar la vista
if ($alerta) {
    echo $alerta;
}
