<?php
session_start();
require "../../Model/Libro.php";

$id = intval($_POST["id"]);
$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$anio = $_POST["anio"] === "" ? null : intval($_POST["anio"]);
$resumen = $_POST["resumen"];

Libro::modifica($id, $titulo, $autor, $anio, $resumen);

header("location: ../../View/libros/lista.php?modifica=exito");
exit;
