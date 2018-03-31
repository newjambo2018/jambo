<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShopProducts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'category')->textInput() ?>

    <?= $form->field($model, 'sub_category')->textInput() ?>

    <?= $form->field($model, 'gender')->dropDownList([ 'Мальчик' => 'Мальчик', 'Девочка' => 'Девочка', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'age')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand')->textInput() ?>

    <?= $form->field($model, 'barcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manufacturer_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_price')->textInput() ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wholesale_price')->textInput() ?>

    <?= $form->field($model, 'vendor_code')->textInput() ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'old_retail_price')->textInput() ?>

    <?= $form->field($model, 'old_wholesale_price')->textInput() ?>

    <?= $form->field($model, 'retail_stock')->textInput() ?>

    <?= $form->field($model, 'wholesale_stock')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
