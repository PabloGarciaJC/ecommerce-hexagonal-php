<?php

namespace config;

use Dotenv\Dotenv;
use mysqli;

## ---------------------------------------------------------
## Mostrar todos los errores para depuración
## ---------------------------------------------------------

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

## ---------------------------------------------------------
## Clase para la Conexión a la base de datos
## ---------------------------------------------------------

class Database
{
    private $conexion;

    public function __construct(?mysqli $conexion = null)
    {
        $this->conexion = ($conexion ? $conexion : self::connect());
    }

    // Método para TEST
    public function getConexion()
    {
        return $this->conexion;
    }

     // Método por DEFECTO
    public static function connect()
    {
        // Cargar variables de entorno si no están cargadas
        if (!getenv('DB_SERVER_NAME')) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();
        }

        $db = new mysqli(
            $_ENV['DB_SERVER_NAME'],
            $_ENV['MYSQL_USER'],
            $_ENV['MYSQL_PASSWORD'],
            $_ENV['DB_DATABASE'],
            $_ENV['MYSQL_PORT']
        );

        if ($db->connect_error) {
            die("Error de conexión: " . $db->connect_error);
        }

        $db->set_charset("utf8");

        return $db;
    }
}

