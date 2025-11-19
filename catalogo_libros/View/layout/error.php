<?php 
// La variable $errorHtml DEBE ser asignada por el Controller que incluya este archivo.
$titulo = "Error";
require "header.php"; // Incluye el layout de cabecera
?>

<section>
    <h2>¡Ocurrió un error!</h2>
    <p>
        **Detalle:** <?= $errorHtml ?>
    </p>
    <p>
        <a href="../../index.php">Volver al inicio</a>
    </p>
</section>

<?php require "footer.php" ?>