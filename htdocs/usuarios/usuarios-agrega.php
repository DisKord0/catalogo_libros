<?php
$titulo = "Agregar Usuario";
require "../header.php";
?>

<main>
    <h1>Agregar Usuario</h1>
 <link rel="stylesheet" href="estilos.css">
    <form action="usuarios-inserta.php" method="post">
        <label>Nombre:
            <input type="text" name="nombre" required>
        </label>
        <br><br>
        <label>Correo:
            <input type="email" name="correo" required>
        </label>
        <br><br>
        <label>Contraseña:
            <input type="password" name="password" required>
        </label>
        <br><br>
        <button type="submit">Agregar</button>
    </form>

    <p><a href="usuarios.php">Volver al menú</a></p>
</main>

<?php require "../footer.php"; ?>
