<?php

ob_start();
session_start();



## ---------------------------------------------------------
## Cargar dependencias y configuraciones
## ---------------------------------------------------------

require_once __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

## ---------------------------------------------------------
## Cargar variables de entorno
## ---------------------------------------------------------

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


ob_end_flush();
