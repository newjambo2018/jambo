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
use app\models\ShopDelivery;
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

        $delivery = ShopDelivery::find()
            ->all();

        if (\Yii::$app->request->isPost) {
            $order = new ShopOrder();
            $items_array = General::post('item');
            $items_in = [];

            foreach ($items_array as $key => $value) $items_in[] = $key;

            $items_in_query = implode(', ', $items_in);

            $items = ShopProducts::find()
                ->where("id IN ({$items_in_query})")
                ->all();

            $sum = 0;
            $sum_discount = 0;

            foreach ($items as $item) {
                $price = General::actualPrice($item);
                $sum += $price * $items_array[$item->id];

                $sum_discount += (General::isWholesale() ? $item->wholesale_price - $price : $item->retail_price - $price);
            }

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
            $order->items = json_encode($items_array);
            $order->sum = $sum;
            $order->sum_discount = $sum_discount;
            $order->phone = General::post('phone');
            $order->delivery = General::post('delivery');
            $order->address = General::post('delivery_address');

            if (!$order->phone || !$order->name || !$order->email) {
                General::setFlash('errors', '<b><i class="fa fa-times-circle"></i> Ошибка!</b> Проверьте правильность заполнения полей!');
            } else {
                if ($order->validate() && $order->save()) {
                    Carts::truncate();

                    Admin::orderNotification($order);

                    General::setFlash('success', '<b><i class="fa fa-check-circle"></i> Успех!</b> Ваш заказ оформлен успешно. Вскоре с Вами свяжется наш менеджер.');

                    return $this->redirect('/');
                } else {
                    General::setFlash('errors', '<b><i class="fa fa-times-circle"></i> Ошибка!</b> Проверьте правильность заполнения полей!');
                }
            }
        }

        $cities = ShopCities::find()
            ->all();
        $managers = Admin::find()
            ->select('id, name, phone')
            ->where(['displayed' => 1])
            ->all();

        return $this->render('cart', ['cart' => $cart, 'cities' => $cities, 'managers' => $managers, 'delivery' => $delivery]);
    }

    public function actionRemoveFromCart($id)
    {
        if (!\Yii::$app->request->isAjax) throw new \HttpException(404);

        Carts::remove($id);

        return Carts::cartCount();
    }

}