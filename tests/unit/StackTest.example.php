<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

final class StackTest extends TestCase
{
    // 📌 Suma
    #[DataProvider('additionProvider')]
    #[TestDox('Suma de dos números enteros')]
    #[Test]
    public function sumar(int $expected, int $a, int $b): void
    {
        $this->assertSame($expected, $a + $b);
    }

    public static function additionProvider(): array
    {
        return [
            'data set 1' => [0, 0, 0],
            'data set 2' => [1, 0, 1],
            'data set 3' => [1, 1, 0],
            'data set 4' => [3, 1, 1]
        ];
    }

    // 📌 assertNotSame()
    #[Test]
    #[TestDox('Comprobación de que los valores no son iguales')]
    public function testAssertNotSame(): void
    {
        $this->assertNotSame('4', 4);  // Pasará, ya que un string no es igual a un int
    }

    // 📌 assertEquals()
    #[Test]
    #[TestDox('Comprobación de que los valores son iguales sin importar el tipo')]
    public function testAssertEquals(): void
    {
        $this->assertEquals(4, 2 + 2);  // Pasa si el valor es igual, sin importar el tipo
    }

    // 📌 assertNotEquals()
    #[Test]
    #[TestDox('Comprobación de que los valores no son iguales')]
    public function testAssertNotEquals(): void
    {
        $this->assertNotEquals(5, 3 + 2);  // 5 no es igual a 3 + 2
    }

    // 📌 assertTrue() / assertFalse()
    #[Test]
    #[TestDox('Comprobación de que la condición es verdadera o falsa')]
    public function testAssertTrueFalse(): void
    {
        $this->assertTrue(2 > 1);  // Pasa, ya que 2 es mayor que 1
        $this->assertFalse(2 < 1);  // Pasa, ya que 2 no es menor que 1
    }

    // 📌 assertNull() / assertNotNull()
    #[Test]
    #[TestDox('Comprobación de que el valor es null o no lo es')]
    public function testAssertNullNotNull(): void
    {
        $this->assertNull(null);     // Pasa, ya que es null
        $this->assertNotNull(42);    // Pasa, ya que no es null
    }

    // 📌 assertInstanceOf()
    #[Test]
    #[TestDox('Comprobación de que el objeto es una instancia de una clase específica')]
    public function testAssertInstanceOf(): void
    {
        $this->assertInstanceOf(DateTime::class, new DateTime());  // Pasa, ya que es una instancia de DateTime
    }

    // 📌 assertCount()
    #[Test]
    #[TestDox('Comprobación de la cantidad de elementos en un arreglo')]
    public function testAssertCount(): void
    {
        $this->assertCount(3, ['a', 'b', 'c']);  // Pasa, ya que el arreglo tiene 3 elementos
    }

    // 📌 assertContains()
    #[Test]
    #[TestDox('Comprobación de que un valor está presente en un arreglo')]
    public function testAssertContains(): void
    {
        $this->assertContains('PHP', ['PHP', 'Python', 'JavaScript']);  // Pasa, ya que 'PHP' está en el arreglo
    }

    // 📌 expectException()
    #[Test]
    #[TestDox('Verificar que una excepción sea lanzada')]
    public function testExpectException(): void
    {
        $this->expectException(DivisionByZeroError::class);
        $resultado = 5 / 0;  // Esto lanza una excepción
    }
}
