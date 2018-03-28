<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\admin\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <h1>Менеджеры</h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Admin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'format' => 'raw',
                'label' => 'Идентификатор'
            ],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'label' => 'Имя'
            ],
            'email:email',
            [
                'attribute' => 'is_superuser',
                'format'    => 'raw',
                'label'     => 'Доступ',
                'value'     => function ($data) {
                    return '<div class="text-center">' . ($data->is_superuser ? '<span style="color: green;"><i class="fa fa-shield"></i> Администратор</span>' : '<span style="color: orange;"><i class="fa fa-user"></i> Менеджер</span>') . '</div>';
                }
            ],
            [
                'attribute' => 'active',
                'format'    => 'raw',
                'label' => 'Активен',
                'value'     => function ($data) {
                    return '<div class="text-center">' . ($data->active ? '<span style="color: green;"><i class="fa fa-check-circle"></i> Да</span>' : '<span style="color: red;"><i class="fa fa-times"></i> Нет</span>') . '</div>';
                }
            ],
            [
                'attribute' => 'active',
                'format'    => 'raw',
                'label' => 'Показан',
                'value'     => function ($data) {
                    return '<div class="text-center">' . ($data->displayed ? '<span style="color: green;"><i class="fa fa-check-circle"></i> Да</span>' : '<span style="color: red;"><i class="fa fa-times"></i> Нет</span>') . '</div>';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
