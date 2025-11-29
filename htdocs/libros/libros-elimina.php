<?php
require_once "../bd/Bd.php";

if (!isset($_GET['id'])) {
    header("Location: libros-lista.php");
    exit;
}

$id = intval($_GET['id']);
$pdo = Bd::pdo();

$stmt = $pdo->prepare("DELETE FROM libros WHERE id = :id");
$stmt->execute([':id' => $id]);

header("Location: libros-lista.php");
exit;
