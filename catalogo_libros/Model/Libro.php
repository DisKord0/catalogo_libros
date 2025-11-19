<?php
require_once __DIR__ . "/Bd.php";

/**
 * Clase estática para manejar las operaciones CRUD sobre la tabla LIBRO.
 */
class Libro
{
    /**
     * Recupera todos los libros de la base de datos.
     * @return array Lista de libros (array asociativo).
     */
    static function lista(): array
    {
        $pdo = Bd::pdo();

        $stmt = $pdo->prepare(
            "SELECT LIB_ID, LIB_TITULO, LIB_AUTOR, LIB_ANIO, LIB_RESUMEN
             FROM LIBRO
             ORDER BY LIB_TITULO, LIB_AUTOR"
        );
        
        $stmt->execute();
        
        // Retorna todos los registros como un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Agrega un nuevo libro a la base de datos.
     * @param string $titulo Título del libro.
     * @param string $autor Autor del libro.
     * @param int|null $anio Año de publicación (puede ser null).
     * @param string|null $resumen Resumen del libro (puede ser null).
     * @return int El ID del libro recién insertado.
     */
    static function agrega(
        string $titulo,
        string $autor,
        ?int $anio,
        ?string $resumen
    ): int {
        $pdo = Bd::pdo();

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
    }
    
    /**
     * Busca un libro por su ID.
     * @param int $id El ID del libro.
     * @return array|false El registro del libro si se encuentra, o false en caso contrario.
     */
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
    
    /**
     * Modifica un libro existente.
     * @param int $id ID del libro a modificar.
     * @param string $titulo Nuevo título.
     * @param string $autor Nuevo autor.
     * @param int|null $anio Nuevo año.
     * @param string|null $resumen Nuevo resumen.
     * @return int Número de filas afectadas (0 o 1).
     */
    static function modifica(
        int $id,
        string $titulo,
        string $autor,
        ?int $anio,
        ?string $resumen
    ): int {
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

    /**
     * Elimina un libro de la base de datos por su ID.
     * @param int $id ID del libro a eliminar.
     * @return int Número de filas afectadas (0 o 1).
     */
    static function elimina(int $id): int
    {
        $pdo = Bd::pdo();

        $stmt = $pdo->prepare(
            "DELETE FROM LIBRO
             WHERE LIB_ID = :LIB_ID"
        );
        
        $stmt->execute([
            ":LIB_ID" => $id
        ]);
        
        return $stmt->rowCount();
    }
}