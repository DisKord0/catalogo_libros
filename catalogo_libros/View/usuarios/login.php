<?php
// Se asume que session_start() y el chequeo de redirección ya se hicieron en index.php
$titulo = "Iniciar Sesión";

// La ruta es relativa: salimos de 'usuarios', salimos de 'view', entramos a 'layout'
require "../layout/header.php"; 
?>

<form action="../../controller/usuarios/procesa-login.php" method="post">

    <h2>Acceso al Catálogo</h2>
    
    <?php if (isset($_GET["registro"]) && $_GET["registro"] === "exito") { ?>
        <p class="mensaje-exito" style="color: green; font-weight: bold;">
            ¡Registro exitoso! Ya puedes iniciar sesión.
        </p>
    <?php } ?>

    <p>
        <label>
            Cuenta (Cue)
            <input type="text" name="cue" required 
                   placeholder="Tu nombre de usuario"
                   autocomplete="username">
        </label>
    </p>

    <p>
        <label>
            Contraseña (Matc)
            <input type="password" name="matc" required 
                   placeholder="Tu contraseña secreta"
                   autocomplete="current-password">
        </label>
    </p>

    <p><button type="submit">Iniciar Sesión</button></p>

    <p>
        <a href="registro.php">¿No tienes cuenta? Regístrate aquí</a>
    </p>

</form>

<?php require "../layout/footer.php" ?>