<?php

namespace Infrastructure\Persistence;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    /**
     * Conecta a la base de datos usando PDO
     * 
     * @param bool $debug Muestra errores de conexión si es true
     * @return PDO
     */
    public static function connect(bool $debug = false): PDO
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        // Cargar variables de entorno desde la raíz del proyecto
        $dotenvPath = __DIR__ . '/../../../';
        if (file_exists($dotenvPath . '.env')) {
            $dotenv = Dotenv::createImmutable($dotenvPath);
            $dotenv->load();
        }

        // Variables de entorno
        $host = $_ENV['DB_SERVER_NAME'] ?? 'localhost';
        $db   = $_ENV['DB_DATABASE'] ?? '';
        $user = $_ENV['MYSQL_USER'] ?? '';
        $pass = $_ENV['MYSQL_PASSWORD'] ?? '';
        $port = $_ENV['MYSQL_PORT'] ?? 3306;

        $dsn = "mysql:host={$host};dbname={$db};port={$port};charset=utf8mb4";

        try {
            self::$instance = new PDO(
                $dsn,
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );

            if ($debug) {
                echo "Conexión PDO exitosa a {$db} en {$host}:{$port}";
            }

        } catch (PDOException $e) {
            if ($debug) {
                die("Error PDO: " . $e->getMessage());
            }
            error_log("[Database] Error de conexión: " . $e->getMessage());
            throw new \RuntimeException('No se pudo conectar a la base de datos.');
        }

        return self::$instance;
    }
}
