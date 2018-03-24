<?php
/**
 * Created by PhpStorm.
 * User: johankitelman
 * Date: 05.03.18
 * Time: 15:39
 */

namespace app\common;

use app\models\Carts;
use app\models\General;

class CommonController extends \yii\web\Controller
{

    public function beforeAction($action)
    {
        $cookie = General::getCookie('c_id');

        if (!$cookie) {
            $cart_id = General::newToken();

            General::setCookie('c_id', $cart_id, time() + 30 * 24 * 60);
        }

        return parent::beforeAction($action);
    }

}