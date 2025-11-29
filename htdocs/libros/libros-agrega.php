<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Agregar Libro</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>

<?php require "../header.php" ?>

<main>

    <h1>Agregar Libro</h1>
 <link rel="stylesheet" href="estilos.css">
    <p><a href="libros.php">Cancelar</a></p>

    <form action="libros-inserta.php" method="post">

        <p>
            <label>Título *
                <input name="titulo">
            </label>
        </p>

        <p>
            <label>Autor *
                <input name="autor">
            </label>
        </p>

        <p>
            <label>Año
                <input name="anio" type="number">
            </label>
        </p>

        <p>* Obligatorio</p>

        <button type="submit">Agregar</button>

    </form>

</main>

<?php require "../footer.php" ?>

</body>
</html>
