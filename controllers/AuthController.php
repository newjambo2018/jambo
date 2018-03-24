<?php

namespace app\controllers;

use app\common\CommonController;

class AuthController extends CommonController
{

    public function actionIndex()
    {
        // TEST!
        return $this->render('index');
    }

}