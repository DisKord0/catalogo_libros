<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirigir al login si no hay sesión activa
if (!isset($_SESSION['USU_ID'])) {
    header("Location: /login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>Biblioteca</title>
 <link rel="stylesheet" href="estilos.css">
</head>

<body>

  <?php require "header.php" ?>

  <main>

    <h1>Biblioteca</h1>

    <p>
      Bienvenido al sistema de Biblioteca por el equipo keyboard.
    </p>

    <p>
      Usa la navegación superior para acceder a los módulos.
    </p>

  </main>

  <?php require "footer.php" ?>

</body>

</html>
