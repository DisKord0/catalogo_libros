<?php
class Bd
{
    private static ?PDO $pdo = null;

    const DB_HOST = "sql202.infinityfree.com";
    const DB_NAME = "if0_40451324_MyBookUTN";
    const DB_USER = "if0_40451324";
    const DB_PASS = "freePHPk";
    const DB_CHARSET = "utf8mb4";

    static function pdo(): PDO
    {
        if (self::$pdo === null) {

            $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME . ";charset=" . self::DB_CHARSET;

            self::$pdo = new PDO(
                $dsn,
                self::DB_USER,
                self::DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }

        return self::$pdo;
    }
}