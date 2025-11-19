<?php
/**
 * Función para recuperar el texto de un parámetro de solicitud.
 * Adaptada de 'recuperaTexto.php'.
 */
function recuperaTexto(string $parametro): false|string
{
    /* Si el parámetro está asignado en $_REQUEST,
     * devuelve su valor; de lo contrario, devuelve false.
     */
    $valor = isset($_REQUEST[$parametro])
        ? $_REQUEST[$parametro]
        : false;
    return $valor;
}