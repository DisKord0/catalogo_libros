<?php
require_once __DIR__ . "/Bd.php";

class Usuario
{
    /**
     * Agrega un nuevo usuario a la base de datos.
     * Cifra la contraseña antes de guardarla.
     * * @param string $cue El nombre de usuario (cuenta).
     * @param string $matc La contraseña en texto plano.
     * @throws Exception Si hay un error de base de datos (ej. el cue ya existe).
     * @return int El ID del usuario recién insertado.
     */
    static function agrega(string $cue, string $matc): int
    {
        $pdo = Bd::pdo();

        // 1. Cifrar la contraseña
        // Es esencial no guardar contraseñas en texto plano. Usamos PASSWORD_DEFAULT.
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
     * Busca un usuario por su cuenta (cue) y verifica la contraseña.
     * Esta función la necesitaremos en el siguiente paso (Login).
     * @param string $cue El nombre de usuario.
     * @param string $matc La contraseña en texto plano para verificar.
     * @return array|false El registro del usuario si las credenciales son correctas, o false en caso contrario.
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

        // 2. Verificar la contraseña cifrada
        if (password_verify($matc, $usuario["USU_MATC"]) === true) {
            return $usuario;
        } else {
            return false;
        }
    }
}