<?php
session_start();
// Si ya hay sesión activa, redirigir al catálogo
if (isset($_SESSION["USU_CUE"])) {
    header("location: ../libros/lista.php");
    return;
}

$titulo = "Iniciar Sesión";
require "../layout/header.php"; 
?>

<?php if (isset($_GET['registro']) && $_GET['registro'] === 'exito'): ?>
    <div style="color: green; border: 1px solid green; padding: 10px; margin-bottom: 20px;">
        ¡Registro exitoso! Ya puedes iniciar sesión.
    </div>
<?php endif; ?>

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

<?php require "../layout/footer.php" ?>