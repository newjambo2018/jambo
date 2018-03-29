<?php

namespace app\admin\controllers;

use app\models\Admin;
use app\models\Client;
use app\models\General;
use app\models\ShopProducts;
use Yii;
use app\models\ShopOrder;
use app\admin\models\OrdersSearch;
use app\admin\AdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for ShopOrder model.
 */
class OrdersController extends AdminController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [

                ],
            ],
        ];
    }

    /**
     * Lists all ShopOrder models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $admin = Admin::get();
        $params = Yii::$app->request->queryParams;

        if (!$admin->is_superuser) $params['OrdersSearch']['manager_id'] = $admin->id;

        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ShopOrder model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ShopOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShopOrder();

        if ($model->load(Yii::$app->request->post())) {
            $model->sum = 0;
            $model->items = json_encode([]);
            if (!$model->save()) General::printR($model->errors);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ShopOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ShopOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)
            ->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ShopOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return ShopOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopOrder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAjaxQuantity($order_id, $item_id, $quantity)
    {
        $order = ShopOrder::find()
            ->where(['id' => $order_id])
            ->limit(1)
            ->one();

        $items = json_decode($order->items, 1);
        Yii::warning(print_r([$item_id, $items], 1));

        if (key_exists($item_id, $items)) $items[$item_id] = $quantity;

        Yii::error(print_r([$item_id, $items], 1));


        $order->items = json_encode($items);
        $recalculated_sum = $this->recalculateSum($items, $order->client_id ?: false);

        $order->sum = $recalculated_sum['sum'];
        $order->sum_discount = $recalculated_sum['sum_discount'];

        if ($order->save()) {

            return json_encode(['sum' => $order->sum, 'sum_discount' => $order->sum_discount]);
        }

        return json_encode($order->errors);
    }

    public function actionAjaxDelete($order_id, $item_id)
    {
        $order = ShopOrder::find()
            ->where(['id' => $order_id])
            ->limit(1)
            ->one();

        $items = json_decode($order->items, 1);
        if (key_exists($item_id, $items)) unset($items[$item_id]);

        Yii::error(print_r($items, 1));

        $order->items = json_encode($items);
        if ($items) {
            $recalculated_sum = $this->recalculateSum($items, $order->client_id ?: false);

            $order->sum = $recalculated_sum['sum'];
            $order->sum_discount = $recalculated_sum['sum_discount'];
        } else $order->sum = 0;

        if ($order->save()) {

            return json_encode(['sum' => $order->sum, 'sum_discount' => $order->sum_discount]);
        }

        return json_encode($order->errors);
    }

    public function recalculateSum($items_array, $client_id)
    {
        $items_in = [];

        foreach ($items_array as $key => $value) $items_in[] = $key;

        $items_in_query = implode(', ', $items_in);

        $items = ShopProducts::find()
            ->where("id IN ({$items_in_query})")
            ->all();

        $sum = 0;
        $sum_discount = 0;

        foreach ($items as $item) {
            $price = General::actualPrice($item, $client_id);
            $sum += $price * $items_array[$item->id];

            $sum_discount += (General::isWholesale($client_id) ? $item->wholesale_price - $price : $item->retail_price - $price) * $items_array[$item->id];
        }

        return ['sum' => $sum, 'sum_discount' => $sum_discount];
    }

    public function actionAjaxAddByVendorCode($order_id, $vendor_code)
    {
        $order = ShopOrder::find()
            ->where(['id' => $order_id])
            ->limit(1)
            ->one();

        $new_item = ShopProducts::find()
            ->where(['vendor_code' => $vendor_code])
            ->limit(1)
            ->one();

        if (!$new_item) return json_encode(['status' => 'error', 'message' => 'Товар с таким артикулом не найден в базе!']);

        $items = json_decode($order->items, 1);

        if (key_exists($new_item->id, $items)) return json_encode(['status' => 'error', 'message' => 'Товар с таким артикулом уже присутствует в заказе!']); else $items[$new_item->id] = "1";

        $order->items = json_encode($items);
        if ($items) {
            $recalculated_sum = $this->recalculateSum($items, $order->client_id ?: false);

            $order->sum = $recalculated_sum['sum'];
            $order->sum_discount = $recalculated_sum['sum_discount'];
        } else $order->sum = 0;

        if ($order->save()) {

            return json_encode(['status' => 'success', 'data' => $this->renderAjax('item', ['item' => $new_item, 'model' => $order]), 'sum' => $order->sum, 'sum_discount' => $order->sum_discount]);
        }

        return json_encode($order->errors);
    }

    public function actionAjaxGetClientInfo($client_id)
    {
        $client = Client::find()
            ->where([
                'or',
                ['id' => $client_id],
                ['email' => $client_id],
                ['username' => $client_id]
            ])
            ->limit(1)
            ->one();

        return json_encode(['id' => $client->id, 'name' => $client->first_name . ' ' . $client->last_name, 'email' => $client->email]);
    }

    public function actionAjaxChangeStatus($order_id, $status)
    {
        ShopOrder::updateAll(['status' => $status], ['id' => $order_id]);

        return ShopOrder::getAdminStatuses()[$status];
    }
}
