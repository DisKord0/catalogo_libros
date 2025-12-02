<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Modificar Libro</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <?php require "header.php" ?>

    <main>
        <form action="libros-actualiza.php" method="post">

            <h1>Modificar Libro</h1>
            <p><a href="libros-lista.php">Cancelar</a></p>

            <input name="id" type="hidden" value="<?= $idHtml ?>">

            <p>
                <label>Título *
                    <input name="titulo" value="<?= $tituloHtml ?>" required>
                </label>
            </p>
            <p>
                <label>Autor *
                    <input name="autor" value="<?= $autorHtml ?>" required>
                </label>
            </p>
            <p>
                <label>Año
                    <input name="anio" type="number" value="<?= $anioHtml ?>">
                </label>
            </p>

            <p>* Obligatorio</p>

            <button type="submit">Guardar Cambios</button>

            <button type="submit"
                    formaction="libros-elimina.php"
                    onclick="if (!confirm('¿Confirma la eliminación del libro?')) { event.preventDefault() }">
                Eliminar Libro
            </button>

        </form>
    </main>

    <?php require "footer.php" ?>
</body>
</html>