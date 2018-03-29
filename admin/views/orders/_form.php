<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShopOrder */
/* @var $form yii\widgets\ActiveForm */
$model->manager_id = \app\models\Admin::get()->id;
$model->created_by_id = \app\models\Admin::get()->id;
?>

<div class="shop-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')
        ->hint('Введите ID, USERNAME или E-MAIL клиента для его идентификации')
        ->textInput() ?>

    <?= $form->field($model, 'manager_id')
        ->textInput(['class' => 'disabled form-control']) ?>

    <?= $form->field($model, 'created_by_id')
        ->textInput(['class' => 'disabled form-control']) ?>

    <?= $form->field($model, 'name')
        ->textInput(['class' => 'disabled form-control']) ?>

    <?= $form->field($model, 'email')
        ->textInput(['class' => 'disabled form-control']) ?>

    <?= $form->field($model, 'city')
        ->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\ShopCities::find()
            ->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'status')
        ->dropDownList(\app\models\ShopOrder::getStatuses()) ?>

    <div class="form-group">
        <?= Html::submitButton('Создать!', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    window.onload = function () {
        $(document).on('change', '#shoporder-client_id', function () {
            var client_id = $(this).val();

            $.get(
                '/admin/orders/ajax-get-client-info',
                {
                    client_id: client_id
                }, function (data) {
                    data = JSON.parse(data);

                    $('#shoporder-client_id').val(data['id']).trigger('change');
                    $('#shoporder-name').val(data['name']).trigger('change');
                    $('#shoporder-email').val(data['email']).trigger('change');
                }
            )
        })
    }
</script>

<style>
    .disabled {
        pointer-events: none;
        background: #eee;
    }
</style>