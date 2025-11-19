<?php
// Este archivo asume que session_start() ya se ha llamado.
$usuarioActivo = isset($_SESSION["USU_CUE"]);
?>

<nav>
    <ul>
        <?php if (!$usuarioActivo) { ?>
            <li>
                <a href="../../index.php">
                    Iniciar Sesión
                </a>
            </li>
            <li>
                <a href="../usuarios/registro.php">
                    Crear Cuenta
                </a>
            </li>
        <?php } else { ?>
            <li>
                <a href="../libros/lista.php">
                    Catálogo
                </a>
            </li>
            <li>
                <a href="../libros/agrega.php">
                    Agregar Libro
                </a>
            </li>
            <li>
                <a href="../../controller/usuarios/cerrar.php">
                    Cerrar Sesión (<?= htmlentities($_SESSION["USU_CUE"]) ?>)
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>