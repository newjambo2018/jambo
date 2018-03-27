<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-view">

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
            'name',
            'email:email',
            [
                'attribute' => 'is_superuser',
                'format'    => 'raw',
                'label'     => 'Уровень доступа',
                'value'     => function ($data) {
                    return '<div class="">' . ($data->is_superuser ? '<span style="color: green;"><i class="fa fa-shield"></i> Администратор</span>' : '<span style="color: orange;"><i class="fa fa-user"></i> Менеджер</span>') . '</div>';
                }
            ],
            [
                'attribute' => 'active',
                'format'    => 'raw',
                'label'    => 'Активен',
                'value'     => function ($data) {
                    return '<div class="">' . ($data->is_superuser ? '<span style="color: green;"><i class="fa fa-check-circle"></i> Да</span>' : '<span style="color: red;"><i class="fa fa-times"></i> Нет</span>') . '</div>';
                }
            ],
            [
                'attribute' => 'active',
                'format'    => 'raw',
                'label'    => 'Показан в списке менеджеров',
                'value'     => function ($data) {
                    return '<div class="">' . ($data->displayed ? '<span style="color: green;"><i class="fa fa-check-circle"></i> Да</span>' : '<span style="color: red;"><i class="fa fa-times"></i> Нет</span>') . '</div>';
                }
            ],
        ],
    ]) ?>

</div>
