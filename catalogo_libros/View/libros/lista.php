<?php
// Se asume que session_start() y el chequeo de redirección ya se hicieron en el Controller
// La variable $libros está disponible aquí.
$titulo = "Catálogo de Libros";

// La ruta es relativa: salimos de 'libros', entramos a 'layout'
require "../layout/header.php"; 
?>

<h2>Catálogo de Libros</h2>

<p>
    <a href="agrega.php" class="btn">
          Añadir Nuevo Libro
    </a>
</p>

<?php if (empty($libros)) { ?>
    <p>
        Aún no hay libros en el catálogo. ¡Sé el primero en añadir uno!
    </p>
<?php } else { ?>
    <ul class="listado-libros">
        <?= $render ?>
    </ul>
<?php } ?>

<?php require "../layout/footer.php" ?>