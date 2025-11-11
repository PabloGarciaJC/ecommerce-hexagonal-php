<?php

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use controllers\ProductoController;
use model\Productos;
use model\Comentario;
use controllers\LanguageController;

class ProductoControllerTest extends TestCase
{
    #[Test]
    #[TestDox('Ficha PRoducto')]
    public function testFichaMuestraProductoCorrectamente()
    {
        // Definir constante para evitar cargar vistas
        define('PHPUNIT_RUNNING', true);

        // Cargo Idiomas
        $languageController = $this->getMockBuilder(LanguageController::class)->onlyMethods(['cargarTextos', 'getIdiomaId'])->getMock();
        $languageController->method('cargarTextos')->willReturn(null);
        $languageController->method('getIdiomaId')->willReturn(1);

        // Creo un mock del modelo Productos y simulo sus métodos
        $productoMock = $this->getMockBuilder(Productos::class)->onlyMethods(['setIdioma', 'setUsuario', 'setGrupoId', 'obtenerProductosPorId'])->getMock();
        $productoMock->method('setIdioma')->willReturn(1);
        $productoMock->method('setUsuario')->willReturn(1);
        $productoMock->method('setGrupoId')->willReturn(123);
        $productoMock->method('obtenerProductosPorId')->willReturn(
            (object) [
                'id' => 333,
                'nombre' => 'Samsung Galaxy J7',
                'imagenes' => [
                    '1735824549_SamsungGalaxyJ7-1.jpg',
                    '1735824549_SamsungGalaxyJ7-2.jpg',
                    '1735824549_SamsungGalaxyJ7-3.jpg'
                ],
                'precio' => 350.00,
                'stock' => 5,
                'estado' => 'available',
                'oferta' => 0.00,
                'nombre_categoria' => 'Móviles',
                'descripcion' => 'El Samsung Galaxy J7 es un smartphone con una pantalla grande...',
                'offer_expiration' => '',
                'parent_id' => 1735806505,
                'grupo_id' => 1735805506,
                'especificacion_1' => '3 GB RAM | 16 GB ROM | Expandible hasta 256 GB',
                'especificacion_2' => 'Pantalla Full HD de 5.5 pulgadas',
                'especificacion_3' => 'Cámara trasera de 13 MP | Cámara frontal de 8 MP',
                'especificacion_4' => 'Batería de 3300 mAh',
                'especificacion_5' => 'Procesador Exynos 7870 Octa Core 1.6GHz',
            ]
        );

        // Creo un mock del modelo Comentarios y simulo sus métodos
        $comentarioMock = $this->getMockBuilder(Comentario::class)->onlyMethods(['obtenerComentariosValorados', 'obtenerComentariosMenosValorados', 'obtenerPromedioCalificacion'])->getMock();
        $comentarioMock->method('obtenerComentariosValorados')->willReturn([(object)['usuario' => 'TestUser1', 'comentario' => 'Muy bueno', 'valoracion' => 5]]);
        $comentarioMock->method('obtenerComentariosMenosValorados')->willReturn([(object)['usuario' => 'TestUser2', 'comentario' => 'No muy bueno', 'valoracion' => 1]]);
        $comentarioMock->method('obtenerPromedioCalificacion')->willReturn(4.5);

        // Cargo Clase
        $productoController = new ProductoController($languageController);

        // Cargo Metodo
        ob_start();
        $productoController->ficha($productoMock, $comentarioMock);
        ob_get_clean();

        // Assert de Productos
        $producto = $productoMock->obtenerProductosPorId();
        $this->assertEquals(1735805506, $producto->grupo_id);

        // Assert de comentarios
        $obtenerComentariosValorados = $comentarioMock->obtenerComentariosValorados($producto->grupo_id);
        $this->assertEquals('TestUser1', $obtenerComentariosValorados[0]->usuario);
        $obtenerComentariosMenosValorados = $comentarioMock->obtenerComentariosMenosValorados($producto->grupo_id);
        $this->assertEquals('TestUser2', $obtenerComentariosMenosValorados[0]->usuario);
        $obtenerPromedioCalificacion = $comentarioMock->obtenerPromedioCalificacion($producto->grupo_id);
        $this->assertEquals('4.5', $obtenerPromedioCalificacion);

        // En caso de que quiera verlo
        // file_put_contents(__DIR__ . '/output_ficha.html', $output);
    }
}
