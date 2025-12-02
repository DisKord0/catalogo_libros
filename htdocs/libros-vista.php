<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Libros - Biblioteca</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php require "header.php" ?>

    <main>
        <h1>Gestión de Libros</h1>
        
        <p><a href="libros-agrega.php">Agregar nuevo libro</a></p>

        <ul><?= $render ?></ul>
    </main>

    <?php require "footer.php" ?>
</body>
</html>