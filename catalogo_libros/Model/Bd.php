<?php
class Bd
{
    private static ?PDO $pdo = null;

   const DB_HOST = "sql202.infinityfree.com"; // ⬅ Este es nuestro Hostname
   const DB_NAME = "if0_40451324_MyBookUTN"; // ⬅ Este es el nombre completo de nuestro BD
   const DB_USER = "if0_40451324";           // ⬅ Este es mi Username del host
   const DB_PASS = "freePHPk"; // ⬅ Mi contraseña del Host
   const DB_CHARSET = 'utf8mb4';

    static function pdo(): PDO
    {
        if (self::$pdo === null) {

            $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME . ";charset=" . self::DB_CHARSET;

            try {
                self::$pdo = new PDO(
                    $dsn,
                    self::DB_USER,
                    self::DB_PASS,
                    // Opciones de PDO: Lanza excepciones y no persistente
                    [
                        PDO::ATTR_PERSISTENT => false,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Devuelve arrays asociativos
                    ]
                );
                
                // Asegura la creación de las tablas si no existen
                self::crearTablas();

            } catch (PDOException $e) {
                // Aquí se podría redirigir a una página de error grave
                throw new Exception("Error al conectar a la base de datos: " . $e->getMessage(), 500);
            }
        }
        return self::$pdo;
    }

    private static function crearTablas(): void
    {
        $pdo = self::$pdo;

        // 1. Tabla USUARIO (Requisito del profesor: login y sesiones)
        $pdo->exec(
            "CREATE TABLE IF NOT EXISTS USUARIO (
                USU_ID INT NOT NULL AUTO_INCREMENT,
                USU_CUE VARCHAR(100) NOT NULL,
                USU_MATC VARCHAR(255) NOT NULL,
                CONSTRAINT USU_PK
                    PRIMARY KEY(USU_ID),
                CONSTRAINT USU_CUE_UNQ
                    UNIQUE(USU_CUE)
            )"
        );

        // 2. Tabla LIBRO (Catálogo Virtual)
        $pdo->exec(
            "CREATE TABLE IF NOT EXISTS LIBRO (
                LIB_ID INT NOT NULL AUTO_INCREMENT,
                LIB_TITULO VARCHAR(255) NOT NULL,
                LIB_AUTOR VARCHAR(255) NOT NULL,
                LIB_ANIO INT NULL,
                LIB_RESUMEN TEXT NULL,
                CONSTRAINT LIB_PK
                    PRIMARY KEY(LIB_ID),
                CONSTRAINT LIB_TIT_AUT_UNQ
                    UNIQUE(LIB_TITULO, LIB_AUTOR)
            )"
        );
    }
}