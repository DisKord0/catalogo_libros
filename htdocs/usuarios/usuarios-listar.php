<?php
// Iniciar sesión solo si no hay sesión activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Protege la página: solo usuarios logueados
if (!isset($_SESSION['USU_ID'])) {
    header("Location: /login.php");
    exit;
}

require_once "../bd/Bd.php";

try {
    $pdo = Bd::pdo();

    // Obtener usuarios y el nombre del creador
    $stmt = $pdo->query("
        SELECT u.id, u.nombre, u.correo, u.rol, c.nombre AS creador
        FROM usuarios u
        LEFT JOIN usuarios c ON u.creado_por = c.id
    ");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Usuarios</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php require "../header.php"; ?>

<main>
    <h1>Listado de Usuarios</h1>
    <p><a href="usuarios-agrega.php">Agregar usuario</a></p>

    <?php if (!empty($error)) : ?>
        <p style="color:red;">Error: <?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Creado por</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['nombre']) ?></td>
                <td><?= htmlspecialchars($u['correo']) ?></td>
                <td><?= htmlspecialchars($u['rol']) ?></td>
                <td><?= htmlspecialchars($u['creador'] ?? 'Self') ?></td>
                <td>
                    <a href="usuarios-modifica.php?id=<?= $u['id'] ?>">Modificar</a> |
                    <a href="usuarios-elimina.php?id=<?= $u['id'] ?>" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php require "../footer.php"; ?>
</body>
</html>
