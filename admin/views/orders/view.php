<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ShopOrder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Shop Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$managers = \yii\helpers\ArrayHelper::map(\app\models\Admin::find()
    ->all(), 'id', 'name');
$cities = \yii\helpers\ArrayHelper::map(\app\models\ShopCities::find()
    ->all(), 'id', 'name');
?>
<div class="shop-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'client_id',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return "<a href=\"/admin/clients/view?id={$data->client_id}\">(#{$data->client_id}) {$data->name}</a>";
                }
            ],
            [
                'attribute' => 'manager_id',
                'format'    => 'raw',
                'label'     => 'Идентификатор менеджера',
                'value'     => function ($data) use ($managers) {
                    return "(#{$data->manager_id}) " . $managers[$data->manager_id];
                }
            ],
            [
                'attribute' => 'created_by_id',
                'format'    => 'raw',
                'label'     => 'Создан вручную менеджером',
                'value'     => function ($data) {
                    return $data->created_by_id ?: 'Нет';
                }
            ],
            [
                'attribute' => 'name',
                'label'     => 'Имя'
            ],
            'email:email',
            [
                'attribute' => 'sum',
                'format'    => 'raw',
                'label'     => 'Сумма',
                'value'     => function ($data) {
                    return '<span style="color: green;"><i class="fa fa-money"></i> ' . $data->sum . ' грн</span>';
                }
            ],
            [
                'attribute' => 'sum_discount',
                'format'    => 'raw',
                'label'     => 'Сумма скидки',
                'value'     => function ($data) {
                    return '<span style="color: red;">-' . $data->sum_discount . ' грн</span>';
                }
            ],
            //            'delivery',
            //            'delivery_price',
            //            'address',
            [
                'attribute' => 'city',
                'format'    => 'raw',
                'label'     => 'Город',
                'value'     => function ($data) use ($cities) {
                    return $cities[$data->city];
                }
            ],
            [
                'attribute' => 'comment',
                'format'    => 'raw',
                'label'     => 'Комментарий покупателя'
            ],
            [
                'attribute' => 'status',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return \app\models\ShopOrder::getAdminStatuses()[$data->status];
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <div class="col-xs-12">
        <h3>Заказанные позиции</h3>
        <?

        $items = [];

        foreach (json_decode($model->items, 1) as $key => $value) $items[] = $key;

        $items_query = implode(', ', $items);
        $items = \app\models\ShopProducts::find()
            ->where("id IN ($items_query)")
            ->all();
        ?>

        <? foreach ($items as $item) { ?>
            <div class="col-xs-12" style="border: 1px solid #eee;padding: 10px;margin-top: 10px;">
                <div class="col-xs-1 text-center">
                    <img src="/images/product-details/1.jpg" alt="" style="max-height: 50px">
                </div>
                <div class="col-xs-5" style="padding-top: 15px">
                    <?= $item->name ?> <b>Артикул: <?= $item->vendor_code ?></b>
                </div>
                <div class="col-xs-2 text-center" style="padding-top: 8px">
                    <input type="number" class="form-control" value="<?= json_decode($model->items, 1)[$item->id] ?>">
                </div>
                <div class="col-xs-3 text-center" style="padding-top: 15px;font-size: 17px">
                    <?= number_format($item->retail_price, 2) ?> грн
                </div>
                <div class="col-xs-1 text-center" style="padding-top: 10px;">
                    <i class="fa fa-times" style="font-size: 25px"></i>
                </div>
            </div>
        <? } ?>
    </div>

</div>
