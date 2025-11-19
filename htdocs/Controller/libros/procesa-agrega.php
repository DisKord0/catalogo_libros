<?php
require "../../Model/Libro.php";

if (!empty($_POST)) {
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $anio = $_POST["anio"];
    $descripcion = $_POST["descripcion"];

    $idInsertado = Libro::agrega($titulo, $autor, $anio, $descripcion);

    if ($idInsertado > 0) {

        header("Location: ../../Controller/libros/lista.php?agrega=exito&id=" . $idInsertado);
        exit;

    } else {
        header("Location: ../../Controller/libros/lista.php?agrega=error");
        exit;
    }
} else {
    header("Location: ../../Controller/libros/lista.php");
    exit;
}
