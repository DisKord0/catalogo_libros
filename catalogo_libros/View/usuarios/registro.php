<?php
session_start();
// Si ya hay sesión activa, redirigir al catálogo 
if (isset($_SESSION["USU_CUE"])) {
    header("location: ../libros/lista.php");
    return;
}

$titulo = "Crear Cuenta";
require "../layout/header.php"; 
?>

<form action="../../Controller/usuarios/procesa-registro.php" method="post">

    <h2>Registrar Cuenta</h2>
    <p>Crea tu cuenta para acceder al catálogo.</p>

    <p>
        <label>
            Cuenta (Cue) *
            <input type="text" name="cue" required 
                   placeholder="Mínimo 4 caracteres"
                   autocomplete="username">
        </label>
    </p>

    <p>
        <label>
            Contraseña (Matc) *
            <input type="password" name="matc" required 
                   placeholder="Mínimo 6 caracteres"
                   autocomplete="new-password">
        </label>
    </p>
    
    <p>
        <label>
            Confirmar Contraseña *
            <input type="password" name="matc2" required 
                   placeholder="Repite la contraseña"
                   autocomplete="new-password">
        </label>
    </p>

    <p>* Obligatorio</p>

    <p><button type="submit">Registrarme</button></p>

    <p>
        <a href="login.php">¿Ya tienes cuenta? Inicia Sesión</a>
    </p>

</form>

<?php require "../layout/footer.php" ?>