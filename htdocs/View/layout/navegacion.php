<?php
// Este archivo asume que session_start() ya se ha llamado (en la vista o en un controlador superior).
$usuarioActivo = isset($_SESSION["USU_CUE"]);

// Obtenemos el nombre del archivo actual. 
if (!isset($nombre_archivo)) {
    $nombre_archivo = basename($_SERVER['PHP_SELF']); 
}
?>

<nav>
    <ul>
        <?php if (!$usuarioActivo) { ?>
            <?php } else { ?>
            
            <li class="<?= $nombre_archivo === 'lista.php' ? 'activo' : '' ?>">
                <a href="../libros/lista.php">
                    Catálogo
                </a>
            </li>
            
            <li class="<?= $nombre_archivo === 'agrega.php' ? 'activo' : '' ?>">
                <a href="../libros/agrega.php">
                    Agregar Libro
                </a>
            </li>
            
            <li>
                <a href="../../Controller/usuarios/cerrar.php">
                    Cerrar Sesión (<?= htmlentities($_SESSION["USU_CUE"]) ?>)
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>