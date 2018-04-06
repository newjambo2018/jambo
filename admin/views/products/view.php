<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ShopProducts */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Shop Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$categories = \yii\helpers\ArrayHelper::map(\app\models\ShopCategories::find()
    ->all(), 'id', 'name');
$sub_categories = \yii\helpers\ArrayHelper::map(\app\models\ShopSubCategories::find()
    ->all(), 'id', 'name');
$brands = \yii\helpers\ArrayHelper::map(\app\models\ShopBrands::find()
    ->all(), 'id', 'name');
?>
<div class="shop-products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'name',
                'label'     => 'Наименование'
            ],
            [
                'attribute' => 'product_id',
                'label'     => 'Номер продукта в 1С'
            ],
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
            [
                'attribute' => 'gender',
                'label'     => 'Пол'
            ],
            [
                'attribute' => 'age',
                'label'     => 'Возраст'
            ],
            [
                'attribute' => 'brand',
                'format'    => 'raw',
                'label'     => 'Бренд',
                'filter'    => $brands,
                'value'     => function ($data) use ($brands) {
                    return $brands[$data->brand];
                }
            ],
            [
                'attribute' => 'barcode',
                'label'     => 'Штрихкод'
            ],
            [
                'attribute' => 'manufacturer_code',
                'label'     => 'Код производителя'
            ],
            [
                'attribute' => 'retail_price',
                'format'    => 'raw',
                'label'     => 'Розничная',
                'value'     => function ($data) {
                    return "<span style='color: green;'><i class='fa fa-money-bill-alt'></i> {$data->retail_price} грн</span>";
                }
            ],
            [
                'attribute' => 'wholesale_price',
                'format'    => 'raw',
                'label'     => 'Оптовая',
                'value'     => function ($data) {
                    return "<span style='color: green;'><i class='fa fa-money-bill-alt'></i> {$data->wholesale_price} грн</span>";
                }
            ],
            [
                'attribute' => 'retail_stock',
                'format'    => 'raw',
                'label'     => 'Акция Розничная',
                'value'     => function ($data) {
                    return $data->retail_stock ? '<span style="color: green;"><i class="fa fa-check-circle"></i> Да</span>' : '<span style="color: red;"><i class="fa fa-times-circle"></i> Нет</span>';
                }
            ],
            [
                'attribute' => 'wholesale_stock',
                'format'    => 'raw',
                'label'     => 'Акция Оптовая',
                'value'     => function ($data) {
                    return $data->wholesale_stock ? '<span style="color: green;"><i class="fa fa-check-circle"></i> Да</span>' : '<span style="color: red;"><i class="fa fa-times-circle"></i> Нет</span>';
                }
            ],
            [
                'attribute' => 'vendor_code',
                'label'     => 'Артикул'
            ],
            [
                'attribute' => 'unit',
                'label'     => 'Единица измерения'
            ],
            [
                'attribute' => 'quantity',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return $data->quantity > 0 ? '<span style="color: green;"><i class="fa fa-check-circle"></i> На складе (' . $data->quantity . ')</span>' : '<span style="color:red"><i class="fa fa-times-circle"></i> Нет на складе</span>';
                }
            ],
            [
                'attribute' => 'old_retail_price',
                'label'     => 'Старая розничная цена'
            ],
            [
                'attribute' => 'old_wholesale_price',
                'label'     => 'Старая оптовая цена'
            ],
            'created_at:datetime',
            //            [
            //                'attribute' => 'description:ntext',
            //                'label' => 'Описание товара'
            //            ],
            [
                'attribute' => 'slug',
                'label'     => 'Ссылка'
            ],
            [
                'attribute' => 'image',
                'label'     => 'Картинка',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return '<div class="text-center2"><img src="/sync/products/' . $data->vendor_code . '/0.jpg" style="max-height:200px"></div>';
                }
            ],
        ],
    ]) ?>

</div>
