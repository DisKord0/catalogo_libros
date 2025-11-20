<?php
require_once "../../Model/Libro.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titulo = trim($_POST["titulo"]);
    $autor = trim($_POST["autor"]);
    $anio = $_POST["anio"] !== "" ? (int)$_POST["anio"] : null;
    $resumen = trim($_POST["resumen"]);

    try {
        $idInsertado = Libro::agrega($titulo, $autor, $anio, $resumen);

        if ($idInsertado > 0) {
            header("Location: lista.php?agrega=exito&id=$idInsertado");
            exit;
        } else {
            header("Location: lista.php?agrega=error");
            exit;
        }

    } catch (Exception $e) {
        header("Location: lista.php?agrega=error");
        exit;
    }

} else {
    header("Location: lista.php");
    exit;
}