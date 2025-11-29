<?php
require_once "recuperaTexto.php";

function recuperaEntero(string $parametro): false|null|int
{
    $valor = recuperaTexto($parametro);
    if ($valor === false) return false;
    if ($valor === "") return null;
    return (int) trim($valor);
}
