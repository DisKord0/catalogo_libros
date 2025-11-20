<?php
require_once "RecuperaTexto.php";

/**
 * Valida un campo de texto: verifica que exista en la solicitud
 * y que no esté en blanco.
 */
function validaTexto(string $parametro): string
{
    $valor = recuperaTexto($parametro);

    if ($valor === false)
        throw new Exception(
            "La solicitud no tiene el valor de '$parametro'.",
            1
        );

    $trimValor = trim($valor);

    if ($trimValor === "")
        throw new Exception(
            "El campo '$parametro' no puede estar en blanco. Por favor, escribe un valor.",
            2
        );

    return $trimValor;
}

/**
 * Devuelve el valor entero de un parámetro, generando un error si no
 * existe o está en blanco, requerido para IDs.
 */
function validaIdEntero(string $parametro): int
{
    $valor = recuperaTexto($parametro);

    if ($valor === false)
        throw new Exception(
            "La solicitud no tiene el valor de $parametro.",
            3
        );

    $trimValor = trim($valor);

    if ($trimValor === "")
        throw new Exception("$parametro en blanco. Se requiere un valor entero.", 4);

    // Asegura que es un entero
    if (!filter_var($trimValor, FILTER_VALIDATE_INT))
         throw new Exception("El valor de $parametro no es un número entero válido.", 5);

    // Devuelve el entero
    return (int) $trimValor;
}

/**
 * Devuelve el valor entero de un parámetro. Puede ser nulo.
 */
function recuperaEntero(string $parametro): false|null|int
{
    $valor = recuperaTexto($parametro);
    
    if ($valor === false) {
        return false; // No se recibió el parámetro
    } 
    
    $trimValor = trim($valor);

    if ($trimValor === "") {
        return null; // Se recibió vacío (útil para campos opcionales como LIB_ANIO)
    } 
    
    // Si no está vacío, intenta validar como entero
    if (!filter_var($trimValor, FILTER_VALIDATE_INT)) {
         throw new Exception("El valor de $parametro debe ser un número entero o estar en blanco.", 6);
    }
    
    return (int) $trimValor;
}