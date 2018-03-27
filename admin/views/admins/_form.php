<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->label('Имя')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->label('Пароль')->passwordInput(['maxlength' => true, 'disabled' => true])->hint('Сервис автоматически сгенерирует пароль и отправит его менеджеру по указанному e-mail.') ?>

    <?= $form->field($model, 'is_superuser')->label('Является ли администратором?')->hint('Имеет ли менеджер полный доступ к панели администратора?')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
