<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php require "header.php" ?>
    
    <main>
        <form action="usuario-procesa-agrega.php" method="post">
            <h1>Agregar Usuario</h1>
            <p><a href="usuarios.php">Cancelar</a></p>

            <p>
                <label>Nombre *
                    <input type="text" name="nombre" required>
                </label>
            </p>
            <p>
                <label>Correo *
                    <input type="email" name="correo" required>
                </label>
            </p>
            <p>
                <label>Contraseña *
                    <input type="password" name="password" required>
                </label>
            </p>

            <p>* Obligatorio</p>
            <p><button type="submit">Agregar</button></p>
        </form>
    </main>

    <?php require "footer.php" ?>
</body>
</html>