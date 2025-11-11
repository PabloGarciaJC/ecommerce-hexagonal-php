<?php
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use controllers\UsuarioController;
use model\Usuario;

class UsuarioControllerTest extends TestCase
{
    #[Test]
    #[TestDox('Registra un nuevo usuario exitosamente')]
    public function testRegistroExitoso()
    {
        $_POST = [
            'usuario' => 'usuarioPrueba',
            'email' => 'correo@prueba.com',
            'password' => '123456',
            'confirmarPassword' => '123456',
            'checked' => 'on'
        ];

        $_SESSION = [];

        // Crear el mock de Usuario
        $usuarioMock = $this->getMockBuilder(Usuario::class)
            ->onlyMethods(['repetidosUsuario', 'repetidosEmail', 'crear', 'iniciarSesion'])
            ->getMock();

        // Definir los comportamientos del mock
        $usuarioMock->method('repetidosUsuario')->willReturn(false);
        $usuarioMock->method('repetidosEmail')->willReturn(false);
        $usuarioMock->expects($this->once())->method('crear');
        $usuarioMock->method('iniciarSesion')->willReturn((object)['id' => 1, 'usuario' => 'usuarioPrueba']);

        // Crear el controlador
        $controller = new UsuarioController();

        // Capturar la salida del echo en el buffer
        ob_start();
        $controller->registro($usuarioMock);
        $output = ob_get_clean();

        // Convertir la salida a un array (JSON)
        $response = json_decode($output, true);

        // Verificar que la respuesta sea correcta
        $this->assertEquals(TEXT_REGISTRATION_SUCCESS_TITLE, $response['titulo']);
        $this->assertTrue($response['success']);
        $this->assertArrayHasKey('usuarioRegistrado', $_SESSION);
        $this->assertArrayHasKey('boton', $response);
    }

    #[Test]
    #[TestDox('Inicia sesión correctamente con credenciales válidas')]
    public function testLoginExitoso()
    {
        $_POST = [
            'email' => 'correo@prueba.com',
            'password' => '123456'
        ];
    
        // Crear el mock de Usuario
        $usuarioMock = $this->getMockBuilder(Usuario::class)
            ->onlyMethods(['repetidosEmail', 'iniciarSesion'])
            ->getMock();
    
        // Simular que el email ya está registrado (repetidosEmail devuelve true)
        $usuarioMock->method('repetidosEmail')->willReturn(true);
    
        // Simular el método iniciarSesion para devolver un objeto de sesión falso con una contraseña encriptada
        $usuarioMock->method('iniciarSesion')->willReturn((object)[
            'Password' => password_hash('123456', PASSWORD_DEFAULT)
        ]);
    
        $controlador = new UsuarioController();
    
        // Capturar la salida del controlador
        ob_start();
        $controlador->iniciarSesion($usuarioMock);
        $output = ob_get_clean();
    
        // Verificás que el JSON emitido tenga los mensajes esperados
        $respuesta = json_decode($output, true);
    
        $this->assertTrue($respuesta['success']);
        $this->assertEquals(LOGIN_SUCCESS, $respuesta['message']);
        $this->assertArrayHasKey('usuarioRegistrado', $_SESSION);
    }
    

}
