<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("location: index.php");
    exit;
}
$usuarioHtml = htmlentities($_SESSION["usuario"]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Info</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

    <?php require "header.php" ?>

    <main>
        <h1>Información</h1>
        <p>Bienvenido, <?= $usuarioHtml ?></p>
        <p>Esta sección está protegida con sesión.</p>
    </main>

    <?php require "footer.php" ?>

</body>
</html>
