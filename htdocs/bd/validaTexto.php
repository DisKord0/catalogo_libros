<?php

function validaTexto($texto): string {
    if ($texto === false || trim($texto) === '') {
        throw new Exception("Falta un dato obligatorio.");
    }

    // Limpiar espacios al inicio y fin
    $texto = trim($texto);

    // Eliminar barras invertidas
    $texto = stripslashes($texto);

    // Escapar caracteres especiales para HTML
    $texto = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');

    return $texto;
}
