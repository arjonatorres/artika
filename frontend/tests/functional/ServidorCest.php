<?php
namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/* @var $scenario \Codeception\Scenario */

class ServidorCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(['servidores/index']);
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'jose',
            'LoginForm[password]' => 'jose1234',
        ]);
    }

    public function checkServidores(FunctionalTester $I)
    {
        $I->see('Servidor', 'h3');
        $I->see('Dirección Web', 'label');
        $I->see('Puerto', 'label');
        $I->see('Pines Analógicos', 'h3');
        $I->see('Pines Digitales', 'h3');
    }

    public function checkServidoresSubmitNoData(FunctionalTester $I)
    {
        $I->submitForm('#servidores-form', [
            'Servidores[url]' => '',
            'Servidores[puerto]' => '',
        ]);
        $I->see('Servidor', 'h3');
        $I->seeValidationError('Dirección Web no puede estar vacío.');
        $I->seeValidationError('Puerto no puede estar vacío.');
    }

    public function checkServidoresSubmitNotCorrectUrlPuerto(FunctionalTester $I)
    {
        $I->submitForm('#servidores-form', [
            'Servidores[url]' => 'tester',
            'Servidores[puerto]' => 'test',
        ]);
        $I->seeValidationError('Dirección Web no es una URL válida.');
        $I->seeValidationError('Puerto debe ser un número entero.');
    }

    public function checkServidoresSubmitNotCorrectPuerto(FunctionalTester $I)
    {
        $I->submitForm('#servidores-form', [
            'Servidores[puerto]' => '96347',
        ]);
        $I->seeValidationError('Puerto no debe ser mayor a 65535.');
    }

    public function checkServidoresSubmitCorrectData(FunctionalTester $I)
    {
        $I->submitForm('#servidores-form', [
            'Servidores[url]' => 'http://www.ejemplo.com',
            'Servidores[puerto]' => '8082',
        ]);
        $I->see('Los datos del servidor se han guardado correctamente.');
        $I->see('Token de seguridad:');
        $I->dontSee('Dirección Web no puede estar vacío.');
        $I->dontSee('Puerto no puede estar vacío.');
    }
}
