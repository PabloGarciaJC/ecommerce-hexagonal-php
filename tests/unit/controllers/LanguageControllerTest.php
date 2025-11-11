<?php
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use controllers\LanguageController;

final class LanguageControllerTest extends TestCase
{
    protected function setUp(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    #[Test]
    #[TestDox('Obtener idioma Inglés')]
    public function testGetIdiomaFromSessionIngles()
    {
        $_SESSION['lang'] = 'en';
        $languageController = new LanguageController();
        $this->assertEquals('en', $languageController->getIdioma());
    }

    #[Test]
    #[TestDox('Obtener idioma Español')]
    public function testGetIdiomaFromSessionEspanol()
    {
        $_SESSION['lang'] = 'es';
        $languageController = new LanguageController();
        $this->assertEquals('es', $languageController->getIdioma());
    }

    #[Test]
    #[TestDox('Obtener idioma Francés')]
    public function testGetIdiomaFromSessionFrances()
    {
        $_SESSION['lang'] = 'fr';
        $languageController = new LanguageController();
        $this->assertEquals('fr', $languageController->getIdioma());
    }
}
