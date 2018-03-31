<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\admin\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shop Orders';
$this->params['breadcrumbs'][] = $this->title;
$managers = \yii\helpers\ArrayHelper::map(\app\models\Admin::find()
    ->all(), 'id', 'name');
$cities = \yii\helpers\ArrayHelper::map(\app\models\ShopCities::find()
    ->all(), 'id', 'name');
?>
<div class="shop-order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать заказ вручную', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'      => 'id',
                'format'         => 'raw',
                'contentOptions' => [
                    'style' => 'width: 20px !important;text-align:center'
                ]
            ],
            //            'client_id',
            [
                'attribute'      => 'manager_id',
                'format'         => 'raw',
                'contentOptions' => [
                    'style' => 'width: 15% !important;text-align:center'
                ],
                'value'          => function ($data) use ($managers) {
                    return '<i class="fa fa-user"></i> ' . $managers[$data->manager_id] . ' (#' . $data->manager_id . ')';
                }
            ],
            //            'created_by_id',
            'name',
            //'email:email',
            [
                'attribute'      => 'sum',
                'format'         => 'raw',
                'contentOptions' => [
                    'style' => 'text-align:center'
                ],
                'value'          => function ($data) {
                    return '<i class="fa fa-money"></i> ' . $data->sum . ' грн';
                }
            ],
            //'sum_discount',
            [
                'attribute'      => 'items',
                'format'         => 'raw',
                'label'          => 'Товаров',
                'contentOptions' => [
                    'style' => 'text-align:center'
                ],
                'value'          => function ($data) {
                    return '<i class="fa fa-shopping-cart"></i> ' . count(json_decode($data->items, 1));
                }
            ],
            //'delivery',
            //'delivery_price',
            //'address',
            [
                'attribute' => 'city',
                'format'    => 'raw',
                'label'     => 'Город',
                'filter'    => \yii\helpers\ArrayHelper::map(\app\models\ShopCities::find()
                    ->all(), 'id', 'name'),
                'value'     => function ($data) use ($cities) {
                    return $cities[$data->city];
                }
            ],
            //'comment:ntext',
            [
                'attribute' => 'status',
                'format'    => 'raw',
                'filter'    => \app\models\ShopOrder::getStatuses(),
                'value'     => function ($data) {
                    return '<div class="text-center">' . \app\models\ShopOrder::getAdminStatuses()[$data->status] . '</div>';
                }
            ],
            //'created_at',
            //'updated_at',

            [
                'attribute' => 'Actions',
                'format' => 'raw',
                'value'     => function ($data) {
                    return "<a href=\"/admin/orders/view?id={$data->id}\" title=\"View\" aria-label=\"View\" data-pjax=\"0\"><span class=\"glyphicon glyphicon-eye-open\"></span></a> 
                            <a href=\"/admin/orders/update?id={$data->id}\" title=\"Update\" aria-label=\"Update\" data-pjax=\"0\"><span class=\"glyphicon glyphicon-pencil\"></span></a> " . (\app\models\Admin::get()->is_superuser ? "<a href=\"/admin/orders/delete?id={$data->id}\" title=\"Delete\" aria-label=\"Delete\" data-pjax=\"0\" data-confirm=\"Are you sure you want to delete this item?\" data-method=\"post\"><span class=\"glyphicon glyphicon-trash\"></span></a>" : "");
                }
            ],
        ],
    ]); ?>
</div>
