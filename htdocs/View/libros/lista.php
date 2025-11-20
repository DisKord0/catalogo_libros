<?php
// No iniciar sesión ni incluir Libro.php aquí

// Incluir header y footer con rutas absolutas
require __DIR__ . "/../layout/header.php";
?>

<main class="gestion-area">

<h2>Catálogo de Libros</h2>

<form method="get" action="lista.php">
    <input type="text" name="q" placeholder="Buscar..." value="<?= htmlentities($busqueda) ?>">
    <button type="submit">Buscar</button>
</form>

<p><a href="agrega.php" class="btn-principal">Agregar Libro</a></p>

<?php if (empty($libros)): ?>
    <p>No hay libros registrados.</p>
<?php else: ?>
<table class="tabla-libros">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Año</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($libros as $l): ?>
        <tr>
            <td><?= $l["LIB_ID"] ?></td>
            <td><?= htmlentities($l["LIB_TITULO"]) ?></td>
            <td><?= htmlentities($l["LIB_AUTOR"]) ?></td>
            <td><?= $l["LIB_ANIO"] ?: "(Desc.)" ?></td>
            <td>
                <a href="modifica.php?id=<?= $l['LIB_ID'] ?>">Modificar</a> |
                <a href="../../Controller/libros/procesa-elimina.php?id=<?= $l['LIB_ID'] ?>"
                   onclick="return confirm('¿Eliminar libro?');">
                   Eliminar
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

</main>

<?php require __DIR__ . "/../layout/footer.php"; ?>
