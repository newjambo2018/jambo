<?php
/**
 * Created by PhpStorm.
 * User: johankitelman
 * Date: 05.03.18
 * Time: 14:56
 */

namespace app\controllers;


use app\common\CommonController;
use app\models\Admin;
use app\models\Carts;
use app\models\Client;
use app\models\General;
use app\models\ShopCities;
use app\models\ShopOrder;
use app\models\ShopProducts;
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

        if (\Yii::$app->request->isPost) {
            $order = new ShopOrder();
            $items_array = General::post('item');
            $items_in = [];

            foreach ($items_array as $key => $value) $items_in[] = $key;

            $items_in_query = implode(', ', $items_in);

            $items = ShopProducts::find()
                ->select('id, retail_price')
                ->where("id IN ({$items_in_query})")
                ->all();

            $sum = 0;

            foreach ($items as $item) $sum += $item->retail_price * $items_array[$item->id];

            $client = General::getUser(1) ?: Client::find()
                ->where(['email' => General::post('email')])
                ->limit(1)
                ->one();

            $order->client_id = $client->id ?: 0;
            $order->name = General::post('name');
            $order->email = General::post('email');
            $order->manager_id = General::post('manager') ?: 0;
            $order->created_by_id = 0;
            $order->city = General::post('city');
            $order->comment = General::post('message');
            $order->status = ShopOrder::STATUS_NEW;
            $order->created_at = time();
            $order->items = serialize($items_array);
            $order->sum = $sum;
            $order->address = General::post('address');

            if($order->save()) {
                Carts::truncate();

                General::setFlash('success', '<b><i class="fa fa-check-circle"></i> Успех!</b> Ваш заказ оформлен успешно. Вскоре с Вами свяжется наш менеджер.');

                return $this->redirect('/');
            } else {
                General::setFlash('errors', '<b><i class="fa fa-times-circle"></i> Ошибка!</b> Проверьте правильность заполнения полей!');
            }
        }

        $cities = ShopCities::find()
            ->all();
        $managers = Admin::find()
            ->select('id, name, phone')
            ->where(['displayed' => 1])
            ->all();

        return $this->render('cart', ['cart' => $cart, 'cities' => $cities, 'managers' => $managers]);
    }

    public function actionRemoveFromCart($id)
    {
        if (!\Yii::$app->request->isAjax) throw new \HttpException(404);

        Carts::remove($id);

        return Carts::cartCount();
    }

}