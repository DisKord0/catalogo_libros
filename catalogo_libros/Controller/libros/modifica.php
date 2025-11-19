<?php
// Se asume que session_start() y el chequeo de redirección ya se hicieron en el Controller
// Las variables $idHtml, $tituloHtml, etc., están disponibles aquí.
$titulo = "Modificar Libro";
require "../layout/header.php"; 
?>

<form action="../../controller/libros/procesa-modifica.php" method="post">

    <h2>Modificar Libro: <?= $tituloHtml ?></h2>

    <p><a href="lista.php">Cancelar y volver al catálogo</a></p>
    
    <input name="id" type="hidden" value="<?= $idHtml ?>">

    <p>
        <label>
            Título *
            <input type="text" name="titulo" required value="<?= $tituloHtml ?>"
                   placeholder="Ej: Cien años de soledad">
        </label>
    </p>

    <p>
        <label>
            Autor *
            <input type="text" name="autor" required value="<?= $autorHtml ?>"
                   placeholder="Ej: Gabriel García Márquez">
        </label>
    </p>

    <p>
        <label>
            Año de Publicación
            <input type="number" name="anio" value="<?= $anioHtml ?>"
                   placeholder="Ej: 1967 (Opcional)">
        </label>
    </p>

    <p>
        <label>
            Resumen o Sinopsis
            <textarea name="resumen" rows="5"
                      placeholder="Escribe aquí un resumen breve... (Opcional)"><?= $resumenHtml ?></textarea>
        </label>
    </p>

    <p>* Obligatorio</p>

    <p>
        <button type="submit">Guardar Cambios</button>
        
        <button type="submit" formaction="../../controller/libros/procesa-elimina.php"
            class="btn" style="background-color: #d32f2f;"
            onclick="if (!confirm('⚠️ CONFIRMA ELIMINACIÓN: ¿Estás seguro de eliminar este libro?')) { event.preventDefault() }">
            Eliminar Libro
        </button>
    </p>

</form>

<?php require "../layout/footer.php" ?>