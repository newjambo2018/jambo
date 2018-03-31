<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\admin\models\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
$categories[''] = 'Не выбрано';
$ages[''] = 'Не выбрано';
$units[''] = 'Не выбрано';
$sub_categories[''] = 'Не выбрано';
$brands[''] = 'Не выбрано';


$ages += ArrayHelper::map(\app\models\ShopProducts::find()
    ->select('age')
    ->groupBy('age')
    ->all(), 'age', 'age');
$units += ArrayHelper::map(\app\models\ShopProducts::find()
    ->select('unit')
    ->groupBy('unit')
    ->all(), 'unit', 'unit');

$categories += \yii\helpers\ArrayHelper::map(\app\models\ShopCategories::find()
    ->all(), 'id', 'name');
$sub_categories += \yii\helpers\ArrayHelper::map(\app\models\ShopSubCategories::find()
    ->all(), 'id', 'name');
$brands += \yii\helpers\ArrayHelper::map(\app\models\ShopBrands::find()
    ->all(), 'id', 'name');

//\app\models\General::printR($categories)
?>

<div class="shop-products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'vendor_code') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'category')
        ->dropDownList($categories) ?>

    <?= $form->field($model, 'sub_category')
        ->dropDownList($sub_categories) ?>

    <?= $form->field($model, 'gender')
        ->dropDownList(['' => 'Не выбрано]', 'Мальчик' => 'Мальчик', 'Девочка' => 'Девочка']) ?>

    <?= $form->field($model, 'age')
        ->dropDownList($ages) ?>

    <?= $form->field($model, 'brand')
        ->dropDownList($brands) ?>

    <?= $form->field($model, 'barcode') ?>

    <?= $form->field($model, 'manufacturer_code') ?>

    <?= $form->field($model, 'unit')
        ->dropDownList($units) ?>

    <?= $form->field($model, 'retail_stock')
        ->dropDownList(['' => '', 0 => 'Нет', 1 => 'Да']) ?>

    <?= $form->field($model, 'wholesale_stock')
        ->dropDownList(['' => '', 0 => 'Нет', 1 => 'Да']) ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
