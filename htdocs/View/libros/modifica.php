<?php
session_start();
if (!isset($_SESSION["USU_CUE"])) {
    header("location: ../../index.php");
    exit;
}

require "../../Model/Libro.php";

if (!isset($_GET["id"])) {
    header("location: lista.php");
    exit;
}

$id = intval($_GET["id"]);
$libro = Libro::buscaPorId($id);

if (!$libro) {
    echo "Libro no encontrado.";
    exit;
}

require "../layout/header.php";
?>

<main class="gestion-area">

<h2>Modificar Libro</h2>

<form action="../../Controller/libros/procesa-modifica.php" method="post">

<input type="hidden" name="id" value="<?= $libro['LIB_ID'] ?>">

<p><label>Título
    <input type="text" name="titulo" value="<?= htmlentities($libro['LIB_TITULO']) ?>" required>
</label></p>

<p><label>Autor
    <input type="text" name="autor" value="<?= htmlentities($libro['LIB_AUTOR']) ?>" required>
</label></p>

<p><label>Año
    <input type="number" name="anio" value="<?= $libro['LIB_ANIO'] ?>">
</label></p>

<p><label>Resumen
    <textarea name="resumen"><?= htmlentities($libro['LIB_RESUMEN']) ?></textarea>
</label></p>

<p><button type="submit">Guardar cambios</button></p>

</form>

</main>

<?php require "../layout/footer.php"; ?>
