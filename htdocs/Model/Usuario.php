<?php
require_once __DIR__ . "/Bd.php"; 

class Usuario
{
    /**
     * Agrega un nuevo usuario a la base de datos (Registro).
     */
    static function agrega(string $cue, string $matc): int
    {
        $pdo = Bd::pdo();

        // Cifrar la contraseña
        $hashMatc = password_hash($matc, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(
            "INSERT INTO USUARIO (
                USU_CUE, USU_MATC
            ) VALUES (
                :USU_CUE, :USU_MATC
            )"
        );
        
        $stmt->execute([
            ":USU_CUE" => $cue,
            ":USU_MATC" => $hashMatc
        ]);
        
        return (int) $pdo->lastInsertId();
    }

    /**
     * Busca un usuario por su cuenta (cue) y verifica la contraseña (Login).
     */
    static function buscaPorCueYMatc(string $cue, string $matc): array|false
    {
        $pdo = Bd::pdo();

        $stmt = $pdo->prepare(
            "SELECT USU_ID, USU_CUE, USU_MATC
             FROM USUARIO
             WHERE USU_CUE = :USU_CUE"
        );
        
        $stmt->execute([
            ":USU_CUE" => $cue
        ]);
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario === false) {
            return false;
        }

        // Verificar la contraseña cifrada
        if (password_verify($matc, $usuario["USU_MATC"]) === true) {
            return $usuario;
        } else {
            return false;
        }
    }
}