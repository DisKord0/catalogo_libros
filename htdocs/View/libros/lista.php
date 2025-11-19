<?php

$titulo = "Catálogo de Libros";

// La ruta es relativa: salimos de 'libros', entramos a 'layout'
require "../layout/header.php"; 
?>

<main class="gestion-area"> 

    <h2>Catálogo de Libros</h2>

    <p>
        <a href="agrega.php" class="btn-principal">
            Añadir Nuevo Libro
        </a>
    </p>

    <?php if (empty($libros)) { ?>
        <p>
            Aún no hay libros en el catálogo. ¡Sé el primero en añadir uno!
        </p>
    <?php } else { ?>
        <table class="tabla-libros">
            <?= $render ?>
        </table>
    <?php } ?>

</main> <?php require "../layout/footer.php" ?>
