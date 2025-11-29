<?php
require_once "../bd/Bd.php";
require_once "../bd/recuperaTexto.php";
require_once "../bd/validaTexto.php";

if (!isset($_GET['id'])) {
    header("Location: usuarios-listar.php");
    exit;
}

$id = intval($_GET['id']);
$pdo = Bd::pdo();

// Obtener datos actuales del usuario
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuario no encontrado");
}

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nombre = validaTexto(recuperaTexto('nombre'));
        $correo = validaTexto(recuperaTexto('correo'));
        $rol = validaTexto(recuperaTexto('rol'));

        // Si se envió contraseña nueva
        $password = recuperaTexto('password');
        if ($password !== false && $password !== '') {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE usuarios SET nombre=:nombre, correo=:correo, rol=:rol, password=:password WHERE id=:id");
            $stmt->execute([
                ':nombre' => $nombre,
                ':correo' => $correo,
                ':rol'    => $rol,
                ':password' => $hash,
                ':id' => $id
            ]);
        } else {
            $stmt = $pdo->prepare("UPDATE usuarios SET nombre=:nombre, correo=:correo, rol=:rol WHERE id=:id");
            $stmt->execute([
                ':nombre' => $nombre,
                ':correo' => $correo,
                ':rol'    => $rol,
                ':id' => $id
            ]);
        }

        header("Location: usuarios-listar.php");
        exit;

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php require "../header.php" ?>

<main>
    <h1>Modificar Usuario</h1>

    <?php if (!empty($error)) echo "<p>Error: ".htmlspecialchars($error)."</p>"; ?>

    <form method="post">
        <label>Nombre:
            <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
        </label>
        <br><br>
        <label>Correo:
            <input type="email" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required>
        </label>
        <br><br>
        <label>Rol:
            <input type="text" name="rol" value="<?= htmlspecialchars($usuario['rol']) ?>" required>
        </label>
        <br><br>
        <label>Nueva Contraseña (dejar vacío para no cambiar):
            <input type="password" name="password">
        </label>
        <br><br>
        <button type="submit">Guardar Cambios</button>
    </form>

    <p><a href="usuarios-listar.php">Volver a la lista</a></p>
</main>

<?php require "../footer.php" ?>
</body>
</html>
