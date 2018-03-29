<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Client */
/* @var $form yii\widgets\ActiveForm */

$managers = \yii\helpers\ArrayHelper::map(\app\models\Admin::findAll(['displayed' => 1]), 'id', 'name')
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true])->label('Имя') ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true])->label('Фамилия') ?>

    <?= $form->field($model, 'personal_manager')->dropDownList($managers) ?>

<!--    --><?//= $form->field($model, 'is_active')->textInput() ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'id' => 'phone'])->label('Телефон') ?>

    <?= $form->field($model, 'retail_discount')->textInput()->label('Скидка розница, %') ?>

    <?= $form->field($model, 'wholesale_discount')->textInput()->label('Скидка опт, %') ?>

    <?= $form->field($model, 'subscribed')->checkbox()->label('Подписан на рассылку') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
