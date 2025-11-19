<?php
session_start();
// Si ya hay sesión activa, redirigir al catálogo para evitar crear cuentas duplicadas
if (isset($_SESSION["USU_CUE"])) {
    header("location: ../libros/lista.php");
    return;
}

$titulo = "Crear Cuenta";
// La ruta es relativa: salimos de 'usuarios', salimos de 'view', entramos a 'layout'
require "../layout/header.php"; 
?>

<form action="../../controller/usuarios/procesa-registro.php" method="post">

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

    <p>* Obligatorio</p>

    <p><button type="submit">Registrarme</button></p>

    <p>
        <a href="../../index.php">¿Ya tienes cuenta? Inicia Sesión</a>
    </p>

</form>

<?php require "../layout/footer.php" ?>