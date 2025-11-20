<?php
require_once __DIR__ . "/Bd.php";

class Libro
{
    static function lista(): array
    {
        $pdo = Bd::pdo();
        $stmt = $pdo->prepare(
            "SELECT LIB_ID, LIB_TITULO, LIB_AUTOR, LIB_ANIO, LIB_RESUMEN
             FROM LIBRO
             ORDER BY LIB_TITULO"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function agrega(string $titulo, string $autor, ?int $anio, ?string $resumen): int
    {
        $pdo = Bd::pdo();
        $stmt = $pdo->prepare(
            "INSERT INTO LIBRO (LIB_TITULO, LIB_AUTOR, LIB_ANIO, LIB_RESUMEN)
             VALUES (:t, :a, :n, :r)"
        );
        $stmt->execute([
            ":t" => $titulo,
            ":a" => $autor,
            ":n" => $anio,
            ":r" => $resumen
        ]);
        return (int)$pdo->lastInsertId();
    }

    static function buscar(string $texto): array
    {
        $pdo = Bd::pdo();
        $stmt = $pdo->prepare(
            "SELECT LIB_ID, LIB_TITULO, LIB_AUTOR, LIB_ANIO, LIB_RESUMEN
             FROM LIBRO
             WHERE LIB_TITULO LIKE :q OR LIB_AUTOR LIKE :q"
        );
        $stmt->execute([":q" => "%$texto%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function buscaPorId(int $id): array|false
    {
        $pdo = Bd::pdo();
        $stmt = $pdo->prepare(
            "SELECT LIB_ID, LIB_TITULO, LIB_AUTOR, LIB_ANIO, LIB_RESUMEN
             FROM LIBRO
             WHERE LIB_ID = :id"
        );
        $stmt->execute([":id" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static function modifica(int $id, string $titulo, string $autor, ?int $anio, ?string $resumen): int
    {
        $pdo = Bd::pdo();
        $stmt = $pdo->prepare(
            "UPDATE LIBRO SET
             LIB_TITULO = :t,
             LIB_AUTOR = :a,
             LIB_ANIO = :n,
             LIB_RESUMEN = :r
             WHERE LIB_ID = :id"
        );

        $stmt->execute([
            ":id" => $id,
            ":t" => $titulo,
            ":a" => $autor,
            ":n" => $anio,
            ":r" => $resumen,
        ]);

        return $stmt->rowCount();
    }

    static function elimina(int $id): int
    {
        $pdo = Bd::pdo();
        $stmt = $pdo->prepare("DELETE FROM LIBRO WHERE LIB_ID = :id");
        $stmt->execute([":id" => $id]);
        return $stmt->rowCount();
    }
}
