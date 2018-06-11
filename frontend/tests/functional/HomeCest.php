<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnPage(\Yii::$app->homeUrl);
        $I->see('ArTiKa');
        $I->seeLink('Login');
        $I->click('Login');
        $I->see('Iniciar sesión');
        $I->seeLink('Manual de usuario');
    }
}
