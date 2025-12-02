<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php require "header.php" ?>

    <main>
        <form action="usuario-procesa-modifica.php" method="post">
            
            <h1>Modificar Usuario</h1>
            <p><a href="usuarios.php">Cancelar</a></p>

            <input name="id" type="hidden" value="<?= $idHtml ?>">

            <p>
                <label>Nombre *
                    <input name="nombre" value="<?= $nombreHtml ?>" required>
                </label>
            </p>
            <p>
                <label>Correo *
                    <input name="correo" value="<?= $correoHtml ?>" required>
                </label>
            </p>
            <p>
                <label>Nueva Contraseña (dejar en blanco para no cambiar)
                    <input type="password" name="password">
                </label>
            </p>

            <p>* Obligatorio</p>

            <button type="submit">Guardar Cambios</button>

            <button type="submit" 
                    formaction="usuario-procesa-elimina.php"
                    onclick="if (!confirm('¿Confirma la eliminación del usuario?')) { event.preventDefault() }">
                Eliminar Usuario
            </button>

        </form>
    </main>

    <?php require "footer.php" ?>
</body>
</html>