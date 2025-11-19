<?php

$renderListaLibros = "
    <li>El Principito - Antoine de Saint-Exupéry</li>
    <li>Cien años de soledad - Gabriel García Márquez</li>
    <li>1984 - George Orwell</li>
    <li>El Señor de los Anillos - J.R.R. Tolkien</li>
    <li>Don Quijote de la Mancha - Miguel de Cervantes</li>
";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Libros | Bienvenido</title>
    <style>
        .container { display: flex; justify-content: space-around; max-width: 1200px; margin: 0 auto; padding: 20px; }
        .list-section { flex: 2; padding-right: 30px; }
        .login-section { flex: 1; padding-left: 30px; border-left: 1px solid #ccc; }
        .login-form { border: 1px solid #eee; padding: 15px; border-radius: 5px; background-color: #f9f9f9; }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido al Catálogo de Libros</h1>
        <hr>
    </header>

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
                
                <form action="../../controller/procesarLogin.php" method="post">
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
                    <p><small>Usuario de prueba: *Cualquier texto* / Contraseña: **secreto**</small></p>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <hr>
        <p>&copy; 2025 Catálogo PHP MVC</p>
    </footer>
</body>
</html>