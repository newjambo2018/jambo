<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\admin\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shop Products';
$this->params['breadcrumbs'][] = $this->title;
$categories = \yii\helpers\ArrayHelper::map(\app\models\ShopCategories::find()
    ->all(), 'id', 'name');
$sub_categories = \yii\helpers\ArrayHelper::map(\app\models\ShopSubCategories::find()
    ->all(), 'id', 'name');
$brands = \yii\helpers\ArrayHelper::map(\app\models\ShopBrands::find()
    ->all(), 'id', 'name');
?>
<div class="shop-products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <i class="fa fa-search"></i> Поиск <i class="fa fa-arrow-down pull-right" style="margin-top:5px"></i>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>
            </div>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            //            'id',
            [
                'attribute'      => 'name',
                'format'         => 'raw',
                'contentOptions' => [
                    'style' => 'font-size: 12px;width:20%'
                ]
            ],
            //            'product_id',
            [
                'attribute' => 'category',
                'format'    => 'raw',
                'label'     => 'Категория',
                'filter'    => $categories,
                'value'     => function ($data) use ($categories) {
                    return $categories[$data->category];
                }
            ],
            [
                'attribute' => 'sub_category',
                'format'    => 'raw',
                'label'     => 'Подкатегория',
                'filter'    => $sub_categories,
                'value'     => function ($data) use ($sub_categories) {
                    return $sub_categories[$data->sub_category];
                }
            ],
            //'gender',
            //'age',
            [
                'attribute' => 'brand',
                'format'    => 'raw',
                'label'     => 'Бренд',
                'filter'    => $brands,
                'value'     => function ($data) use ($brands) {
                    return $brands[$data->brand];
                }
            ],
            //            'barcode',
            //'manufacturer_code',
            [
                'attribute' => 'retail_price',
                'format'    => 'raw',
                'label'     => 'Розничная',
                'value'     => function ($data) {
                    return "{$data->retail_price} грн";
                }
            ],
            //'slug',
            [
                'attribute' => 'wholesale_price',
                'format'    => 'raw',
                'label'     => 'Оптовая',
                'value'     => function ($data) {
                    return "{$data->wholesale_price} грн";
                }
            ],
            [
                'attribute' => 'vendor_code',
                'format'    => 'raw',
                'label'     => 'Артикул',
            ],
            //'unit',
            [
                'attribute'      => 'quantity',
                'format'         => 'raw',
                'label'          => 'На складе',
                'contentOptions' => [
                    'class' => 'text-center'
                ]
            ],
            //'old_retail_price',
            //'old_wholesale_price',
            //'retail_stock',
            //'wholesale_stock',
            //'description:ntext',
            //'created_at',

            [
                'attribute'      => 'actions',
                'format'         => 'raw',
                'contentOptions' => [
                    'class' => 'text-center'
                ],
                'value'          => function ($data) {
                    return '<a href="/admin/products/view?id=' . $data->id . '"><i class="fa fa-eye"></i></a>';
                }
            ],
        ],
    ]); ?>
</div>
