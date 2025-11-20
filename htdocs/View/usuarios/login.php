<?php
session_start();

// Si ya hay sesión activa, redirigir al catálogo
if (isset($_SESSION["USU_CUE"])) {
    header("location: ../libros/lista.php");
    exit;
}

$titulo = "Iniciar Sesión";
require "../layout/header.php"; 
?>

<main class="auth-container"> 

    <?php if (isset($_GET['registro']) && $_GET['registro'] === 'exito'): ?>
        <div class="mensaje-exito">
            ¡Registro exitoso! Ya puedes iniciar sesión.
        </div>
    <?php endif; ?>

    <!-- RUTA IGUAL QUE ANTES (FUNCIONA EN TU SERVIDOR) -->
    <form action="../../Controller/usuarios/procesa-login.php" method="post">

        <h2>Iniciar Sesión</h2>
        <p>Ingresa tus credenciales para acceder al sistema.</p>

        <p>
            <label>
                Cuenta (Cue) *
                <input type="text" name="cue" required autocomplete="username">
            </label>
        </p>

        <p>
            <label>
                Contraseña (Matc) *
                <input type="password" name="matc" required autocomplete="current-password">
            </label>
        </p>

        <p><button type="submit">Acceder</button></p>

        <p>
            <a href="registro.php">¿No tienes cuenta? Regístrate aquí</a>
        </p>

    </form>
    
</main>

<?php require "../layout/footer.php"; ?>
