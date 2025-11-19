<?php
// El archivo que lo requiera debe llamar a session_start() primero (si es necesario en otras vistas).
if (!isset($titulo)) {
    $titulo = "Catálogo de Libros"; // Título por defecto
}

// 1. Obtener el nombre del archivo de la vista actual (para menú activo)
$nombre_archivo = basename($_SERVER['PHP_SELF']); 

// 2. Lógica para determinar el CSS adicional a cargar
$css_adicional = null;

if (in_array($nombre_archivo, ['login.php', 'registro.php'])) {
    $css_adicional = "../../assets/css/auth.css";
} elseif (in_array($nombre_archivo, ['lista.php', 'agrega.php', 'edita.php', 'elimina.php'])) {
    $css_adicional = "../../assets/css/gestion.css";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= htmlentities($titulo) ?> - Catálogo Cabaña
    </title>
    
    <link rel="stylesheet" href="../../assets/css/estilos.css?v=4"> <?php // Incrementamos la versión para forzar la carga ?>
    <?php if ($css_adicional): ?>
        <link rel="stylesheet" href="<?= $css_adicional ?>">
    <?php endif; ?>
</head>

<body>
    <header>
        <button id="theme-toggle" aria-label="Cambiar a modo oscuro o claro" class="theme-toggle">
            ☀️
        </button>
        
        <div class="header-content"> 
            <h1>Catálogo Rústico de Libros</h1>
            <a href="../../View/indexInicial.php" title="Ir a la página de inicio" class="logo-link">
                <img src="../../assets/img/logo-cabana.png" alt="Logo Rústico del Catálogo" class="logo-cabana">
            </a>
            <div class="decorative-divider"></div> 
        </div>
        
        <p>
            <button type="button" id="hamburguesa" popovertarget="navegacionDelSitio" aria-controls="navegacionDelSitio"
                aria-label="Abrir navegación del sitio">
                ≡
            </button>
        </p>

        <nav popover="auto" id="navegacionDelSitio">
            <h2>Menú Principal</h2>
            <?php require "navegacion.php" ?>
        </nav>

        <nav id="navegacionAncha" aria-label="Navegación del sitio">
            <?php require "navegacion.php" ?>
        </nav>
    </header>