<?php
session_start();

if (!isset($_SESSION["USU_CUE"])) {
    header("location: ../../index.php");
    exit;
}

$titulo = "Agregar Libro";

require "../layout/header.php";
?>

<main class="gestion-area">

    <h2>Añadir Nuevo Libro</h2>

    <p><a href="lista.php">Volver al catálogo</a></p>

    <form action="../../Controller/libros/procesa-agrega.php" method="post">

        <p>
            <label>
                Título *
                <input type="text" name="titulo" required>
            </label>
        </p>

        <p>
            <label>
                Autor *
                <input type="text" name="autor" required>
            </label>
        </p>

        <p>
            <label>
                Año
                <input type="number" name="anio">
            </label>
        </p>

        <p>
            <label>
                Resumen
                <textarea name="resumen" rows="4"></textarea>
            </label>
        </p>

        <p><button type="submit">Guardar</button></p>

    </form>

</main>

<?php require "../layout/footer.php"; ?>