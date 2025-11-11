<?php

use PHPUnit\Framework\TestCase;
use model\Usuario;

class RegistroYPerfilTest extends TestCase
{

    public function testRegistroYActualizacionPerfil()
    {
        // Registrar Usuario
        $_POST = [
            'usuario' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => '123456',
            'confirmarPassword' => '123456',
            'checked' => 'on',
        ];

        $ObjUsuario = new Usuario();
        $ObjUsuario->setUsuario($_POST['usuario']);
        $ObjUsuario->setEmail($_POST['email']);
        $ObjUsuario->setPassword($_POST['confirmarPassword']);
        $ObjUsuario->setRol(21);
        $ObjUsuario->crear();

        // Actualizar perfil
        $_POST = [
            'id' => $ObjUsuario->getId(),
            'usuario' => 'pablo',
            'Nombres' => 'pablo',
            'Apellidos' => 'garcia',
            'NumeroDocumento' => 'y6005812c',
            'NroTelefono' => '672354875',
            'Direccion' => 'Malaga',
            'Pais' => 'España',
            'Ciudad' => 'Malaga',
            'CodigoPostal' => '29009',
            'imagen' => '',
        ];

        $ObjUsuario->setId($_POST['id']);
        $ObjUsuario->setUsuario($_POST['usuario']);
        $ObjUsuario->setNombres($_POST['Nombres']);
        $ObjUsuario->setApellidos($_POST['Apellidos']);
        $ObjUsuario->setNumeroDocumento($_POST['NumeroDocumento']);
        $ObjUsuario->setNroTelefono($_POST['NroTelefono']);
        $ObjUsuario->setDireccion($_POST['Direccion']);
        $ObjUsuario->setPais($_POST['Pais']);
        $ObjUsuario->setCiudad($_POST['Ciudad']);
        $ObjUsuario->setCodigoPostal($_POST['CodigoPostal']);
        $ObjUsuario->actualizar();

        $this->assertEquals(TRUE, $ObjUsuario->actualizar());
    }
}
