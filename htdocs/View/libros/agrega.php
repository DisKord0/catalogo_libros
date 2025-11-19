<?php
session_start();
// 1. Protección de acceso
if (!isset($_SESSION["USU_CUE"])) {
    header("location: ../../index.php");
    return;
}

$titulo = "Agregar Libro";
require "../layout/header.php"; 
?>

<!-- CORRECCIÓN CRÍTICA: Cambiar 'controller' a 'Controller' (Mayúscula) -->
<form action="../../Controller/libros/procesa-agrega.php" method="post">

    <h2>Añadir Nuevo Libro al Catálogo</h2>

    <p><a href="lista.php">Cancelar y volver al catálogo</a></p>

    <p>
        <label>
            Título *
            <input type="text" name="titulo" required 
                   placeholder="Ej: Cien años de soledad">
        </label>
    </p>

    <p>
        <label>
            Autor *
            <input type="text" name="autor" required 
                   placeholder="Ej: Gabriel García Márquez">
        </label>
    </p>

    <p>
        <label>
            Año de Publicación
            <input type="number" name="anio" 
                   placeholder="Ej: 1967 (Opcional)">
        </label>
    </p>

    <p>
        <label>
            Resumen o Sinopsis
            <textarea name="resumen" rows="5"
                      placeholder="Escribe aquí un resumen breve... (Opcional)"></textarea>
        </label>
    </p>

    <p>* Obligatorio</p>

    <p><button type="submit">Agregar Libro</button></p>

</form>

<?php require "../layout/footer.php" ?>
