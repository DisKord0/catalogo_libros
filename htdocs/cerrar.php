<?php
session_start();

if (isset($_SESSION["USU_CUE"])) {
    unset($_SESSION["USU_CUE"]);
}
if (isset($_SESSION["USU_ID"])) {
    unset($_SESSION["USU_ID"]);
}

session_destroy();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>Cerrado - Biblioteca</title>
  <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>

  <?php require "../header.php" ?>

  <main>
    <h1>Cerraste sesión</h1>
    <p>Hasta pronto.</p>
  </main>

  <?php require "../footer.php" ?>

</body>

</html>
