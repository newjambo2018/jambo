<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$managers = \yii\helpers\ArrayHelper::map(\app\models\Admin::find()
    ->all(), 'id', 'name');
?>
<div class="client-view">

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
            'username',
            'email:email',
            'first_name',
            'last_name',
            [
                'attribute' => 'personal_manager',
                'format'    => 'raw',
                'value'     => function ($data) use ($managers) {
                    return $data->personal_manager ? ('<i class="fa fa-user"></i> ' . $managers[$data->personal_manager] . ' (#' . $data->personal_manager . ')') : '';
                }
            ],
            [
                'attribute' => 'is_active',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return '<div class="">' . ($data->is_active ? '<span style="color: green;"><i class="fa fa-check-circle"></i> Да</span>' : '<span style="color: red;"><i class="fa fa-times"></i> Нет</span>') . '</div>';
                }
            ],
            [
                'attribute' => 'created_at',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return Yii::$app->formatter->asDatetime($data->created_at);
                }
            ],
            'phone',
            [
                'attribute' => 'wholesale',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return
                        '<select id="wholesale_select">' .
                        '   <option value="0" ' . ($data->wholesale === 0 ? "selected": "") . '>Не оптовик</option>' .
                        '   <option value="1" ' . ($data->wholesale === 1 ? "selected": "") . '>Подтвержден</option>' .
                        '   <option value="2" ' . ($data->wholesale === 2 ? "selected": "") . '>Ожидает рассмотрения</option>' .
                        '   <option value="3" ' . ($data->wholesale === 3 ? "selected": "") . '>Отказать в оптовом доступе</option>' .
                        '</select>';
                }
            ],
            [
                'attribute' => 'retail_discount',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return '<span style="color: red;">-' . $data->retail_discount . '%</span>';
                }
            ],
            [
                'attribute' => 'wholesale_discount',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return '<span style="color: red;">-' . $data->wholesale_discount . '%</span>';
                }
            ],
            [
                'attribute' => 'subscribed',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return '<div class="">' . ($data->subscribed ? '<span style="color: green;"><i class="fa fa-check-circle"></i> Да</span>' : '<span style="color: red;"><i class="fa fa-times"></i> Нет</span>') . '</div>';
                }
            ],
        ],
    ]) ?>

</div>

<div class="alert alert-warning" id="wholesale_time_div" style="<?php if ($model->wholesale !== \app\models\Client::WHOLESALE_ACTIVE): ?>display: none<?php endif ?>">
    <div class="container">
        <h4 class="col-xs-3" style="margin-top: 9px">Временный доступ до </h4>
        <div class="col-xs-4">
            <input type="text" class="form-control" placeholder="Формат: 31.12.2018" id="wholesale_time" value="<?= $model->wholesale_timecycle ? date('d.m.Y', $model->wholesale_timecycle): ''?>" style="color: #000;">
        </div>
        <div class="col-xs-2">
            <button class="btn btn-success" id="set_time"><i class="fa fa-clock"></i> Установить</button>
        </div>
    </div>
</div>


<script>
    window.onload = function () {
        $(document).on('change', '#wholesale_select', function () {
            var _this = $(this);
            $('#wholesale_time_div').hide();

            $.get(
                '/admin/clients/ajax-wholesale-change',
                {
                    client_id: "<?= $model->id ?>",
                    wholesale: _this.val()
                }, function (data) {
                    data = JSON.parse(data);
                    $('#wholesale_time').val('');
                    if (_this.val() === "1") $('#wholesale_time_div').show();

                    notify(data['text'], data['type']);
                }
            )
        }).on('click', '#set_time', function () {
            var time = $('#wholesale_time').val();

            $.get(
                '/admin/clients/ajax-wholesale-change-time',
                {
                    client_id: "<?= $model->id ?>",
                    time: time
                }, function (data) {
                    data = JSON.parse(data);

                    notify(data['text'], data['type']);
                }
            )
        })
    }
</script>