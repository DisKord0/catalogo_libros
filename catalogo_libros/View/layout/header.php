<?php
// El archivo que lo requiera debe llamar a session_start() primero.
if (!isset($titulo)) {
    $titulo = "Catálogo de Libros"; // Título por defecto
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= htmlentities($titulo) ?> - Catálogo Cabaña
    </title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>

<body>
    <header>
        <p>
            <button type="button" id="hamburguesa" popovertarget="navegacionDelSitio" aria-controls="navegacionDelSitio"
                aria-label="Abrir navegación del sitio">
                ≡
            </button>
        </p>

        <nav popover="auto" id="navegacionDelSitio">
            <h2>Menú Principal</h2>
            <?php require "navegacion.php" ?>
        </nav>

        <nav id="navegacionAncha" aria-label="Navegación del sitio">
            <h1>Catálogo Rústico de Libros</h1>
            <?php require "navegacion.php" ?>
        </nav>
    </header>

    <main></main>