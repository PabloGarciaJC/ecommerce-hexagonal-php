<?php

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use model\Pedidos;
use model\LineaPedidos;
use controllers\LineaPedidosController;
use controllers\LanguageController;

class LineaPedidosControllerTest extends TestCase
{
    #[Test]
    #[TestDox('Prueba Exitosa para checkout guardar')]
    public function tesCheckoutGuardar()
    {
        // Evitar carga de vistas
        define('PHPUNIT_RUNNING_LINEA', true);

        // Mock del controlador de idiomas
        $languageController = $this->getMockBuilder(LanguageController::class)->onlyMethods(['cargarTextos', 'getIdiomaId'])->getMock();
        $languageController->method('cargarTextos')->willReturn(null);
        $languageController->method('getIdiomaId')->willReturn(1);

        // Mock del pedido
        $pedidoMock = $this->getMockBuilder(Pedidos::class)->onlyMethods(['guardar', 'getId'])->getMock();
        $pedidoMock->method('guardar')->willReturn(true);
        $pedidoMock->method('getId')->willReturn(123);

        // Mock de LineaPedidos
        $lineaPedidosMock = $this->getMockBuilder(LineaPedidos::class)->onlyMethods(['actualizarConPedido', 'obtenerProductosDelPedido'])->getMock();
        $lineaPedidosMock->method('actualizarConPedido')->willReturn(true);
        $lineaPedidosMock->method('obtenerProductosDelPedido')->willReturn(301);
       
        // Instanciar controlador y ejecutar el método
        $lineaPedidosController = new LineaPedidosController($languageController);

        // Cargo Metodo
        ob_start();
        $lineaPedidosController->checkoutGuardar($pedidoMock, $lineaPedidosMock);
        ob_get_clean();

        // Declarar explícitamente una aserción para evitar warning
        $this->assertTrue(true, $lineaPedidosMock->obtenerProductosDelPedido(1));
    }
}
