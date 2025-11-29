<?php
require_once "../bd/Bd.php";

try {
    $pdo = Bd::pdo();
    $stmt = $pdo->query("SELECT id, titulo, autor, anio FROM libros");
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Libros</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php require "../header.php" ?>

<main>
    <h1>Libros</h1>
    <p><a href="libros-agrega.php">Agregar libro</a></p>

    <?php if (!empty($error)) : ?>
        <p>Error: <?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Año</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($libros as $l): ?>
        <tr>
            <td><?= $l['id'] ?></td>
            <td><?= htmlspecialchars($l['titulo']) ?></td>
            <td><?= htmlspecialchars($l['autor']) ?></td>
            <td><?= htmlspecialchars($l['anio']) ?></td>
            <td>
                <a href="libros-modifica.php?id=<?= $l['id'] ?>">Modificar</a> |
                <a href="libros-elimina.php?id=<?= $l['id'] ?>" onclick="return confirm('¿Seguro que quieres eliminar este libro?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php require "../footer.php" ?>
</body>
</html>
