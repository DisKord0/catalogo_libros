<?php
require_once "../bd/Bd.php";

if (!isset($_GET['id'])) {
    header("Location: usuarios-listar.php");
    exit;
}

$id = intval($_GET['id']);
$pdo = Bd::pdo();

// Evitar eliminar el usuario admin si quieres
$stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $id]);

header("Location: usuarios-listar.php");
exit;
