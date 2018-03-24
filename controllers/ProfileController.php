<?php
/**
 * Created by PhpStorm.
 * User: johankitelman
 * Date: 06.03.18
 * Time: 13:04
 */

namespace app\controllers;


use app\common\CommonController;

class ProfileController extends CommonController
{

    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionHistory()
    {
        return $this->render('history');
    }

}