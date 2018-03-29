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
                'attribute' => 'retail_discount',
                'format' => 'raw',
                'value' => function ($data) {
                    return '<span style="color: red;">-' . $data->retail_discount . '%</span>';
                }
            ],
            [
                'attribute' => 'wholesale_discount',
                'format' => 'raw',
                'value' => function ($data) {
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
