<?php
require_once "../bd/Bd.php";
require_once "../bd/recuperaTexto.php";
require_once "../bd/validaTexto.php";

if (!isset($_GET['id'])) {
    header("Location: libros-lista.php");
    exit;
}

$id = intval($_GET['id']);
$pdo = Bd::pdo();

// Obtener datos actuales del libro
$stmt = $pdo->prepare("SELECT * FROM libros WHERE id = :id");
$stmt->execute([':id' => $id]);
$libro = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$libro) {
    die("Libro no encontrado");
}

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $titulo = validaTexto(recuperaTexto('titulo'));
        $autor = validaTexto(recuperaTexto('autor'));
        $anio = intval(recuperaTexto('anio'));

        $stmt = $pdo->prepare("UPDATE libros SET titulo = :titulo, autor = :autor, anio = :anio WHERE id = :id");
        $stmt->execute([
            ':titulo' => $titulo,
            ':autor'  => $autor,
            ':anio'   => $anio,
            ':id'     => $id
        ]);

        header("Location: libros-lista.php");
        exit;

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Modificar Libro</title>
</head>
<body>
<?php require "../header.php" ?>

<main>
    <h1>Modificar Libro</h1>

    <?php if (!empty($error)) echo "<p>Error: ".htmlspecialchars($error)."</p>"; ?>

    <form method="post">
        <label>Título:
            <input type="text" name="titulo" value="<?= htmlspecialchars($libro['titulo']) ?>" required>
        </label>
        <br><br>
        <label>Autor:
            <input type="text" name="autor" value="<?= htmlspecialchars($libro['autor']) ?>" required>
        </label>
        <br><br>
        <label>Año:
            <input type="number" name="anio" value="<?= htmlspecialchars($libro['anio']) ?>" required>
        </label>
        <br><br>
        <button type="submit">Guardar Cambios</button>
    </form>

    <p><a href="libros-lista.php">Volver a la lista</a></p>
</main>

<?php require "../footer.php" ?>
</body>
</html>
