<?php

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use config\Database;
use mysqli;

class DatabaseTest extends TestCase
{
    #[Test]
    #[TestDox('Se inyecta Mysqli en el objeto manualmente')]
    public function testConexionPorObjetoMysql()
    {
        // Creamos un mock de la clase mysqli
        $mockMysqli = $this->createMock(mysqli::class);
        
        // Inyectamos el mock directamente al constructor de Database
        $db = new Database($mockMysqli);
        
        // Comprobamos que el objeto devuelto sea una instancia de mysqli
        $this->assertInstanceOf(mysqli::class, $db->getConexion());
    }

    #[Test]
    #[TestDox('Debe simular Conexión BD')]
    public function testConexionPorMock()
    {
        // Creamos un mock de mysqli
        $mockMysqli = $this->createMock(mysqli::class);
        
        // Creamos un mock parcial de la clase Database para simular el método connect
        $db = $this->getMockBuilder(Database::class)
                   ->onlyMethods(['connect'])
                   ->getMock();
         
        // Simulamos que el método connect devuelve el mock de mysqli
        $db->method('connect')->willReturn($mockMysqli);
        
        // Verificamos que getConexion() retorne un objeto mysqli simulado
        $this->assertInstanceOf(mysqli::class, $db->getConexion());
    }
}
