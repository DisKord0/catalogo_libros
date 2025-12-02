<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Usuarios - Biblioteca</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php require "header.php" ?>

    <main>
        <h1>Lista de Usuarios</h1>
        <p><a href="usuarios-agrega.php">Agregar nuevo usuario</a></p>
        <ul><?= $render ?></ul>
    </main>

    <?php require "footer.php" ?>
</body>
</html>