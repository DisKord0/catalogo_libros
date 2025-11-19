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
             ORDER BY LIB_TITULO, LIB_AUTOR"
        );
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function agrega(string $titulo, string $autor, ?int $anio, ?string $resumen): int
    {
        $pdo = Bd::pdo();

        try {
            $stmt = $pdo->prepare(
                "INSERT INTO LIBRO (
                    LIB_TITULO, LIB_AUTOR, LIB_ANIO, LIB_RESUMEN
                ) VALUES (
                    :LIB_TITULO, :LIB_AUTOR, :LIB_ANIO, :LIB_RESUMEN
                )"
            );
            
            $stmt->execute([
                ":LIB_TITULO" => $titulo,
                ":LIB_AUTOR" => $autor,
                ":LIB_ANIO" => $anio,
                ":LIB_RESUMEN" => $resumen
            ]);

            return (int) $pdo->lastInsertId();

        } catch (PDOException $e) {
            // Esto evita el ERROR 500
            return -1;
        }
    }

    static function buscaPorId(int $id): array|false
    {
        $pdo = Bd::pdo();
        $stmt = $pdo->prepare(
            "SELECT LIB_ID, LIB_TITULO, LIB_AUTOR, LIB_ANIO, LIB_RESUMEN
             FROM LIBRO
             WHERE LIB_ID = :LIB_ID"
        );
        $stmt->execute([":LIB_ID" => $id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static function modifica(int $id, string $titulo, string $autor, ?int $anio, ?string $resumen): int
    {
        $pdo = Bd::pdo();

        $stmt = $pdo->prepare(
            "UPDATE LIBRO SET
                LIB_TITULO = :LIB_TITULO, 
                LIB_AUTOR = :LIB_AUTOR, 
                LIB_ANIO = :LIB_ANIO, 
                LIB_RESUMEN = :LIB_RESUMEN
             WHERE LIB_ID = :LIB_ID"
        );
        
        $stmt->execute([
            ":LIB_ID" => $id,
            ":LIB_TITULO" => $titulo,
            ":LIB_AUTOR" => $autor,
            ":LIB_ANIO" => $anio,
            ":LIB_RESUMEN" => $resumen
        ]);
        
        return $stmt->rowCount();
    }

    static function elimina(int $id): int
    {
        $pdo = Bd::pdo();

        $stmt = $pdo->prepare(
            "DELETE FROM LIBRO
             WHERE LIB_ID = :LIB_ID"
        );
        
        $stmt->execute([":LIB_ID" => $id]);
        
        return $stmt->rowCount();
    }
}
