<?php

class Bd {
    private static ?PDO $pdo = null;

    static function pdo(): PDO {
        if (self::$pdo === null) {
            self::$pdo = new PDO(
                "sqlite:" . __DIR__ . "/biblioteca.db",
                null,
                null,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_PERSISTENT => false
                ]
            );

            // Modo seguro para hosting
            self::$pdo->exec("PRAGMA journal_mode = WAL;");

            // TABLA USUARIOS
            self::$pdo->exec("
                CREATE TABLE IF NOT EXISTS usuarios (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nombre TEXT NOT NULL,
                    correo TEXT NOT NULL UNIQUE,
                    password TEXT NOT NULL,
                    rol TEXT NOT NULL DEFAULT 'usuario',
                    creado_por INTEGER DEFAULT NULL
                );
            ");

            // TABLA LIBROS
            self::$pdo->exec("
                CREATE TABLE IF NOT EXISTS libros (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    titulo TEXT NOT NULL,
                    autor TEXT NOT NULL,
                    anio INTEGER
                );
            ");
        }

        return self::$pdo;
    }
}
