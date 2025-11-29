<?php
require_once "recuperaEntero.php";

function recuperaIdEntero(string $parametro): int
{
    $id = recuperaEntero($parametro);

    if ($id === false)
        throw new Error("Falta el parámetro $parametro.");

    if ($id === null)
        throw new Error("$parametro en blanco.");

    return $id;
}

function validaTexto(false|string $texto, string $nombreCampo)
{
    if ($texto === false) {
        throw new Error("Falta el campo $nombreCampo.");
    }

    $t = trim($texto);

    if ($t === "") {
        throw new Error("$nombreCampo no puede estar en blanco.");
    }

    return $t;
}
