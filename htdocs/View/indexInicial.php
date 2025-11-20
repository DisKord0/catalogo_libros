<?php
// Define el título de la página (usado en layout/header.php)
$titulo = "Bienvenido al Catálogo";

// Datos de ejemplo para la lista de libros
$renderListaLibros = "
    <li>El Principito - Antoine de Saint-Exupéry</li>
    <li>Cien años de soledad - Gabriel García Márquez</li>
    <li>1984 - George Orwell</li>
    <li>El Señor de los Anillos - J.R.R. Tolkien</li>
    <li>Don Quijote de la Mancha - Miguel de Cervantes</li>
";

/* INCLUYE EL ENCABEZADO Y COMIENZA EL DOCUMENTO HTML */
require "layout/header.php";
?>

<main>
    <div class="container">
        
        <div class="list-section">
            <h2>Nuestros Títulos</h2>
            <p>Explora la colección disponible. Para agregar, modificar o eliminar libros, por favor, inicia sesión.</p>
            
            <ul>
                <?= $renderListaLibros ?>
            </ul>
        </div>

        <div class="login-section">
            <div class="login-form">
                <h3>Acceso al Sistema de Gestión</h3>
                
                <form action="../../Controller/usuarios/procesa-login.php" method="post">
                    <p>
                        <label for="cue">Usuario (Cue):</label>
                        <input type="text" id="cue" name="cue" required>
                    </p>
                    <p>
                        <label for="matc">Contraseña (Matc):</label>
                        <input type="password" id="matc" name="matc" required>
                    </p>
                    <p>
                        <button type="submit">Iniciar Sesión</button>
                    </p>
                    <p>
                        <a href="usuarios/registro.php">¿No tienes cuenta? Regístrate aquí</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
/* INCLUYE EL PIE DE PÁGINA Y CIERRA EL DOCUMENTO HTML */
require "layout/footer.php";
?>