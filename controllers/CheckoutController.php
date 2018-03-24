<?php
/**
 * Created by PhpStorm.
 * User: johankitelman
 * Date: 05.03.18
 * Time: 14:56
 */

namespace app\controllers;


use app\common\CommonController;
use app\models\Carts;
use app\models\General;
use yii\web\Controller;

class CheckoutController extends CommonController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCart()
    {
        $cart = Carts::find()
            ->with('item')
            ->where(['cart_id' => General::getCookie('c_id')])
            ->all();

        return $this->render('cart', ['cart' => $cart]);
    }

    public function actionRemoveFromCart($id)
    {
        if (!\Yii::$app->request->isAjax) throw new \HttpException(404);

        Carts::remove($id);

        return Carts::cartCount();
    }

}