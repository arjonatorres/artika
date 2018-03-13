<?php

namespace frontend\controllers;

class CasasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
