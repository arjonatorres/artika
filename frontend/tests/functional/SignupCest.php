<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class SignupCest
{
    protected $formId = '#form-signup';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('usuarios/registro');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Registrarse', 'h3');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Nombre de usuario no puede estar vacío.');
        $I->seeValidationError('Email no puede estar vacío.');
        $I->seeValidationError('Contraseña no puede estar vacío.');
        $I->seeValidationError('Confirmación de contraseña no puede estar vacío.');

    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
            'SignupForm[username]'  => 'tester',
            'SignupForm[email]'     => 'ttttt',
            'SignupForm[password]'  => 'tester_password',
            'SignupForm[password_repeat]'  => 'tester_password',
        ]
        );
        $I->dontSee('Nombre de usuario no puede estar vacío.', '.help-block');
        $I->dontSee('Contraseña no puede estar vacío.', '.help-block');
        $I->dontSee('Confirmación de contraseña no puede estar vacío.', '.help-block');
        $I->see('Email no es una dirección de correo válida.', '.help-block');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'tester',
            'SignupForm[email]' => 'tester.email@example.com',
            'SignupForm[password]' => 'tester_password',
            'SignupForm[password_repeat]'  => 'tester_password',
        ]);

        $I->seeRecord('common\models\Usuarios', [
            'username' => 'tester',
            'email' => 'tester.email@example.com',
        ]);

        $I->see('Gracias por registrarte. Comprueba tu correo para activar tu cuenta.');
    }
}
