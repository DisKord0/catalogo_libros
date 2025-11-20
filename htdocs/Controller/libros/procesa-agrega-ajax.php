<?php

header("Content-Type: application/json");

require "../../Model/Libro.php";

try {

    $titulo = $_POST["titulo"];

    $autor = $_POST["autor"];

    $anio = $_POST["anio"] === "" ? null : intval($_POST["anio"]);

    $resumen = $_POST["resumen"];

    $id = Libro::agrega($titulo, $autor, $anio, $resumen);

    if ($id < 1) {

        echo json_encode(["exito" => false, "error" => "No se pudo agregar"]);

        exit;

    }

    echo json_encode([

        "exito" => true,

        "data" => [

            "id" => $id,

            "titulo" => $titulo,

            "autor" => $autor,

            "anio" => $anio

        ]

    ]);

} catch (Exception $e) {

    echo json_encode(["exito" => false, "error" => $e->getMessage()]);

}