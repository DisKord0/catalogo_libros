<?php
session_start();
require "../../Model/Libro.php";

if (!isset($_GET["id"])) {
    header("location: ../../View/libros/lista.php");
    exit;
}

$id = intval($_GET["id"]);
Libro::elimina($id);

header("location: ../../View/libros/lista.php?elimina=exito");
exit;
